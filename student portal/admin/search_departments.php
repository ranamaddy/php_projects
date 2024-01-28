<?php
// Include database connection file
require_once '../dbconnect.php';

// Get search term from POST request
$searchTerm = $_POST['searchTerm'];

// Prepare SQL query to search departments
$sql = "SELECT department_id, department_name FROM Departments WHERE department_name LIKE '%$searchTerm%'";

// Execute query and fetch results
$result = mysqli_query($conn, $sql);
$departments = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $departments[] = $row;
    }
}

// Generate table rows for matching departments
$tableRows = '';
foreach ($departments as $department) {
    $departmentId = $department['department_id'];
    $departmentName = $department['department_name'];

    $tableRows .= "<tr>";
    $tableRows .= "<td>$departmentId</td>";
    $tableRows .= "<td>$departmentName</td>";
    $tableRows .= "<td>";
    $tableRows .= "<a href='edit_department.php?id=$departmentId' class='btn btn-primary btn-sm'>Edit</a>";
    $tableRows .= "<a href='delete_department.php?id=$departmentId' class='btn btn-danger btn-sm'>Delete</a>";
    $tableRows .= "</td>";
    $tableRows .= "</tr>";
}

echo $tableRows;

?>