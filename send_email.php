<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipient = "ajay.kanagaraj@sifycorp.com"; // Set the recipient email here
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    // File upload handling code can go here

    // Send email
    $headers = "From: ajay.kanagaraj@sifyccrp.Com\r\n";
    $headers .= "Reply-To: your@example.com\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    if (mail($recipient, $subject, $message, $headers)) {
        echo "Email sent successfully.";
    } else {
        echo "Failed to send email.";
    }
} else {
    echo "Error: Invalid request.";
}
?>
