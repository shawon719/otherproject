<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modal From Right</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS for the modal -->
  <style>
    /* Modal dialog styling */
    .modal-dialog {
      position: fixed;
      top: 0;
      right: -100%; /* Start off-screen */
      height: 100%; /* Full height */
      width: 30%; /* 30% width of the screen */
      transition: right 0.3s ease-in-out;
    }

    /* When modal is visible, move it to the right */
    .modal.show .modal-dialog {
      right: 0;
    }

    /* Modal content styling */
    .modal-content {
      height: 100%; /* Full height */
      border-radius: 0;
      padding: 0; /* Remove any padding to ensure it fits perfectly */
    }

    /* Remove horizontal line in modal body */
    .modal-body {
      border-bottom: none;
      padding: 20px; /* Padding for content inside the body */
    }

    /* Close button styling */
    .close {
      position: absolute;
      top: 10px;
      right: 10px;
      color: #000;
      font-size: 1.5rem;
      border: none;
      background: none;
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
          <!-- <h5 class="modal-title" id="loginModalLabel">Log In</h5> -->
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
          <!-- Your login form or content here -->
          <form>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" required>
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

</body>
</html>
