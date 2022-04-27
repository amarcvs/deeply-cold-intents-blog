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

    $oldTitle = urldecode($_GET["title"]);
    $oldDate = $_GET["oldDate"];

    $author = $_SESSION["user_name"];
    $date = date("Y-m-d");
    $title = $_POST["title"];
    $text = $_POST["text"];

    $bannerImage = $_FILES["fileToUpload"]["name"];
    $topics = "";
    $topicsArray = $_POST['topics'];
    $topicsLen = count($topicsArray);

    for($i = 0; $i < $topicsLen; ++$i) {
        if($i != $topicsLen - 1) $topics .= $topicsArray[$i] . ",";
        else $topics .= $topicsArray[$i];
    }

    $topics = "{".$topics."}";


    if($bannerImage != "") {
        $dirPath = "../src/uploads/";
        include_once("../includes/upload.inc.php");

        $imgToDelete = urldecode($_GET["img"]);
        include_once("../includes/deleteImg.inc.php");

        $updateQuery = "UPDATE post SET p_title = $1, p_text = $2, p_img_url = $3, p_topics = $4, p_is_updated = 'true', p_who_updated = $5, p_when_updated = $6 WHERE p_title = $7 AND p_date = $8;";

        $result = pg_query_params($dbconn, $updateQuery, array($title, $text, $bannerImage, $topics, $author, $date, $oldTitle, $oldDate));
    } else {
        $updateQuery = "UPDATE post SET p_title = $1, p_text = $2, p_topics = $3, p_is_updated = 'true', p_who_updated = $4, p_when_updated = $5 WHERE p_title = $6 AND p_date = $7;";

        $result = pg_query_params($dbconn, $updateQuery, array($title, $text, $topics, $author, $date, $oldTitle, $oldDate));
    }

    if(!$result) exit('Query attempt failed. ' . pg_last_error($dbconn));

    include_once("../php/clearResources.inc.php");

    header("Location: /posts/");
?>