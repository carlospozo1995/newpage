<?php

    require dirname(__DIR__) . '/vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
    $dotenv->load();

    $client = \Algolia\AlgoliaSearch\SearchClient::create(
        $_ENV['ALGOLIA_APP_ID'],
        $_ENV['ALGOLIA_ADMIN_API_KEY']
    );

    $index_products = $client->initIndex('index_products');
    $index_images = $client->initIndex('index_images');

    $host = $_ENV['HOST'];
    $username = $_ENV['USER'];
    $password = $_ENV['PASSWORD'];
    $database = $_ENV['DATABASE'];

    $mysqli = new mysqli($host, $username, $password, $database);

    if ($mysqli->connect_error) {
        die("Error de conexión a MySQL: " . $mysqli->connect_error);
    }

    $sql_products = "SELECT id_product, name_category, name_product, desMain, tags, brand, price, stock, prevPrice, discount, cantDues, priceDues, url FROM products WHERE status = 1";
    $result_products = $mysqli->query($sql_products);

    if ($result_products->num_rows > 0) {
        $records_products = [];

        while ($row = $result_products->fetch_assoc()) {
            $row['objectID'] = $row['id_product'];


            unset($row['id_product']);
            $records_products[] = $row;
        }

        $index_products->replaceAllObjects($records_products, ['autoGenerateObjectIDIfNotExist' => true]);
    }

    $sql_img = "SELECT * FROM img_product";
    $result_img = $mysqli->query($sql_img);

    if ($result_img->num_rows > 0) {
        $records_img = [];

        while ($row_img = $result_img->fetch_assoc()) {
            $row_img['objectID'] = $row_img['id_img'];


            unset($row_img['id_img']);
            $records_img[] = $row_img;
        }

        $index_images->replaceAllObjects($records_img, ['autoGenerateObjectIDIfNotExist' => true]);
    }

    $result_products->free();
    $result_img->free();
    $mysqli->close();
?>