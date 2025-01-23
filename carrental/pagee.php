<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome CSS -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <style>
        /* Custom styles for form and layout */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 30px;
        }

        .car-rental-form {
            background-color: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-size: 13px;
            color: #333;
        }

        .form-control {
            height: 45px;
            border-radius: 8px;
        }

        .input-group-text {
            background-color: #079d49;
            color: white;
            border-radius: 8px;
        }

        .btn-search {
            background-color: #079d49;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            text-transform: uppercase;
            padding: 12px 24px;
            border: none;
            margin-top: 15px;
        }

        .btn-search:hover {
            background-color: #064d34;
        }

        .form-row {
            margin-bottom: 15px;
        }

        .form-icon {
            color: #079d49;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="car-rental-form">
            <h3 class="text-center mb-4">Car Rental Search</h3>
            <form id="carRentalForm">
                <div class="row g-3">
                    <!-- Pick-Up Location -->
                    <div class="col-md-3 form-row">
                        <label for="pickUpLocation" class="form-label">Pick-Up Location</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt form-icon"></i></span>
                            <input type="text" class="form-control" id="pickUpLocation" placeholder="Enter location" required>
                        </div>
                    </div>
                             <!-- Suggestions dropdown
                        <div id="locationSuggestions"></div> -->
                    <!-- Return Location -->
                    <div class="col-md-3 form-row">
                        <label for="returnLocation" class="form-label">Return Location</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt form-icon"></i></span>
                            <input type="text" class="form-control" id="returnLocation" placeholder="Enter location" required>
                        </div>
                    </div>
                   

                    <!-- Pick-Up Date & Time -->
                    <div class="col-md-2 form-row">
                        <label for="pickUpDateTime" class="form-label">Pick-Up (Date & Time)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar-alt form-icon"></i></span>
                            <input type="datetime-local" class="form-control" id="pickUpDateTime" required>
                        </div>
                    </div>
                     

                    <!-- Return Date & Time -->
                    <div class="col-md-2 form-row">
                        <label for="returnDateTime" class="form-label">Return (Date & Time)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar-alt form-icon"></i></span>
                            <input type="datetime-local" class="form-control" id="returnDateTime" required>
                        </div>
                    </div>

                    <!-- Search Button -->
                    <div class="col-md-2 form-row d-flex align-items-end">
                        <button type="submit" class="btn-search w-100">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>

            // Location suggestion feature
        document.getElementById("pickUpLocation").addEventListener("input", function () {
            const query = this.value.toLowerCase();
            const suggestionBox = document.getElementById("locationSuggestions");
            const returnLocation = document.getElementById("returnLocation");
            const locations = [
                "New York",
                "Los Angeles",
                "San Francisco",
                "Chicago",
                "Miami",
                "Boston",
                "Dallas"
            ];

            if (query.length > 0) {
                suggestionBox.innerHTML = "";
                const filteredLocations = locations.filter(location => location.toLowerCase().includes(query));
                filteredLocations.forEach(location => {
                    const div = document.createElement("div");
                    div.textContent = location;
                    div.onclick = function () {
                        document.getElementById("pickUpLocation").value = location;
                        if (document.getElementById("sameLocation").checked) {
                            document.getElementById("returnLocation").value = location;
                        }
                        suggestionBox.style.display = "none";
                    };
                    suggestionBox.appendChild(div);
                });
                suggestionBox.style.display = "block";
            } else {
                suggestionBox.style.display = "none";
            }
        });

        // Close suggestions if clicked outside
        document.addEventListener("click", function (e) {
            if (!e.target.closest("#pickUpLocation")) {
                document.getElementById("locationSuggestions").style.display = "none";
            }
        });



        // JavaScript to handle form submission
        document.getElementById("carRentalForm").addEventListener("submit", function (e) {
            e.preventDefault();
            
            const pickUpLocation = document.getElementById("pickUpLocation").value;
            const returnLocation = document.getElementById("returnLocation").value;
            const pickUpDateTime = document.getElementById("pickUpDateTime").value;
            const returnDateTime = document.getElementById("returnDateTime").value;

            alert(`Car rental search details:\n
                Pick-Up Location: ${pickUpLocation}\n
                Return Location: ${returnLocation}\n
                Pick-Up Date & Time: ${pickUpDateTime}\n
                Return Date & Time: ${returnDateTime}`);
        });
    </script>
</body>

</html>
