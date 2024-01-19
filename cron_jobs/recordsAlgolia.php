<?php

    require dirname(__DIR__) . '/vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
    $dotenv->load();

    $client = \Algolia\AlgoliaSearch\SearchClient::create(
        $_ENV['ALGOLIA_APP_ID'],
        $_ENV['ALGOLIA_ADMIN_API_KEY']
    );

    $index = $client->initIndex('index_products');

    $host = $_ENV['HOST'];
    $username = $_ENV['USER'];
    $password = $_ENV['PASSWORD'];
    $database = $_ENV['DATABASE'];

    $mysqli = new mysqli($host, $username, $password, $database);

    if ($mysqli->connect_error) {
        die("Error de conexión a MySQL: " . $mysqli->connect_error);
    }

    $sql = "SELECT id_product, name_category, name_product, desMain, tags, brand, price, stock, prevPrice, discount, cantDues, priceDues, datacreate, url FROM products WHERE status = 1";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $records = [];

        while ($row = $result->fetch_assoc()) {
            $row['objectID'] = $row['id_product'];
            $row['price'] = floatval($row['price']);
            $row['stock'] = intval($row['stock']); 
            $row['discount'] = $row['discount'] != null ? intval($row['discount']) : $row['discount'];   
            $row['prevPrice'] = $row['prevPrice'] != null ? floatval($row['prevPrice']) : $row['prevPrice'];  
            $row['cantDues'] = $row['cantDues'] != null ? intval($row['cantDues']) : $row['cantDues'];  
            $row['priceDues'] = $row['priceDues'] != null ? floatval($row['priceDues']) : $row['priceDues']; 
                    

            unset($row['id_product']);
            $records[] = $row;
        }
        
        $index->replaceAllObjects($records, ['autoGenerateObjectIDIfNotExist' => true]);
    }


    $result->free();
    $mysqli->close();
?>