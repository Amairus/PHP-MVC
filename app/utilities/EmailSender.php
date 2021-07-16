<?php

namespace App\Utilities;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailSender
{

    public static function sendEmail($name, $email, $subject, $message)
    {
        //Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'weplayallgames741@gmail.com';                     //SMTP username
            $mail->Password   = 'youtube9128';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('weplayallgames741@gmail.com', 'Collection Garage');
            $mail->addAddress('weplayallgames741@gmail.com', 'Collection Garage');               //Name is optional

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $name.' contacted us!';
            $mail->Body    = "Applyer's name:".$name."<br> Email: ".$email."<br> Subject: ".$subject."<br> Message: ".$message."";
            $mail->AltBody = "Applyer's name:".$name."<br> Email: ".$email."<br> Subject: ".$subject."<br> Message: ".$message."";

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }

}

?>