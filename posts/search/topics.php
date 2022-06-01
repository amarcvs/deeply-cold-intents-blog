<?php include_once($_SERVER['DOCUMENT_ROOT'].'/includes/components/header.php') ?>
    
    <section class="post" id="post">
        <div class="title" id="latestposts">
        <?php
            if(!(isset($_GET['tag']))) {
                header('Location: /posts/');
                exit();
            }

            $limit = 4;
            include_once('../../includes/utility.inc.php');

            $topic  = urldecode($_GET['tag']);
            $searchForTopicQuery = "SELECT * FROM post WHERE $1 = ANY(p_topics) ORDER BY p_id DESC LIMIT '$limit';";
            $result = makeAQuery($searchForTopicQuery, array($topic));
            $rows   = pg_num_rows($result);

            echo '<h2>Tagged "<span>'.$topic.'</span>"</h2>';

            if(!$rows)
                echo '<p>There are no results matching your search!</p>';
            else {
                if($rows == 1) echo '<p>There is $rows '.result. 'matching your search:</p>';
                else echo '<p>There are' .$rows. 'results matching your search:</p>';
            }

            echo '</div>';
            echo '<div class="contentBx" name="contentBx">';

            generatePosts($result);

            echo '</div>';
            include_once('../../includes/components/load_more_btn.php');
            include_once('../../includes/components/search_posts.php');
        ?>
    </section>

<?php include_once($_SERVER['DOCUMENT_ROOT'].'/includes/components/footer.php') ?>