<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

$mail = new PHPMailer(true);

try {
    // SMTP settings (Mailtrap OR Gmail — choose one)
    $mail->isSMTP();
    $mail->Host = 'sandbox.smtp.mailtrap.io';  // for Mailtrap (testing)
    $mail->SMTPAuth = true;
    $mail->Username = 'your_mailtrap_username';   // your Mailtrap username
    $mail->Password = 'your_mailtrap_password';   // your Mailtrap password
    $mail->Port = 2525;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    // Email info
    $mail->setFrom('autoassistant@example.com', 'Auto Assistant');
    $mail->addAddress('repairshop@example.com', 'Repair Shop');

    // Breakdown details (assuming you collected these)
    $vehicle = $_POST['vehicle'];
    $location = $_POST['location'];
    $issue = $_POST['issue'];
    $user = $_SESSION['name'];

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'New Breakdown Request Submitted';
    $mail->Body    = "
        <h3>🚗 New Breakdown Request</h3>
        <p><strong>Name:</strong> $user</p>
        <p><strong>Vehicle:</strong> $vehicle</p>
        <p><strong>Location:</strong> $location</p>
        <p><strong>Issue:</strong> $issue</p>
    ";

    $mail->send();
    echo "✅ Email sent to repair shop.";
} catch (Exception $e) {
    echo "❌ Mailer Error: {$mail->ErrorInfo}";
}
?>
