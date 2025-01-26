<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Vehicle</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
        .vehicle-selection {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 50px;
        }

        .vehicle-item {
            text-align: center;
            cursor: pointer;
            padding: 20px;
            border: 2px solid #ddd;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .vehicle-item:hover {
            background-color: #f0f0f0;
            border-color: #079d49;
        }

        .vehicle-item.selected {
            background-color: #079d49;
            color: white;
            border-color: #079d49;
        }

        .vehicle-item i {
            font-size: 3rem;
            color: #079d49;
        }

        .vehicle-item.selected i {
            color: white;
        }

        .vehicle-item p {
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mt-5">Choose Your Vehicle</h2>

    <div class="vehicle-selection">
        <!-- Car Selection -->
        <div class="vehicle-item" id="carItem" onclick="selectVehicle('car')">
            <i class="fas fa-car"></i>
            <p>Car</p>
        </div>

        <!-- Van Selection -->
        <div class="vehicle-item" id="vanItem" onclick="selectVehicle('van')">
            <i class="fas fa-shuttle-van"></i>
            <p>Van</p>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script>
    // Function to handle selection of vehicle
    function selectVehicle(vehicle) {
        // Reset both vehicles to unselected
        document.getElementById('carItem').classList.remove('selected');
        document.getElementById('vanItem').classList.remove('selected');

        // Select the clicked vehicle
        if (vehicle === 'car') {
            document.getElementById('carItem').classList.add('selected');
        } else if (vehicle === 'van') {
            document.getElementById('vanItem').classList.add('selected');
        }

        // Optionally, you can use this to show the selected vehicle in a different part of the app
        alert(`You have selected the ${vehicle.charAt(0).toUpperCase() + vehicle.slice(1)}!`);
    }
</script>

</body>
</html>


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
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-size: 14px;
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

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .pick-up-return-group {
            display: flex;
            gap: 10px;
            flex: 1;
        }

        .pick-up-return-group input {
            flex: 1;
        }

        .pick-up-return-group .input-group-text {
            border-radius: 8px 0 0 8px;
        }

        .pick-up-return-group .input-group-text + .form-control {
            border-radius: 0 8px 8px 0;
        }

        /* Style for suggestion dropdown */
        #locationSuggestions {
            display: none;
            background-color: #f1f1f1;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            max-height: 150px;
            overflow-y: auto;
            position: absolute;
            z-index: 999;
            width: 100%;
            margin-top: 5px;
            border-radius: 8px;
        }

        #locationSuggestions div {
            padding: 8px;
            cursor: pointer;
        }

        #locationSuggestions div:hover {
            background-color: #079d49;
            color: white;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="car-rental-form">
            <h3 class="text-center mb-4">Car Rental Search</h3>
            <form id="carRentalForm">
                <div class="row g-3">
                    <!-- Checkbox to toggle location fields -->
                    <div class="col-12 form-row checkbox-group">
                        <input type="checkbox" id="sameLocation" class="form-check-input">
                        <label for="sameLocation" class="form-check-label">Use the same location for return</label>
                    </div>

                    <!-- Pick-Up Location and Return Location Fields -->
                    <div class="col-md-6 form-row position-relative">
                        <label class="form-label">Location</label>
                        <div class="pick-up-return-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map-marker-alt form-icon"></i></span>
                                <input type="text" class="form-control" id="pickUpLocation" placeholder="Pick-Up Location" required>
                            </div>
                            <div class="input-group" id="returnLocationField" style="display: block;">
                                <span class="input-group-text"><i class="fas fa-map-marker-alt form-icon"></i></span>
                                <input type="text" class="form-control" id="returnLocation" placeholder="Return Location" required>
                            </div>
                        </div>
                        <!-- Suggestions dropdown -->
                        <div id="locationSuggestions"></div>
                    </div>

                    <!-- Pick-Up and Return Date & Time -->
                    <div class="col-md-3 form-row">
                        <label for="pickUpDateTime" class="form-label">Pick-Up & Return (Date & Time)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar-alt form-icon"></i></span>
                            <input type="datetime-local" class="form-control" id="pickUpDateTime" required>
                        </div>
                    </div>

                    <!-- Search Button -->
                    <div class="col-md-3 form-row d-flex align-items-end">
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
        // Toggle between same location for return or separate fields
        document.getElementById("sameLocation").addEventListener("change", function () {
            const pickUpLocation = document.getElementById("pickUpLocation");
            const returnLocationField = document.getElementById("returnLocationField");
            const returnLocation = document.getElementById("returnLocation");

            if (this.checked) {
                // If checked, merge Pick-Up and Return Location into one
                returnLocationField.style.display = "none";
                returnLocation.value = pickUpLocation.value;  // Set the return location to be same as pick-up location
            } else {
                // If unchecked, show both fields separately
                returnLocationField.style.display = "block";
            }
        });

        // // Location suggestion feature
        // document.getElementById("pickUpLocation").addEventListener("input", function () {
        //     const query = this.value.toLowerCase();
        //     const suggestionBox = document.getElementById("locationSuggestions");
        //     const returnLocation = document.getElementById("returnLocation");
        //     const locations = [
        //         "New York",
        //         "Los Angeles",
        //         "San Francisco",
        //         "Chicago",
        //         "Miami",
        //         "Boston",
        //         "Dallas"
        //     ];

        //     if (query.length > 0) {
        //         suggestionBox.innerHTML = "";
        //         const filteredLocations = locations.filter(location => location.toLowerCase().includes(query));
        //         filteredLocations.forEach(location => {
        //             const div = document.createElement("div");
        //             div.textContent = location;
        //             div.onclick = function () {
        //                 document.getElementById("pickUpLocation").value = location;
        //                 if (document.getElementById("sameLocation").checked) {
        //                     document.getElementById("returnLocation").value = location;
        //                 }
        //                 suggestionBox.style.display = "none";
        //             };
        //             suggestionBox.appendChild(div);
        //         });
        //         suggestionBox.style.display = "block";
        //     } else {
        //         suggestionBox.style.display = "none";
        //     }
        // });

        // // Close suggestions if clicked outside
        // document.addEventListener("click", function (e) {
        //     if (!e.target.closest("#pickUpLocation")) {
        //         document.getElementById("locationSuggestions").style.display = "none";
        //     }
        // });

        // Handle form submission
        document.getElementById("carRentalForm").addEventListener("submit", function (e) {
            e.preventDefault();

            const pickUpLocation = document.getElementById("pickUpLocation").value;
            const returnLocation = document.getElementById("returnLocation").value;
            const pickUpDateTime = document.getElementById("pickUpDateTime").value;

            alert(`Car rental search details:\n
                Pick-Up Location: ${pickUpLocation}\n
                Return Location: ${returnLocation}\n
                Pick-Up Date & Time: ${pickUpDateTime}`);
        });
    </script>
