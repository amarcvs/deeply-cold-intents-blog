<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deeply cold intents</title>
    
    <link rel="icon" href="">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="/css/mainstyle.css">
    <?php
        $uriPage = trim($_SERVER['REQUEST_URI'], "/");
        switch ($uriPage) {
            case '':        echo("<link rel=\"stylesheet\" type=\"text/css\" href=\"/css/homepage.css\">"); break;
            case 'about':   echo("<link rel=\"stylesheet\" type=\"text/css\" href=\"/css/about.css\">");    break;
            case 'posts':   echo("<link rel=\"stylesheet\" type=\"text/css\" href=\"/css/posts.css\">");    break;
            case 'contact': echo("<link rel=\"stylesheet\" type=\"text/css\" href=\"/css/contact.css\">");  break;
            case 'profile': echo("<link rel=\"stylesheet\" type=\"text/css\" href=\"/css/profile.css\">");
                            echo("<link rel=\"stylesheet\" type=\"text/css\" href=\"/css/bootstrap/bootstrap.css\">"); break;
        }

        if(strpos($uriPage, 'article') !== false || strpos($uriPage, 'manageArticle') !== false) echo("<link rel=\"stylesheet\" type=\"text/css\" href=\"/css/article.css\">");
        if(strpos($uriPage, 'search')!== false) echo("<link rel=\"stylesheet\" type=\"text/css\" href=\"/css/posts.css\">");
        if(strpos($uriPage, 'login') !== false) echo("<link rel=\"stylesheet\" type=\"text/css\" href=\"/css/login.css\">");
        if(strpos($uriPage, 'signup')!== false) echo("<link rel=\"stylesheet\" type=\"text/css\" href=\"/css/signup.css\">");
        if(strpos($uriPage, 'manageArticle')!== false) {
            echo("<link rel=\"stylesheet\" type=\"text/css\" href=\"/css/manageArticle.css\">");
            echo("<link rel=\"stylesheet\" type=\"text/css\" href=\"/css/popupArticlePreview.css\">");
        }
    ?>
    <link rel="stylesheet" type="text/css" href="/css/mobile.css">
</head>

<body>
    <header>
        <a href="/" class="logo">|DCI|</a>
        <div class="toggleMenu" onclick="toggleMenu();"></div>
        <ul class="navigation">
            <li id="li-posts"><a href="/posts/" onclick="toggleMenu()">Posts</a></li>
            <li id="li-about"><a href="/about/" onclick="toggleMenu()">About</a></li>
            <li id="li-contact"><a href="/contact/" onclick="toggleMenu()">Contact</a></li>
            <?php
                if(isset($_SESSION["user_id"])) {
                    echo("<li id=\"li-profile\"><a href=\"/profile/\" onclick=\"toggleMenu()\"><u>".$_SESSION["user_name"]."</u></a></li>");
                }
            ?>
        </ul>
    </header>