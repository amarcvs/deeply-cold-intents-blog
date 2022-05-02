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

    <script type="text/javascript" src="/javascript/mainscript.js"></script>
    <?php
        switch ($uriPage) {
            case '':            echo("<script type=\"text/javascript\" src=\"/javascript/homepage.js\"></script>");
                                echo("<script type=\"text/javascript\" src=\"/javascript/purpleCodedRain.js\"></script>");  break;
            case 'posts':       echo("<script type=\"text/javascript\" src=\"/javascript/loadPosts.js\"></script>");        break;
            case 'profile':     echo("");                                                                                   break;
        }
    ?>
<?php 
    if(strpos($uriPage, 'article') !== false || $uriPage == 'profile') include_once($_SERVER['DOCUMENT_ROOT']."/includes/elements/loadImg.php");
    if(strpos($uriPage, 'manageArticle') !== false) echo("<script type=\"text/javascript\" src=\"/javascript/article.js\"></script>");
    if(strpos($uriPage, 'signup') !== false || strpos($uriPage, 'login') !== false || strpos($uriPage, 'contact') !== false || strpos($uriPage, 'posts') !== false) echo("<script type=\"text/javascript\" src=\"/javascript/checkForms.js\"></script>")
?>
    
</body>
</html>