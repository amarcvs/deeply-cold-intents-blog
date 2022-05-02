<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/elements/header.php") ?>

    <section class="signup" id="signup">
        <div class="title">
            <h2>Signup</h2>
            <p>Registration reserved for admins and mods to manage the blog.</p>
        </div>
        <form class="formDiv" action="../includes/signup.inc.php" method="post" name="form" id="signupform" enctype="multipart/form-data" onSubmit="return checkSignupForm();">
            <div class="row">
                <input type="text" name="email" placeholder="E-MAIL*" maxlength="30">
                <input type="text" name="username" placeholder="USERNAME*" maxlength="30">
            </div>
            <div class="row2">
                <input type="password" name="password" placeholder="PASSWORD*">
                <input type="password" name="passwordRepeated" placeholder="REPEAT PASSWORD*">
            </div>
            <div class="row3">
                <input type="submit" name="signupBtn" value="Sign up" class="btn">
            </div>
        </form>
        <p class="errorMessage" id="errorMessage">
        <?php
            if(isset($_GET["error"])) {
                if($_GET["error"] == "emptyfields") {
                    echo '<p class="errorMessage" id="errorMessage">Fill in all fields!</p>';
                }
                
                else if($_GET["error"] == "invalidemail") {
                    echo '<p class="errorMessage" id="errorMessage">Choose a proper email!</p>';
                }

                else if($_GET["error"] == "invalidusername") {
                    echo '<p class="errorMessage" id="errorMessage">Choose a proper username!</p>';
                }

                else if($_GET["error"] == "unmatchpasswords") {
                    echo '<p class="errorMessage" id="errorMessage">The two passwords do not match!</p>';
                }

                else if($_GET["error"] == "existingaccount") {
                    echo '<p class="errorMessage" id="errorMessage">Email/Username already exists. Choose another one!</p>';
                }

                else if($_GET["error"] == "queryfailed") {
                    echo '<p class="errorMessage" id="errorMessage">Something went wrong, try again!</p>';
                }

                else if($_GET["error"] == "none") {
                    echo '<p class="errorMessage" id="errorMessage">You have signed up successfully! Go to <a href="/login/">login page</a></p>';
                }
            }
        ?>
        <p>
    </section>
    
<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/elements/footer.php") ?>