
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <section>
  <div class="bg-cover bg-center h-75 pt-5 px-5" style="background-image: url('https://i.ibb.co/Jj5HQ4K/hero-illustration.webp');">
    <div class="bg-light mx-auto rounded-3xl p-4 max-w-full w-100 relative">
      <div class="d-flex ml-4 pt-2 align-items-center space-x-4 mb-4">
                    <label class="d-flex align-items-center space-x-2">
                        <!-- <input type="radio" name="tripType" class="h-5 w-5 text-dark" checked> -->
                        <span class="text-dark font-medium">What type of vehicle</span>
                    </label>   
                    <div>
                        <div>
                            <button></button>
                        </div>
                    </div>       



        <!-- <label class="d-flex align-items-center space-x-2">
          <input type="radio" name="tripType" class="h-5 w-5 text-dark" checked>
          <span class="text-dark font-medium">One Way</span>
        </label>
        <label class="d-flex align-items-center space-x-2">
          <input type="radio" name="tripType" class="h-5 w-5 text-success">
          <span class="text-dark font-medium">Round Way</span>
        </label> -->
      </div>

      <form action="">
        <div class="d-flex gap-4 px-6">
          <label for="fromInput" class="border rounded-lg cursor-pointer border-gray-300 w-100 h-14">
            <div class="d-flex gap-3">
              <div class="mt-3 pl-2">
                <i class="fas fa-location-arrow text-success"></i>
              </div>
              <div>
                <p class="text-success text-xs mt-1">FROM</p>
                <input type="text" name="DestinationFrom" id="fromInput" placeholder="FROM" class="form-control text-success font-weight-bold text-left">
              </div>
            </div>
          </label>
          <div id="fromSuggestions" class="position-absolute z-index-10 bg-light shadow mt-4 rounded w-100 max-height-52 overflow-auto hidden">
            <button></button>
          </div>

          <div class="mt-3 cursor-pointer">
            <i class="fas fa-exchange-alt text-dark"></i>
          </div>

          <label for="toInput" class="border rounded-lg cursor-pointer border-gray-300 w-100 h-14">
            <div class="d-flex gap-3">
              <div class="mt-3 pl-2">
                <i class="fas fa-location-arrow text-success"></i>
              </div>
              <div>
                <p class="text-success text-xs mt-1">TO</p>
                <input type="text" name="DestinationTo" id="toInput" placeholder="TO" class="form-control text-success font-weight-bold text-left">
              </div>
            </div>
          </label>
          <div id="toSuggestions" class="position-absolute z-index-10 bg-light max-height-52 overflow-auto list-none shadow mt-4 rounded w-100 ml-50 hidden">
            <button></button>
          </div>

          <div class="border rounded-lg cursor-pointer border-gray-300 w-100 h-14">
            <div class="d-flex px-2">
              <div class="h-50 rounded-lg w-50">
                <label for="fromcity">
                  <p class="text-success text-xs mt-1">Journey Date</p>
                  <input type="text" name="PickDate" id="date-picker" placeholder="Pick a date" class="form-control text-success font-weight-bold text-left">
                </label>
              </div>
              <div class="h-50 rounded-lg w-50">
                <label for="fromcity">
                  <p class="text-success text-xs mt-1"></p>
                  <button class="text-warning text-xs ml-5 mt-4 font-medium">+ ADD RETURN TRIP</button>
                </label>
              </div>
            </div>
          </div>

          <div>
            <button id="findLocation" class="btn btn-success px-5 py-3 rounded-lg text-white font-weight-bold">SEARCH</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

</body>
</html>