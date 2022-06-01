<?php include_once($_SERVER['DOCUMENT_ROOT'].'/includes/components/header.php') ?>

    <div class="container">
        <div class="hero" id="hero"></div>

        <main>
        <?php
            if(!(isset($_GET['title']))) {
                header('Location: /posts/');
                exit();
            }

            include_once('../includes/utility.inc.php');

            $title  = urldecode($_GET['title']);
            $date   = $_GET['date'];

            $searchPostQuery = "SELECT * FROM post INNER JOIN (SELECT a_username, a_img_profile FROM account) AS account ON p_author = a_username WHERE p_title = $1 AND p_date = $2;";
            $result = makeAQuery($searchPostQuery, array($title, $date));
            $rows   = pg_num_rows($result);

            if(!$rows) {
                echo '<p>There is a problem with this post, or there are no posts available that meet this request!</p>';
                exit();
            }
            else if($rows > 1) {
                echo '<p>A collision occurred. More than one article matches this search!</p>';
                exit();
            }

            $line       = pg_fetch_array($result, null, PGSQL_ASSOC);

            $topics     = findTopics($line['p_topics']);
            $dateTime   = date('F d Y', strtotime($line['p_date']));
            $isUpdated  = $line['p_is_updated'];

            $update = '';
            if($isUpdated == 't') {
                $updatedBy = "";
                if($line['p_who_updated'] != $line['p_author']) $updatedBy = 'by <em>'. $line['p_who_updated'] . '</em> ';
                $update = '<br/>Updated '.$updatedBy.'on ' . date('F d Y', strtotime($line['p_when_updated']));
            }
            ?>

            <div class="profile-container">
                <div class="profile">
                    <div class="img-container" id="img-container"></div>
                    <div class="text">
                        <h3><?php echo $line['p_author'] ?></h3>
                        <!--<p><strong>Software Engineer</strong></p>-->
                        <p>Published on <?php echo $dateTime . $update ?></p>
                    </div>
                </div>
                <?php if($_SESSION['user_name']): ?>
                    <div class="tags">
                        <a href="manageArticle.php?<?php echo 'title=' . urlencode($line['p_title']) . '&text='.urlencode($line['p_text']).'&date='.$line['p_date'].'&img='.$line['p_img_url']?>" class="btn">Update</a>

                        <a href="deleteArticle.php?<?php echo 'title=' . urlencode($line['p_title']) . '&date='.$line['p_date'].'&img='.$line['p_img_url']?>" class="btn" onclick="return warnBeforeUnload();">Delete</a>
                    </div>
                <?php endif; ?>
            </div>

            <h2><?php echo $line['p_title'] ?></h2>

            <div class="content">
                <?php echo $line['p_text'] ?>
            </div>

            <div class="tags">
                <?php echo $topics ?>
            </div>
        </main>
    </div>
    <script>document.title = "<?php echo $line['p_title'].' | Deeply cold intents'?>";</script>

<?php include_once($_SERVER['DOCUMENT_ROOT'].'/includes/components/footer.php') ?>