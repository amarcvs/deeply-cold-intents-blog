<?php
    if(!pg_free_result($result)) echo "Error on free the memory!";
    pg_close($dbconn);
?>