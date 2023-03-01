<?php
session_start();
require('../dbm.php');
$dbconn = new DatabaseManager;
$dbconn->connect();

$cs_name = $_POST['cs_name'];
$cs_phone_number = $_POST['phone-number'];
$cs_email = $_POST['cs_email'];
$cs_password = $_POST['cs_password'];
$cs_dob = $_POST['cs_dob'];
$cs_occupation = $_POST['cs_occupation'];
$cs_nationality = $_POST['cs_country'];

$travel_document_type = $_POST['document_type'];
$travel_document_number = $_POST['document_number'];
$travel_document_expiry = $_POST['expiry_date'];
$travel_document_country = $_POST['issuance_country'];

function isUpdated($saved_detail, $new_detail) {
    return !($saved_detail === $new_detail);
}

$sql = "SELECT * FROM Customer WHERE Customer_Email = '{$_SESSION['user-email']}'";
$result = $dbconn->query($sql);
$row = $result->fetch_row();
$current_travel_document_number = $row[8];

if (isUpdated($travel_document_number, $current_travel_document_number)) {
    $sql = "SELECT * FROM Travel_Document WHERE Travel_Document_Number = '$travel_document_number'";
    $result = $dbconn->query($sql);

    if ($result->num_rows != 0) {
        $url = "http://localhost:8080/airexpress/customer/manage-profile.php?credentials=Invalidtraveldocumentnumber";
        header("Location: $url");
    }
}

$sql = "SELECT * FROM Travel_Document WHERE Travel_Document_Number = '$current_travel_document_number'";
$result = $dbconn->query($sql);
$row = $result->fetch_row();

if (isUpdated($travel_document_type, $row[0])) {
    $sql = "UPDATE Travel_Document SET Travel_Document_Type = '$travel_document_type' WHERE Travel_Document_Number = '$current_travel_document_number'";
    $dbconn->query($sql);
}
if (isUpdated($travel_document_expiry, $row[1])) {
    $sql = "UPDATE Travel_Document SET Travel_Document_ExpiryDate = '$travel_document_expiry' WHERE Travel_Document_Number = '$current_travel_document_number'";
    $dbconn->query($sql);
}
if (isUpdated($travel_document_country, $row[3])) {
    $sql = "UPDATE Travel_Document SET Travel_Document_Country = '$travel_document_country' WHERE Travel_Document_Number = '$current_travel_document_number'";
    $dbconn->query($sql);
}
if (isUpdated($travel_document_number, $row[2])) {
    $sql = "UPDATE Travel_Document SET Travel_Document_Number = '$travel_document_number' WHERE Travel_Document_Number = '$current_travel_document_number'";
    $dbconn->query($sql);
}

if (isUpdated($cs_email, $_SESSION['user-email'])) {
    $sql = "SELECT * FROM Customer WHERE Customer_Email = '$cs_email'";
    $result = $dbconn->query($sql);
    if ($result->num_rows != 0) {
        $url = "http://localhost:8080/airexpress/customer/manage-profile.php?credentials=Invalidemail";
        header("Location: $url");
    }
}

$sql = "SELECT * FROM Customer WHERE Customer_Email = '{$_SESSION['user-email']}'";
$result = $dbconn->query($sql);

while($row = $result->fetch_row()) {
    if (isUpdated($cs_name, $row[0])) {
        $sql = "UPDATE Customer SET Customer_Name = '$cs_name' WHERE Customer_Email = '{$_SESSION['user-email']}'";
        $dbconn->query($sql);
    }
    if (isUpdated($cs_phone_number, $row[1])) {
        $sql = "UPDATE Customer SET Customer_Phone_Number = '$cs_phone_number' WHERE Customer_Email = '{$_SESSION['user-email']}'";
        $dbconn->query($sql);
    }
    if (isUpdated($cs_password, $row[3])) {
        $sql = "UPDATE Customer SET Customer_Password = '$cs_password' WHERE Customer_Email = '{$_SESSION['user-email']}'";
        $dbconn->query($sql);
    }
    if (isUpdated($cs_dob, $row[5])) {
        $sql = "UPDATE Customer SET Customer_DOB = '$cs_dob' WHERE Customer_Email = '{$_SESSION['user-email']}'";
        $dbconn->query($sql);
    }
    if (isUpdated($cs_occupation, $row[6])) {
        $sql = "UPDATE Customer SET Customer_Occupation = '$cs_occupation' WHERE Customer_Email = '{$_SESSION['user-email']}'";
        $dbconn->query($sql);
    }
    if (isUpdated($cs_nationality, $row[7])) {
        $sql = "UPDATE Customer SET Customer_Nationality = '$cs_nationality' WHERE Customer_Email = '{$_SESSION['user-email']}'";
        $dbconn->query($sql);
    }
    if (isUpdated($travel_document_number, $current_travel_document_number)) {
        $sql = "UPDATE Customer SET Travel_Document_Number = '$travel_document_number' WHERE Customer_Email = '{$_SESSION['user-email']}'";
        $dbconn->query($sql);
    }
    if (isUpdated($cs_email, $row[2])) {
        $sql = "UPDATE Customer SET Customer_Email = '$cs_email' WHERE Customer_Email = '{$_SESSION['user-email']}'";
        $dbconn->query($sql);
    }
}

$url = "http://localhost:8080/airexpress/login.php";
header("Location: $url");

?>