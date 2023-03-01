<!DOCTYPE html>
<html>

<head lang="en">
  <meta charset="utf-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../stylesheet.css">
</head>
<?php
require('../dbm.php');
$dbconn = new DatabaseManager;
$dbconn->connect();

$sql = "SELECT * FROM Flight";
$results = $dbconn->query($sql);
$flights = mysqli_num_rows($results);

$sql = "SELECT * FROM Flight WHERE Flight_Status = 'Arrived'";
$results = $dbconn->query($sql);
$arrived_flights = mysqli_num_rows($results);

$sql = "SELECT * FROM Flight WHERE Flight_Status = 'Cancelled'";
$results = $dbconn->query($sql);
$cancelled_flights = mysqli_num_rows($results);

$sql = "SELECT * FROM Flight WHERE Flight_Status = 'Pending'";
$results = $dbconn->query($sql);
$pending_flights = mysqli_num_rows($results);

$sql = "SELECT * FROM Ticket";
$results = $dbconn->query($sql);
$tickets = mysqli_num_rows($results);

$sql = "SELECT * FROM Booking";
$results = $dbconn->query($sql);
$bookings = mysqli_num_rows($results);

?>
<body class="home-body">
  <?php include 'header.php' ?>
  <div class="totalFlights"  style="margin-top: 7em;">
    <img class="dashboardImages"src="../images/flightImage.jpg">
    <div class="dashboardCaptions"><caption>Total Flights: <?php echo $flights ?></caption></div>
  </div>

  <div class="arrivedFlights">
    <!-- iamge icon here -->
    <img class="dashboardImages" src="../images/arrivingFlight.jpg">
    <div class="dashboardCaptions">Arrived Flights: <?php echo $arrived_flights ?></div>
  </div>

  <div class="cancelledFlights">
    <!-- iamge icon here -->
    <label></label>
    <img class="dashboardImages" src="../images/cancelledFlight.jpg" >
    <div class="dashboardCaptions">Cancelled Flights: <?php echo $cancelled_flights ?></div>
  </div>

  <div class="pendingFlights">
    <!-- iamge icon here -->
    <img class="dashboardImages" src="../images/pendingFlight.png" >
    <div class="dashboardCaptions">Pending Flights: <?php echo $pending_flights ?></div>
  </div>

  <div class="ticketsIssued">
    <!-- iamge icon here -->
    <img class="dashboardImages" src="../images/tickets.jpg">
    <div class="dashboardCaptions">Tickets Issued: <?php echo $tickets ?></div>
  </div>

  <div class="bookingsIssued">
    <!-- iamge icon here -->
    <img class="dashboardImages" src="../images/booking.png">
    <div class="dashboardCaptions">Bookings Issued: <?php echo $bookings ?></div>
  </div>
</body>
