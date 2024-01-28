<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <h1 class="mt-5 mb-4">Registration Form</h1>

    <form action="register.php" method="post" class="needs-validation" novalidate>
      <div class="mb-3">
        <label for="firstName" class="form-label">First Name:</label>
        <input type="text" class="form-control" id="firstName" name="firstName" required>
        <div class="invalid-feedback">
          Please enter your first name.
        </div>
      </div>

      <div class="mb-3">
        <label for="lastName" class="form-label">Last Name:</label>
        <input type="text" class="form-control" id="lastName" name="lastName" required>
        <div class="invalid-feedback">
          Please enter your last name.
        </div>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required>
        <div class="invalid-feedback">
          Please enter a valid email address.
        </div>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password:</label>
        <input type="password" class="form-control" id="password" name="password" required>
        <div class="invalid-feedback">
          Please enter a password.
        </div>
      </div>

      <div class="mb-3">
        <label for="confirmPassword" class="form-label">Confirm Password:</label>
        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
        <div class="invalid-feedback">
          Passwords do not match.
        </div>
      </div>

      <div class="mb-3">
        <label for="role" class="form-label">Role:</label>
        <select class="form-select" id="role" name="role" required>
          <option value="" selected disabled>Select Role</option>
          <option value="student">Student</option>
          <option value="admin">Admin</option>
          <option value="staff">Staff</option>
        </select>
        <div class="invalid-feedback">
          Please select a role.
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Register</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <script>
    (function () {
      'use strict';

      // Fetch all forms with the needs-validation class
      var forms = document.querySelectorAll('.needs-validation');

      // Loop over them and
// prevent submission
Array.prototype.slice.call(forms).forEach(function (form) {
  form.addEventListener('submit', function (event) {
    if (!form.checkValidity()) {
      event.preventDefault();
      event.stopPropagation();
    }
    form.classList.add('was-validated');
  }, false);
});
})();
</script>
</body>
