<?php

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$to = $admin_mail;
define("PALVELU","mailtrap");
if (PALVELU == 'sendgrid'){
    /* SendGrid */      
    define("HOST","smtp.sendgrid.net");
    define("PORT", 587);
    define("USERNAME",$username_sendgrid);
    define("PASSWORD",$password_sendgrid);
    }
    
elseif (PALVELU == 'mailtrap'){
    /* Mailtrap */
    define("HOST",'smtp.mailtrap.io');
    define("PORT",2525);
    define("USERNAME",$username_mailtrap);
    define("PASSWORD",$password_mailtrap);
    //debuggeri("username:".USERNAME.",password:".PASSWORD);
    }

function posti($emailTo,$msg,$subject){
$emailFrom = "wohjelmointi@gmail.com";
$emailFromName = "Ohjelmointikurssi";
$emailToName = "";
try {
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Port = PORT;
    $mail->Host = HOST;
    $mail->Username = USERNAME;
    $mail->Password = PASSWORD;
    $mail->CharSet = 'UTF-8';
    $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
    $mail->SMTPSecure = 'tls'; 
    $mail->setFrom($emailFrom, $emailFromName);
    $mail->addAddress($emailTo, $emailToName);
    $mail->Subject = $subject;
    $mail->msgHTML($msg); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
    $mail->AltBody = 'HTML messaging not supported';
    // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
    if (!$tulos = $mail->send()){
        //$tulos = false;
        debuggeri("Viestiä ei lähetetty: ".$mail->ErrorInfo);
        }    
    else {
        //$tulos = true;
        debuggeri("Viesti lähetetty: $emailTo!");
        }   
    }

catch (Exception $e) {
    $tulos = false;
    debuggeri(__FUNCTION__.','.$e->errorMessage()); 
    debuggeri(__FUNCTION__.',',$e->getMessage()); 
   } 

return $tulos;
}
