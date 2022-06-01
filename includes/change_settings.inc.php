<!-- script for changing settings in profile section -->
<?php
    session_start();

    include_once('utility.inc.php');

    if(!(isset($_POST['settingBtn']))) {
        header('Location: /');
        exit();
    }

    $setting = $_GET['set'];
    $settingValue = $_POST[$setting];
    $username = $_SESSION['user_name'];

    if($setting == 'a_username') $_SESSION['user_name'] = $settingValue;
    else if($setting == 'a_pw') $settingValue = hash('SHA512', $settingValue);

    $changeSettingQuery = "UPDATE account SET $setting = $1 WHERE a_username ='$username';";
    makeAQuery($changeSettingQuery, array($settingValue));

    header('Location: /profile/index.php?message=changed');
?>