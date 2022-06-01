<!-- script for deleting images updated on server -->
<?php
    $filename = $dirPath . urldecode($_GET['img']);
    
    if (file_exists($filename)) {
        unlink($filename);

    } else {
        echo 'Could not delete '.$filename.', file does not exist';
        exit();
    }
?>