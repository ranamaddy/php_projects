<?php
// Include database connection file
require_once '../dbconnect.php';

// Get course ID from URL parameter
$courseId = $_GET['id'];

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Get form data
    $courseName = $_POST['course_name'];
    $courseCode = $_POST['course_code'];
    $departmentId = $_POST['department_id'];

    // Prepare SQL query to update course
    $sql = "UPDATE Courses SET course_name = ?, course_code = ?, department_id = ? WHERE course_id = ?";

    // Prepare statement
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssii", $courseName, $courseCode, $departmentId, $courseId);

    // Execute statement
    if (mysqli_stmt_execute($stmt)) {
        // Success message
        echo '<div class="alert alert-success">Course updated successfully!</div>';

        // Redirect to view courses page
        header('refresh:2; url=view_course.php');
    } else {
        // Error message
        echo '<div class="alert alert-danger">Failed to update course!</div>';
    }

    // Close statement
    mysqli_stmt_close($stmt);
} else {
    // Fetch course details
    $sql = "SELECT course_name, course_code, department_id FROM Courses WHERE course_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $courseId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $course = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    $courseName = $course['course_name'];
    $courseCode = $course['course_code'];
    $departmentId = $course['department_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Course</h2>

    <form action="" method="post">
        <div class="mb-3">
            <label for="course_name" class="form-label">Course Name</label>
            <input type="text" class="form-control" id="course_name" name="course_name" value="<?php echo $courseName; ?>" required>
        </div>
        <div class="mb-3">
            <label for="course_code" class="form-label">Course Code</label>
            <input type="text" class="form-control" id="course_code" name="course_code" value="<?php echo $courseCode; ?>" required>
        </div>
        <div class="mb-3">
            <label for="department_id" class="form-label">Department</label>
            <select class="form-select" id="department_id" name="department_id" required>
                <?php
                // Fetch departments from database
                $sql = "SELECT department_id, department_name FROM Departments";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    $departmentIdOption = $row['department_id'];
                    $departmentName = $row['department_name'];
                    if ($departmentIdOption == $departmentId) {
                        echo "<option value='$departmentIdOption' selected>$departmentName</option>";
                    } else {
                        echo "<option value='$departmentIdOption'>$departmentName</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="submit">Update Course</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
