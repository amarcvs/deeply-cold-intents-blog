<!-- script for database handling connection -->
<?php
    include_once('ini_handler.inc.php');

    $dbname     = $ini['DB_NAME'];
    $dbuser     = $ini['DB_USER'];
    $dbpassword = $ini['DB_PASSWORD'];

    $dbconn = pg_connect("host=localhost port=5432 dbname=$dbname user=$dbuser password=$dbpassword");
    if(!$dbconn) exit('Connection to database failed. ' . pg_last_error($dbconn));
?>