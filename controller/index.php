<?php
    require("../model/plant_db.php");
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
        if ($action == NULL) {
            $action = 'landing';
        }
    }
    // echo '<p>'.$action.'</p>';
    switch($action) {
        case 'landing': {
            $result = get_plant_list('global');
            include('../view/plant_list.php');
            break;
        }
        case 'add_plant': {
            $soil_types = get_soil_types();
            $light_levels = get_light_levels();
            include('../view/add_plant.php');
            break;
        }
        case 'delete_plant': {
            $delete_plant_id = filter_input(INPUT_GET, 'p_id');
            echo $delete_plant_id;
            include('../model/delete_plant.php');
            break;
        }
        default: {
            echo 'goodbye world';
        }
    }
?>