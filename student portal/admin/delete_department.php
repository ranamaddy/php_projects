<?php
// Include database connection file
require_once '../dbconnect.php';
session_start();
// Check if admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Get department ID from URL parameter
$departmentId = $_GET['id'];

// Check if department ID is valid
if (!empty($departmentId) && is_numeric($departmentId)) {
    // Prepare SQL query to delete department
    $sql = "DELETE FROM Departments WHERE department_id = $departmentId";

    // Execute query
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Department deleted successfully.');</script>";
        header('Location: view_departments.php');
    } else {
        echo "<script>alert('Failed to delete department.');</script>";
    }
} else {
    echo "<script>alert('Invalid department ID.');</script>";
}
?>
