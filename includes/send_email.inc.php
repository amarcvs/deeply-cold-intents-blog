<!-- script for contact form which send email using encryption -->
<?php
    if (!isset($_POST['name']) || !isset($_POST['email'])) {
        header('Location: /');
        exit();
    }

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'email/vendor/autoload.php';
    include_once('ini_handler.inc.php');

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $messageBody = trim($_POST['body']);

    $mail = new PHPMailer(TRUE);
    $emailFrom = $ini['SMTP_EMAIL'];

    try {
        /* SMTP settings. */
        /* Tells PHPMailer to use SMTP. */
        $mail->isSMTP();
        
        /* SMTP server address. */
        /* Google (Gmail) SMTP server. */
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        /* Use SMTP authentication. */
        $mail->SMTPAuth = TRUE;
        /* Set the encryption system. */
        $mail->SMTPSecure = 'tls';
        
        /* SMTP authentication username. */
        /* Username (email address). */
        $mail->Username = $emailFrom;

        /* SMTP authentication password. */
        /* Google account password. */
        $mail->Password = $ini['SMTP_PASSWORD'];
        /*******************************/
        
        $mail->setFrom($emailFrom, 'Deeply Cold Intents');
        $mail->addAddress($ini['PERSONAL_EMAIL'], 'Marco Alberti');
        $mail->addBCC($emailFrom, 'Deeply Cold Intents');

        $mail->isHTML(true);
        $mail->Subject = $subject;

        $body = 
            '<h2>|DCI|</h2>
            <p>
                <strong>FROM:</strong> ' . $email . '<br/>
                <strong>FULL NAME:</strong> ' . $name . 
            '</p>
            <p>
                <strong>MESSAGE:</strong> ' . $messageBody . 
            '</p>';

        $mail->Body = $body;
        $mail->AltBody = 'From: ' . $email . ' | Full name: ' . $name . ' | Message: ' . $messageBody;

        $mail->send();
        header('Location: /contact/index.php?sent=true');
    }
    catch (Exception $e) {
        /* PHPMailer exception. */
        // echo $mail->ErrorInfo
        header('Location: /contact/index.php?sent=false&error=' . strip_tags($e->errorMessage()));
    }
    catch (\Exception $e) {
        /* PHP exception (note the backslash to select the global namespace Exception class). */
        // echo $mail->ErrorInfo
        header('Location: /contact/index.php?sent=false&error=' . strip_tags($e->errorMessage()));
    }