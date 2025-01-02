<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sliding Modals with Bootstrap</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* Custom CSS for sliding modals */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      right: 0;
      width: 80%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 1050;
      transform: translateX(100%);
      transition: transform 0.3s ease;
    }

    /* Modal Content (no overflow) */
    .modal-content {
      background-color: white;
      height: 100%;
      overflow-y: auto;
      padding: 20px;
      box-sizing: border-box;
      transform: translateX(100%);
      transition: transform 0.3s ease;
    }

    /* Show modals */
    .modal.show {
      transform: translateX(0);
    }

    .modal.show .modal-content {
      transform: translateX(0);
    }

    /* Close Button Styling */
    .close {
      font-size: 28px;
      color: #000;
      position: absolute;
      top: 20px;
      right: 20px;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <!-- Button to open the first modal (menu modal) -->
  <button class="btn btn-primary" id="openMenuBtn">Open Menu</button>

  <!-- Menu Modal -->
  <div class="modal" id="menuModal">
    <div class="modal-content">
      <span class="close" id="closeMenuModal">&times;</span>
      <h2>Menu</h2>
      <p>Select an option:</p>
      <ul>
        <li><button class="btn btn-secondary" id="openSecondModalBtn">Open Second Modal</button></li>
        <li><button class="btn btn-secondary" id="closeMenuBtn">Close Menu</button></li>
      </ul>
    </div>
  </div>

  <!-- Second Modal -->
  <div class="modal" id="secondModal">
    <div class="modal-content">
      <span class="close" id="closeSecondModal">&times;</span>
      <h2>Second Modal</h2>
      <p>This is the second modal, opened from the menu.</p>
      <button class="btn btn-danger" id="closeSecondModalBtn">Close Second Modal</button>
    </div>
  </div>

  <!-- Bootstrap and Popper.js (required for Bootstrap modals) -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

  <script>
    // Get modal elements
    const menuModal = document.getElementById("menuModal");
    const secondModal = document.getElementById("secondModal");
    const openMenuBtn = document.getElementById("openMenuBtn");
    const closeMenuModal = document.getElementById("closeMenuModal");
    const openSecondModalBtn = document.getElementById("openSecondModalBtn");
    const closeMenuBtn = document.getElementById("closeMenuBtn");
    const closeSecondModal = document.getElementById("closeSecondModal");
    const closeSecondModalBtn = document.getElementById("closeSecondModalBtn");

    // Open the menu modal
    openMenuBtn.onclick = function() {
      menuModal.style.display = "block";
      setTimeout(() => menuModal.classList.add("show"), 10); // Add class after display
    }

    // Close the menu modal
    closeMenuModal.onclick = function() {
      menuModal.classList.remove("show");
      setTimeout(() => menuModal.style.display = "none", 300); // Hide after animation
    }

    closeMenuBtn.onclick = closeMenuModal;

    // Open the second modal from the menu
    openSecondModalBtn.onclick = function() {
      menuModal.classList.remove("show");
      setTimeout(() => menuModal.style.display = "none", 300); // Hide menu modal after animation
      secondModal.style.display = "block";
      setTimeout(() => secondModal.classList.add("show"), 10); // Show second modal
    }

    // Close the second modal
    closeSecondModal.onclick = function() {
      secondModal.classList.remove("show");
      setTimeout(() => secondModal.style.display = "none", 300); // Hide second modal after animation
    }

    closeSecondModalBtn.onclick = closeSecondModal;
  </script>

</body>
</html>
