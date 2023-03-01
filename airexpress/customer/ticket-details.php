<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Booking Page</title>
	<link rel="stylesheet" href="../stylesheet.css">
	<?php
	require('../dbm.php');
	$dbconn = new DatabaseManager;
	$dbconn->connect();
	?>
</head>
<body class="home-body">
	<?php
	include "header.php";
	if (isset($_GET['tk-select'])) {
		$flight_number = $_GET['tk-select'];
		$customer = $_SESSION['user-email'];
		$no_of_passengers = $_SESSION['no-of-passengers'];
		$cabin_class = $_SESSION['selected-class'];
	}
	function getFlightDetails($fl_num, $dbconn) {
		$sql = "SELECT * FROM Flight WHERE Flight_Number = '$fl_num'";
		$result = $dbconn->query($sql);
		return $result->fetch_row();
	}

	function getCustomerDetails($cs_email, $dbconn) {
		$sql = "SELECT * FROM Customer WHERE Customer_Email = '$cs_email'";
		$result = $dbconn->query($sql);
		return $result->fetch_row();
	}
	function displayTicketDetails($flight_details) { ?>
		<tr>
			<td><label style="margin: 1em">Flight Number: </label></td>
			<td><input readonly name="fl-num" value="<?php echo $flight_details[0] ?>"></td>
		</tr>
		<tr>
			<td><label style="margin: 1em">Origin: </label></td>
			<td><input readonly value="<?php echo $flight_details[1] ?>"></td>
		</tr>
		<tr>
			<td><label style="margin: 1em">Destination: </label></td>
			<td><input readonly value="<?php echo $flight_details[2] ?>"></td>
		</tr>
		<tr>
			<td><label style="width: fit-content; margin: 1em">Departure Date: </label></td>
			<td><input readonly value="<?php echo $flight_details[3] ?>"></td>
		</tr>
		<tr>
			<td><label style="width: fit-content; margin: 1em">Arrival Date: </label></td>
			<td><input readonly value="<?php echo $flight_details[5] ?>"></td>
		</tr>
		<tr>
			<td><label style="width: fit-content; margin: 1em">Departure Time: </label></td>
			<td><input readonly value="<?php echo $flight_details[4] ?>"></td>
		</tr>
		<tr>
			<td><label style="width: fit-content; margin: 1em">Arrival Time: </label></td>
			<td><input readonly value="<?php echo $flight_details[6] ?>"></td>
		</tr>
		<tr>
			<td><label style="width: fit-content; margin: 1em">Airplane: </label></td>
			<td><input readonly value="<?php echo $flight_details[7] ?>"></td>
		</tr>
		<tr>
			<td><label style="width: fit-content; margin: 1em">Flight Duration: </label></td>
			<td><input readonly value="<?php echo $flight_details[8]." Hours" ?>"></td>

		</tr>
		<tr>
			<td><label style="width: fit-content; margin: 1em">Flight Price: </label></td>
			<td><input readonly value="<?php echo 'MYR '.$flight_details[9] ?>"></td>
			<?php
			?>
		</tr>
	<?php }
	function displayCustomerDetails($customer_details) { ?>
		<tr>
			<td><label style="margin: 1em">Customer Email: </label></td>
			<td><input readonly name="passenger-1-email" value="<?php echo $customer_details[2] ?>"></td>
		</tr>
		<tr>
			<td><label style="margin: 1em">Customer Name: </label></td>
			<td><input readonly name="passenger-1-name" value="<?php echo $customer_details[0] ?>"></td>
		</tr>
		<tr>
			<td><label style="margin: 1em">Travel Document Number: </label></td>
			<td><input readonly name="passenger-1-document" value="<?php echo $customer_details[8] ?>"></td>
		</tr>
	<?php } ?>
	
	<form method="POST" class="bookingPageResultForms" action="ticket-purchase-process.php">
		<caption><h2>Booking Details</h2></caption>
		<fieldset>
			<legend><img src="../images/travelDocumentIcon.png"><h3>Ticket Details</h3></legend>
			<table>
				<?php
				$flight_details = getFlightDetails($flight_number, $dbconn); 
				displayTicketDetails($flight_details);
				?>
			</table>
		</fieldset>
		<fieldset>
			<legend><img src="../images/travelDocumentIcon.png"><h3>Passenger Details</h3></legend>
			<table>
				<?php
				$passenger_details = getCustomerDetails($customer, $dbconn);
				displayCustomerDetails($passenger_details);
				for($i = 2; $i <= $no_of_passengers; $i++) { ?>
					<tr>
						<td><label style="margin: 1em">Passenger <?php echo $i ?> Email: </label></td>
						<td><input type="email" name="passenger-<?php echo $i ?>-email"  required></td>
					</tr>
					<tr>
						<td><label style="margin: 1em">Passenger <?php echo $i ?> Name: </label></td>
						<td><input type="text" name="passenger-<?php echo $i ?>-name" required></td>
					</tr>
					<tr>
						<td><label style="margin: 1em">Passenger <?php echo $i ?> Travel Document Number: </label></td>
						<td><input type="text" name="passenger-<?php echo $i ?>-document" required></td>
					</tr>
				<?php } ?>
			</table>
		</fieldset>
		<fieldset>
			<legend><img src="../images/travelDocumentIcon.png"><h3>Payment Details</h3></legend>
				<table>
					<tr>
						<td><label style="margin: 1em">Total number of passengers: </label></td>
						<td><input name="no-of-pssngrs" value="<?php echo $no_of_passengers ?>" readonly></td>
					</tr>
					<tr>
						<td><label style="margin: 1em">Ticket Price: </label></td>
						<td><input name="" value="<?php echo $flight_details[9] ?>" readonly></td>
					</tr>
					<tr>
						<?php $total_price = (float)$flight_details[9] * (int)$no_of_passengers ?>
						<td><label style="margin: 1em">Total Price: </label></td>
						<td><input readonly name="total-price" value="<?php echo $total_price ?>"></td>
					</tr>
		<?php 
		if ($_SESSION['trip-type'] === "one-way" || ( $_SESSION['trip-type'] === "two-way" && $_SESSION['return-ticket'] === "Selected")) { ?>
					<tr>
						<td><label style="margin: 1em">Card No. : </label></td>
						<td><input pattern="^[0-9]*" type="text" title="No special characters allowed, only digits" maxlength="50" name="card-number" required></td>
					</tr>
					<tr>
						<td><label style="margin: 1em">Card CVV: </label></td>
						<td><input pattern="^[0-9]*" type="text" title="No special characters allowed, only digits" maxlength="3" name="card-cvv" required></td>
					</tr>
					<tr>
						<td><label style="margin: 1em">Card Expiry: </label></td>
						<td><input type="date" name="card-exp" required></td>
					</tr>
				</table>
			</fieldset>
			<?php
			$_SESSION['departure-ticket'] = "Selected";
			echo "<input type='submit' name='proceed' value='Confirm Purchase'>";
		} else {
			if ($_SESSION['trip-type'] === "two-way" && $_SESSION['return-ticket'] === "Not Selected") { ?>
				</table>
			</fieldset>
			<?php }
			$_SESSION['departure-ticket'] = "Selected";
			echo "<input type='submit' name='proceed' value='Proceed To Return Flight'>";
		}
		?>
	</form>
</body>
<?php include('customer-footer.php') ?>
</html>