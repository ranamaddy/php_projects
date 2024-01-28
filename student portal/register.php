<?php
// Include database connection file
require_once 'dbconnect.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $role = $_POST['role'];

    // Validate and sanitize data
    // Check for empty fields
    if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($confirmPassword) || empty($role)) {
        echo "<script>alert('Please fill in all required fields.');</script>";
    }

    // Check if passwords match
    if ($password != $confirmPassword) {
        echo "<script>alert('Passwords do not match.');</script>";
    }

    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email address.');</script>";
    }

    // Check if role is valid
    if (!in_array($role, ['student', 'admin', 'staff'])) {
        echo "<script>alert('Invalid role selected.');</script>";
    }

    if (empty($errors)) {
        // Hash password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // Prepare SQL query to insert user data
        $sql = "INSERT INTO Users (first_name, last_name, email, password, role) VALUES ('$firstName', '$lastName', '$email', '$hashedPassword', '$role')";

        

        // Execute query using mysqli_query function
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>alert('Registration successful!');</script>";
            // Redirect to login page or welcome page
            header('Location: login.php');
        } else {
            echo "<script>alert('Registration failed. Please try again.');</script>";
        }
    }
}
?>
