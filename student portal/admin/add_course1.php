
<?php
// Include database connection file

include('../dbconnect.php');
// Check if form is submitted
if (isset($_POST['submit'])) {
    // Get form data
    $courseName = $_POST['courseName'];
    $courseCode = $_POST['courseCode'];
    $departmentId = $_POST['departmentId'];

    // Prepare SQL query to insert course
    $sql = "INSERT INTO Courses (course_name, course_code, department_id) VALUES (?, ?, ?)";

    // Prepare statement
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssi", $courseName, $courseCode, $departmentId);

    // Execute statement
    if (mysqli_stmt_execute($stmt)) {
        // Success message
       
        header('Location: view_course.php');
    } else {
        // Error message
        echo '<div class="alert alert-danger">Failed to add course!</div>';
    }

    // Close statement
    mysqli_stmt_close($stmt);
}
?>
