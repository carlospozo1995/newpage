<?php

    class Models_Products{
        static public function getCategories()
        {
            $sql = "SELECT table1.*, table2.name_category AS fatherName FROM categories table1 LEFT JOIN categories table2 ON table1.fatherCategory = table2.id_category where table1.id_category not in (select table3.fatherCategory from categories table3 where table3.fatherCategory is not null AND table3.status = 1 ORDER BY table3.name_category ASC) AND table1.status = 1 ORDER BY table1.name_category ASC";
            return $GLOBALS["db"]->selectAll($sql, array(0));
        }
    }

?>