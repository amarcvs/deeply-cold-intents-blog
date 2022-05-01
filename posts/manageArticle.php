<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/elements/header.php") ?>

    <div class="container">
        <div class="hero"></div>

        <?php
            if(!(isset($_SESSION['user_id']))) {
                header("Location: /");
                exit();
            }
        ?>

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
                    <a href="article.php?" name="previewBtn" class="btn" target="_blank">Preview</a>
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

<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/elements/footer.php") ?>