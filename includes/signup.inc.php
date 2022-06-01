<!-- script for signup new moderators -->
<?php
    if(isset($_POST['signupBtn'])) {
        $email      = $_POST['email'];
        $username   = $_POST['username'];
        $pw         = $_POST['password'];
        $pwRepeated = $_POST['passwordRepeated'];

        require_once 'check_forms.inc.php';

        if(emptyFieldsSignup($email, $username, $pw, $pwRepeated) !== false) {
            header('Location: ../signup/index.php?error=emptyfields');
            exit();
        }

        if(invalidEmail($email) !== false) {
            header('Location: ../signup/index.php?error=invalidemail');
            exit();
        }

        if(invalidUsername($username) !== false) {
            header('Location: ../signup/index.php?error=invalidusername');
            exit();
        }
        
        if(passwordMatch($pw, $pwRepeated) !== false) {
            header('Location: ../signup/index.php?error=unmatchpasswords');
            exit();
        }

        if(accountExists($dbconn, $email, $username) !== false) {
            header('Location: ../signup/index.php?error=existingaccount');
            exit();
        }

        createUser($dbconn, $email, $username, $pw);
    }

    else {
        header('Location: ../signup/');
        exit();
    }
?>