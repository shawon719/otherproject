<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (isset($_POST['submit'])) {
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    $message = $_POST['message'];
    $useremail = $_SESSION['login'];
    $status = 0;
    $vhid = $_GET['vhid'];
    $bookingno = mt_rand(100000000, 999999999);

    // Query to check if the vehicle is already booked during the selected dates
    $ret = "SELECT * FROM tblbooking WHERE (:fromdate BETWEEN date(FromDate) AND date(ToDate) OR :todate BETWEEN date(FromDate) AND date(ToDate) OR date(FromDate) BETWEEN :fromdate AND :todate) AND VehicleId=:vhid";
    $query1 = $dbh->prepare($ret);
    $query1->bindParam(':vhid', $vhid, PDO::PARAM_STR);
    $query1->bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
    $query1->bindParam(':todate', $todate, PDO::PARAM_STR);
    $query1->execute();
    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);

    if ($query1->rowCount() == 0) {

        // Fetch vehicle price per day
        $sql = "SELECT PricePerDay FROM tblvehicles WHERE id=:vhid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':vhid', $vhid, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        $pricePerDay = $result->PricePerDay;

        // Calculate the number of rental days
        $fromDateTimestamp = strtotime($fromdate);
        $toDateTimestamp = strtotime($todate);
        $diffDays = ($toDateTimestamp - $fromDateTimestamp) / (60 * 60 * 24);
        $totalAmount = $pricePerDay * $diffDays;

        // Insert booking information into the database
        $sql = "INSERT INTO tblbooking (BookingNumber, userEmail, VehicleId, FromDate, ToDate, message, Status, TotalAmount) VALUES (:bookingno, :useremail, :vhid, :fromdate, :todate, :message, :status, :totalAmount)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':bookingno', $bookingno, PDO::PARAM_STR);
        $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
        $query->bindParam(':vhid', $vhid, PDO::PARAM_STR);
        $query->bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
        $query->bindParam(':todate', $todate, PDO::PARAM_STR);
        $query->bindParam(':message', $message, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':totalAmount', $totalAmount, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();

        if ($lastInsertId) {
            echo "<script>alert('Booking successful.');</script>";
            echo "<script type='text/javascript'> document.location = 'my-booking.php'; </script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again');</script>";
            echo "<script type='text/javascript'> document.location = 'car-listing.php'; </script>";
        }
    } else {
        echo "<script>alert('Car already booked for these days');</script>";
        echo "<script type='text/javascript'> document.location = 'car-listing.php'; </script>";
    }
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Car Rental | Vehicle Details</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <!-- FontAwesome -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>


<!-- Start Switcher -->
<?php //include('includes/colorswitcher.php');?>
<!-- /Switcher -->  

<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header --> 

<!--Listing-Image-Slider-->

<?php 
$vhid=intval($_GET['vhid']);
$sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.id=:vhid";
$query = $dbh -> prepare($sql);
$query->bindParam(':vhid',$vhid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  
$_SESSION['brndid']=$result->bid;  
?>  

<section id="listing_img_slider">
  <div style="float: left;"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="image" width="500" height="560"></div>
  <div style="float: left;"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage2);?>" class="img-responsive" alt="image" width="500" height="560"></div>
  <div style="float: left;"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage3);?>" class="img-responsive" alt="image" width="500" height="560"></div>
  <div style="float: left;"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage4);?>" class="img-responsive"  alt="image" width="500" height="560"></div>
  <?php if($result->Vimage5=="")
{

} else {
  ?>
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage5);?>" class="img-responsive" alt="image" width="900" height="560"></div>
  <?php } ?>
</section>
<!--/Listing-Image-Slider-->


<!--Listing-detail-->
<section class="listing-detail">
  <div class="container">
    <div class="listing_detail_head row">
      <div class="col-md-9">
        <h2><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></h2>
      </div>
      <div class="col-md-3">
        <div class="price_info">
          <p>$<?php echo htmlentities($result->PricePerDay);?> </p>Per Day
         
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9">
        <div class="main_features">
          <ul>
          
            <li> <i class="fa fa-calendar" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result->ModelYear);?></h5>
              <p>Reg.Year</p>
            </li>
            <li> <i class="fa fa-cogs" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result->FuelType);?></h5>
              <p>Fuel Type</p>
            </li>
       
            <li> <i class="fa fa-user-plus" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result->SeatingCapacity);?></h5>
              <p>Seats</p>
            </li>
          </ul>
        </div>
        <div class="listing_more_info">
          <div class="listing_detail_wrap"> 
            <!-- Nav tabs -->
            <ul class="nav nav-tabs gray-bg" role="tablist">
              <li role="presentation" class="active"><a href="#vehicle-overview " aria-controls="vehicle-overview" role="tab" data-toggle="tab">Vehicle Overview </a></li>
          
              <li role="presentation"><a href="#accessories" aria-controls="accessories" role="tab" data-toggle="tab">Accessories</a></li>
            </ul>
            
            <!-- Tab panes -->
            <div class="tab-content"> 
              <!-- vehicle-overview -->
              <div role="tabpanel" class="tab-pane active" id="vehicle-overview">
                
                <p><?php echo htmlentities($result->VehiclesOverview);?></p>
              </div>
              
              
              <!-- Accessories -->
              <div role="tabpanel" class="tab-pane" id="accessories"> 
                <!--Accessories-->
                <table>
                  <thead>
                    <tr>
                      <th colspan="2">Accessories</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Air Conditioner</td>
