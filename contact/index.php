<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/elements/header.php") ?>

    <section class="contact">
        <div class="title" id="contact">
            <h2>Get in touch</h2>
            <p>Do not hesitate to contact me if you want to know more about the blog, on a particular post or in case of collaboration.</p>
        </div>
        <form class="formDiv" action="../includes/sendEmail.php" method="post" name="form" enctype="multipart/form-data" onSubmit="return checkForm();">
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

<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/elements/footer.php") ?>