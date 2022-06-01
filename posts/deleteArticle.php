<!-- script for deleting an article -->
<?php
    session_start();
    
    if(!(isset($_GET['title']))) {
        header('Location: /');
        exit();
    }

    if(!(isset($_SESSION['user_name']))) {
        header('Location: /');
        exit();
    }

    include_once('../includes/utility.inc.php');

    $title  = urldecode($_GET['title']);
    $date   = $_GET['date'];
    $imgToDelete = urldecode($_GET['img']);
    
    $deleteQuery = "DELETE FROM post WHERE p_title = $1 AND p_date = $2;";

    $result = makeAQuery($deleteQuery, array($title, $date));

    $dirPath = '../src/uploads/';
    include_once('../includes/delete_img.inc.php');

    header('Location: /posts/');
?>