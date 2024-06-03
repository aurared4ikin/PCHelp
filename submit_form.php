<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the input data
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format";
    }

    // Check if all fields are filled
    if (empty($name) || empty($email) || empty($message)) {
        $error_message = "All fields are required";
    }

    // If there are no validation errors, send the email
    if (empty($error_message)) {
        $to = "korobenkoigor12@gmail.com";
        $subject = "New contact form submission";
        $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
        $headers = "From: $email";

        if (mail($to, $subject, $body, $headers)) {
            $success_message = "Thank you for contacting us. We will get back to you shortly.";
        } else {
            $error_message = "There was a problem sending your message. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Contact Form Submission</h1>
        </div>
    </header>
    <section id="contact-response" class="section">
        <div class="container">
            <?php if (!empty($error_message)): ?>
                <div class="error-message">
                    <p><?php echo htmlspecialchars($error_message); ?></p>
                </div>
            <?php elseif (!empty($success_message)): ?>
                <div class="success-message">
                    <p><?php echo htmlspecialchars($success_message); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <footer>
        <div class="container">
            <p>&copy; 2024 Remote Computer Setup Services. All rights reserved.</p>
        </div>
    </footer>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        header {
            background: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
        .section {
            padding: 50px 0;
            text-align: center;
        }
        .error-message, .success-message {
            padding: 20px;
            margin: 20px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .error-message {
            background: #fdd;
            color: #900;
        }
        .success-message {
            background: #dfd;
            color: #090;
        }
        footer {
            background: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</body>
</html>