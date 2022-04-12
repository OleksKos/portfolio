<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->setLanguage('en','phpmailer/language/');
$mail->IsHtml(true);

//From
$mail->setFrom('admin@freeproagent.site', 'My site');
//To
$mail->addAddress('maindmn@gmail.com');
//Subject
$mail->Subject = 'Hello! This is letter from the site';

//Body
$body = '<h1>You have new message from the site</h1>';
if (trim(!empty($_POST['name']))) {
    $body.='<p><strong>Name: </strong>'.$_POST['name'].'</p>';
}
if (trim(!empty($_POST['email']))) {
    $body.='<p><strong>E-mail: </strong>'.$_POST['email'].'</p>';
}
if (trim(!empty($_POST['subject']))) {
    $body.='<p><strong>Subject: </strong>'.$_POST['subject'].'</p>';
}
if (trim(!empty($_POST['message']))) {
    $body.='<p><strong>Message: </strong>'.$_POST['message'].'</p>';
}

$mail->Body = $body;

//Send
if (!$mail->send()) {
    $message = 'Error';
}else{
    $message = 'Email was sent!';
}
$response = ['message=>$message'];
header('Content-type:application/json');
echo json_encode($response);
?>