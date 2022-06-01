<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/components/header.php") ?>

    <section class="profile bootstrap" id="profile">
        <div class="container mt-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-7">
                    <div class="card p-3 py-4">
                        <div class="d-flex justify-content-center img-box">
                            <div class="profile-img" id="profile-img"></div>
                            <span class="bg-secondary p-1 px-4 rounded text-white"><?php echo $_SESSION["user_name"]?></span>
                            <a data-modal-target="#modalMsg" id="changeEmailBtn" class="btn setting">Change e-mail</a>
                            <a data-modal-target="#modalMsg" id="changeUsernameBtn" class="btn setting">Change username</a>
                            <a data-modal-target="#modalMsg" id="changePasswordBtn" class="btn setting">Change password</a>
                            <a href="/includes/delete_account.inc.php" class="btn setting" onclick="return warnBeforeUnload();">Delete account</a>
                            <a href="/includes/logout.inc.php" class="btn setting"  onclick="return warnBeforeUnload();">Logout</a>
                        </div>
                        <div class="text-center mt-3">
                            <h5 class="mt-2 mb-0 info">Admin</h5>
                            <span class="info">Author | Technical staff</span>
                            <div class="px-4 mt-1">
                                <?php
                                    if(!(isset($_SESSION['user_name']))) {
                                        header("Location: /");
                                        exit();
                                    }

                                    include_once("../includes/utility.inc.php");

                                    $user   = $_SESSION['user_name'];
                                    $countPostsQuery = "SELECT * FROM (SELECT count(p_id) AS posted FROM post where p_author = $1) AS posted natural join (SELECT count(p_id) AS updated FROM post WHERE p_who_updated = $1) AS updated;";
                                    $result = makeAQuery($countPostsQuery, array($user));
                                    $line   = pg_fetch_array($result, null, PGSQL_ASSOC);
                                ?>
                                <p>Computer engineering student at La Sapienza, University of Rome. Authorized to manage the main activities of the blog.<?php echo "<br/><br/>Online created posts: <strong>" . $line['posted'] . "</strong>"; echo "<br/>Online updated posts: <strong>" . $line['updated'] . "</strong>";?><br/></p>
                            </div>
                            <a href="/posts/manageArticle.php" class="btn btn-outline-secondary">Create a new post</a>
                            <a href="/signup/" class="btn btn-outline-secondary">Create a new mod</a>
                            <form class="formDiv" name="form" action= <?php echo "../includes/change_profile_img.inc.php?img=". $_SESSION['user_img']?> method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="submit" name="createBtn" value="Change image" class="btn btn-outline-secondary">
                                    <input type="file" class="form-control requiredInput" name="fileToUpload" id="fileToUpload" required>
                                </div>

                            </form>
                            <div class="modalMsg modalMsgSettings" id="modalMsg">
                                <div class="modalMsg-header">
                                    <div class="title">Changing settings</div>
                                    <button data-close-button class="close-button">&times;</button>
                                </div>
                                <div class="modalMsg-body"></div>
                            </div>
                            <div id="overlay"></div>
                            <?php
                                if(isset($_GET["error"])) {
                                    if($_GET["error"] == "notimg") {
                                        echo '<p class="errorMessage">File is not an image!</p>';
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
                                    else if($_GET["error"] == "none") {
                                        echo '<p class="notErrorMessage">Image has been successfully updated!</p>';
                                    }
                                }
                                if(isset($_GET["message"])) {
                                    if($_GET["message"] == "changed") {
                                        echo '<p class="notErrorMessage">Settings have been successfully changed!</p>';
                                    }
                                    else if($_GET["message"] == "mod") {
                                        echo '<p class="notErrorMessage">New moderator account has been successfully created!</p>';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/components/footer.php") ?>