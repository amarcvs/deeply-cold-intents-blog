<!--
    script for parsing the hidden ini file which contains sensitive information for:
    - db connections
    - SMTP authentication for sending emails
    - personal email and password
-->
<?php
    $ini = parse_ini_file('app.ini.php');
    if(!$ini) echo 'Error while parsing the .ini file!';
?>