<?php
$Name = $_POST['name'];
$Email = $_POST['email'];
// $Password = $_POST['Password'];
$Message = $_POST['message'];

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
if (empty($Message)) {
    $errors[] = "Message is required.";}
//   elseif (strlen($Password) < ) {
    // $errors[] = "Password should be at least 6 characters long.";
// }


// If there are any errors, display them and redirect back to the form
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
    echo '<a href="contact.html">Go back to the page</a>';
    exit;
}



$conn = new mysqli('localhost', 'root', '', 'project1');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO contacts (Name, Email, Message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $Name, $Email, $Message);
    $stmt->execute();
    echo "message sent successfully";

    echo '<br><a href="homepage.html">Go back to  homepage</a>';
    // header("Location: homepage.html");
    exit();

    $stmt->close();
    $conn->close();
}
?>
