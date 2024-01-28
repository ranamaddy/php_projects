<?php
// Include database connection file
require_once '../dbconnect.php';
session_start();
// Check if admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}


// Process form data if submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $departmentName = $_POST['department_name'];

    // Check if department name is empty
    if (empty($departmentName)) {
        echo "<script>alert('Please enter department name.');</script>";
    } else {
        // Prepare SQL query to insert department
        $sql = "INSERT INTO Departments (department_name) VALUES ('$departmentName')";

        // Execute query
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Department added successfully.');</script>";
            
        } else {
            echo "<script>alert('Failed to add department.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Department</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container ">
<?php
include('menu.php');
?>
    <h2 class="text-center mb-4">Add Department</h2>

    <form action="add_department.php" method="post">
        <div class="mb-3">
            <label for="department_name" class="form-label">Department Name:</label>
            <input type="text" class="form-control" id="department_name" name="department_name" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Department</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
