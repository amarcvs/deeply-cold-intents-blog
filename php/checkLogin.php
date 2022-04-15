<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkLogin</title>
</head>
<body>
    <?php
        if(!(isset($_POST['loginBtn']))) {
            header("Location: ../");
        }
        else {
            include_once("dbHandler.inc.php");

            $email = strtolower($_POST['email']);
            $checkEmailQuery = 'SELECT * FROM account WHERE email=$1';
            
            $result = pg_query_params($dbconn, $checkEmailQuery, array($email));
            if(!$result) exit('Query attempt failed. ' . pg_result_error($result));

            if(!($line=pg_fetch_array($result, null, PGSQL_ASSOC))) {
                echo "You are not a registered user!<br/><a href='../'>Home page</a>";
            }
            else {
                $password = hash('SHA512', $_POST['password']);
                $checkPasswordQuery = 'SELECT * FROM account WHERE email=$1 AND pw=$2';

                $result = pg_query_params($dbconn, $checkPasswordQuery, array($email, $password));
                if(!$result) exit('Query attempt failed. ' . pg_result_error($result));

                $line=pg_fetch_array($result, null, PGSQL_ASSOC);
                if(!($line)) {
                    echo "The password is wrong<br/><a href='../'>Home page</a>";
                }
                else {
                    $username = $line['username'];
                    echo "Welcome $username!";
                }
            }
        }
        
        if(!pg_free_result($result)) echo "Error on free the memory!";
        pg_close($dbconn);
    ?>
</body>
</html>