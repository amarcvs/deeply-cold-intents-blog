<!-- script for creating an article -->
<?php
    include_once('../includes/create_header.inc.php');
    include_once('../includes/upload.inc.php');
    
    $createQuery = "INSERT INTO post(p_author, p_title, p_text, p_img_url, p_date, p_topics, p_is_updated) VALUES($1, $2, $3, $4, $5, $6, false);";
    makeAQuery($createQuery, array($author, $title, $text, $bannerImage, $date, $topics));
    
    header('Location: /posts/');
?>