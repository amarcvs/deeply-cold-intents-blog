<?php include_once($_SERVER['DOCUMENT_ROOT'].'/includes/components/header.php') ?>

    <div class="container">
        <div class="hero"></div>

        <?php
            if(!(isset($_SESSION['user_name']))) {
                header('Location: /');
                exit();
            }
        ?>

        <main>
            <?php
                if(isset($_GET["error"])) {
                    if($_GET["error"] == "notimg") {
                        echo '<p class="errorMessage">File is not an image! Try to change image.</p>';
                    }
                    else if($_GET["error"] == "imgexists") {
                        echo '<p class="errorMessage">Sorry, file (with this name) already exists!</p>';
                    }
                    else if($_GET["error"] == "imglarge") {
                        echo '<p class="errorMessage">Sorry, your file is too large (>500KB)!</p>';
                    }
                    else if($_GET["error"] == "wrongtype") {
                        echo '<p class="errorMessage">Sorry, only JPG, JPEG, PNG & GIF files are allowed!</p>';
                    }
                    else if($_GET["error"] == "general") {
                        echo '<p class="errorMessage">Sorry, there was an internal error uploading your file! Try again later.</p>';
                    }
                }
            ?>
            <form class="formDiv preview-area" action="<?php if($_GET['title']) echo "updateArticle.php?title=".urlencode($_GET['title'])."&oldDate=".$_GET['date']."&img=".urlencode($_GET['img']); else echo "createArticle.php";?>" method="post" name="form" enctype="multipart/form-data" onSubmit="return warnBeforeUnload();">
                <div class="row">
                    <input type="text" id="titlebox" name="title" placeholder="TITLE" value="<?php if($_GET['title']) echo urldecode($_GET['title']) ?>" required focus>
                </div>
                <div class="row3">
                    <textarea name="text" placeholder="TEXT" required><?php if($_GET['text']) echo urldecode($_GET['text']); ?></textarea>
                </div>
                <div class="row settings">
                    <div class="row">
                        <input class="requiredInput" type="file" id="fileToUpload" name="fileToUpload" accept="image/*" <?php if(!$_GET['title']) echo "required"; ?>>
                    </div>
                    <div class="topic-selection row">
                        <div id="newtopic" style="display:flex;">
                            <input type="text" id="topic-bar" name="topics[]" placeholder="Insert a topic..."><!--required-->
                            <a class="btn" id="push">Add</a>
                        </div>
                        <div id="topics"></div>
                    </div>
                </div>
                <div class="row3">
                    <input type="submit" name="createBtn" value="PUBLIC" class="btn">
                    <a data-modal-target="#modalMsg" name="previewBtn" class="btn">Preview</a>
                </div>
            </form>

            <div class="modalMsg" id="modalMsg">
                <div class="modalMsg-header">
                    <div class="title">Article preview</div>
                    <button data-close-button class="close-button">&times;</button>
                </div>
                <div class="modalMsg-body">
                    <main>
                        <div class="profile-container">
                            <div class="profile">
                                <div class="img-container" id="img-container"></div>
                                <div class="text">
                                    <h3><?php echo($_SESSION['user_name']); ?></h3>
                                    <p>Published on <?php echo(date("M d Y"))?></p>
                                </div>
                            </div>
                        </div>
                        <h2 class="inserted-title">title here</h2>
                        <div class="content inserted-text"></div>
                    </main>
                </div>
            </div>
            <div id="overlay"></div>
        </main>
    </div>

<?php include_once($_SERVER['DOCUMENT_ROOT'].'/includes/components/footer.php') ?>