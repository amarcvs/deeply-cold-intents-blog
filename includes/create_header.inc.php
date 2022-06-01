<!-- script for adding some repetitive infos -->
<?php
    session_start();
    
    if(!(isset($_POST['createBtn']))) {
        header('Location: /');
        exit();
    }
    
    if(!(isset($_SESSION['user_name']))) {
        header('Location: /');
        exit();
    }

    include_once('../includes/utility.inc.php');

    $author  = $_SESSION['user_name'];
    $title   = $_POST['title'];
    $text    = $_POST['text'];
    $date    = date('Y-m-d');
    $topics  = arrayTopics($_POST['topics']);
    $dirPath = '../src/uploads/';
    $bannerImage = $_FILES['fileToUpload']['name'];
?>