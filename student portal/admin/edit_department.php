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
    // Fetch department details
    $sql = "SELECT department_name FROM Departments WHERE department_id = $departmentId";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $departmentData = mysqli_fetch_assoc($result);
        $departmentName = $departmentData['department_name'];
    } else {
        echo "<script>alert('Invalid department ID.');</script>";
        header('Location: view_departments.php');
        exit();
    }

    // Process form data if submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $newDepartmentName = $_POST['department_name'];

        // Check if department name is empty
        if (empty($newDepartmentName)) {
            echo "<script>alert('Please enter department name.');</script>";
        } else {
            // Prepare SQL query to update department
            $sql = "UPDATE Departments SET department_name = '$newDepartmentName' WHERE department_id = $departmentId";

            // Execute query
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Department updated successfully.');</script>";
                header('Location: view_departments.php');
            } else {
                echo "<script>alert('Failed to update department.');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Department</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Department</h2>

    <form action="edit_department.php?id=<?php echo $departmentId; ?>" method="post">
        <div class="mb-3">
            <label for="department_name" class="form-label">Department Name:</label>
            <input type="text" class="form-control" id="department_name" name="department_name" value="<?php echo $departmentName; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Department</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
