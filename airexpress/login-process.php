<?php
session_start();
require('dbm.php');
$dbconn = new DatabaseManager;
$dbconn->connect();

if (isset($_GET['booking_session'])) {
	$email = $_SESSION['user-email'];
	$password = $_SESSION['user-password'];
	session_destroy();
	session_start();
	$_SESSION['user-email'] = $email;
	$_SESSION['user-password'] = $password;
} else {

	$email = $_GET['email'];
	$password = $_GET['password'];
	if ($email === "admin.airexpress@gmail.com") {
		$_SESSION['user-email'] = $email;
		$_SESSION['user-password'] = $password;
		$url = "http://localhost:8080/airexpress/admin/admin-dashboard.php?admin=true";
		header("Location: $url");
		return;
	} else {
		$sql = "SELECT * FROM Customer WHERE Customer_Email = '$email'";
		$result = $dbconn->query($sql);

		if ($result->num_rows == 0) {
			$url = "http://localhost:8080/airexpress/login.php?credentials=Invalidusernameorpassword";
			header("Location: $url");
		} else {
			$row = $result->fetch_assoc();
			if ($row["Customer_Password"] === $password) {
				$_SESSION['user-email'] = $email;
				$_SESSION['user-password'] = $password;
				$url = "http://localhost:8080/airexpress/customer/flight-booking.php?customer=true";
				header("Location: $url");
			} else {
				$url = "http://localhost:8080/airexpress/login.php?credentials=Invalidpassword";
				header("Location: $url");
			}
		}
	}
}

?>