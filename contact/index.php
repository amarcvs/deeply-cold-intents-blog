<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/components/header.php") ?>

    <section class="contact">
        <div class="title" id="contact">
            <h2>Get in touch</h2>
            <p>Do not hesitate to contact me if you want to know more about the blog, on a particular post or in case of collaboration.</p>
        </div>
        <form class="formDiv" action="../includes/send_email.inc.php" method="post" name="form" id="contactform" enctype="multipart/form-data" onSubmit="return checkContactForm();">
            <div class="row">
                <input type="text" name="name" placeholder="FULL NAME*" maxlength="30">
                <input type="text" name="email" placeholder="E-MAIL*" maxlength="30">
            </div>
            <div class="row2">
                <input type="text" name="subject" placeholder="SUBJECT">
            </div>
            <div class="row3">
                <textarea name="body" placeholder="MESSAGE*"></textarea>
            </div>
            <div class="row3">
                <input type="submit" name="sendBtn" value="Send" class="btn">
            </div>
        </form>
        <p class="errorMessage" id="errorMessage"></p>
        <?php
            if(isset($_GET["sent"]) && $_GET["sent"] == 'false' && isset($_GET["error"]))
                echo '<p class="errorMessage">E-mail could not be sent. '.$_GET["error"].'!</p>';
            else if(isset($_GET["sent"]) && $_GET["sent"] == 'true')
                echo '<p class="notErrorMessage">E-mail has been sent!</p>';
        ?>
    </section>

<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/components/footer.php") ?>