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
  <script type="text/javascript">
    function validateDestination() {
      var origin = document.forms["addFlightForm"]["origin"].value;
      var destination = document.forms["addFlightForm"]["destination"].value;
      if (origin == destination) {
        alert("Origin city and destination city cannot be the same.");
        return false;
      }
    return true;
  }

    function validateDate() {
        var departDate = new Date(document.forms["addFlightForm"]["dep-date"].value);
        var arrivalDate = new Date(document.forms["addFlightForm"]["arr-date"].value);
        if (departDate > arrivalDate) {
            alert("Arrival Date cannot be before Depart Date");
            return false;
    }
    return true;
}
  </script>
</head>

<body class="home-body">
  <?php include 'header.php' ?>
  <div>
    <label><h2>Add Flight</h2></label>
    <form  method="POST" class="flight-form" action="add-flight-process.php" name="addFlightForm" onsubmit="return(validateDate() && validateDestination())">
      <table>
      <tr>
      <td><label>Origin:</label></td>
      <td><select  id="airplane" name="origin" required>
        <?php
        $sql = "SELECT * FROM Cities";
        $results = $dbconn->query($sql);
        while ($row = $results->fetch_assoc()) {
          echo "<option value=".$row['City_Name'].">".$row['City_Name']."</option>";
        }
        ?>
      </select></td>
      <td><label >Destination City:</label></td>
      <td><select id="selectElements" id="airplane" name="destination" required>
        <?php
        $sql = "SELECT * FROM Cities";
        $results = $dbconn->query($sql);
        while ($row = $results->fetch_assoc()) {
          echo "<option value=".$row['City_Name'].">".$row['City_Name']."</option>";
        }
        ?>
      </select></td>
    </tr>

      <tr>
      <td><label >Departure Date:</label></td>
      <td><input type="date" id="departure-date" name="dep-date" required></td>
      <td><label >Arrival Date:</label></td>
      <td><input type="date" id="return-date"  name="arr-date" required></td>
    </tr>
    <tr>
      <td><label >Departure Time:</label></td>
      <td><input type="time" id="departure-date" name="dep-time" required></td>
      <td><label >Arrival Time:</label></td>
      <td><input type="time" id="return-date"  name="arr-time" required></td>
    </tr>
    <tr>
      <td><label >Airplane:</label></td>
      <td><select id="airplane" name="airplane" required>
        <?php
        $sql = "SELECT * FROM Airplane";
        $results = $dbconn->query($sql);
        while ($row = $results->fetch_assoc()) {
          echo "<option value=".$row['Airplane_Type'].">".$row['Airplane_Type']."</option>";
        }
        ?>
      </select></td>
      <td><label >Flight Price:</label></td>
      <td><input type="number" name="flight-price" step="0.01" required></td>
    </tr>
  </table>
      
      <input type="submit" name="flight-add" value="Add Flight">
    </form>
  </div>
</body>