</body>

</html>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 1200px;
            margin-top: 30px;
        }
        .form-control {
            height: 50px;
        }
        .vehicle-item {
            cursor: pointer;
            padding: 20px;
            border: 2px solid #ddd;
            border-radius: 12px;
            transition: all 0.3s ease;
            text-align: center;
        }
        .vehicle-item:hover {
            background-color: #f0f0f0;
            border-color: #079d49;
        }
        .vehicle-item.selected {
            background-color: #079d49;
            color: white;
            border-color: #079d49;
        }
        .vehicle-item i {
            font-size: 3rem;
            color: #079d49;
        }
        .vehicle-item.selected i {
            color: white;
        }
        .vehicle-selection {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .location-suggestions {
            background-color: #f1f1f1;
            max-height: 150px;
            overflow-y: auto;
            position: absolute;
            width: 100%;
            z-index: 1000;
            border-radius: 5px;
            display: none;
        }
        .location-suggestions li {
            padding: 10px;
            cursor: pointer;
        }
        .location-suggestions li:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">Car Rental</h2>

    <!-- Vehicle Selection -->
    <div class="vehicle-selection mb-4">
        <!-- Car Option -->
        <div class="vehicle-item" id="carItem" onclick="selectVehicle('car')">
            <i class="fas fa-car"></i>
            <p>Car</p>
        </div>

        <!-- Van Option -->
        <div class="vehicle-item" id="vanItem" onclick="selectVehicle('van')">
            <i class="fas fa-shuttle-van"></i>
            <p>Van</p>
        </div>
    </div>

    <!-- Form for Pickup and Return Location, Date and Time -->
    <form action="#" method="POST" id="carRentalForm">
        <div class="row mb-3">
            <!-- Pickup and Return Locations -->
            <div class="col-md-6">
                <div class="form-group position-relative">
                    <input type="text" class="form-control" id="pickupLocation" placeholder="Pick Up Location" onkeyup="showSuggestions(this.value)">
                    <ul class="location-suggestions" id="pickupSuggestions"></ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group position-relative">
                    <input type="text" class="form-control" id="returnLocation" placeholder="Return Location" onkeyup="showSuggestions(this.value)">
                    <ul class="location-suggestions" id="returnSuggestions"></ul>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <!-- Pickup and Return Date & Time -->
            <div class="col-md-6">
                <input type="datetime-local" class="form-control" id="pickupDateTime">
            </div>
            <div class="col-md-6">
                <input type="datetime-local" class="form-control" id="returnDateTime">
            </div>
        </div>

        <!-- Search Button -->
        <button type="submit" class="btn btn-primary btn-block">Search</button>
    </form>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script>
    // Function to select car or van
    function selectVehicle(vehicle) {
        document.getElementById('carItem').classList.remove('selected');
        document.getElementById('vanItem').classList.remove('selected');

        if (vehicle === 'car') {
            document.getElementById('carItem').classList.add('selected');
        } else if (vehicle === 'van') {
            document.getElementById('vanItem').classList.add('selected');
        }
    }

    // Function to show location suggestions based on input
    function showSuggestions(value) {
        const suggestions = [
            'New York',
            'Los Angeles',
            'San Francisco',
            'Chicago',
            'Dallas',
            'Miami',
            'Houston',
            'Washington DC',
            'Las Vegas',
            'Boston'
        ];
        
        const filteredSuggestions = suggestions.filter(location => location.toLowerCase().includes(value.toLowerCase()));
        const suggestionList = value ? filteredSuggestions : [];

        // Update suggestions list for Pickup and Return Location
        updateSuggestions(suggestionList, value === 'pickup');
    }

    // Function to update the suggestions dropdown
    function updateSuggestions(suggestions, isPickup) {
        const suggestionBox = isPickup ? document.getElementById('pickupSuggestions') : document.getElementById('returnSuggestions');
        suggestionBox.innerHTML = '';
        
        if (suggestions.length) {
            suggestionBox.style.display = 'block';
            suggestions.forEach(suggestion => {
                const listItem = document.createElement('li');
                listItem.textContent = suggestion;
                listItem.onclick = () => setLocation(isPickup, suggestion);
                suggestionBox.appendChild(listItem);
            });
        } else {
            suggestionBox.style.display = 'none';
        }
    }

    // Function to set location when clicked from suggestions
    function setLocation(isPickup, location) {
        if (isPickup) {
            document.getElementById('pickupLocation').value = location;
        } else {
            document.getElementById('returnLocation').value = location;
        }
        document.getElementById(isPickup ? 'pickupSuggestions' : 'returnSuggestions').style.display = 'none';
    }
</script>

</body>
</html>

