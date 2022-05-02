<?php
    session_start();

    include_once("utility.inc.php");

    if(!(isset($_POST['createBtn']))) {
        header("Location: /");
        exit();
    }

    $username = $_SESSION['user_name'];
    $oldImg   = $_GET['img'];
    $newImg   = $_FILES["fileToUpload"]["name"];

    if($oldImg != "") {
        $dirPath = "../src/uploads/profiles/";
        include_once("../includes/deleteImg.inc.php");
    }

    $dirPath = "../src/uploads/profiles/";
    include_once("../includes/upload.inc.php");
    $_SESSION['user_img'] = $newImg;

    $updateImgQuery = "UPDATE account SET a_img_profile = $1 WHERE a_username = $2;";
    makeAQuery($updateImgQuery, array($newImg, $username));

    header("Location: /profile/");
?>