<?php

use PHPMailer\PHPMailer\PHPMailer; // PHPMailer

require "vendor/autoload.php";

// Start the session
if(!isset($_SESSION))
{
    session_start();
}

// Initialize variables
$user = []; // Data sent by the user
$errors = []; // Errors
$successMessage = ""; // Success message


// Set the "user" variable for the session
if(!isset($_SESSION["user"]))
{
    // Assign user data to the session variable
    $_SESSION["user"] = $user;
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Assign input values to the user variable
    $_SESSION["user"]["username"] = trim($_POST["username"]) ?? "";
    $_SESSION["user"]["email"] = trim($_POST["email"]) ?? "";
    $_SESSION["user"]["body"] = trim($_POST["body"]) ?? "";
    $_SESSION["user"]["files"] = $_FILES["files"] ?? null;

    // Rename user session variables
    $username = $_SESSION["user"]["username"];
    $email = $_SESSION["user"]["email"];
    $body = $_SESSION["user"]["body"];
    $files = $_SESSION["user"]["files"];

    // Validate username
    if (empty($username)) {
        $errors["username"] = "Username is required.";
    }

    // Validate email
    if (empty($email)) {
        $errors["email"] = "Email is required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email format.";
    }

    // Validate body
    if (empty($body)) {
        $errors["body"] = "Message is required.";
    }

    // Validate files
    if (!empty($files["name"][0])) {
        $allowedExtensions = ["pdf", "txt", "doc", "png", "jpg"];
        $maxFileSize = 5 * 1024 * 1024; // 5 MB

        foreach ($files["name"] as $key => $name) {
            $fileSize = $files["size"][$key];
            $fileExtension = strtolower(pathinfo($name, PATHINFO_EXTENSION));

            if ($fileSize > $maxFileSize) {
                $errors["files"] = "\"".$name."\" size exceeds the maximum limit (5MB).";
                break;
            }

            if (!in_array($fileExtension, $allowedExtensions)) {
                $errors["files"] = "Invalid file extension. Only PDF, TXT, DOC, PNG, and JPG files are allowed.";
                break;
            }
        }

        if (count($files["name"]) > 5) {
            $errors["files"] = "You can only upload a maximum of 5 files.";
        }
    }

    // Process the form if there are no errors
    if (empty($errors)) {
        // Create a new PHPMailer instance
        $mail = new PHPMailer;

        // SMTP configuration for Mailtrap
        $mail->isSMTP();
        $mail->Host = "sandbox.smtp.mailtrap.io";
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = "b506eca58867bd";
        $mail->Password = "b81f82917438c6";

        // Sender and recipient
        $mail->setFrom($email, $username);
        $mail->addAddress("test_email_sending@example.com", "Email testing");

        // Attach files
        foreach ($files["tmp_name"] as $key => $tmpName) {
            $fileName = $files["name"][$key];
            $mail->addAttachment($tmpName, $fileName);
        }

        // Email content
        $mail->isHTML();
        $mail->CharSet = "UTF-8";
        $mail->Subject = "Message from ".$username;
        $mail->Body = $body;

        // Send the email
        if ($mail->send()) {
            // Redirect to the same page with a success parameter
            header("Location: index.php?success=1");
            exit;

        }
        else {
            $errors["notSent"] = "Message could not be sent. Please try again later.";
        }
    }
}

// If redirection happened, we manage the success message:
if (!empty($_SESSION["user"]) && isset($_GET["success"]) && $_GET["success"] == 1)
{
    $successMessage = "Message has been sent successfully. We will answer as soon as possible. Your response will arrive at ".$_SESSION["user"]["email"];
    unset($_SESSION["user"]); // Data are already sent, so we can unset the user session variable
}