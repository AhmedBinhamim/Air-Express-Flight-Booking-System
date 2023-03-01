<!DOCTYPE html>
<html>
<?php 
require('../dbm.php');
$dbconn = new DatabaseManager;
$dbconn->connect();
function displayTableRow($fl_num, $origin, $dest, $departure_date, $arrival_date, $price, $duration, $airplane, $status) { ?>
    <tr>
        <td><?php echo $fl_num ?></td>
        <td><?php echo $origin ?></td>
        <td><?php echo $dest ?></td>
        <td><?php echo $departure_date ?></td>
        <td><?php echo $arrival_date ?></td>
        <td><?php echo $price ?></td>
        <td><?php echo $duration ?></td>
        <td><?php echo $airplane ?></td>
        <td><?php echo $status ?></td>
        <td><input type="submit" name="fl-delete" value="<?php echo $fl_num ?>"/></td>
        <td><input type="submit" name="fl-edit" value="<?php echo $fl_num ?>"/></td>
    </tr>
<?php } ?>

<head lang="en">
  <meta charset="utf-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../stylesheet.css">
</head>

<body class="home-body">
  <?php include 'header.php' ?>
  <label><h1>Flights</h1></label>
    <form class="manageFlightForm" method="POST" action="manage-flight-process.php">
        <table class="table-view">
            <tr>
                <th>Flight Number</th>
                <th>Flight Source</th>
                <th>Flight Destination</th>
                <th>Flight Departure</th>
                <th>Flight Arrival</th>
                <th>Flight Price</th>
                <th>Flight Duration</th>
                <th>Flight Airplane</th>
                <th>Flight Status</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            <?php
            $sql = "SELECT * FROM Flight";
            $results = $dbconn->query($sql);
            while ($row = $results->fetch_assoc()) {
                displayTableRow($row['Flight_Number'], $row['Flight_From'], $row['Flight_To'], $row['Flight_Departure_Date'], $row['Flight_Arrival_Date'], $row['Flight_Price'], $row['Flight_Duration'], $row['Flight_Airplane'], $row['Flight_Status']);
            } ?>
        </table>
    </form>
    <div style="margin-left: 16em; background-color: rgba(255,255,255,0.5); width: fit-content; padding: 0.5em; margin-top: 0.5em;">
      <label style="font-weight: bold;">Click add button to add new flights:</label>
      <a href="add-flight.php"><button id="addButton" >Add Flight</button></a>
    </div>

  <?php
  if (isset($_GET['flight_status'])) {
      if ($_GET['flight_status'] == "arrived") {
        echo "<script>alert('Error: Cannot edit a flight afer arrival');</script>";
      }
  } 
  ?>
</body>