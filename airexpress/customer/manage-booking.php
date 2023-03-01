<?php
session_start();
?>
<!DOCTYPE html>
<html>
<?php 
require('../dbm.php');
$dbconn = new DatabaseManager;
$dbconn->connect();
function displayTableRow($bk_num ,$fl_num, $status) { ?>
    <tr>
        <td><?php echo $bk_num ?></td>
        <td><?php echo $fl_num ?></td>
        <td><?php echo $status ?></td>
        <td><input type="submit" class="flightDetailButton" name="bk-manage" value="<?php echo $bk_num ?>" id="bk-number"></td>
    </tr>
<?php } ?>

<head lang="en">
  <meta charset="utf-8">
  <title>My Bookings</title>
  <link rel="stylesheet" href="../stylesheet.css">
</head>

<body class="home-body">
  <?php include 'header.php' ?>
  <label><h1>My Bookings</h1></label>
    <form class="managebookingForm" method="POST" action="booking-details.php">
        <table class="table-view">
            <tr>
                <th>Booking Number</th>
                <th>Flight Number</th>
                <th>Booking Status</th>
                <th>Details</th>
            </tr>
            <?php
            $sql = "SELECT * FROM Booking WHERE Customer_Email = '{$_SESSION['user-email']}'";
            $results = $dbconn->query($sql);
            while ($row = $results->fetch_assoc()) {
                displayTableRow($row['Booking_Number'], $row['Flight_Number'], $row['Booking_Status']);
            } ?>
        </table>
    </form>
</body>
<?php include('customer-footer.php') ?>
</html>