<?php

require('../dbm.php');
$dbconn = new DatabaseManager;
$dbconn->connect();

$tableName1 = 'Customer';
$tableName2 = 'Travel_Document';
$currentDate = new DateTime();

$cs_name = $_POST['cs_name'];
$cs_phone_number = $_POST['country-code'].$_POST['phone-number'];
$cs_email = $_POST['cs_email'];
$cs_password = $_POST['cs_password'];
$cs_gender = (($_POST['gender'] == 'M') ? 'Male' : 'Female');
$cs_dob = $_POST['cs_dob'];
$cs_age = ($currentDate->diff(new DateTime($cs_dob)))->y;
$cs_occupation = $_POST['cs_occupation'];
$cs_nationality = $_POST['cs-country'];

$travel_document_type = $_POST['document_type'];
$travel_document_number = $_POST['document_number'];
$travel_document_expiry = $_POST['expiry_date'];
$travel_document_country = $_POST['issuance_country'];

$sql = "SELECT * FROM Customer WHERE Customer_Email = '$cs_email'";
$result1 = $dbconn->query($sql);

$sql = "SELECT * FROM Travel_Document WHERE Travel_Document_Number = '$travel_document_number'";
$result2 = $dbconn->query($sql);

if ($result1->num_rows != 0 && $result2->num_rows != 0) {
        $url = "http://localhost:8080/airexpress/customer/registration.php?credentials=Invalidemailandtraveldocumentnumber";
        header("Location: $url");
}
elseif ($result1->num_rows != 0) {
        $url = "http://localhost:8080/airexpress/customer/registration.php?credentials=Invalidemail";
        header("Location: $url");
}
elseif ($result2->num_rows != 0) {
        $url = "http://localhost:8080/airexpress/customer/registration.php?credentials=Invalidtraveldocumentnumber";
        header("Location: $url");
}
else {
        $sql = "INSERT INTO $tableName2 (Travel_Document_Type, Travel_Document_ExpiryDate, Travel_Document_Number, Travel_Document_Country)
                VALUES ('$travel_document_type', '$travel_document_expiry', '$travel_document_number', '$travel_document_country')";
        $dbconn->query($sql);

        $sql = "INSERT INTO $tableName1 (Customer_Name, Customer_Phone_Number, Customer_Email, Customer_Password, Customer_Gender, Customer_DOB, Customer_Occupation, Customer_Nationality, Travel_Document_Number)
                VALUES ('$cs_name', '$cs_phone_number', '$cs_email', '$cs_password', '$cs_gender', '$cs_dob', '$cs_occupation', '$cs_nationality', '$travel_document_number')";
        $dbconn->query($sql);

        $url = "http://localhost:8080/airexpress/login.php";
        header("Location: $url");
}

?>