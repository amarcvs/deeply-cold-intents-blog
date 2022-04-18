<?php
    include_once("../php/dbHandler.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article | Deeply cold intents</title>
    
    <link rel="icon" href="">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../css/mainstyle.css">
    <link rel="stylesheet" type="text/css" href="../css/article.css">
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
            <li><a href="/login/" onclick="toggleMenu()">Login</a></li>
        </ul>
    </header>

    <div class="container">
        <div class="hero"></div>

        <main>
        <?php
            if(!(isset($_GET['title']))) {
                header("Location: /posts/");
            }
            
            $title = $_GET['title'];
            $date = $_GET['date'];

            $searchPostQuery = "SELECT * FROM post WHERE p_title = '$title' AND p_date = '$date'";

            $result = pg_query($searchPostQuery);
            if(!$result) exit('Query attempt failed. ' . pg_result_error($result));

            $rows = pg_num_rows($result);
            if(!$rows) {
                echo "\t\t\t<p>There is a problem with this post, or there are no posts available that meet this request!</p>\n";
                exit();
            }
            else if($rows > 1) {
                echo "\t\t\t<p>A collision occurred. More than one article matches this search!</p>\n";
                exit();
            }
            
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);

            $topics = "";
            $topicsArray = explode(',', trim($line['p_topics'], '{}'));
            for($i = 0; $i < sizeof($topicsArray); ++$i) {
                $topics .= "<a href=\"search/topics.php?tag=$topicsArray[$i]\">".$topicsArray[$i]."</a>";
            }

            //https://stackoverflow.com/questions/13563665/changing-date-format-to-word-in-php
            $dateTime = date('F d Y', strtotime($line['p_date']));
            
            echo 
            "<h2>".$line['p_title']."</h2>
            <div class=\"profile-container\">
                <div class=\"profile\">
                    <div class=\"img-container\"></div>
                    <div class=\"text\">
                        <h3>".$line['p_author']."</h3>
                        <p>".$dateTime."</p>
                    </div>
                </div>
            </div>
            <div class=\"content\">
                <p>".$line['p_text']."</p>
            </div>
            <div class=\"tags\">
                ".$topics."
            </div>";

            include_once("../php/clearResources.inc.php");
            
            //https://stackoverflow.com/questions/24791305/how-to-change-title-dynamically-after-the-header-is-included
            $pageTitle = "Article n.".$line['p_id']." | Deeply cold intents";
            echo "<script>document.title = '".$pageTitle."';</script>";
        ?>
        </main>
    </div>
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

    <script type="text/javascript" src="../javascript/mainscript.js"></script>
</body>
</html>