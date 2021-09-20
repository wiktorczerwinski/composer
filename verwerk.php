<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$email_address = $_POST['email_address'];
$feedback = $_POST['feedback'];

function filter_email_header($form_field)
{
    return preg_replace('/[nr|!/<>^$%*&]+/', '', $form_field);
}

$email_address = filter_email_header($email_address);

$mail = new PHPMailer(true);

try {

    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Port = 2525;
    $mail->Username = '3f99d747b7dcab';
    $mail->Password = 'e067dc188eee6b';
    //Recipients
    $mail->setFrom('czerwinskiwiktor@gmail.com', 'Mailer');
    $mail->addAddress('wiktor.czerwinski@ictmbo.nl');


    $mail->isHTML(true);
    $mail->Subject = 'uw klacht is in behandeling';
    $mail->Body = $feedback;
    $mail->AltBody = '';

    $mail->send();
    echo 'Bericht is verstuurd';
} catch (Exception $e) {
    echo "Het bericht kon niet verzonden worden. Bericht foutmelding: {$mail->ErrorInfo}";
}
