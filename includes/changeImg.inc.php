<?php
    session_start();
    include_once("../php/dbHandler.inc.php");

    if(!(isset($_POST['createBtn']))) {
        header("Location: /");
        exit();
    }

    $username = $_SESSION['user_name'];
    $oldImg = $_GET['img'];
    $newImg = $_FILES["fileToUpload"]["name"];

    if($oldImg != "") {
        $dirPath = "../src/uploads/profiles/";
        include_once("../includes/deleteImg.inc.php");
    }

    $dirPath = "../src/uploads/profiles/";
    include_once("../includes/upload.inc.php");
    $_SESSION['user_img'] = $newImg;

    $updateImgQuery = "UPDATE account SET a_img_profile = '$newImg' WHERE a_username = '$username';";

    $result = pg_query($updateImgQuery);
    if(!$result) exit('Query attempt failed. ' . pg_last_error($dbconn));

    include_once("../php/clearResources.inc.php");

    header("Location: /profile/");
?>