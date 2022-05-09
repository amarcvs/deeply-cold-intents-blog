<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/components/header.php") ?>

    <section class="profile bootstrap" id="profile">
        <div class="container mt-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-7">
                    <div class="card p-3 py-4">
                        <div class="d-flex justify-content-center">
                            <div class="profile-img" id="profile-img"></div>
                        </div>
                        <div class="text-center mt-3">
                            <span class="bg-secondary p-1 px-4 rounded text-white">Admin</span>
                            <h5 class="mt-2 mb-0 info"><?php echo $_SESSION["user_name"]?></h5>
                            <span class="info">Author | Technical staff</span>
                            <div class="px-4 mt-1">
                                <?php
                                    if(!(isset($_SESSION['user_id']))) {
                                        header("Location: /");
                                        exit();
                                    }

                                    include_once("../includes/utility.inc.php");

                                    $user   = $_SESSION['user_name'];
                                    $countPostsQuery = "SELECT * FROM (SELECT count(p_id) AS posted FROM post where p_author = $1) AS posted natural join (SELECT count(p_id) AS updated FROM post WHERE p_who_updated = $1) AS updated;";
                                    $result = makeAQuery($countPostsQuery, array($user));
                                    $line   = pg_fetch_array($result, null, PGSQL_ASSOC);
                                ?>
                                <p><!-- description --><?php echo "<br/><br/>Public created posts: <strong>" . $line['posted'] . "</strong>"; echo "<br/>Public updated posts: <strong>" . $line['updated'] . "</strong>";?><br/><a href="/posts/manageArticle.php">Create a new post</a></p>
                            </div>
                            <form class="formDiv" name="form" action= <?php echo "../includes/change_profile_img.inc.php?img=". $_SESSION['user_img']?> method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="submit" name="createBtn" value="Upload Image" class="btn btn-outline-secondary">
                                    <input type="file" class="form-control requiredInput" name="fileToUpload" id="fileToUpload" required>
                                </div>
                            </form>
                            <div class="buttons">
                                <a href="/includes/logout.inc.php" class="btn btn-outline-primary px-4">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/components/footer.php") ?>