<!DOCTYPE html>
<html>
<?php 
require('../dbm.php');
$dbconn = new DatabaseManager;
$dbconn->connect();
?>
<head lang="en">
  <meta charset="utf-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../stylesheet.css">
</head>

<body class="home-body">
  <?php include 'header.php' ?>
    <h1>Airplanes</h1>
    <form class="addAirplaneTable" method="POST" action="add-airplane-process.php">
        <table class="table-view">
            <tr>
                <th>Airplane Model</th>
                <th>Total Seats</th>
                <th>Delete</th>
            </tr>
            <?php
            $sql = "SELECT * FROM Airplane";
            $results = $dbconn->query($sql);
            while ($row = $results->fetch_assoc()) {
                echo "<tr><td>" . $row['Airplane_Type'] . "</td><td>" . $row['Airplane_Seats'] . "</td>";
                echo "<td><input type='submit' name='ar-type' value='{$row['Airplane_Type']}'/></td></tr>";
            }
            ?>
        </table>
    </form>

    <form class="addAirplaneForm" method="POST" action="add-airplane-process.php">
      <label style="margin: 1em">Airplane Type:</label>
      <input style="width: fit-content; margin: 1em" type="text" name="airplane-type" required>
      <label style="margin: 1em">Airplane Seats:</label> 
      <input style="width: fit-content; margin: 1em" type="number" name="airplane-seats" required>
      <input style="width: fit-content; margin: 1em" type="submit" name="add-airplane" value="Add Airplane">
    </form>
  <?php
  if (isset($_GET['airplane'])) {
      if ($_GET['airplane'] == "alreadyAdded") {
        echo '<script>window.alert("The flight model is already added");</script>';
      }
  }
  ?>
</body>