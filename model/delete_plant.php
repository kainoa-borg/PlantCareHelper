<html>
    <body>
    
    <a href="../controller/index.php?action=landing">Return Home</a>

    <?php
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
    ?>

    </body>
</html>