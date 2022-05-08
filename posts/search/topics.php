<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/elements/header.php") ?>
    
    <section class="post" id="post">
        <div class="title" id="latestposts">
        <?php
            if(!(isset($_GET['tag']))) {
                header("Location: /posts/");
                exit();
            }

            $limit = 4;
            include_once("../../includes/utility.inc.php");

            $topic  = urldecode($_GET['tag']);
            $searchForTopicQuery = "SELECT * FROM post WHERE $1 = ANY(p_topics) ORDER BY p_id DESC LIMIT '$limit';";
            $result = makeAQuery($searchForTopicQuery, array($topic));
            $rows   = pg_num_rows($result);

            echo "\t\t<h2>Tagged \"<span>".$topic."</span>\"</h2>\n";

            if(!$rows)
                echo "\t\t\t<p>There are no results matching your search!</p>\n";
            else {
                if($rows == 1) echo "\t\t\t<p>There is $rows result matching your search:</p>\n";
                else echo "\t\t\t<p>There are $rows results matching your search:</p>\n";
            }

            echo "\t\t</div>\n";
            echo "\t\t<div class=\"contentBx\" name=\"contentBx\">";

            generatePosts($result);

            echo "\n\t\t</div>\n";
            include_once("../../includes/elements/load-moreBtn.php");
            include_once("../../includes/elements/searchPosts.php");
        ?>
    </section>

<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/elements/footer.php") ?>