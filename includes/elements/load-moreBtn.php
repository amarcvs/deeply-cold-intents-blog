<?php 
    if($rows > 3 && $rows > $limit)
        echo
        "
        <div class=\"hidden-anchor\">
            <a name=\"more-posts\" href=\"\"></a>
        </div>
        <div class=\"title\">
            <a href=\"#more-posts\" class=\"btn addMargin\" id=\"load-more\">Load more</a>
        </div>";
?>