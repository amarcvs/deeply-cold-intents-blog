<?php
    session_start();
    include_once("../php/dbHandler.inc.php");
    
    if(!(isset($_POST['createBtn']))) {
        header("Location: /");
        exit();
    }
    
    if(!(isset($_SESSION['user_id']))) {
        header("Location: /");
        exit();
    }

    $author = $_SESSION["user_name"];
    $title = $_POST['title'];
    $text = $_POST['text'];
    $bannerImage = $_FILES["fileToUpload"]["name"];
    $date = date("Y-m-d");

    $topics = "";
    $topicsArray = $_POST['topics'];
    $topicsLen = count($topicsArray);

    for($i = 0; $i < $topicsLen; ++$i) {
        if($i != $topicsLen - 1) $topics .= $topicsArray[$i] . ",";
        else $topics .= $topicsArray[$i];
    }

    $topics = "{".$topics."}";

    $dirPath = "../src/uploads/";
    include_once("../includes/upload.inc.php");
    
    $createQuery = "INSERT INTO post(p_author, p_title, p_text, p_img_url, p_date, p_topics, p_is_updated) VALUES($1, $2, $3, $4, $5, $6, false)";

    $result = pg_query_params($dbconn, $createQuery, array($author, $title, $text, $bannerImage, $date, $topics));
    if(!$result) exit('Query attempt failed. ' . pg_last_error($dbconn));

    include_once("../php/clearResources.inc.php");
    
    header("Location: /posts/");
?>