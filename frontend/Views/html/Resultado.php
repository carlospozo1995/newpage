<?php

$searchData = $template_vars;
$searchedProducts = Models_Store::showSearchData($template_vars);
Utils::dep($searchedProducts);

?>