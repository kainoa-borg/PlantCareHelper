<html>
    <?php
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
        } catch (PDOException $e) {
            echo 'Error Thrown: ' . $e->getMessage();
            die();
        }
        try {
            $light_levels = $db->query(
                'SELECT
                l_id, light_level
                FROM
                LIGHT
                ');
            $light_levels = $light_levels->fetchAll();
        } catch (PDOException $e) {
            echo 'Error Thrown: ' . $e->getMessage();
            die();
        }
    ?>
    <body>
        <a href="index.php">Return Home</a>
        <form action="add_query.php">
            <label>
                Plant Name
            </label>
            <input name="p_name" type="text">
            <label>
                Water Per Week
            </label>
            <input name="water_per_week" type="number">
            <label>
                Container Size
            </label>
            <select name="container_size">
                <option value="Small">Small</option>
                <option value="Medium">Medium</option>
                <option value="Large">Large</option>
            </select>
            <label>
                Soil Type
            </label>
            <select name="soil_id">
                <?php
                    foreach($soil_types as $soil) {
                        echo '<option value="'.$soil['s_id'].'">';
                        echo $soil['soil_type'];
                        echo '</option>';
                    } 
                ?>
            </select>
            <label>
                Light Level
            </label>
            <select name="light_id">
                <?php
                    foreach($light_levels as $light) {
                        echo '<option value="'.$light['l_id'].'">';
                        echo $light['light_level'];
                        echo '</option>';
                    } 
                ?>
            </select>
            <input type="submit" action="Submit">
        </form>
    </body>
</html>