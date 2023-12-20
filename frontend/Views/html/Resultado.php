<?php

$searchData = $template_vars;
$searchedProducts = Models_Resultado::showSearchData($template_vars);

Utils::dep($searchedProducts);
// Utils::dep($searchedProducts['dataSummary']);

//     if (isset($searchedProducts['number_data'])) {
//         echo "existe";
//     }else{
//         echo "no existe";
//     }

// if (!empty($searchedProducts['products'])) {
    
// }else{

// }

?>