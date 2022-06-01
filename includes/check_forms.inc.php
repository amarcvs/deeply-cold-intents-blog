<!-- functions for form server-side checks, creating users and login -->
<?php
    include_once('utility.inc.php');

    /* sign up functions */
    function emptyFieldsSignup($email, $username, $pw, $pwRepeated) {
        $result;
        if(empty($email) || empty($username) || empty($pw) || empty($pwRepeated)) {
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
    }

    function invalidEmail($email) {
        $result;
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
    }

    function invalidUsername($username) {
        $result;
        if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
    }

    function passwordMatch($pw, $pwRepeated) {
        $result;
        if($pw !== $pwRepeated) {
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
    }

    function accountExists($dbconn, $email, $username) {
        $email = strtolower($email);

        $existsQuery = "SELECT * FROM account WHERE a_email = $1 OR a_username = $2;";
        $result = makeAQuery($existsQuery, array($email, $username), 'checkForms');

        if($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            return $line;
        }

        else {
            $result = false;
            return $result;
        }
    }

    function createUser($dbconn, $email, $username, $pw) {
        $hashedPassword     = hash('SHA512', $pw);

        $createAccountQuery = "INSERT INTO account (a_email, a_username, a_pw) VALUES ($1, $2, $3);";
        makeAQuery($createAccountQuery, array($email, $username, $hashedPassword), "checkForms");

        // header('Location: ../signup/index.php?error=none');
        header('Location: /profile/index.php?message=mod');
        exit();
    }

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
            header('Location: ../login/index.php?error=wrongdata');
            exit();
        }

        $hashedPassword = hash('SHA512', $pw);

        if($hashedPassword != $accountExists['a_pw']) {
            header('Location: ../login/index.php?error=wrongdata');
            exit();
        }

        else if($hashedPassword == $accountExists['a_pw']) {
            session_start();

            $_SESSION['user_name'] = $accountExists['a_username'];
            $_SESSION['user_img']  = $accountExists['a_img_profile'];

            header('Location: ../posts/');
            exit();
        }
    }
?>