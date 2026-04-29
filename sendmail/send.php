<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    // Get form data safely
    $full_name = isset($_POST['full_name']) ? $_POST['full_name'] : '';
    $phone     = isset($_POST['phone']) ? $_POST['phone'] : '';
    $email     = isset($_POST['email']) ? $_POST['email'] : '';
    $requirements   = isset($_POST['requirements']) ? $_POST['requirements'] : '';

    $mail = new PHPMailer(true);

    try {

        // SMTP Settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';   
        $mail->SMTPAuth   = true;
        $mail->Username   = 'jitender@digicots.com';
        $mail->Password   = 'tmbiihppypejlnhz';   // Gmail App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Email Settings
        $mail->setFrom('jitender@digicots.com', 'Bento LP Form');
        // $mail->addAddress('shaqibwebror@gmail.com'); 
        $mail->addAddress('moulik@head-field.com'); 
        $mail->addCC('sk@head-field.com');    
        $mail->addCC('nakul@headfield.com');    

        $mail->addReplyTo($email, $full_name);

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = 'New Enquiry From Website';

        $mail->Body = "
        <h3>New Enquiry Received</h3>

        <b>Name:</b> {$full_name} <br>
        <b>Phone:</b> {$phone} <br>
        <b>Email:</b> {$email} <br>
        <b>Requirements:</b> {$requirements} <br>
        ";

        $mail->send();

        // Redirect after success
        header("Location: ../thankyou.html");
        exit();

    } catch (Exception $e) {
        echo "Message could not be sent. Error: {$mail->ErrorInfo}";
    }

}else{
    echo "Invalid Request";
}
?>