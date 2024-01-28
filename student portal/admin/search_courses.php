<?php
// Include database connection file
require_once '../dbconnect.php';

// Get search term from POST request
$searchTerm = $_POST['searchTerm'];

// Prepare SQL query to search courses
$sql = "SELECT c.course_id, c.course_name, c.course_code, d.department_name
        FROM Courses c
        INNER JOIN Departments d ON c.department_id = d.department_id
        WHERE c.course_name LIKE '%$searchTerm%' OR c.course_code LIKE '%$searchTerm%'";
$result = mysqli_query($conn, $sql);

// Generate table rows for matching courses
$tableRows = '';
while ($row = mysqli_fetch_assoc($result)) {
  $courseId = $row['course_id'];
  $courseName = $row['course_name'];
  $courseCode = $row['course_code'];
  $departmentName = $row['department_name'];

  $tableRows .= "<tr>";
  $tableRows .= "<td>$courseId</td>";
  $tableRows .= "<td>$courseName</td>";
  $tableRows .= "<td>$courseCode</td>";
  $tableRows .= "<td>$departmentName</td>";
  $tableRows .= "<td>";
  $tableRows .= "<a href='edit_course.php?id=$courseId' class='btn btn-primary btn-sm'>Edit</a>";
  $tableRows .= "<a href='delete_course.php?id=$courseId' class='btn btn-danger btn-sm'>Delete</a>";
  $tableRows .= "</td>";
  $tableRows .= "</tr>";
}

echo $tableRows;
?>