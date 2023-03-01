<?php
require('../dbm.php');
$dbconn = new DatabaseManager;
$dbconn->connect();
if (isset($_POST['flight-add'])) {
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];
    $departure_date = $_POST['dep-date'];
    $departure_time = $_POST['dep-time'];
    $arrival_date = $_POST['arr-date'];
    $arrival_time = $_POST['arr-time'];
    $airplane = $_POST['airplane'];
    $price = $_POST['flight-price'];

    $flight_departure = date('Y-m-d H:i', strtotime("$departure_date $departure_time"));
    $flight_arrival = date('Y-m-d H:i', strtotime("$arrival_date $arrival_time"));;
    $date1 = strtotime($flight_departure);
    $date2 = strtotime($flight_arrival);
    $duration = ($date2-$date1)/(60*60);

    $sql = "INSERT INTO `Flight` (`Flight_From`, `Flight_To`, `Flight_Departure_Date`, `Flight_Departure_Time`, `Flight_Arrival_Date`, `Flight_Arrival_Time`, `Flight_Airplane`, `Flight_Duration`, `Flight_Price`, `Last_Seat`, `Flight_Status`) 
            VALUES ('$origin', '$destination', '$departure_date', '$departure_time', '$arrival_date', '$arrival_time', '$airplane', '$duration', '$price', '0', 'Pending')";

    $dbconn->query($sql);
    $url = "http://localhost/airexpress/admin/manage-flight.php";
    header("Location: $url");
}
?>