    <footer>
        <a href="/" class="logo">BLOG</a>
        <ul class="footerMenu">
            <li><a href="/">Home</a></li>
            <li><a href="/about/">About</a></li>
            <li><a href="/posts/">Posts</a></li>
            <li><a href="/news/">News</a></li>
            <li><a href="/contact/">Contact</a></li>
            <?php
                if(isset($_SESSION["user_id"])) {
                    echo("<li><a href=\"/profile/\"><u>".$_SESSION["user_name"]."</u></a></li>");
                }
                else {
                    echo("<li><a href=\"/login/\">login</a></li>");
                }
            ?>
        </ul>
        <p class="copyright">Copyright &copy; 2022 <a href="https://www.deeplycoldintents.com">deeplycoldintents.com</a> &bull; All rights reserved.</p>
    </footer>
    
    <div class="cursor"></div>

    <script type="text/javascript" src="/javascript/mainscript.js"></script>
    <?php
        switch ($uriPage) {
            case '':            echo("<script type=\"text/javascript\" src=\"/javascript/homepage.js\"></script>");
                                echo("<script type=\"text/javascript\" src=\"/javascript/encryptedText.js\"></script>");  break;
            case 'posts':       echo("<script type=\"text/javascript\" src=\"/javascript/loadPosts.js\"></script>");      break;
        }
    ?>
<?php 
    if(strpos($uriPage, 'article') !== false || $uriPage == 'profile') include_once($_SERVER['DOCUMENT_ROOT']."/includes/load_article_imgs_script.inc.php");
    if(strpos($uriPage, 'manageArticle')!== false) {
        echo("<script type=\"text/javascript\" src=\"/javascript/article.js\"></script>");
        echo("<script type=\"text/javascript\" src=\"/javascript/popupArticlePreview.js\"></script>");
    }
    if(strpos($uriPage, 'signup') !== false || strpos($uriPage, 'login') !== false || strpos($uriPage, 'contact') !== false || strpos($uriPage, 'posts') !== false || strpos($uriPage, 'profile' || strpos($uriPage, 'manageArticle') !== false) !== false) {
        echo("<script type=\"text/javascript\" src=\"/javascript/checkForms.js\"></script>");
        echo("<script type=\"text/javascript\" src=\"/javascript/checkRequiredElements.js\"></script>");
    }
?>
    
</body>
</html>