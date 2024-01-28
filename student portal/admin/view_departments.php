<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Departments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container">
<?php
include('menu.php');
?>
    <h2 class="text-center mb-4">View Departments</h2>

    <div class="mb-3">
        <input type="text" class="form-control" id="searchInput" placeholder="Search by department name">
    </div>

    <table class="table table-bordered table-striped" id="departmentsTable">
        <thead>
            <tr>
                <th>Department ID</th>
                <th>Department Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="departmentsTableBody">

            <?php
            include('../dbconnect.php');
            $sql = "SELECT department_id, department_name FROM Departments";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $departmentId = $row['department_id'];
                $departmentName = $row['department_name'];

                echo "<tr>";
                echo "<td>$departmentId</td>";
                echo "<td>$departmentName</td>";
                echo "<td>";
                echo "<a href='edit_department.php?id=$departmentId' class='btn btn-primary btn-sm'>Edit</a>";
                echo "<a href='delete_department.php?id=$departmentId' class='btn btn-danger btn-sm'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#searchInput").on("keyup", function() {
            var searchTerm = $(this).val();

            $.ajax({
                url: "search_departments.php",
                method: "POST",
                data: { searchTerm: searchTerm },
                success: function(response) {
                    $("#departmentsTableBody").html(response);
                }
            });
        });
    });
</script>
</body>
</html>
