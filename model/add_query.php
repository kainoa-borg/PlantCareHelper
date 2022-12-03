<html>
    <body>
    
    <a href="../controller/index.php?action=landing">Return Home</a>

    <?php
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
        ,"'.$_GET['p_name'].'"
        ,"'.$_GET['water_per_week'].'"
        ,"'.$_GET['container_size'].'"
        ,"'.$_GET['soil_id'].'"
        ,"'.$_GET['light_id'].'")
        ';
        echo $q;
        
        try {
            $result = $db->query($q);
        } catch (PDOException $e) {
            echo 'Error Thrown: ' . $e->getMessage();
            die();
        }
        
    ?>

    </body>
</html>