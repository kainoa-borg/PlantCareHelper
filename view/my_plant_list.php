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
            echo '<a href=?action=remove_from_list&pl_id='.$row['pl_id'].'>Remove</a>';
            echo '</td>';
            echo '</tr>';
        }
    ?>
    <body>
    <main>
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
      </table> <!--//End of the table -->
   </section>
   </main> 
    </body>
</html>