<html>
    <?php
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
            echo '<a href=?action=delete_plant&p_id='.$row['p_id'].'>Delete</a>';
            echo '<a href=?action=add_to_list&p_id='.$row['p_id'].'>Add To My List</a>';
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
                    <a href="?action=add_plant">Add New Plant</a>
                </td>
            </tr>
      </table> <!--//End of the table -->
   </section>
   </main> 
    </body>
</html>