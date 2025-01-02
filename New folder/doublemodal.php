<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modal Inside Modal</title>
  <style>
    /* Modal Styles */
    .modal {
      display: none; /* Hidden by default */
      position: fixed;
      z-index: 1; /* Sit on top */
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto; /* Enable scroll if needed */
      background-color: rgba(0, 0, 0, 0.5); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
      background-color: #fefefe;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      max-width: 500px;
    }

    /* Close Button */
    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <!-- Button to trigger the first modal -->
  <button id="openFirstModalBtn">Open First Modal</button>

  <!-- First Modal (Outer Modal) -->
  <div id="firstModal" class="modal">
    <div class="modal-content">
      <span class="close" id="closeFirstModal">&times;</span>
      <h2>First Modal</h2>
      <p>This is the first modal.</p>
      <button id="openSecondModalBtn">Open Second Modal</button>
    </div>
  </div>

  <!-- Second Modal (Inner Modal) -->
  <div id="secondModal" class="modal">
    <div class="modal-content">
      <span class="close" id="closeSecondModal">&times;</span>
      <h2>Second Modal</h2>
      <p>This is the second modal opened from the first one!</p>
    </div>
  </div>

  <script>
    // Get modal elements
    const firstModal = document.getElementById("firstModal");
    const secondModal = document.getElementById("secondModal");

    // Get buttons and close elements
    const openFirstModalBtn = document.getElementById("openFirstModalBtn");
    const closeFirstModal = document.getElementById("closeFirstModal");
    const openSecondModalBtn = document.getElementById("openSecondModalBtn");
    const closeSecondModal = document.getElementById("closeSecondModal");

    // Open the first modal
    openFirstModalBtn.onclick = function() {
      firstModal.style.display = "block";
    }

    // Close the first modal
    closeFirstModal.onclick = function() {
      firstModal.style.display = "none";
    }

    // Open the second modal from the first modal
    openSecondModalBtn.onclick = function() {
      firstModal.style.display = "none"; // Close the first modal
      secondModal.style.display = "block"; // Open the second modal
    }

    // Close the second modal
    closeSecondModal.onclick = function() {
      secondModal.style.display = "none";
    }

    // Close modals when clicking outside of them
    window.onclick = function(event) {
      if (event.target === firstModal) {
        firstModal.style.display = "none";
      }
      if (event.target === secondModal) {
        secondModal.style.display = "none";
      }
    }
  </script>

</body>
</html>
