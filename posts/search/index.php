<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/elements/header.php") ?>
    
    <section class="post" id="post">
        <div class="title" id="latestposts">
        <?php
            if(!(isset($_POST['searchBtn']))) {
                header("Location: /posts/");
                exit();
            }

            $limit = 4;
            include_once("../../includes/utility.inc.php");

            $search = $_POST['search'];
            $searchQuery = "SELECT * FROM post WHERE p_title LIKE $1 OR p_text LIKE $1 OR p_author LIKE $1 ORDER BY p_id DESC LIMIT '$limit';";
            $result = makeAQuery($searchQuery, array("%".$search."%"));
            $rows   = pg_num_rows($result);

            echo "\t\t<h2>Posts found with \"<span>".$search."</span>\"</h2>\n";

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