<!-- script for changing profile image in profile section -->
<?php
    session_start();

    include_once('utility.inc.php');

    if(!(isset($_POST['createBtn']))) {
        header('Location: /');
        exit();
    }

    $username = $_SESSION['user_name'];
    $oldImg   = $_GET['img'];
    $newImg   = $_FILES['fileToUpload']['name'];

    $dirPath = '../src/uploads/profiles/';

    include_once('../includes/upload.inc.php');
    $_SESSION['user_img'] = $newImg;

    if($oldImg != "") {
        include_once('../includes/delete_img.inc.php');
    }

    $updateImgQuery = "UPDATE account SET a_img_profile = $1 WHERE a_username = $2;";
    makeAQuery($updateImgQuery, array($newImg, $username));

    header('Location: /profile/index.php?error=none');
?>