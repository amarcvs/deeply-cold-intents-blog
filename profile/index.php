<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/elements/header.php") ?>

    <section class="profile" id="profile">
        <div class="contentBx">
            <h2>Profile</h2>
            <h4>Personal area: <?php echo $_SESSION["user_name"]?></h4>
            <div class="profile-img" id="profile-img"></div>
            
            <a href="/posts/manageArticle.php" class="btn">Create a post</a>
            <a href="/includes/logout.inc.php" class="btn">Logout</a>

            <form class="formDiv" name="form" action= <?php echo "../includes/changeImg.inc.php?img=". $_SESSION['user_img']?> method="post" enctype="multipart/form-data">
                <div class="row">
                    <input type="file" name="fileToUpload" id="fileToUpload" required>
                    <input type="submit" name="createBtn" value="Upload Image" class="btn">
                </div>
            </form>
        </div>
        <div class="contentBx">
            <h2>Data:</h2>
            <p></p>
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

                echo "<p>Public created posts: " . $line['posted'] . "</p>";
                echo "<p>Public updated posts: " . $line['updated'] . "</p>";
            ?>
        </div>
    </section>

<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/elements/footer.php") ?>