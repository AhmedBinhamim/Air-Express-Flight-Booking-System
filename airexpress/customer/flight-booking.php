<?php
session_start();
?>
<!DOCTYPE html>
<html>
<?php
require('../dbm.php');
$dbconn = new DatabaseManager;
$dbconn->connect();
?>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Booking Page</title>
	<link rel="stylesheet" href="../stylesheet.css">
	<script type="text/javascript">
		function validateDestination() {
			var origin = document.forms["booking-form"]["origin"].value;
			var destination = document.forms["booking-form"]["destination"].value;
			if (origin == destination) {
				alert("Origin city and Destination city cannot be the same.");
				return false;
			}
			return true;
		}

		function validateDate() {
			var departDate = new Date(document.forms["booking-form"]["departure-date"].value);
			var arrivalDate = new Date(document.forms["booking-form"]["return-date"].value);
			if (departDate > arrivalDate) {
				alert("Arrival Date cannot be before Depart Date");
				return false;
			}
			return true;
		}
  </script>
</head>

<body class="search-flight">
	<?php
	include 'header.php';
	?>
		<form method="POST" name="booking-form" class="bookingForm" action="flight-booking-process.php?customer=true" onsubmit="return(validateDate() && validateDestination())">
			<h2>Search Flight</h2>	
			<label class="toggle">
			<input type="radio" class="hide" id="one-way-trip" name="trip-type" value="one-way" onclick="toggleOneWayFlight()" checked>
			<label style="display: inline; background: green;" id="one-way-label" for="one-way-trip">One Way</label>
			<input type="radio" class="hide" id="two-way-trip" name="trip-type" value="two-way" onclick="toggleTwoWayFlight()">
			<label style="display: inline; background: #EFF2F4;" id="two-way-label" for="two-way-trip">Two Way</label>
			</label>
			<fieldset>
			<label style="display: inline; margin: 1em">Origin:</label>
			<select style="width: fit-content; margin: 1em" id="airplane" name="origin" required>
				<?php
				$sql = "SELECT * FROM Cities";
				$results = $dbconn->query($sql);
				while ($row = $results->fetch_assoc()) {
				echo "<option value=".$row['City_Name'].">".$row['City_Name']."</option>";
				}
				?>
			</select>
			<label style="display: inline; margin: 1em">Destination City:</label>
			<select style="width: fit-content; margin: 1em" id="airplane" name="destination" required>
				<?php
				$sql = "SELECT * FROM Cities";
				$results = $dbconn->query($sql);
				while ($row = $results->fetch_assoc()) {
				echo "<option value=".$row['City_Name'].">".$row['City_Name']."</option>";
				}
				?>
			</select>
			<label>Departure Date:</label>
			<input type="date" name="dep-date" id="departure-date" required>
			<div id="ret-date-div" style="display: none;">
				<label>Return Date:</label>
				<input type="date" name="ret-date" id="return-date">
			</div>
			<label>Ticket Class:</label>
			<select id="ticket-class" name="cabin-class" style="width: fit-content;">
			<option value="economy">Economy</option>
			<option value="business">Business</option>
			<option value="first-class">First Class</option>
			</select>
			<label>Passengers:</label>
			<input type="number" id="noOfPassengers" name="noOfPassengers" value="1" min="1" max="10" required>
		</fieldset>
			<input type="submit" name='fl-search' value="Search Flight">
		</form>
		<script>
			function toggleTwoWayFlight() {
			var returnFlight = document.getElementById("ret-date-div");
			if (returnFlight.style.display === "none") {
				returnFlight.style.display = "block";
			} else {
				returnFlight.style.display = "none";
			}
			document.getElementById("return-date").setAttribute("required", "");
			document.getElementById('one-way-label').style.backgroundColor = "#EFF2F4";
			document.getElementById('two-way-label').style.backgroundColor="green";
			}
			function toggleOneWayFlight() {
			var returnFlight = document.getElementById("ret-date-div");
			if (returnFlight.style.display === "block") {
				returnFlight.style.display = "none";
			} else {
				returnFlight.style.display = "none";
			}
			document.getElementById("return-date").removeAttribute("required");
			document.getElementById('one-way-label').style.backgroundColor="green";
			document.getElementById('two-way-label').style.backgroundColor="#EFF2F4";
			}
    	</script>

		<video class= "welcomingVideo" controls loop autoplay muted>
			<source src="../videos/welcomeVideo.mp4" type="video/mp4">
		</video>
	</div>
	
	<?php
	$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	if (strpos($fullUrl, "dates=noDepartFlights") == true) {
		echo '<script>window.alert("Sorry no flights available");</script>';
	} elseif (strpos($fullUrl, "dates=noReturnFlights") == true) {
		echo '<script>window.alert("Sorry no flights available");</script>';
	}
	?>
</body>
<?php include('customer-footer.php') ?>
</html>