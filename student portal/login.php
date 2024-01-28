<?php
// Include database connection file
require_once 'dbconnect.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email and password are empty
    if (empty($email) || empty($password)) {
        echo "<script>alert('Please enter email and password.');</script>";
    } else {
        // Prepare SQL query to check user credentials
        $sql = "SELECT user_id, role, password FROM Users WHERE email = '$email'";

        // Execute query
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            // Fetch user data
            $row = mysqli_fetch_assoc($result);
            $userId = $row['user_id'];
            $userRole = $row['role'];
            $hashedPassword = $row['password'];

            // Verify password
            if (password_verify($password, $hashedPassword)) {
                // Successful login
                session_start();
                $_SESSION['user_id'] = $userId;
                $_SESSION['role'] = $userRole;

                // Redirect based on user role
                if ($userRole == 'student') {
                    header('Location: student.php');
                } else if ($userRole == 'admin') {
                    header('Location:admin/admindashboard.php');
                } else if ($userRole == 'teacher') {
                    header('Location: teacher.php');
                }
            } else {
                echo "<script>alert('Invalid password.');</script>";
            }
        } else {
            echo "<script>alert('Invalid email or user not found.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Login</h2>

        <form action="login.php" method="post" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <div class="invalid-feedback">
                    Please enter your email address.
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="invalid-feedback">
                    Please enter your password.
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>
       
            (function () {
                'use strict';

    // Get form elements
    const emailInput = document.getElementById('email');
    const emailFeedback = document.querySelector('#email + .invalid-feedback');

    // Validate email on input change
    emailInput.addEventListener('input', function () {
        const emailValue = emailInput.value.trim();
        const validEmailRegex = /^[a-zA-Z0-9.+_-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        if (emailValue === '') {
            emailFeedback.textContent = 'Please enter your email address.';
            emailInput.classList.add('is-invalid');
        } else if (!validEmailRegex.test(emailValue)) {
            emailFeedback.textContent = 'Please enter a valid email address.';
            emailInput.classList.add('is-invalid');
        } else {
            emailFeedback.textContent = '';
            emailInput.classList.remove('is-invalid');
        }
    });
})();
