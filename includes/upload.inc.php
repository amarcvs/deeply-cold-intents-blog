<!-- script for uploading images on server -->
<?php
    $target_dir    = $dirPath;
    $target_file   = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk      = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $errormessage = 'none';
    // Check if image file is a actual image or fake image
    if(isset($_POST["createBtn"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            //echo "File is not an image.";
            $errormessage = 'notimg';
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        //echo "Sorry, file already exists.";
        $errormessage = 'imgexists';
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        //echo "Sorry, your file is too large.";
        $errormessage = 'imglarge';
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $errormessage = 'wrongtype';
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        // echo "Sorry, your file was not uploaded.";
        //header("Location: createArticle?result=error");
        if(strpos($_SERVER['REQUEST_URI'], 'profile') !== false)
            header('Location: ../profile/index.php?error=' . $errormessage);
        else
            header('Location: ../posts/manageArticle.php?error=' . $errormessage);
        exit();

    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            // header("Location: ./profile?result=uploaded");
            // header("Location: ../profile/");
        } else {
            // echo "Sorry, there was an error uploading your file.";
            if(strpos($_SERVER['REQUEST_URI'], 'profile') !== false)
                header('Location: ../profile/index.php?error=general');
            else
                header('Location: ../posts/manageArticle.php?error=general');
            exit();
        }
    }
?>