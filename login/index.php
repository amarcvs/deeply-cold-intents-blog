<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/components/header.php") ?>
    
    <section class="login" id="login">
        <div class="title">
            <h2>Login</h2>
            <p>Access reserved for admin and mods to manage the blog! If you want to be part of the team, apply via the form in the <a href="/contact/">contact section</a>.</p>
        </div>
        <form class="formDiv" action="../includes/login.inc.php" method="post" name="form" id="loginform" enctype="multipart/form-data" onSubmit="return checkLoginForm();">
            <div class="row">
                <input type="text" name="username" placeholder="E-MAIL/USERNAME*" maxlength="30">
                <input type="password" name="password" placeholder="PASSWORD*">
            </div>
            <div class="row3">
                <input type="submit" name="loginBtn" value="Log in" class="btn">
            </div>
        </form>
        <p class="errorMessage" id="errorMessage"><p>
        <?php
            if(isset($_GET["error"])) {
                if($_GET["error"] == "emptyfields") {
                    echo '<p class="errorMessage">Fill in all fields!</p>';
                }
                else if($_GET["error"] == "wrongdata") {
                    echo '<p class="errorMessage">Error entering e-mail/username or password!</p>';
                }
            }
        ?>
    </section>

<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/components/footer.php") ?>