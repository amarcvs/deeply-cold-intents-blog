<?php
    session_start();
    include_once("../../php/dbHandler.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts | Deeply cold intents</title>
    
    <link rel="icon" href="">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../../css/mainstyle.css">
    <link rel="stylesheet" type="text/css" href="../../css/posts.css">
</head>

<body>
    <header>
        <a href="/" class="logo">|DCI|</a>
        <div class="toggleMenu navigation"></div>
        <ul class="">
            <li><a href="/about/" onclick="toggleMenu()">About</a></li>
            <li id="li-posts"><a href="/posts/" onclick="toggleMenu()">Posts</a></li>
            <li><a href="/news/" onclick="toggleMenu()">News</a></li>
            <li><a href="/contact/" onclick="toggleMenu()">Contact</a></li>
            <?php
                if(isset($_SESSION["user_id"])) {
                    echo "<li><a href=\"/profile/\" onclick=\"toggleMenu()\"><u>".$_SESSION["user_name"]."</u></a></li>";
                }
                else {
                    echo "<li><a href=\"/login/\" onclick=\"toggleMenu()\">Login</a></li>";
                }
            ?>
        </ul>
    </header>
    
    <section class="post" id="post">
        <div class="title" id="latestposts">
        <?php
            if(!(isset($_GET['tag']))) {
                header("Location: /posts/");
                exit();
            }

            $topic = urldecode($_GET['tag']);
            $searchForTopicQuery = "SELECT * FROM post WHERE '$topic' = ANY(p_topics) ORDER BY p_id DESC LIMIT 6";

            $result = pg_query($searchForTopicQuery);
            if(!$result) exit('Query attempt failed. ' . pg_result_error($result));
            
            echo "\t\t<h2>Tagged \"<span>".$topic."</span>\"</h2>\n";

            $rows = pg_num_rows($result);
            if(!$rows)
                    echo "\t\t\t<p>There are no results matching your search!</p>\n";
            else {
                if($rows == 1) echo "\t\t\t<p>There is $rows result matching your search:</p>\n";
                else echo "\t\t\t<p>There are $rows results matching your search:</p>\n";
            }

            echo "\t\t</div>\n";
            echo "\t\t<div class=\"contentBx\">";

            while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                $topics = "";
                $topicsArray = explode(',', trim($line['p_topics'], '{}'));
                for($i = 0; $i < sizeof($topicsArray); ++$i) {
                    if($topicsArray[$i] != "") $topics .= "<a href=\"topics.php?tag=".urlencode(trim($topicsArray[$i], '"'))."\" class=\"btn topic\">".trim($topicsArray[$i], '"')."</a>";
                }

                $dateTime = date('F d Y', strtotime($line['p_date']));

                echo "\n\t\t\t<div class=\"postsColumn\">
                    <div class=\"postBx\">
                        <div class=\"imgBx\">
                            <img src=\"../../src/uploads/".$line['p_img_url']."\" alt=\"post".$line['p_id']."\" class=\"cover\">
                        </div>
                        <a href=\"../article.php?title=".urlencode($line['p_title'])."&date=".$line['p_date']."\">
                            <div class=\"textBx\">
                                <h3>".$dateTime."<!--<br/><strong>".$line['p_author']."</strong>--></h3>
                                <br/><br/>
                                <h2>".$line['p_title']."</h2>
                                <h3>".$line['p_text']."</h3>
                                <br/>
                                <h5>".$topics."</h5>
                            </div>
                        </a>
                    </div>
                </div>";
            }
            echo "\n\t\t</div>\n";

            if($rows > 6)
                echo
                "<div class=\"title\">
                    <a href=\"#\" class=\"btn addMargin\">Load more</a>
                </div>";
        ?>

        <br/><br/><hr/>
        <div class="title" id="topics">
            <h2>Search or filter by topic</h2>
            <p>You can also use <a href="https://www.google.com/search?q=site%3Adeeplycoldintents.com%2Fposts+cybersecurity">Google</a>:</p>
            <form class="formDiv" action="../search/" method="post" name="form" enctype="multipart/form-data" onSubmit="return checkForm();">
                <div class="row">
                    <input type="search" name="search" placeholder="SEARCH*" maxlength="30" required>
                    <input type="submit" name="searchBtn" value="Search" class="btn">
                </div>
            </form>
            <br/><br/>
            <?php
                $topicsQuery = 'SELECT p_topics AS topics FROM post';

                $result = pg_query($topicsQuery);
                if(!$result) exit('Query attempt failed. ' . pg_last_error($dbconn));

                $allTopics = "";
                $allTopicsArray = [];
                while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                    $allTopicsArray = array_merge($allTopicsArray, explode(',', trim($line['topics'], '{}')));
                }

                $allTopicsArray = array_unique($allTopicsArray);
                sort($allTopicsArray);
                for($i = 0; $i < sizeof($allTopicsArray); ++$i) {
                    if($allTopicsArray[$i] != "") $allTopics .= "<a href=\"topics.php?tag=".trim($allTopicsArray[$i], '"')."\" class=\"btn topic\">".trim($allTopicsArray[$i], '"')."</a>";
                }

                include_once("../php/clearResources.inc.php");
                echo "<p>".$allTopics."</p>";
            ?>
        </div>
    </section>

    <footer>
        <a href="/" class="logo">BLOG</a>
        <ul class="footerMenu">
            <li><a href="/">Home</a></li>
            <li><a href="/about/">About</a></li>
            <li><a href="/posts/">Posts</a></li>
            <li><a href="/news/">News</a></li>
            <li><a href="/contact/">Contact</a></li>
        </ul>
        <p class="copyright">Copyright &copy; 2022 <a href="https://www.deeplycoldintents.com">deeplycoldintents.com</a> &bull; All rights reserved.</p>
    </footer>

    <div class="cursor"></div>

    <script type="text/javascript" src="../../javascript/mainscript.js"></script>
</body>
</html>