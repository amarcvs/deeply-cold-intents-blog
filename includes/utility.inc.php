<!-- utility functions for posts sections and queries to dbb -->
<?php
    function arrayTopics($array) {
        $len = count($array);
        $string = "";
        for($i = 0; $i < $len; ++$i) {
            if(!(strpos($string, $array[$i]) !== false)) {
                $string .= $array[$i] . "  ";
            }
        }
        return "{".str_replace("  ", ",", trim($string))."}";
    }

    function findTopics($t) {
        $topicsArray = explode(',', trim($t, '{}'));
        $len = sizeof($topicsArray);
        for($i = 0; $i < $len; ++$i) {
            if($topicsArray[$i] != "") $topics .= "<a href=\"/posts/search/topics.php?tag=".urlencode(trim($topicsArray[$i], '"'))."\" class=\"btn\">".trim($topicsArray[$i], '"')."</a>";// class=\"btn topic\"
        }
        return $topics;
    }

    function generatePosts($result) {
        while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $topics = findTopics($line['p_topics']);
            
            $dateTime = date('F d Y', strtotime($line['p_date']));

            echo
            "<div class=\"postsColumn\">
                <div class=\"postBx\">
                    <div class=\"imgBx\">
                        <img src=\"/src/uploads/".$line['p_img_url']."\" alt=\"post".$line['p_id']."\" class=\"cover\">
                    </div>
                    <a href=\"/posts/article.php?title=".urlencode($line['p_title'])."&date=".$line['p_date']."\">
                        <div class=\"textBx\">
                            <h3>".$dateTime."<!--<br/><strong>".$line['p_author']."</strong>--></h3>
                            <br/><br/>
                            <h2>".$line['p_title']."</h2>
                            <h3>".substr($line['p_text'], 0, 300)." . . .</h3>
                            <br/>
                            <!--<h5>".$topics."</h5>-->
                        </div>
                    </a>
                </div>
            </div>

            ";
        }
    }

    function findExistingTopics($result) {
        $allTopics = "";
        $allTopicsArray = [];
        while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $allTopicsArray = array_merge($allTopicsArray, explode(',', trim($line['topics'], '{}')));
        }

        $allTopicsArray = array_unique($allTopicsArray);
        sort($allTopicsArray);
        $len = sizeof($allTopicsArray);
        for($i = 0; $i < $len; ++$i) {
            if($allTopicsArray[$i] != "") $allTopics .= "<a href=\"/posts/search/topics.php?tag=".trim($allTopicsArray[$i], '"')."\" class=\"btn topic\">".trim($allTopicsArray[$i], '"')."</a>";
        }

        return $allTopics;
    }

    function makeAQuery($query, $array, $from = "") {
        include_once($_SERVER['DOCUMENT_ROOT']."/includes/db_handler.inc.php");

        $result = pg_query_params($query, $array);
        if(!$result && $from == "checkForms") {
            // exit('Query attempt failed. ' . pg_last_error($dbconn));
            header("Location: ../signup/index.php?error=queryfailed");
            exit();
        }
        else if(!$result) exit('Query attempt failed. ' . pg_last_error($dbconn));

        $res = $result;
        include_once($_SERVER['DOCUMENT_ROOT']."/includes/clear_db_resources.inc.php");

        return $res;
    }
?>