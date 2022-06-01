<!-- header component included in every page -->
<?php
    session_start();
    ob_implicit_flush(true);
?>

<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deeply cold intents</title>
    
    <link rel="icon" href="/src/favicon.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="/css/mainstyle.css">
    <?php
        $uriPage = trim($_SERVER['REQUEST_URI'], '/');
        $stylefiles = [];

        if($uriPage === '' || $uriPage === 'index.php') array_push($stylefiles, 'homepage.css');
        else if(strpos($uriPage, 'about') !== false) array_push($stylefiles, 'about.css');
        else if(strpos($uriPage, 'contact') !== false) array_push($stylefiles, 'contact.css');
        else if(strpos($uriPage, 'profile') !== false) array_push($stylefiles, 'profile.css', 'popupMessages.css',  'bootstrap/bootstrap.css');
        else if(strpos($uriPage, 'article') !== false) array_push($stylefiles, 'article.css');
        else if(strpos($uriPage, 'login') !== false) array_push($stylefiles, 'login.css');
        else if(strpos($uriPage, 'signup') !== false) array_push($stylefiles, 'signup.css');
        else if(strpos($uriPage, 'manageArticle') !== false) array_push($stylefiles, 'article.css', 'manageArticle.css', 'popupMessages.css');
        else if(strpos($uriPage, 'posts') !== false || strpos($uriPage, 'search') !== false) array_push($stylefiles, 'posts.css');

        foreach ($stylefiles as $file)
            echo('<link rel="stylesheet" type="text/css" href="/css/'.$file.'">');

    ?>
    <link rel="stylesheet" type="text/css" href="/css/mobile.css">
</head>

<body class="fade_out fade_transition">
    <header>
        <a href="/" class="logo">|DCI|</a>
        <div class="toggleMenu" onclick="toggleMenu();"></div>
        <ul class="navigation">
            <li id="li-posts"><a href="/posts/" onclick="toggleMenu()">Posts</a></li>
            <li id="li-about"><a href="/about/" onclick="toggleMenu()">About</a></li>
            <li id="li-contact"><a href="/contact/" onclick="toggleMenu()">Contact</a></li>
            <?php
                if(isset($_SESSION['user_name'])) {//user_id
                    echo('<li id="li-profile"><a href="/profile/" onclick="toggleMenu()"><u>'.$_SESSION['user_name'].'</u></a></li>');
                }
            ?>
            <a><i class="theme_icon fa-solid"></i></a>
        </ul>
    </header>