<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/elements/header.php") ?>
    
    <section class="post" id="post">
        <div class="title" id="latestposts">
            <h2>Latest posts</h2>
            <p>The latest posts published.</p>
        </div>
        <div class="contentBx" name="contentBx">
        <?php
            $limit = 4;
            if(isset($_GET['more'])) {
                $limit += $_GET['more'];
            }

            include_once("../includes/utility.inc.php");

            $countPostsQuery = "SELECT * FROM post ORDER BY p_id;";
            $result = makeAQuery($countPostsQuery, array());
            $rows = pg_num_rows($result);

            $postsQuery = "SELECT * FROM post ORDER BY p_id DESC LIMIT '$limit';";
            $result = makeAQuery($postsQuery, array());
            generatePosts($result);

            echo "\n\t\t</div>\n";
            include_once("../includes/elements/load-moreBtn.php");
            include_once("../includes/elements/searchPosts.php");
        ?>
    </section>

<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/elements/footer.php") ?>