<!-- script for login system -->
<?php
    if(isset($_POST['loginBtn'])) {
        $username = $_POST['username']; //username/email
        $pw = $_POST['password'];

        require_once 'check_forms.inc.php';

        if(emptyFieldsLogin($username, $pw) !== false) {
            header('Location: ../login/index.php?error=emptyfields');
            exit();
        }

        loginUser($dbconn, $username, $pw);
    }

    else {
        header('Location: ../login/');
        exit();
    }
?>