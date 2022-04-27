<?php
    /* login functions */
    function emptyFieldsLogin($username, $pw) {
        $result;
        
        if(empty($username) || empty($pw)) {
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }

    function loginUser($dbconn, $username, $pw) {
        $accountExists = accountExists($dbconn, $username, $username);

        if($accountExists === false) {
            header("Location: ../login/index.php?error=wrongdata");
            exit();
        }

        $hashedPassword = hash('SHA512', $pw);

        if($hashedPassword != $accountExists["a_pw"]) {
            header("Location: ../login/index.php?error=wrongdata");
            exit();
        }

        else if($hashedPassword == $accountExists["a_pw"]) {
            session_start();

            $_SESSION["user_id"] = $accountExists["a_id"];
            $_SESSION["user_name"] = $accountExists["a_username"];
            $_SESSION["user_img"] = $accountExists["a_img_profile"];

            include_once("../php/clearResources.inc.php");
            header("Location: ../");
            exit();
        }
    }
?>