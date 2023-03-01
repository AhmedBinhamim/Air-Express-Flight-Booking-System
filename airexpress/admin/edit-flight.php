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
  <style>
    label
    {
      display: block;
      margin-top: 5em;
      margin-bottom: 2em;
    }
    form 
    {
      width: 500px;
    }
    input[type="text"], select
    {
      width: 100%;
      padding: 12px 20px;
      margin-left: 1em;
      box-sizing: border-box;
      border: 2px solid #ccc;
      border-radius: 4px;
      padding: 0.5em;
    }
    input[type="submit"] 
    {
      width: 100%;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    input[type="number"]
    {
      width: 3em;
      margin-left: 1em;
    }
    input[type="date"]
    {
      margin-left: 1em;
    }
  </style>
</head>

<body class="home-body">
  <?php 
  include 'header.php';
  if (isset($_GET['flight'])) {
    $flight_number = $_GET['flight'];
    $sql = "SELECT * FROM Flight WHERE Flight_Number=$flight_number";
    $result = $dbconn->query($sql);
    $row = $result->fetch_row();
    $origin = $row[1];
    $destination = $row[2];
    $dep_date = $row[3];
    $dep_time = $row[4];
    $arr_date = $row[5];
    $arr_time = $row[6];
    $fl_status = $row[11];
  }
  ?>

  <div>
    <label><h2>Update Flight Details</h2></label>
    <form style="margin: auto;" method="POST" class="flight-form" action="edit-flight-process.php">  
      <table>
        <tr>
          <td><label style="margin: 1em">Flight Number: </label></td>
          <td><input readonly style="margin: 1em; width: fit-content;" type="number" name="flight-number" value=<?php echo $flight_number ?>></td>
        </tr>
        <tr>
          <td><label style="margin: 1em">Origin: </label></td>
          <td><label style="margin: 1em"><?php echo $origin ?></label></td>
        </tr>
        <tr>
          <td><label style="margin: 1em">Destination: </label></td>
          <td><label style="margin: 1em"><?php echo $destination ?></label></td>
        </tr>
        <tr>
          <td><label style="width: fit-content; margin: 1em">Departure Date:</label></td>
          <td><input type="date" id="departure-date" name="dep-date" value="<?php echo $dep_date ?>" required></td>
        </tr>
        <tr>
          <td><label style="width: fit-content; margin: 1em">Arrival Date:</label></td>
          <td><input type="date" id="return-date" name="arr-date" value="<?php echo $arr_date ?>" required></td>
        </tr>
        <tr>
          <td><label style="width: fit-content; margin: 1em">Departure Time:</label></td>
          <td><input type="time" id="departure-date" name="dep-time" value="<?php echo $dep_time ?>" required></td>
        </tr>
        <tr>
          <td><label style="width: fit-content; margin: 1em">Arrival Time:</label></td>
          <td><input type="time" id="return-date" name="arr-time" value="<?php echo $arr_time ?>" required></td>
        </tr>
        <tr>
          <td><label style="margin: 1em">Flight Status: </label></td>
          <td>
            <select style="width: fit-content;" name="fl-status">
              <option value="Pending" <?php if ($fl_status == 'Pending') echo 'selected="selected"';?>>Pending</option>
              <option value="Arrived" <?php if ($fl_status == 'Arrived') echo 'selected="selected"';?>>Arrived</option>
              <option value="Cancelled" <?php if ($fl_status == 'Cancelled') echo 'selected="selected"';?>>Cancelled</option>
            </select>
          </td>
        </tr>
        </table>
        <input style="width: fit-content; margin: 1em" type="submit" name="flight-edit" value="Save">
    </form>
  </div>
</body>