<?php
    $ini = parse_ini_file('app.ini.php');
    if(!$ini) echo "Error while parsing the .ini file!";
?>