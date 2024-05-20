<?php

// Import necessary classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoload file
require 'vendor/autoload.php';

$mail = new PHPMailer(true);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $communication = implode(', ', $_POST['comm']);
    $event_date = $_POST['date'];
    $date_flexible = isset($_POST['date_flexible']) ? 'Yes' : 'No';
    $address = $_POST['address'];
    $event_type = $_POST['type'];
    $guest_count = $_POST['count'];
    $budget = $_POST['budget'];
    $hear_about = $_POST['hear'];
    $social_media = $_POST['social'];
    $more_info = $_POST['info'];

    // Create a new PHPMailer instance

    try {
        $mail ->SMTPDebug = SMTP::DEBUG_SERVER;
        // SMTP settings for Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nguyenhctracy@gmail.com'; // Your Gmail address
        $mail->Password = 'xrgltptcbcnlnwkd'; // Your Gmail password
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        // $mail->SMTPSecure = "ssl";
        // $mail->Port = 465;

        // Sender and recipient settings
        $mail->setFrom($email, $name); // Sender's email and name
        $mail->addAddress('nguyenhctracy@gmail.com', 'Tracy Nguyen');

        // Email subject and body
        $mail->isHTML(true);
        $mail->Subject = 'New Event Planning Inquiry';
        $mail->Body = "
            <h1>New Event Planning Inquiry</h1>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Preferred Method of Communication:</strong> $communication</p>
            <p><strong>Event Date:</strong> $event_date</p>
            <p><strong>Is the Date Flexible:</strong> $date_flexible</p>
            <p><strong>Address for Event:</strong> $address</p>
            <p><strong>Event Type:</strong> $event_type</p>
            <p><strong>Estimated Guest Count:</strong> $guest_count</p>
            <p><strong>Estimated Total Budget:</strong> $budget</p>
            <p><strong>How did you hear about us?</strong> $hear_about</p>
            <p><strong>Social Media Accounts:</strong> $social_media</p>
            <p><strong>More Information:</strong> $more_info</p>
        ";

        // Send email
        $mail->send();
        header("Location: sent.html");
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
