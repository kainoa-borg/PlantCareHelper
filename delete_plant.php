<html>
    <body>
    
    <a href="index.php">Return Home</a>

    <?php
        $user = 'root';
        $pass = '';
        $db = new PDO('mysql:host=localhost;dbname=pch', $user, $pass);
        $q = 'DELETE FROM
        PLANT        
        WHERE
        p_id = '.$_GET['p_id'].'
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