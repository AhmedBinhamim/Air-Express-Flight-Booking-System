<?php
session_start();
if (!isset($_SESSION['departure-ticket'])) {
  $_SESSION['departure-ticket'] = "Not Selected";
}
if (!isset($_SESSION['trip-type'])) {
  $_SESSION['trip-type'] = $_POST['trip-type'];
}
if ($_SESSION['trip-type'] === "two-way" && !isset($_SESSION['return-ticket'])) {
  $_SESSION['return-ticket'] = "Not Selected";
}
?>
<!DOCTYPE html>
<html>

<?php 
require('../dbm.php');
$dbconn = new DatabaseManager;
$dbconn->connect();;

if (isset($_POST['fl-search'])) {
  $origin = $_POST['origin'];
  $dest = $_POST['destination'];
  $return = ($_POST['trip-type'] === "two-way") ? 'Yes' : 'No';
  $passNo = $_POST['noOfPassengers'];
  $depDate = $_POST['dep-date'];
  $class = $_POST['cabin-class'];
  if ($return == 'Yes') {
    $retDate = $_POST['ret-date'];
  }
  $_SESSION['no-of-passengers'] = $_POST['noOfPassengers'];
  $_SESSION['selected-class'] = $_POST['cabin-class'];
  $_SESSION['origin'] = $_POST['origin'];
  $_SESSION['dest'] = $_POST['destination'];
  $_SESSION['retDate'] = $_POST['ret-date'];
}
?>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Booking Page Result</title>
  <link rel="stylesheet" href="../stylesheet.css">
  <?php
    function displayTableRow($fl_num, $origin, $dest, $departure_date, $departure_time, $arrival_date, $arrival_time, $duration, $price) { ?>
      <tr>
        <td><?php echo $origin ?></td>
        <td><?php echo $dest ?></td>
        <td><?php echo $departure_date ?></td>
        <td><?php echo $departure_time ?></td>
        <td><?php echo $duration ?></td>
        <td><?php echo $arrival_date ?></td>
        <td><?php echo $arrival_time ?></td>
        <td><?php echo $price ?></td>
        <td>
          <input type="submit" name="tk-select" value="<?php echo $fl_num ?>"/>
        </td>
      </tr>
  <?php }
    function showDepartFlights($results) { ?>
      <form method="GET" class="bookingPageResultForms" action="ticket-details.php?customer=true">
        <caption><h2>Departure Flights</h2></caption>
        <fieldset>
          <legend><img src="../images/departureIcon.png"></legend>
          <table class="DepartTable">
            <tr>
              <th>Origin</th>
              <th>Destination</th>
              <th>Departure Date</th>
              <th>Departure Time</th>
              <th>Duration (Hours)</th>
              <th>Arrival Date</th>
              <th>Arrival Time</th>
              <th>Price (MYR)</th>
              <th>Flight Number</th>
            </tr>

            <?php
              if ($results) {
                while ($row = $results->fetch_assoc()) {
                  displayTableRow($row["Flight_Number"], $row["Flight_From"], $row["Flight_To"], $row["Flight_Departure_Date"], $row["Flight_Departure_Time"], $row["Flight_Arrival_Date"], $row["Flight_Arrival_Time"], $row["Flight_Duration"], $row['Flight_Price']);
                }
              } ?>
          </table>
        </fieldset>
      </form>
  <?php }
    function showReturnFlights($results) { ?>
      <form method="GET" class="bookingPageResultForms" action="ticket-details.php?customer=true">
        <caption><h2>Return Flights</h2></caption>
        <fieldset>
          <legend><img src="../images/returnIcon.png"></legend>
          <table class="ReturnTable">
            <tr>
              <th>Origin</th>
              <th>Destination</th>
              <th>Departure Date</th>
              <th>Departure Time</th>
              <th>Duration (Hours)</th>
              <th>Arrival Date</th>
              <th>Arrival Time</th>
              <th>Price (MYR)</th>
              <th>Flight Number</th>
            </tr>

            <?php
              if ($results) {
                while ($row = $results->fetch_assoc()) {
                  displayTableRow($row["Flight_Number"], $row["Flight_To"], $row["Flight_From"], $row["Flight_Departure_Date"], $row["Flight_Departure_Time"], $row["Flight_Arrival_Date"], $row["Flight_Arrival_Time"], $row["Flight_Duration"], $row['Flight_Price']);
                }
              } ?>
          </table>
        </fieldset>
      </form>
  <?php } ?>
</head>

<body class="home-body">
  <?php
  include("header.php");
  echo "<br>";
  print_r($_POST);
  if ($_SESSION['departure-ticket'] === "Not Selected") {
    $sql = "SELECT * FROM Flight WHERE Flight_Departure_Date = '$depDate' AND Flight_From = '$origin' AND Flight_To = '$dest'";
    $results = $dbconn->query($sql);
    $num_rows = mysqli_num_rows($results);
    if ($num_rows != 0) {
      showDepartFlights($results);
    } else {
      $url = "http://localhost:8080/airexpress/customer/flight-booking.php?customer=true?dates=noDepartFlights";
      header("Location: $url");
    }
  }
  if ($_SESSION['trip-type'] === "two-way" && $_SESSION['departure-ticket'] === "Selected" && $_SESSION['return-ticket'] === "Not Selected") {
    $sql = "SELECT * FROM Flight WHERE Flight_Departure_Date = '{$_SESSION['retDate']}' AND Flight_From = '{$_SESSION['dest']}' AND Flight_To = '{$_SESSION['origin']}'";
    $results = $dbconn->query($sql);
    $num_rows = mysqli_num_rows($results);
    if ($num_rows != 0) {
      $_SESSION['return-ticket'] = "Selected";
      showReturnFlights($results);
    }
    else {
      $url = "http://localhost:8080/airexpress/customer/flight-booking.php?customer=true?dates=noReturnFlights";
      header("Location: $url");
    }
  }
  ?>

  <div class="aside">
    <div class="ads">
      <a href="https://www.booking.com/index.en.html?aid=309654;label=hotels-english-en-malaysia-vIn5ubZDELapbNYQj8VR2gS432875813414:pl:ta:p1:p2:ac:ap:neg:fi:tikwd-17218370:lp1029507:li:dec:dm:ppccp=UmFuZG9tSVYkc2RlIyh9YcsZ-Id2vkzIfTmYhvC5HOg;ws=&gclid=Cj0KCQiAzeSdBhC4ARIsACj36uGmERIDKuOmELlwuilc9NBcvuNsA6W6ELAnExpR8tSD6wf_U3CbIcQaAn6SEALw_wcB"><p class="adsText">Found a flight? Now find a hotel!</p></a>
      <img src="../images/hotel.jpg" width="80%" height="70%">
    </div>
    <div class="ads">
      <a href="https://socar.my/consumer"><p class="adsText">Rent a car!</p></a>
      <img src="../images/rent.png" width="80%" height="70%">
    </div>
    <div class="ads">
      <a href="https://www.malaysia.gov.my/portal/content/28905"><p class="adsText">Apply for tourist visa!</p></a>
      <img src="../images/tourist.jpg"  width="80%" height="70%">
    </div>
  </div>
</body>
<?php include('customer-footer.php') ?>
</html>