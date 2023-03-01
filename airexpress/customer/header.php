<head>
	<div class="topnav">
		<?php
			$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			if(strpos($fullUrl, "customer") == true && !isset($_GET['register'])) { ?>
				<a href="flight-booking.php?customer=true">Book</a>
				<a href="manage-booking.php">My Booking</a>
				<a href="manage-profile.php">Profile</a>
				<a href="about-us.php">About Us</a>
				<a href="faq.php">FAQ</a>
				<div class="topnav-right">
					<a href="../login.php">Logout</a>
				</div>
		<?php } elseif (strpos($fullUrl, "tk-select") == true) { ?>
				<div class="topnav-right">
					<a href="../login.php">Logout</a>
				</div>
		<?php } else { ?>
			<a href="about-us.php">About Us</a>
			<a href="faq.php">FAQ</a>
			<?php if (isset($_GET['register'])) { ?>
				<div class="topnav-right">
					<a href="../login.php">Login</a>
				</div>
			<?php } else { ?>
				<div class="topnav-right">
					<a href="customer/registration.php?register=true">Signup</a>
				</div>
			<?php } ?>
		<?php } ?>
	</div>
</head>
