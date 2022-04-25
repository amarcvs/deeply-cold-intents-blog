<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | Deeply cold intents</title>
    
    <link rel="icon" href="">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../css/mainstyle.css">
    <link rel="stylesheet" type="text/css" href="../css/contact.css">
</head>

<body>
    <header>
        <a href="/" class="logo">|DCI|</a>
        <div class="toggleMenu navigation"></div>
        <ul class="">
            <li><a href="/about/" onclick="toggleMenu()">About</a></li>
            <li><a href="/posts/" onclick="toggleMenu()">Posts</a></li>
            <li><a href="/news/" onclick="toggleMenu()">News</a></li>
            <li id="li-contact"><a href="/contact/" onclick="toggleMenu()">Contact</a></li>
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

    <section class="contact">
        <div class="title" id="contact">
            <h2>Get in touch</h2>
            <p>Do not hesitate to contact me if you want to know more about the blog, on a particular post or in case of collaboration.</p>
        </div>
        <form class="formDiv" action="../php/sendEmail.php" method="post" name="form" enctype="multipart/form-data" onSubmit="return checkForm();">
            <div class="row">
                <input type="text" name="name" placeholder="NAME*" maxlength="30" required>
                <input type="email" name="email" placeholder="E-MAIL*" maxlength="30" required>
            </div>
            <div class="row2">
                <input type="text" name="subject" placeholder="SUBJECT">
            </div>
            <div class="row3">
                <textarea name="message" placeholder="MESSAGE*" required></textarea>
            </div>
            <div class="row3">
                <input type="submit" name="sendBtn" value="Send" class="btn">
            </div>
        </form>
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

    <script type="text/javascript" src="../javascript/mainscript.js"></script>
    <script type="text/javascript" src="../javascript/homepage.js"></script>
</body>
</html>