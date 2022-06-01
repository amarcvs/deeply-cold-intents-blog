<!-- footer component included in every page -->
    <footer>
        <span class="logo">BLOG</span>
        <ul class="footerMenu">
            <li><a href="/">Home</a></li>
            <li><a href="/about/">About</a></li>
            <li><a href="/posts/">Posts</a></li>
            <li><a href="/contact/">Contact</a></li>
            <?php
                if(isset($_SESSION['user_name'])) {
                    echo('<li><a href="/profile/"><u>'.$_SESSION['user_name'].'</u></a></li>');
                }
                else {
                    echo('<li><a href="/login/">login</a></li>');
                }
            ?>
        </ul>
        <p class="copyright">Copyright &copy; 2022 <a href="https://www.deeplycoldintents.com">deeplycoldintents.com</a> &bull; All rights reserved.</p>
    </footer>
    
    <div class="cursor"></div>

    <script type="text/javascript" src="/javascript/switchstyle.js"></script>
    <script type="text/javascript" src="/javascript/mainscript.js"></script>
    <?php
        $stylefiles = [];

        if($uriPage === '' || $uriPage === 'index.php') array_push($stylefiles, 'encryptedText.js');
        else if(strpos($uriPage, 'manageArticle')!== false) array_push($stylefiles, 'article.js', 'popupMessages.js', 'checkForms.js', 'checkRequiredElements.js');
        else if(strpos($uriPage, 'article') !== false) include_once($_SERVER['DOCUMENT_ROOT'].'/includes/load_imgs_script.inc.php');
        else if(strpos($uriPage, 'posts') !== false) array_push($stylefiles, 'loadPosts.js', 'checkForms.js', 'checkRequiredElements.js');
        else if(strpos($uriPage, 'profile') !== false) {
            include_once($_SERVER['DOCUMENT_ROOT'].'/includes/load_imgs_script.inc.php');
            array_push($stylefiles, 'checkForms.js', 'popupMessages.js', 'checkRequiredElements.js');
        }
        else if(strpos($uriPage, 'signup') !== false || strpos($uriPage, 'login') !== false || strpos($uriPage, 'contact') !== false)
            array_push($stylefiles, 'checkForms.js', 'checkRequiredElements.js');

        foreach ($stylefiles as $file)
            echo('<script type="text/javascript" src="/javascript/'.$file.'"></script>');
    ?>
</body>
</html>