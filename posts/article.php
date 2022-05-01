<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/elements/header.php") ?>

    <div class="container">
        <div class="hero" id="hero"></div>

        <main>
        <?php
            if(!(isset($_GET['title']))) {
                header("Location: /posts/");
                exit();
            }

            include_once("../includes/utility.inc.php");

            $title  = urldecode($_GET['title']);
            $date   = $_GET['date'];

            $searchPostQuery = "SELECT * FROM post INNER JOIN (SELECT a_username, a_img_profile FROM account) AS account ON p_author = a_username WHERE p_title = $1 AND p_date = $2;";
            $result = makeAQuery($searchPostQuery, array($title, $date));
            $rows   = pg_num_rows($result);

            if(!$rows) {
                echo "\t\t\t<p>There is a problem with this post, or there are no posts available that meet this request!</p>\n";
                exit();
            }
            else if($rows > 1) {
                echo "\t\t\t<p>A collision occurred. More than one article matches this search!</p>\n";
                exit();
            }

            $line       = pg_fetch_array($result, null, PGSQL_ASSOC);

            $topics     = findTopics($line['p_topics']);
            $dateTime   = date('F d Y', strtotime($line['p_date']));
            $isUpdated  = $line['p_is_updated'];

            $update = "";
            if($isUpdated == 't') $update = "<br/>Updated by <em>". $line['p_who_updated'] . "</em> on " . date('F d Y', strtotime($line['p_when_updated']));

            $operations = "";
            if($_SESSION["user_id"]) $operations =
            "<div class=\"button\">
                <a href=\"manageArticle.php?title=".urlencode($line['p_title'])."&text=".urlencode($line['p_text'])."&date=".$line['p_date']."&img=".$line['p_img_url']."\" class=\"btn\">Update</a>
                <a href=\"deleteArticle.php?title=".urlencode($line['p_title'])."&date=".$line['p_date']."&img=".$line['p_img_url']."\" class=\"btn\">Delete</a>
            </div>";

            echo 
            "<h2>".$line['p_title']."</h2>
            <div class=\"profile-container\">
                <div class=\"profile\">
                    <div class=\"img-container\" id=\"img-container\"></div>
                    <div class=\"text\">
                        <h3>".$line['p_author']."</h3>
                        <p>Published on ".$dateTime.$update."</p>
                    </div>
                </div>
                ".$operations."
            </div>
            <div class=\"content\">
                <p>".$line['p_text']."</p>
            </div>
            <div class=\"tags\">
                ".$topics."
            </div>";

            $pageTitle = "Article n.".$line['p_id']." | Deeply cold intents";
            echo "<script>document.title = '".$pageTitle."';</script>";
        ?>
        </main>
    </div>

<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/elements/footer.php") ?>