<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Courses</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container">
  <?php include('menu.php'); ?>

  <h2 class="text-center mb-4">View Courses</h2>

  <div class="mb-3">
    <input type="text" class="form-control" id="searchInput" placeholder="Search by course name or code">
  </div>

  <table class="table table-bordered table-striped" id="coursesTable">
    <thead>
      <tr>
        <th>Course ID</th>
        <th>Course Name</th>
        <th>Course Code</th>
        <th>Department</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Include database connection file
      require_once '../dbconnect.php';

      // Fetch courses from database
      $sql = "SELECT c.course_id, c.course_name, c.course_code, d.department_name
              FROM Courses c
              INNER JOIN Departments d ON c.department_id = d.department_id";
      $result = mysqli_query($conn, $sql);

      while ($row = mysqli_fetch_assoc($result)) {
        $courseId = $row['course_id'];
        $courseName = $row['course_name'];
        $courseCode = $row['course_code'];
        $departmentName = $row['department_name'];

        echo "<tr>";
        echo "<td>$courseId</td>";
        echo "<td>$courseName</td>";
        echo "<td>$courseCode</td>";
        echo "<td>$departmentName</td>";
        echo "<td>";
        echo "<a href='edit_course.php?id=$courseId' class='btn btn-primary btn-sm'>Edit</a>";
        echo "<a href='delete_course.php?id=$courseId' class='btn btn-danger btn-sm'>Delete</a>";
        echo "</td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>

  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourseModal">Add Course</button>

  <div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addCourseModalLabel">Add Course</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="add_course1.php" method="post">
            <div class="mb-3">
              <label for="courseName" class="form-label">Course Name</label>
              <input type="text" class="form-control" id="courseName" name="courseName" required>
            </div>
            <div class="mb-3">
              <label for="courseCode" class="form-label">Course Code</label>
              <input type="text" class="form-control" id="courseCode" name="courseCode" required>
            </div>
            <div class="mb-3">
              <label for="departmentId" class="form-label">Department</label>
              <select class="form-select" id="departmentId" name="departmentId" required>
                <?php
                // Fetch departments from database
                $sql = "SELECT department_id, department_name FROM Departments";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                  $departmentIdOption = $row['department_id'];
                  $departmentName = $row['department_name'];
                  echo "<option value='$departmentIdOption'>$departmentName</option>";
                }
                ?>
              </select>
            </div>
            <div class="mb-3">
              <button type="submit" class="btn btn-primary" name="submit">Add Course</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>
$(document).ready(function() {
  $("#searchInput").on("keyup", function() {
    var searchTerm = $(this).val();

    $.ajax({
      url: "search_courses.php",
      method: "POST",
      data: { searchTerm: searchTerm },
      success: function(response) {
        $("#coursesTable tbody").html(response);
      }
    });
  });
});
</script>
</body>
</html>
