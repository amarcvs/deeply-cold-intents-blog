<?php
    $filename = $dirPath . urldecode($_GET["img"]);
    
    if (file_exists($filename)) {
        unlink($filename);
        // echo 'File '.$filename.' has been deleted';
    } else {
        echo 'Could not delete '.$filename.', file does not exist';
        exit();
    }
?>