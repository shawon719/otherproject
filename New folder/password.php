<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modal With Show/Hide Password</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome (for eye icons) -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

  <!-- Custom CSS for modal and input styling -->
  <style>
    .modal-dialog {
      position: fixed;
      top: 0;
      right: -100%;
      height: 100%;
      width: 30%;
      transition: right 0.3s ease-in-out;
    }

    .modal.show .modal-dialog {
      right: 0;
    }

    .modal-content {
      height: 100%;
      border-radius: 0;
      padding: 0;
    }

    .modal-body {
      border-bottom: none;
      padding: 20px;
    }

    .close {
      position: absolute;
      top: 10px;
      right: 10px;
      color: #000;
      font-size: 1.5rem;
      border: none;
      background: none;
    }

    .eye-icon {
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
      cursor: pointer;
    }
  </style>
</head>
<body>

  <!-- Log In Button -->
  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
    Log In
  </button>

  <!-- Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            &times;
          </button>
          <h5 class="modal-title" id="loginModalLabel">Log In</h5>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
          <!-- Your login form -->
          <form>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" required>
            </div>
            <div class="mb-3 position-relative">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" required>
              <!-- Eye icon for show/hide password -->
              <i id="togglePassword" class="fas fa-eye eye-icon"></i>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

  <!-- Custom JS for show/hide password toggle -->
  <script>
    // Get the password field and the toggle icon
    const passwordField = document.getElementById('password');
    const togglePasswordIcon = document.getElementById('togglePassword');

    // Add event listener to the eye icon
    togglePasswordIcon.addEventListener('click', function() {
      // Toggle the type of the password field between 'password' and 'text'
      const type = passwordField.type === 'password' ? 'text' : 'password';
      passwordField.type = type;

      // Toggle the eye icon between eye and eye-slash
      this.classList.toggle('fa-eye');
      this.classList.toggle('fa-eye-slash');
    });
  </script>

</body>
</html>
