<?php
$Name = $_POST['Name'];
$Email = $_POST['Email'];
$Password = $_POST['Password'];
$confirm_Password = $_POST['confirm'];

// Validate form data
$errors = [];

// Check if name is empty
if (empty($Name)) {
    $errors[] = "Name is required.";
}

// Check if email is empty and valid
if (empty($Email)) {
    $errors[] = "Email is required.";
} elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}

// Check if password is empty and meets certain criteria
if (empty($Password)) {
    $errors[] = "Password is required.";
} elseif (strlen($Password) < 6) {
    $errors[] = "Password should be at least 6 characters long.";
}

// Check if confirm password matches the password
if ($Password !== $confirm_Password) {
    $errors[] = "Passwords do not match.";
}

// If there are any errors, display them and redirect back to the form
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
    echo '<a href="sign_up.html">Go back to the form</a>';
    exit;
}



$conn = new mysqli('localhost', 'root', '', 'project1');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO coding (Name, Email, Password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $Name, $Email, $Password);
    $stmt->execute();
    echo "Registration Successful";

    echo '<br><a href="homepage.html">Go  to  homepage</a>';
    // header("Location: sign_in.html");
    exit();

    $stmt->close();
    $conn->close();
}
?>
