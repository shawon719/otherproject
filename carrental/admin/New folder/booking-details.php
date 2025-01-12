<?php
session_start();
error_reporting(0);
include('includes/config.php');

// If session is not set, redirect to login page
if (strlen($_SESSION['alogin']) == 0) {
    header('location:indexlog.php');
} else {
    // Cancel booking
    if (isset($_REQUEST['eid'])) {
        $eid = intval($_GET['eid']);
        $status = "2";
        // Prepare the query
        $sql = "UPDATE tblbooking SET Status=? WHERE id=?";
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("si", $status, $eid);
            $stmt->execute();
            echo "<script>alert('Booking Successfully Cancelled');</script>";
            echo "<script type='text/javascript'> document.location = 'canceled-bookings.php'; </script>";
            $stmt->close();
        }
    }

    // Confirm booking
    if (isset($_REQUEST['aeid'])) {
        $aeid = intval($_GET['aeid']);
        $status = 1;
        // Prepare the query
        $sql = "UPDATE tblbooking SET Status=? WHERE id=?";
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("ii", $status, $aeid);
            $stmt->execute();
            echo "<script>alert('Booking Successfully Confirmed');</script>";
            echo "<script type='text/javascript'> document.location = 'confirmed-bookings.php'; </script>";
            $stmt->close();
        }
    }
    ?>

    <!doctype html>
    <html lang="en" class="no-js">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="theme-color" content="#3e454c">
        <title>Car Rental Portal | New Bookings</title>

        <!-- Add your CSS links here -->
    </head>

    <body>
        <?php include('includes/header.php');?>

        <div class="ts-main-content">
            <?php include('includes/leftbar.php');?>
            <div class="content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="page-title">Booking Details</h2>
                            <div class="panel panel-default">
                                <div class="panel-heading">Bookings Info</div>
                                <div class="panel-body">
                                    <div id="print">
                                        <table border="1" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                            <tbody>
                                                <?php 
                                                $bid = intval($_GET['bid']);
                                                $sql = "SELECT tblusers.*, tblbrands.BrandName, tblvehicles.VehiclesTitle, tblbooking.FromDate, tblbooking.ToDate, tblbooking.message, tblbooking.VehicleId as vid, tblbooking.Status, tblbooking.PostingDate, tblbooking.id, tblbooking.BookingNumber,
                                                                DATEDIFF(tblbooking.ToDate, tblbooking.FromDate) as totalnodays, tblvehicles.PricePerDay
                                                FROM tblbooking 
                                                JOIN tblvehicles ON tblvehicles.id = tblbooking.VehicleId 
                                                JOIN tblusers ON tblusers.EmailId = tblbooking.userEmail 
                                                JOIN tblbrands ON tblvehicles.VehiclesBrand = tblbrands.id 
                                                WHERE tblbooking.id = ?";
                                                
                                                if ($stmt = $mysqli->prepare($sql)) {
                                                    $stmt->bind_param("i", $bid);
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            ?>
                                                            <h3 style="text-align:center; color:red">#<?php echo htmlentities($row['BookingNumber']);?> Booking Details</h3>

                                                            <tr>
                                                                <th colspan="4" style="text-align:center;color:blue">User Details</th>
                                                            </tr>
                                                            <tr>
                                                                <th>Booking No.</th>
                                                                <td>#<?php echo htmlentities($row['BookingNumber']);?></td>
                                                                <th>Name</th>
                                                                <td><?php echo htmlentities($row['FullName']);?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Email Id</th>
                                                                <td><?php echo htmlentities($row['EmailId']);?></td>
                                                                <th>Contact No</th>
                                                                <td><?php echo htmlentities($row['ContactNo']);?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Address</th>
                                                                <td><?php echo htmlentities($row['Address']);?></td>
                                                                <th>City</th>
                                                                <td><?php echo htmlentities($row['City']);?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Country</th>
                                                                <td colspan="3"><?php echo htmlentities($row['Country']);?></td>
                                                            </tr>

                                                            <tr>
                                                                <th colspan="4" style="text-align:center;color:blue">Booking Details</th>
                                                            </tr>
                                                            <tr>
                                                                <th>Vehicle Name</th>
                                                                <td><a href="edit-vehicle.php?id=<?php echo htmlentities($row['vid']);?>"><?php echo htmlentities($row['BrandName']);?> , <?php echo htmlentities($row['VehiclesTitle']);?></a></td>
                                                                <th>Booking Date</th>
                                                                <td><?php echo htmlentities($row['PostingDate']);?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>From Date</th>
                                                                <td><?php echo htmlentities($row['FromDate']);?></td>
                                                                <th>To Date</th>
                                                                <td><?php echo htmlentities($row['ToDate']);?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Total Days</th>
                                                                <td><?php echo htmlentities($tdays = $row['totalnodays']);?></td>
                                                                <th>Rent Per Days</th>
                                                                <td><?php echo htmlentities($ppdays = $row['PricePerDay']);?></td>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="3" style="text-align:center">Grand Total</th>
                                                                <td><?php echo htmlentities($tdays * $ppdays);?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Booking Status</th>
                                                                <td><?php 
                                                                    if ($row['Status'] == 0) {
                                                                        echo htmlentities('Not Confirmed yet');
                                                                    } else if ($row['Status'] == 1) {
                                                                        echo htmlentities('Confirmed');
                                                                    } else {
                                                                        echo htmlentities('Cancelled');
                                                                    }
                                                                ?></td>
                                                                <th>Last Update Date</th>
                                                                <td><?php echo htmlentities($row['LastUpdationDate']);?></td>
                                                            </tr>

                                                            <?php if ($row['Status'] == 0) { ?>
                                                                <tr>
                                                                    <td style="text-align:center" colspan="4">
                                                                        <a href="bookig-details.php?aeid=<?php echo htmlentities($row['id']);?>" onclick="return confirm('Do you really want to Confirm this booking')" class="btn btn-primary">Confirm Booking</a>
                                                                        <a href="bookig-details.php?eid=<?php echo htmlentities($row['id']);?>" onclick="return confirm('Do you really want to Cancel this Booking')" class="btn btn-danger">Cancel Booking</a>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        <?php }
                                                    }
                                                    $stmt->close();
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <form method="post">
                                            <input name="Submit2" type="submit" class="txtbox4" value="Print" onClick="return f3();" style="cursor: pointer;" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loading Scripts -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap-select.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/dataTables.bootstrap.min.js"></script>
        <script src="js/Chart.min.js"></script>
        <script src="js/fileinput.js"></script>
        <script src="js/chartData.js"></script>
        <script src="js/main.js"></script>
        <script language="javascript" type="text/javascript">
        function f3() {
            window.print();
        }
        </script>
    </body>
    </html>
<?php } ?>
