<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Retrieve the submitted email and password from the login form
$email = $_POST['email'];
$password = $_POST['password'];

// Connect to the database
$servername = 'localhost';
$username = 'root';
$dbpassword = '';
$dbname = 'project1';

$conn = new mysqli($servername, $username, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the SQL statement to retrieve the user's password
$stmt = $conn->prepare("SELECT Password FROM coding WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if a user with the provided email exists
if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $storedPassword = $row['Password'];

    // Check if the entered password matches the stored password
    if ($password === $storedPassword) {
        // Password is correct, redirect to the homepage or perform further actions
        echo '<h1>Sign succesful your session has been started!</h1>';
        echo '<a href="homepage.html">Go back to the form</a>';
        sleep(5);
        header("Location: homepage.html");
        session_start();
        $_SESSION['user'] = 1;
        exit();
    } else {
        // Invalid password, redirect back to the sign-in form with an error
         echo "Invalid email or password. Please sign in again.";
         echo '<br><a href="sign_in.html">Sign in again!!</a>';
        exit();
    }
} else {
    echo "Invalid email or password. Please sign in again.";
    echo '<br><a href="sign_in.html">Sign in again!!</a>';
   exit();
}

// Close the database connection
$stmt->close();
$conn->close();
?>
