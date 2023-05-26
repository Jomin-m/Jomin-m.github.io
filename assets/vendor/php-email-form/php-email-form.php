<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  // Validate form data (perform additional validation if needed)
  if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
    // Set recipient email address
    $to = 'jominmathew@lewisu.edu';

    // Set email headers
    $headers = "From: $name <$email>" . "\r\n";
    $headers .= "Reply-To: $email" . "\r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";

    // Compose the email message
    $email_message = "
      <html>
      <head>
        <title>New Contact Form Submission</title>
      </head>
      <body>
        <h2>New Contact Form Submission</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Subject:</strong> $subject</p>
        <p><strong>Message:</strong> $message</p>
      </body>
      </html>
    ";

    // Send the email
    if (mail($to, $subject, $email_message, $headers)) {
      echo 'success';
    } else {
      echo 'error';
    }
  } else {
    echo 'error';
  }
} else {
  echo 'error';
}
?>
