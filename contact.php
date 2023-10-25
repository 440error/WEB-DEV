<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
  $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING);

  if (empty($name) || empty($email) || empty($message)) {
    // Handle empty fields
    http_response_code(400); // Bad Request
    exit;
  }

  $to = "rinayush@gmail.com"; // Replace with your email address
  $subject = "New contact form submission from $name";
  $headers = "From: $email";
  $messageContent = "Name: $name\nEmail: $email\nMessage:\n$message";

  if (mail($to, $subject, $messageContent, $headers)) {
    // Email sent successfully
    http_response_code(200); // OK
  } else {
    // Email sending failed
    http_response_code(500); // Internal Server Error
  }
} else {
  // Handle invalid request method
  http_response_code(405); // Method Not Allowed
}
?>