<?php if($result->AirConditioner==1)
{
?>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?> 
   <td><i class="fa fa-close" aria-hidden="true"></i></td>
   <?php } ?> </tr>

<tr>
<td>AntiLock Braking System</td>
<?php if($result->AntiLockBrakingSystem==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else {?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
                    </tr>

<tr>
<td>Power Steering</td>
<?php if($result->PowerSteering==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>
                   

<tr>

<td>Power Windows</td>

<?php if($result->PowerWindows==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>
                   
 <tr>
<td>CD Player</td>
<?php if($result->CDPlayer==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>

<tr>
<td>Leather Seats</td>
<?php if($result->LeatherSeats==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>

<tr>
<td>Central Locking</td>
<?php if($result->CentralLocking==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>

<tr>
<td>Power Door Locks</td>
<?php if($result->PowerDoorLocks==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
                    </tr>
                    <tr>
<td>Brake Assist</td>
<?php if($result->BrakeAssist==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php  } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>

<tr>
<td>Driver Airbag</td>
<?php if($result->DriverAirbag==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
 </tr>
 
 <tr>
 <td>Passenger Airbag</td>
 <?php if($result->PassengerAirbag==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else {?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>

<tr>
<td>Crash Sensor</td>
<?php if($result->CrashSensor==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          
        </div>
<?php }} ?>
   
      </div>
        <!-- Booking Form -->
        <div class="row">
            <!-- <aside class="col-md-3">
                <div class="sidebar_widget">
                    <div class="widget_heading">
                        <h5><i class="fa fa-envelope" aria-hidden="true"></i>Book Now</h5>
                    </div>
                    <form method="post">
                        <div class="form-group">
                            <label>From Date:</label>
                            <input type="date" class="form-control" name="fromdate" placeholder="From Date" required>
                        </div>
                        <div class="form-group">
                            <label>To Date:</label>
                            <input type="date" class="form-control" name="todate" placeholder="To Date" required>
                        </div>

                        <div class="form-group">
                            <label>Total Amount:</label>
                            <p><span id="totalAmount"></span></p>
                        </div>

                        <div class="form-group">
                            <textarea rows="4" class="form-control" name="message" placeholder="Message" required></textarea>
                        </div>
                        
                        <?php //if ($_SESSION['login']) { ?>
                            <div class="form-group">
                                <input type="submit" class="btn" name="submit" value="Book Now">
                            </div>
                        <?php // } else { ?>
                            <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login to Book</a>
                        <?php //} ?>
                    </form>
                </div>
            </aside> -->


             <!--Side-Bar-->
      <aside class="col-md-3">
      
      <div class="share_vehicle">
        <p>Share: <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a> </p>
      </div>
      <div class="sidebar_widget">
        <div class="widget_heading">
          <h5><i class="fa fa-envelope" aria-hidden="true"></i>Book Now</h5>
        </div>
        <form method="post">
          <div class="form-group">
            <label>From Date:</label>
            <input type="date" class="form-control" name="fromdate" placeholder="From Date" required>
          </div>
          <div class="form-group">
            <label>To Date:</label>
            <input type="date" class="form-control" name="todate" placeholder="To Date" required>
          </div>

          <div class="form-group">
                            <label>Total Amount:</label>
                            <p><span id="totalAmount"></span></p>
                        </div>
          <div class="form-group">
            <textarea rows="4" class="form-control" name="message" placeholder="Message" required></textarea>
          </div>
        <?php if($_SESSION['login'])
            {?>
            <div class="form-group">
              <input type="submit" class="btn"  name="submit" value="Book Now">
            </div>
            <?php } else { ?>
<a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login For Book</a>

            <?php } ?>
        </form>
      </div>
    </aside>
    <!--/Side-Bar--> 




        </div>
    </div>
</section>

<?php  ?>

<!-- Footer -->
<?php include('includes/footer.php');?>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script>
    // Calculate total amount dynamically based on selected dates
    $("input[name='fromdate'], input[name='todate']").change(function() {
        var fromdate = $("input[name='fromdate']").val();
        var todate = $("input[name='todate']").val();

        if (fromdate && todate) {
            var fromDateTimestamp = new Date(fromdate).getTime();
            var toDateTimestamp = new Date(todate).getTime();
            var diffDays = (toDateTimestamp - fromDateTimestamp) / (1000 * 3600 * 24);
            
            if (diffDays >= 0) {
                // Get PricePerDay from the backend and calculate the total amount
                var pricePerDay = <?php echo htmlentities($result->PricePerDay); ?>;
                var totalAmount = pricePerDay * diffDays;
                $("#totalAmount").text("$" + totalAmount.toFixed(2));
            } else {
                alert("To Date must be later than From Date");
            }
        }
    });
</script>
</body>
</html>
