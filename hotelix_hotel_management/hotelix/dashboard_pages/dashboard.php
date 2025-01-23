<?php
require_once "db_root.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    .card {
      box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
      transition: all 0.4s ease-out;
      text-decoration: none;
      border: 1px solid #60a5fa;
    }

    .card:hover {
      transform: translateY(-5px) scale(1.005) translateZ(0);
      box-shadow: 0 24px 36px rgba(0, 0, 0, 0.11),
        0 3px 10px var(--box-shadow-color);
      cursor: pointer;
    }
  </style>
</head>

<body>
  <section class="py-16">
    <h3 class="titel_content text-3xl mb-2">Hello Dashboard!</h3>
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
      <div class="card border border-blue-500 p-4 rounded-lg text-center">
        <span class="text-center mb-3"><i class="fa-solid fa-users text-4xl"></i></span>
        <h2 class="text-xl uppercase">Total Register Users</h2>
        <?php
        $getUsers = $db_conn->query("select * from users");
        echo "<p class='text-2xl'>" . $getUsers->num_rows . ' Users' . "</p>";
        ?>
        <a href="main_dashboard.php?page=manage_user"
          class="border border-blue-600 text-center rounded-md py-3 mt-3 font-medium hover:bg-blue-600 hover:text-white transition-all">View
          More</a>
      </div>
      <div class="card border border-blue-500 p-4 rounded-lg text-center">
        <span class="text-center mb-3"><i class="fa-solid fa-house-chimney-user text-4xl"></i></span>
        <h2 class="text-xl uppercase">Total Rooms</h2>
        <?php
        $getUsers = $db_conn->query("select * from rooms");
        echo "<p class='text-2xl'>" . $getUsers->num_rows . ' Rooms' . "</p>";
        ?>
        <a href="main_dashboard.php?page=room_list"
          class="border border-blue-600 text-center rounded-md py-3 mt-3 font-medium hover:bg-blue-600 hover:text-white transition-all">View
          More</a>
      </div>
      <div class="card border border-blue-500 p-4 rounded-lg text-center">
        <span class="text-center mb-3"><i class="fa-solid fa-clipboard-list text-4xl"></i></span>
        <h2 class="text-xl uppercase">Total Booking List</h2>
        <?php
        $getUsers = $db_conn->query("select * from bookings");
        echo "<p class='text-2xl'>" . $getUsers->num_rows . ' Bookings' . "</p>";
        ?>
        <a href="main_dashboard.php?page=all_booking_list"
          class="border border-blue-600 text-center rounded-md py-3 mt-3 font-medium hover:bg-blue-600 hover:text-white transition-all">View
          More</a>
      </div>

      <div class="card border border-blue-500 p-4 rounded-lg text-center">
        <span class="text-center mb-3"><i class="fa-solid fa-hand-holding-dollar text-4xl"></i></span>
        <h2 class="text-xl uppercase">Total Amount</h2>
        <p class="text-2xl font-bold">$2,258</p>
        <a href=""
          class="border border-blue-600 text-center rounded-md py-3 mt-3 font-medium hover:bg-blue-600 hover:text-white transition-all">View
          More</a>
      </div>
      <!-- Add more cards -->
    </div>

    <div>
      <canvas id="myChart"></canvas>
    </div>
  </section>


  <script>
    const ctx = document.getElementById('myChart');

    // Data values
    const dataValues = [65, 59, 80, 81, 26, 55, 40, 30, 20];

    // Create an array of colors based on the data values
    const lineColors = dataValues.map(value => value <= 30 ? 'rgb(255, 99, 132)' : 'rgb(75, 192, 192) ');

    // Create a dataset with these dynamic colors applied to the line
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September'],
        datasets: [{
          label: 'Looping tension',
          data: dataValues,
          fill: false,
          borderColor: lineColors, // Apply the dynamic colors to the line
          tension: 0.1,
        }]
      },
      options: {
        animations: {
          tension: {
            duration: 1000,
            easing: 'linear',
            from: 1,
            to: 0,
            loop: true
          }
        },
        scales: {
          y: {
            min: 0,
            max: 100
          }
        }
      }
    });
  </script>




</body>

</html>