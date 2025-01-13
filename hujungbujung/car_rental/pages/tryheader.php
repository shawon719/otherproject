<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Side Modal Without JavaScript</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Hidden checkbox for modal trigger */
    #modalToggle {
      display: none;
    }

    /* Side Modal Style */
    .modal-side {
      position: fixed;
      top: 0;
      right: -100%;
      width: 300px; /* Width of the modal */
      height: 100%;
      background-color: #f8f9fa;
      transition: right 0.3s ease-in-out;
      box-shadow: -2px 0px 10px rgba(0, 0, 0, 0.3);
    }

    /* Show the modal when checkbox is checked */
    #modalToggle:checked + .modal-side {
      right: 0;
    }

    /* Modal Content Styling */
    .modal-content {
      height: 100%;
      border-radius: 0;
      border: none;
    }

    .modal-header {
      border-bottom: none;
    }

    .modal-header .btn-close {
      color: #000;
      background: transparent;
      border: none;
      font-size: 1.5rem;
      position: absolute;
      right: 10px;
      top: 10px;
    }

    .modal-body {
      padding: 20px;
    }

    /* Style for the Menu Button */
    .menu-btn {
      position: absolute;
      top: 20px;
      left: 20px;
      z-index: 10;
    }
  </style>
</head>
<body>

  <!-- Menu Button -->
  <label for="modalToggle" class="btn btn-primary menu-btn">Open Menu</label>

  <!-- Hidden checkbox to toggle modal -->
  <input type="checkbox" id="modalToggle">

  <!-- Side Modal Structure -->
  <div class="modal-side">
    <div class="modal-content">
      <div class="modal-header">
        <label for="modalToggle" class="btn-close">&times;</label>
      </div>
      <div class="modal-body">
        <h5 class="modal-title">Side Menu</h5>
        <ul class="list-unstyled">
          <li><a href="#">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies (optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
