<!-- script for deleting account -->
<?php
    session_start();
    
    /*TODO in future: add a security check */

    if(!(isset($_SESSION['user_name']))) {
        header('Location: /');
        exit();
    }

    include_once('../includes/utility.inc.php');

    $username  = $_SESSION['user_name'];
    $deletePostsQuery = 'DELETE FROM post WHERE p_author = $1;';
    makeAQuery($deletePostsQuery, array($username));
    /* TODO in future: and also delete their imgs */

    $deleteAccountQuery = "DELETE FROM account WHERE a_username = $1;";
    makeAQuery($deleteAccountQuery, array($username));

    $_GET['img'] = $_SESSION['user_img'];
    $dirPath = '../src/uploads/profiles/';
    include_once('../includes/delete_img.inc.php');

    include_once('../includes/logout.inc.php');
?>