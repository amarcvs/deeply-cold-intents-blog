<!-- script for updating an article -->
<?php
    include_once('../includes/create_header.inc.php');

    $oldTitle = urldecode($_GET['title']);
    $oldDate  = $_GET['oldDate'];

    if($bannerImage != "") {
        $imgToDelete = urldecode($_GET['img']);
        include_once('../includes/delete_img.inc.php');
        include_once('../includes/upload.inc.php');
    } else {
        $bannerImage = urldecode($_GET['img']);
    }

    $updateQuery = "UPDATE post SET p_title = $1, p_text = $2, p_img_url = $3, p_topics = $4, p_is_updated = 'true', p_who_updated = $5, p_when_updated = $6 WHERE p_title = $7 AND p_date = $8;";
    $result = makeAQuery($updateQuery, array($title, $text, $bannerImage, $topics, $author, $date, $oldTitle, $oldDate));

    header('Location: /posts/');
?>