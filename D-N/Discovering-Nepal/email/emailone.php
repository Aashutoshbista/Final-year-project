<?php

$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

//$mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->Username = "rovingrg659@gmail.com";
$mail->Password = "pxoszetftdqnntdv";

$mail->setFrom($email, $name);
$mail->addAddress($email, "Notra");

$mail->Subject = $subject;
$mail->Body = $message;

$mail->send();
echo "email sent sucessfully";

//header("Location: sent.php");
?>