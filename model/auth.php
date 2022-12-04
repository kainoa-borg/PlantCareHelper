<?php
    function register_user($username, $password) {
        $usernames = null;
        $user = 'root';
        $pass = '';
            $db = new PDO('mysql:host=localhost;dbname=pch', $user, $pass);
        try {
            $result = $db->query(
                'SELECT username
                FROM user
                ');
            $result = $result->fetchall();
            $usernames = [];
            foreach($result as $uname) {
                array_push($usernames, $uname['username']);
            }
        } catch (PDOException $e) {
            echo 'Error Thrown: ' . $e->getMessage();
            die();
        }
        if (isset($usernames) && in_array($username, $usernames)) {
            return false;
        }
        else {
            try {
                $result = $db->query(
                    'SELECT MAX(u_id)
                    FROM user
                    ');
                $most_recent_id = $result->fetchall();
                $most_recent_id = $most_recent_id[0][0] + 1;
            } catch (PDOException $e) {
                echo 'Error Thrown: ' . $e->getMessage();
                die();
            }
            try {
                $result = $db->query(
                    'INSERT INTO user (u_id, username, pass_hash)
                    VALUES (
                        "'.$most_recent_id.'",
                        "'.$username.'",
                        "'.password_hash($password, PASSWORD_BCRYPT).'"
                    )'
                );
            } catch (PDOException $e) {
                echo 'Error Thrown: ' . $e->getMessage();
                die();
            }
            $_SESSION['username'] = $username;
            $_SESSION['u_id'] = $most_recent_id;
            return true;
        }
    }

    function auth_user($username, $password) {
        $usernames = null;
        $user = 'root';
        $pass = '';
            $db = new PDO('mysql:host=localhost;dbname=pch', $user, $pass);
        try {
            $result = $db->query(
                'SELECT username
                FROM user
                ');
            $result = $result->fetchall();
            $usernames = [];
            foreach($result as $uname) {
                array_push($usernames, $uname['username']);
            }
        } catch (PDOException $e) {
            echo 'Error Thrown: ' . $e->getMessage();
            die();
        }
        if (isset($usernames) && in_array($username, $usernames)) {
            try {
                $result = $db->query(
                    'SELECT u_id, username, pass_hash
                    FROM user
                    WHERE user.username = "'.$username.'"
                    ');
                $result = $result->fetch();
                $verified = password_verify($password, $result['pass_hash']);
                if ($verified) {
                    $_SESSION['username'] = $result['username'];
                    $_SESSION['u_id'] = $result['u_id'];
                    return true;
                }
            } catch (PDOException $e) {
                echo 'Error Thrown: ' . $e->getMessage();
                die();
            }
        }
        else {
            echo 'Could not find '.$username.' in array '.implode(', ', $usernames).'';
            return false;
        }
        
    }
?>