<?php
    function get_plant_list($plantuser = 'global') {
        $user = 'root';
        $pass = '';
            $db = new PDO('mysql:host=localhost;dbname=pch', $user, $pass);
        try {
            $result = $db->query(
                'SELECT 
                p_id, 
                p_name, 
                water_per_week,
                container_size,
                soil_type,
                light_level
                FROM PLANT INNER JOIN SOIL INNER JOIN LIGHT 
                WHERE soil_id = s_id AND light_id = l_id
                ORDER BY p_id ASC
                ');
            return $result;
        } catch (PDOException $e) {
            echo 'Error Thrown: ' . $e->getMessage();
            die();
        }
    }
    function get_soil_types() {
        $user = 'root';
        $pass = '';
        $db = new PDO('mysql:host=localhost;dbname=pch', $user, $pass);
        try {
            $soil_types = $db->query(
                'SELECT
                s_id, soil_type
                FROM
                SOIL
                ');
            $soil_types = $soil_types->fetchAll();
            return $soil_types;
        } catch (PDOException $e) {
            echo 'Error Thrown: ' . $e->getMessage();
            die();
        }
    }
    function get_light_levels() {
        $user = 'root';
        $pass = '';
        $db = new PDO('mysql:host=localhost;dbname=pch', $user, $pass);
        try {
            $light_levels = $db->query(
                'SELECT
                l_id, light_level
                FROM
                LIGHT
                ');
            $light_levels = $light_levels->fetchAll();
            return $light_levels;
        } catch (PDOException $e) {
            echo 'Error Thrown: ' . $e->getMessage();
            die();
        }
    }
?>