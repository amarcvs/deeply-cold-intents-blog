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
    <title>Profile | Deeply cold intents</title>
    
    <link rel="icon" href="">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../css/mainstyle.css">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
</head>

<body>
    <header>
        <a href="/" class="logo">|DCI|</a>
        <div class="toggleMenu navigation"></div>
        <ul class="">
            <li><a href="/about/" onclick="toggleMenu()">About</a></li>
            <li><a href="/posts/" onclick="toggleMenu()">Posts</a></li>
            <li><a href="/news/" onclick="toggleMenu()">News</a></li>
            <li><a href="/contact/" onclick="toggleMenu()">Contact</a></li>
            <?php
                if(isset($_SESSION["user_id"])) {
                    echo "<li id=\"li-profile\"><a href=\"/profile/\" onclick=\"toggleMenu()\"><u>".$_SESSION["user_name"]."</u></a></li>";
                }
            ?>
        </ul>
    </header>

    <section class="profile" id="profile">
        <div class="contentBx">
            <h2>Profile</h2>
            <h4>Personal area: <?php echo $_SESSION["user_name"]?></h4>
            <div class="profile-img" id="profile-img"></div>
            
            <a href="/posts/manageArticle.php" class="btn">Create a post</a>
            <a href="/includes/logout.inc.php" class="btn">Logout</a>
        
            <!--<form action="../includes/upload.inc.php" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload Image" name="createBtn">
            </form>-->
            <form class="formDiv" name="form" action= <?php echo "../includes/changeImg.inc.php?img=". $_SESSION['user_img']?> method="post" enctype="multipart/form-data" onSubmit="return checkForm();">
                <div class="row">
                    <input type="file" name="fileToUpload" id="fileToUpload" required>
                    <input type="submit" name="createBtn" value="Upload Image" class="btn">
                </div>
            </form>
        </div>
        <div class="contentBx">
            <h2>Data:</h2>
            <p></p>
            <?php
                $user = $_SESSION['user_name'];
                $countPostsQuery = "SELECT count(p_id) AS num_post FROM post WHERE p_author = '$user'";

                $result = pg_query($countPostsQuery);
                if(!$result) exit('Query attempt failed. ' . pg_last_error($dbconn));

                $line = pg_fetch_array($result, null, PGSQL_ASSOC);
                echo "<p>Public created posts: " . $line['num_post'] . "</p>";

                $countUpdatedPostsQuery = "SELECT count(p_id) AS num_post FROM post WHERE p_who_updated = '$user'";

                $result = pg_query($countUpdatedPostsQuery);
                if(!$result) exit('Query attempt failed. ' . pg_last_error($dbconn));

                $line2 = pg_fetch_array($result, null, PGSQL_ASSOC);
                echo "<p>Public updated posts: " . $line2['num_post'] . "</p>";

                include_once("../php/clearResources.inc.php");
            
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

    <script type="text/javascript" src="../javascript/mainscript.js"></script>
    <script type="text/javascript">
        if(<?php if(is_null($_SESSION["user_img"])) echo 0; else echo 1; ?>) {
            const imgContainer = document.getElementById("profile-img");
            imgContainer.style.backgroundImage = "url(<?php echo("../src/uploads/profiles/".$_SESSION["user_img"]);?>)";
        }
    </script>
</body>
</html>