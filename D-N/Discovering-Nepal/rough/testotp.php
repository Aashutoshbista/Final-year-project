<?php
// Start the session (make sure you have session started before this script)
session_start();

// Include PHPMailer library
require 'path/to/PHPMailerAutoload.php';

// Function to generate OTP
function generateOTP($length = 6)
{
    $characters = '0123456789';
    $otp = '';
    for ($i = 0; $i < $length; $i++) {
        $otp .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $otp;
}

// Function to send OTP email
function sendOTP($email, $otp)
{
    $mail = new PHPMailer;

    // Enable SMTP debugging (0 = no output, 1 = errors and messages, 2 = messages only)
    $mail->SMTPDebug = 0;

    // Use SMTP for sending the email
    $mail->isSMTP();

    // SMTP configuration
    $mail->Host = 'bistaaashutosh@gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'bistaaashutosh@gmail.com';
    $mail->Password = 'monk@1507';
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587; // Use the appropriate port for your SMTP server

    // Email details
    $mail->setFrom('bistaaashutosh@gmail.com', 'aashutosh');
    $mail->addAddress($email);
    $mail->Subject = 'OTP Verification Code';
    $mail->Body = "Your OTP verification code is: $otp";

    if (!$mail->send()) {
        return false;
    } else {
        return true;
    }
}

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the email address (you can add more validation if needed)
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Generate a 6-digit OTP
    $otp = generateOTP();

    // Save the OTP in the session for verification later
    $_SESSION['OTP'] = $otp;

    // Send the OTP to the user's email
    if (sendOTP($email, $otp)) {
        echo 'OTP sent successfully. Please check your email.';
    } else {
        echo 'Failed to send OTP. Please try again later.';
    }
}
?>

<!-- HTML form to submit the email address -->
<!DOCTYPE html>
<html>

<head>
    <title>OTP Verification</title>
</head>

<body>
    <h2>OTP Verification</h2>
    <form method="post" action="">
        <label for="email">Enter your email address:</label>
        <input type="email" name="email" required>
        <button type="submit">Send OTP</button>
    </form>
</body>

</html>
