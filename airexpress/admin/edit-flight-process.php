<?php
require('../dbm.php');
$dbconn = new DatabaseManager;
$dbconn->connect();
if (isset($_POST['flight-edit'])) {
    $flight_number = $_POST['flight-number'];
    $departure_date = $_POST['dep-date'];
    $departure_time = $_POST['dep-time'];
    $arrival_date = $_POST['arr-date'];
    $arrival_time = $_POST['arr-time'];
    $flight_status = $_POST['fl-status'];

    $flight_departure = date('Y-m-d H:i', strtotime("$departure_date $departure_time"));
    $flight_arrival = date('Y-m-d H:i', strtotime("$arrival_date $arrival_time"));;
    $date1 = strtotime($flight_departure);
    $date2 = strtotime($flight_arrival);
    $duration = ($date2-$date1)/(60*60);

    $sql = "UPDATE Flight
            SET Flight_Departure_Date = '$departure_date',
            Flight_Arrival_Date = '$arrival_date',
            Flight_Departure_Time = '$departure_time',
            Flight_Arrival_Time = '$arrival_time',
            Flight_Duration = '$duration',
            Flight_Status = '$flight_status'
            WHERE Flight_Number = '$flight_number'";
    $dbconn->query($sql);

    $url = "http://localhost/airexpress/admin/manage-flight.php";
    header("Location: $url");
}
?>