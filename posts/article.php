<?php
    session_start();
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

    <div class="container">
        <div class="hero" id="hero"></div>

        <main>
        <?php
            if(!(isset($_GET['title']))) {
                header("Location: /posts/");
                exit();
            }

            $title = urldecode($_GET['title']);
            $date = $_GET['date'];

            $searchPostQuery = "SELECT * FROM post INNER JOIN (SELECT a_username, a_img_profile FROM account) AS account on p_author = a_username WHERE p_title = '$title' AND p_date = '$date'";

            $result = pg_query($searchPostQuery);
            if(!$result) exit('Query attempt failed. ' . pg_last_error($dbconn));

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
                if($topicsArray[$i] != "") $topics .= "<a href=\"search/topics.php?tag=".urlencode(trim($topicsArray[$i], '"'))."\">".trim($topicsArray[$i], '"')."</a>";
            }

            $dateTime = date('F d Y', strtotime($line['p_date']));

            $isUpdated = $line['p_is_updated'];
            $update = "";
            if($isUpdated == 't') $update = "<br/>Updated by <em>". $line['p_who_updated'] . "</em> on " . date('F d Y', strtotime($line['p_when_updated']));;

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

            include_once("../php/clearResources.inc.php");

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
    <script type="text/javascript">
        const hero = document.getElementById("hero");
        hero.style.backgroundImage = "url(<?php echo("../src/uploads/".$line['p_img_url']);?>)";
        
        if(<?php if(is_null($line['a_img_profile'])) echo 0; else echo 1; ?>) {
            const imgContainer = document.getElementById("img-container");
            imgContainer.style.backgroundImage = "url(<?php echo("../src/uploads/profiles/".$line['a_img_profile']);?>)";
        }
    </script>
</body>
</html>