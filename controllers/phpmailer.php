<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require_once "../libs/phpmailer/PHPMailer.php";
    require_once "../libs/phpmailer/SMTP.php";
    require_once "../libs/phpmailer/Exception.php";
    
    function sendMailing ( $Sujet, $Message, $Destinataire, $PJS = false, $Reply = 'contact@associationarchedenoe.fr' ) {

        $mail = new PHPMailer();
        $mail->CharSet = "UTF-8";
        $mail->isSMTP();
        $mail->Host = "smtp.hostinger.fr";
        $mail->SMTPAuth = true;
        $mail->Username = "contact@associationarchedenoe.fr";
        $mail->Password = 'uxaqiypjcegnevqe';
        $mail->Port = 465;  // port
        $mail->SMTPSecure = "ssl";  // tls or ssl

        $mail->From = "contact@associationarchedenoe.fr";
        $mail->FromName = "Institut L'Arche de Noé";

        $mail->addAddress($Destinataire);
        $mail->isHTML(true);
        
        if ( $PJS ) {
            $mail->addAttachment($PJS);
        }

        $mail->addReplyTo($Reply, 'Reply to');
        
        $mail->Subject = $Sujet;
        $mail->Body = $Message;

        return $mail->send() ? true : false;
    }
?>