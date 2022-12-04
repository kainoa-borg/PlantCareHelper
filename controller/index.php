<?php
    require("../model/plant_db.php");
    require("../model/auth.php");
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
        if ($action == NULL) {
            $action = 'landing';
        }
    }
    
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (!isset($is_logged_in)) {
        if (isset($_SESSION['is_valid']) && $_SESSION['is_valid'] == true) {
            $is_logged_in = true;
        }
        else {
            $is_logged_in = false;
        }
    }

    $is_logged_in_str = $is_logged_in ? 'style=display:none' : '';

    // echo htmlspecialchars('<p>'.$is_logged_in_str.'</p>');

    // Header
    include('../view/header.php');
    // Body
    switch($action) {
        case 'landing': {
            $result = get_plant_list();
            include('../view/plant_list.php');
            break;
        }
        case 'add_plant_form': {
            $soil_types = get_soil_types();
            $light_levels = get_light_levels();
            include('../view/add_plant.php');
            break;
        }
        case 'add_plant_query': {
            $p_name = filter_input(INPUT_POST, 'p_name');
            $water_per_week = filter_input(INPUT_POST, 'water_per_week');
            $container_size = filter_input(INPUT_POST, 'container_size');
            $soil_id = filter_input(INPUT_POST, 'soil_id');
            $light_id = filter_input(INPUT_POST, 'light_id');
            add_plant($p_name, $water_per_week, $container_size, $soil_id, $light_id);
            Header('Location: ?action=landing');
            break;
        }
        case 'delete_plant': {
            $delete_plant_id = filter_input(INPUT_GET, 'p_id');
            // echo $delete_plant_id;
            // include('../model/delete_plant.php');
            delete_plant($delete_plant_id);
            Header('Location: ?action=landing');
            break;
        }
        case 'my_list': {
            echo '<h4> Welcome '.$_SESSION['username']." here's your list!</h4>";
            if (isset($_SESSION['u_id'])) {
                $result = get_user_plant_list($_SESSION['u_id']);
                include('../view/my_plant_list.php');
            }
            else {
                echo 'not logged in.';
                die();
            }
            break;
        }
        case 'add_to_list': {
            if (isset($_SESSION['u_id'])) {
                // Can add
                $u_id = $_SESSION['u_id'];
                $p_id = $_GET['p_id'];
                add_to_user_list($p_id, $u_id);
                header('Location: ?action=my_list');
            }
            else {
                echo 'Please login to access your list';
                die();
            }
            break;
        }
        case 'remove_from_list': {
            $id_to_remove = filter_input(INPUT_GET, 'pl_id');
            remove_from_user_list($id_to_remove);
            header('Location: ?action=my_list');
            break;
        }
        case 'login': {
            if (isset($_GET['failed_last']) && $_GET['failed_last'] == true) {
                echo 'Login Failed: Check username and password.';
            }
            include('../view/login_page.php');
            break;
        }
        case 'register': {
            if (isset($_GET['failed_last']) && $_GET['failed_last'] == true) {
                echo 'Failed Registration. Username already exists.';
            }
            include('../view/register_page.php');
            break;
        }
        case 'register_user': {
            $username = filter_input(INPUT_POST, 'username');
            $password = filter_input(INPUT_POST, 'password1');
            $confirm_pass = filter_input(INPUT_POST, 'password2');
            if ($password != $confirm_pass) {
                header('Location: ?action=landing');
            }
            if (register_user($username, $password)) {
                $_SESSION['is_valid'] = true;
                header('Location: ?action=landing');
            }
            else {
                header('Location: ?action=register&failed_last=true');
            }
            break;
        }
        case 'auth': {
            $username = filter_input(INPUT_POST, 'username');
            $password = filter_input(INPUT_POST, 'password');
            if (auth_user($username, $password)) {
                $_SESSION['is_valid'] = true;
                header('Location: ?action=landing');
            }
            else {
                header('Location: ?action=login&failed_last=true');
            }
            // include('');
            break;
        }
        case 'search_plant_list': {
            $search_term = filter_input(INPUT_POST, 'search_term');
            if ($search_term == '') {
                echo 'Please enter a search term';
                Header('Location: ?action=landing');
            }
            $result = search_plant_list($search_term);
            include('../view/plant_list.php');
            break;
        }
        case 'logout': {
            session_destroy();
            header('Location: ?action=landing');
            break;
        }
        default: {
            echo 'default case. no valid action.';
        }
    }
?>