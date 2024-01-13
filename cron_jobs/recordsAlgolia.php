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
    $charset = $_ENV['CHARSET'];

    $mysqli = new mysqli($host, $username, $password, $database, $charset);

    if ($mysqli->connect_error) {
        die("Error de conexión a MySQL: " . $mysqli->connect_error);
    }

    $query = "SELECT id_product, name_product, desMain, tags, brand, price, stock, prevPrice, discount, cantDues, priceDues, url FROM products WHERE status = 1";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        $records = [];

        while ($row = $result->fetch_assoc()) {
            $row['objectID'] = $row['id_product'];


            unset($row['id_product']);
            $records[] = $row;
        }

        $index->replaceAllObjects($records, ['autoGenerateObjectIDIfNotExist' => true]);
    }

    $result->free();
    $mysqli->close();
?>