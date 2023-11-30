<?php

    class Models_Banners{

        static public function searchData($table, $column, $data) {
            $sql = "SELECT $data FROM $table WHERE $column != ? AND status = ?";
            $request = $GLOBALS["db"]->selectAll($sql, array('', 1));
            return $request;
        }

        static public function getData($table, $column, $value, $data) {
            $sql = "SELECT $value FROM $table WHERE $column = ?";
            $request = $GLOBALS["db"]->auto_array($sql, array($data));
            return $request;
        }

        static public function insertBannerCtg($id, $moreData, $typeBanner, $amount) {
            $sql = "SELECT * FROM banners_category WHERE banner_type = ?";
            $request = $GLOBALS["db"]->selectAll($sql, array($typeBanner));
            $redirect = $moreData['url'];
            $arrData = array();

            if (count($request) < $amount) {
                $exists = array_filter($request, function($element) use ($id) {
                    return $element["category_id"] == $id;
                });

                if (empty($exists)) {
                    if (!empty($moreData['fatherCategory'])) {
                        $verifyHierarchy = self::hierarchyCategory($moreData['fatherCategory']);
                        $redirect = implode('/', array_reverse(array_column($verifyHierarchy, 'url'))) . '/' . $redirect;
                    }

                    if ($typeBanner == 1) {
                        $arrData[] = array("category_id" => $id, "banner_name" => $moreData['name_category'], "sliderDst" => $moreData['sliderDst'], "sliderMbl" => $moreData['sliderMbl'], "sliderDesOne" => $moreData['sliderDesOne'], "sliderDesTwo" => $moreData['sliderDesTwo'], "redirect" => $redirect, "banner_type" => $typeBanner); 
                    }else if ($typeBanner == 2) {
                        $arrData[] = array("category_id" => $id, "banner_name" => $moreData['name_category'], "banner_large" => $moreData['banner_large'], "redirect" => $redirect, "banner_type" => $typeBanner);
                    }else{
                        $arrData[] = array("category_id" => $id, "banner_name" => $moreData['name_category'], "banner_small" => $moreData['photo'], "redirect" => $redirect, "banner_type" => $typeBanner);
                    }

                    return $GLOBALS["db"]->insert_multiple("banners_category", $arrData);
                }else{
                    return "exists";
                }
            }else{
                return "excess";
            }
        }

        static public function hierarchyCategory($data) {
            $sql = "WITH RECURSIVE hierarchyCategory AS ( SELECT id_category, name_category, fatherCategory, url FROM categories WHERE id_category = ? UNION SELECT c.id_category, c.name_category, c.fatherCategory, c.url FROM categories c JOIN hierarchyCategory cj ON c.id_category = cj.fatherCategory ) SELECT url FROM hierarchyCategory";
            return $GLOBALS["db"]->selectAll($sql, array($data));
        }

        static public function insertBannerProd($id, $moreData, $typeBanner, $amount) {
            $sql = "SELECT * FROM banners_product WHERE banner_type = ?";
            $request = $GLOBALS["db"]->selectAll($sql, array($typeBanner));
            $arrData = array();

            if (count($request) < $amount) {
                $exists = array_filter($request, function($element) use ($id) {
                    return $element["product_id"] == $id;
                });

                if (empty($exists)) {
                    $name = str_replace("'", "", $moreData['name_product']);
                    if ($typeBanner == 1) {
                        $arrData[] = array("product_id" => $id, "banner_name" => $name, "sliderDst" => $moreData['sliderDst'], "sliderMbl" => $moreData['sliderMbl'], "sliderDes" => $moreData['sliderDes'], "redirect" => $moreData['url'], "banner_type" => $typeBanner); 
                    }else if ($typeBanner == 2) {
                        $arrData[] = array("product_id" => $id, "category_id" => $moreData['category_id'], "banner_name" => $name, "banner_large" => $moreData['banner_large'], "redirect" => $moreData['url'], "banner_type" => $typeBanner);
                    }
                    else{
                    //     $arrData[] = array("category_id" => $id, "banner_name" => $moreData['name_category'], "banner_small" => $moreData['photo'], "redirect" => $redirect, "banner_type" => $typeBanner);
                    }

                    return $GLOBALS["db"]->insert_multiple("banners_product", $arrData);
                }else{
                    return "exists";
                }
            }else{
                return "excess";
            }
        }

        static public function getBanners($table, $column, $type) {
            $sql = "SELECT $column FROM $table WHERE banner_type = ?";
            $request = $GLOBALS["db"]->selectAll($sql, array($type));
            return $request;
        }

        static public function modifyTBanners($table, $column, $data, $type) {
            return $GLOBALS["db"]->delete($table, "$column NOT IN ($data) AND banner_type = '$type'");
        }

        static public function deleteBanner($table, $data, $type)
        {   
            return $GLOBALS["db"]->delete($table, "id_banner = '$data' AND banner_type = '$type'");
        }

        static public function getRelatedProducts($category_id, $id)
        {   
            $sql = "SELECT id_product, name_product, brand, price, stock, prevPrice, discount, cantDues, priceDues, url FROM `products` WHERE category_id = ? AND id_product != ? AND status = ? ORDER BY id_product DESC LIMIT 8";
            return $GLOBALS["db"]->selectAll($sql, array($category_id, $id));
        }
    }
?>
