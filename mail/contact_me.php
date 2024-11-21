<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php'; // Path to PHPMailer
require 'PHPMailer/Exception.php';

if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['message']) || 
   !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo "No arguments Provided!";
    return false;
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));

$mail = new PHPMailer(true);

try {
    // Gmail SMTP Configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'yuktidoshi@gmail.com'; // Replace with your Gmail
    $mail->Password = '#Yukti123#';   // Replace with your Gmail App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Sender and recipient
    $mail->setFrom('yuktidoshi@gmail.com', 'Your Website');
    $mail->addAddress('yuktidoshi@gmail.com'); // Your email to receive messages
    $mail->addReplyTo($email_address, $name);

    // Email content
    $mail->isHTML(false);
    $mail->Subject = "Website Contact Form: $name";
    $mail->Body = "You have received a new message from your website contact form.\n\n" .
                  "Name: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";

    $mail->send();
    echo "Message sent successfully!";
} catch (Exception $e) {
    echo "Message could not be sent. Error: {$mail->ErrorInfo}";
}
?>
