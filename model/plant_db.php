<?php
    function add_to_user_list($p_id, $u_id) {
        $user = 'root';
        $pass = '';
        $db = new PDO('mysql:host=localhost;dbname=pch', $user, $pass);
        try {
            $result = $db->query(
                'INSERT INTO user_plant (plant_id, user_id)
                VALUES (
                    "'.$p_id.'",
                    "'.$u_id.'"
                )
                ');
            return $result;
        } catch (PDOException $e) {
            echo 'Error Thrown: ' . $e->getMessage();
            die();
        }
    }
    function remove_from_user_list($pl_id) {
        $user = 'root';
        $pass = '';
        $db = new PDO('mysql:host=localhost;dbname=pch', $user, $pass);
        try {
            $result = $db->query(
                'DELETE FROM user_plant 
                WHERE pl_id = "'.$pl_id.'"
                ');
            return $result;
        } catch (PDOException $e) {
            echo 'Error Thrown: ' . $e->getMessage();
            die();
        }
    }
    function get_user_plant_list($u_id) {
        $user = 'root';
        $pass = '';
        $db = new PDO('mysql:host=localhost;dbname=pch', $user, $pass);
        try {
            $result = $db->query(
                'SELECT 
                pl_id,
                p_id, 
                p_name, 
                water_per_week,
                container_size,
                soil_type,
                light_level
                FROM PLANT INNER JOIN SOIL INNER JOIN LIGHT INNER JOIN user_plant INNER JOIN user
                WHERE soil_id = s_id AND light_id = l_id AND plant_id = p_id AND user_id = u_id AND u_id = "'.$u_id.'"
                ORDER BY pl_id ASC
                ');
            return $result;
        } catch (PDOException $e) {
            echo 'Error Thrown: ' . $e->getMessage();
            die();
        }
    }
    function get_plant_list() {
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
    function add_plant($p_name, $water_per_week, $container_size, $soil_id, $light_id) {
        $user = 'root';
        $pass = '';
        $db = new PDO('mysql:host=localhost;dbname=pch', $user, $pass);
        
        $q_prelim = 'SELECT MAX(p_id) as p_id FROM PLANT';
        
        try {
            $max_p_id = $db->query($q_prelim);
            $max_p_id = $max_p_id->fetch()['p_id'];
        } catch (PDOException $e) {
            echo 'Error Thrown: ' . $e->getMessage();
            die();
        }

        $q = 'INSERT INTO
        PLANT
        VALUES
        ("'.($max_p_id+1).'"
        ,"'.$p_name.'"
        ,"'.$water_per_week.'"
        ,"'.$container_size.'"
        ,"'.$soil_id.'"
        ,"'.$light_id.'")
        ';        
        try {
            $result = $db->query($q);
        } catch (PDOException $e) {
            echo 'Error Thrown: ' . $e->getMessage();
            die();
        }
    }
    function delete_plant($delete_plant_id) {
        $user = 'root';
        $pass = '';
        $db = new PDO('mysql:host=localhost;dbname=pch', $user, $pass);
        $q = 'DELETE FROM
        PLANT        
        WHERE
        p_id = '.$delete_plant_id.'
        ';
        echo $q;
        try {
            $result = $db->query($q);
        } catch (PDOException $e) {
            echo 'Error Thrown: ' . $e->getMessage();
            die();
        }
    }
    function search_plant_list($search_term) {
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
                WHERE soil_id = s_id AND light_id = l_id AND p_name = "'.$search_term.'"
                ORDER BY p_id ASC
                ');
            return $result;
        } catch (PDOException $e) {
            echo 'Error Thrown: ' . $e->getMessage();
            die();
        }
    }
?>