<?php

$dataSearch = $_GET['search'];

$products = Models_Resultado::testSearch($dataSearch);
Utils::dep($products);

?>