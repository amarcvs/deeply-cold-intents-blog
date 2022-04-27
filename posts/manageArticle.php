<?php
    session_start();
    include_once("../php/dbHandler.inc.php");

    if(!(isset($_SESSION['user_id']))) {
        header("Location: /");
        exit();
    }
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
        <div class="hero"></div>

        <main>
            <form class="formDiv" action="<?php if($_GET["title"]) echo "updateArticle.php?title=".urlencode($_GET["title"])."&oldDate=".$_GET["date"]."&img=".urlencode($_GET['img']); else echo "createArticle.php";?>" method="post" name="form" enctype="multipart/form-data" onSubmit="return checkForm();">
                <div class="row">
                    <input type="text" id="titlebox" name="title" placeholder="TITLE" value="<?php if($_GET["title"]) echo urldecode($_GET["title"]) ?>" required focus>
                </div>
                <div class="row3">
                    <textarea name="text" placeholder="TEXT" required><?php if($_GET["text"]) echo urldecode($_GET["text"]); ?></textarea>
                </div>
                <div class="row">
                    <label for="img">SELECT IMAGE FOR BANNER:</label>
                    <input type="file" id="fileToUpload" name="fileToUpload" accept="image/*" <?php if(!$_GET["title"]) echo "required"; ?>>
                </div>
                <div class="topic-selection">
                    <div id="newtopic">
                        <input type="text" id="topic-bar" name="topics[]" placeholder="Insert a topic..." required>
                        <a class="btn" id="push">Add</a>
                    </div>
                    <div id="topics"></div>
                </div>
                <div class="row3">
                    <input type="submit" name="createBtn" value="PUBLIC" class="btn">
                </div>
            </form>

            <script type="text/javascript">
                document.querySelector('#push').onclick = function() {
                    if(document.querySelector('#newtopic input').value.length == 0) {
                        alert("Please Enter a topic")
                    }

                    else {
                        document.querySelector('#topics').innerHTML += `
                            <input type="text" name="topics[]" value="${document.querySelector('#newtopic input').value}">
                        `;

                        document.querySelector('#topic-bar').value = "";

                        let current_topics = document.querySelectorAll(".delete");
                        for(let i = 0; i < current_topics.length; ++i) {
                            current_topics[i].onclick = function() {
                                this.parentNode.remove();
                            }
                        }
                    }
                }
            </script>
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
    <script type="text/javascript" src="../javascript/article.js"></script>
</body>
</html>