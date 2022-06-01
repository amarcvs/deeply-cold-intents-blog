<!-- searchbar component and topics for searching posts -->
        <br/><br/><hr/>
        <div class="title" id="topics">
            <h2>Search or filter by topic</h2>
            <p>You can also use <a href="https://www.google.com/search?q=site%3Adeeplycoldintents.com%2Fposts+cybersecurity">Google</a>.</p>
            <form class="formDiv" action="/posts/search/" method="post" name="form" enctype="multipart/form-data">
                <div class="row">
                    <input type="search" class="requiredInput" name="search" placeholder="SEARCH*" maxlength="30" required>
                    <input type="submit" name="searchBtn" value="Search" class="btn">
                </div>
            </form>
            <br/><br/>
            <?php
                $topicsQuery = "SELECT p_topics AS topics FROM post;";
                $result = makeAQuery($topicsQuery, array());
                $allTopics = findExistingTopics($result);
                echo '<p>'.$allTopics.'</p>';
            ?>
        </div>