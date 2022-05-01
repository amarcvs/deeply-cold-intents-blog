<?php
    session_start();
    
    if(!(isset($_GET['title']))) {
        header("Location: /");
        exit();
    }

    if(!(isset($_SESSION['user_id']))) {
        header("Location: /");
        exit();
    }

    include_once("../includes/utility.php");

    $title  = urldecode($_GET["title"]);
    $date   = $_GET["date"];
    $imgToDelete = urldecode($_GET["img"]);
    
    $deleteQuery = "DELETE FROM post WHERE p_title = $1 AND p_date = $2;";

    $result = makeAQuery($deleteQuery, array($title, $date));

    $dirPath = "../src/uploads/";
    include_once("../includes/deleteImg.inc.php");

    header("Location: /posts/");
?>