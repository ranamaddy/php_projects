
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container ">
<?php
require_once '../dbconnect.php';
include('menu.php');
?>
    <h2 class="text-center mb-4">Add Course</h2>

    <form action="" method="post">
        <div class="mb-3">
            <label for="course_name" class="form-label">Course Name</label>
            <input type="text" class="form-control" id="course_name" name="course_name" required>
        </div>
        <div class="mb-3">
            <label for="course_code" class="form-label">Course Code</label>
            <input type="text" class="form-control" id="course_code" name="course_code" required>
        </div>
        <div class="mb-3">
            <label for="department_id" class="form-label">Department</label>
            <select class="form-select" id="department_id" name="department_id" required>
                <?php
                // Fetch departments from database
                $sql = "SELECT department_id, department_name FROM Departments";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    $departmentId = $row['department_id'];
                    $departmentName = $row['department_name'];

                    echo "<option value='$departmentId'>$departmentName</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="submit">Add Course</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

<?php
// Include database connection file


// Check if form is submitted
if (isset($_POST['submit'])) {
    // Get form data
    $courseName = $_POST['course_name'];
    $courseCode = $_POST['course_code'];
    $departmentId = $_POST['department_id'];

    // Prepare SQL query to insert course
    $sql = "INSERT INTO Courses (course_name, course_code, department_id) VALUES (?, ?, ?)";

    // Prepare statement
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssi", $courseName, $courseCode, $departmentId);

    // Execute statement
    if (mysqli_stmt_execute($stmt)) {
        // Success message
        echo '<div class="alert alert-success">Course added successfully!</div>';
    } else {
        // Error message
        echo '<div class="alert alert-danger">Failed to add course!</div>';
    }

    // Close statement
    mysqli_stmt_close($stmt);
}
?>
