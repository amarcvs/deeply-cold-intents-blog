<?php
    session_start();
    include_once("../php/dbHandler.inc.php");
    
    if(!(isset($_GET['title']))) {
        header("Location: /");
        exit();
    }

    if(!(isset($_SESSION['user_id']))) {
        header("Location: /");
        exit();
    }

    $title = urldecode($_GET["title"]);
    $date = $_GET["date"];
    $imgToDelete = urldecode($_GET["img"]);
    
    $deleteQuery = "DELETE FROM post WHERE p_title = '$title' AND p_date = '$date';";

    $result = pg_query($deleteQuery);
    if(!$result) exit('Query attempt failed. ' . pg_last_error($dbconn));

    include_once("../php/clearResources.inc.php");
    $dirPath = "../src/uploads/";
    include_once("../includes/deleteImg.inc.php");

    header("Location: /posts/");
?>