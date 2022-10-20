<html>
    <?php
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
        } catch (PDOException $e) {
            echo 'Error Thrown: ' . $e->getMessage();
            die();
        }

        function display_row($row) {
            echo '<tr>';
            echo '<td>';
            echo $row['p_id'];
            echo '</td>';
            echo '<td>';
            echo $row['p_name'];
            echo '</td>';
            echo '<td>';
            echo $row['water_per_week'];
            echo '</td>';
            echo '<td>';
            echo $row['container_size'];
            echo '</td>';
            echo '<td>';
            echo $row['soil_type'];
            echo '</td>';
            echo '<td>';
            echo $row['light_level'];
            echo '</td>';
            echo '<td>';
            echo '<a href=delete_plant.php?p_id='.$row['p_id'].'>Delete</a>';
            echo '</td>';
            echo '</tr>';
        }
    ?>
    <body>
    <main>
   <h1>Plant Care Helper</h1>
   <section>
      <table>
         <tr>
            <th>
                Plant ID
            </th>
            <th>
                Plant Name
            </th>
            <th>
                Water Per Week
            </th>
            <th>
                Container Size
            </th>
            <th>
                Soil Type
            </th>
            <th>
                Light Level
            </th>
         </tr> <!--//This will end the first row.-->

        <?php
        foreach ($result as $row)
            display_row($row);
        ?>
            <tr>
                <td>
                    <a href="add_plant.php">Add New Plant</a>
                </td>
            </tr>
      </table> <!--//End of the table -->
   </section>
   </main> 
    </body>
</html>