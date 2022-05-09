<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/components/header.php") ?>

    <div class="container">
        <div class="hero"></div>

        <?php
            if(!(isset($_SESSION['user_id']))) {
                header("Location: /");
                exit();
            }
        ?>

        <main>
            <form class="formDiv preview-area" action="<?php if($_GET["title"]) echo "updateArticle.php?title=".urlencode($_GET["title"])."&oldDate=".$_GET["date"]."&img=".urlencode($_GET['img']); else echo "createArticle.php";?>" method="post" name="form" enctype="multipart/form-data" onSubmit="return warnBeforeUnload();">
                <div class="row">
                    <input type="text" id="titlebox" name="title" placeholder="TITLE" value="<?php if($_GET["title"]) echo urldecode($_GET["title"]) ?>" required focus>
                </div>
                <div class="row3">
                    <textarea name="text" placeholder="TEXT" required><?php if($_GET["text"]) echo urldecode($_GET["text"]); ?></textarea>
                </div>
                <div class="row" style="display:flex;">
                    <div class="row">
                        <input class="requiredInput" type="file" id="fileToUpload" name="fileToUpload" accept="image/*" <?php if(!$_GET["title"]) echo "required"; ?>>
                    </div>
                    <div class="topic-selection row">
                        <div id="newtopic" style="display:flex;">
                            <input type="text" id="topic-bar" name="topics[]" placeholder="Insert a topic..." required>
                            <a class="btn" id="push">Add</a>
                        </div>
                        <div id="topics"></div>
                    </div>
                </div>
                <div class="row3">
                    <input type="submit" name="createBtn" value="PUBLIC" class="btn">
                    <a data-modal-target="#modal" name="previewBtn" class="btn">Preview</a>
                </div>
            </form>

            <div class="modal" id="modal">
                <div class="modal-header">
                    <div class="title">Article preview</div>
                    <button data-close-button class="close-button">&times;</button>
                </div>
                <div class="modal-body">
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
                        <div class="content inserted-text">
                            <!--<p class="inserted-text"></p>-->
                        </div>
                        <!--<div class="tags">
                            ".$topics."
                        </div>-->
                    </main>
                </div>
            </div>
            <div id="overlay"></div>

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

<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/components/footer.php") ?>