<?php
// Include database connection file
require_once '../dbconnect.php';

// Get course ID from URL parameter
$courseId = $_GET['id'];

// Prepare SQL query to delete course
$sql = "DELETE FROM Courses WHERE course_id = ?";

// Prepare statement
$stmt = mysqli_prepare($conn, $sql);

// Bind parameter
mysqli_stmt_bind_param($stmt, "i", $courseId);

// Execute statement
if (mysqli_stmt_execute($stmt)) {
    // Success message
    echo '<div class="alert alert-success">Course deleted successfully!</div>';

    // Redirect to view courses page
    header('refresh:2; url=view_course.php');
} else {
    // Error message
    echo '<div class="alert alert-danger">Failed to delete course!</div>';
}

// Close statement
mysqli_stmt_close($stmt);
?>
