<?php
session_start();
?>
<!DOCTYPE html>
<html>
<?php 
require('../dbm.php');
$dbconn = new DatabaseManager;
$dbconn->connect();
$customer = $_SESSION['user-email'];
function getCustomerDetails($cs_email, $dbconn) {
    $sql = "SELECT * FROM Customer WHERE Customer_Email = '$cs_email'";
    $result = $dbconn->query($sql);
    return $result->fetch_row();
}
function getCustomerTravelDocument($cs_travel_document_number, $dbconn) {
    $sql = "SELECT * FROM Travel_Document WHERE Travel_Document_Number = '$cs_travel_document_number'";
    $result = $dbconn->query($sql);
    return $result->fetch_row();
}
?>
<head lang="en">
	<meta charset="utf-8">
	<title>My Profile</title>
	<link rel="stylesheet" href="../stylesheet.css">
</head>

<body class="home-body">
    <?php
    include 'header.php';
    $customer_details = getCustomerDetails($customer, $dbconn);
    $travel_document = getCustomerTravelDocument($customer_details[8], $dbconn);
    ?>
    <script>
        function stateToEdit(field_name, button) {
            document.getElementById(field_name).setAttribute("required", "");
            document.getElementById(field_name).removeAttribute("readonly");
            document.getElementById(button).value = "Save";
            document.getElementById(button).onclick = function() {stateToRead(field_name, button)};
        }
        function stateToRead(field_name, button) {
            document.getElementById(field_name).setAttribute("readonly", "");
            document.getElementById(field_name).removeAttribute("required");
            document.getElementById(button).value = "Edit";
            document.getElementById(button).onclick = function() {stateToEdit(field_name, button)};
        }
        function editTravelDocument() {
            document.getElementById("doc-type").removeAttribute("readonly");
            document.getElementById("doc-type").setAttribute("required", "");
            document.getElementById("doc-number").removeAttribute("readonly");
            document.getElementById("doc-number").setAttribute("required", "");
            document.getElementById("doc-country").removeAttribute("readonly");
            document.getElementById("doc-country").setAttribute("required", "");
            document.getElementById("doc-expiry").removeAttribute("readonly");
            document.getElementById("doc-expiry").setAttribute("required", "");
            document.getElementById("edit-doc").value = "Save";
            document.getElementById("edit-doc").onclick = function() {saveTravelDocument()};
        }
        function saveTravelDocument() {
            document.getElementById("doc-type").setAttribute("readonly", "");
            document.getElementById("doc-type").removeAttribute("required");
            document.getElementById("doc-number").setAttribute("readonly", "");
            document.getElementById("doc-number").removeAttribute("required");
            document.getElementById("doc-country").setAttribute("readonly", "");
            document.getElementById("doc-country").removeAttribute("required");
            document.getElementById("doc-expiry").setAttribute("readonly", "");
            document.getElementById("doc-expiry").removeAttribute("required");
            document.getElementById("edit-doc").value = "Edit Travel Document Detials";
            document.getElementById("edit-doc").onclick = function() {editTravelDocument()};
        }
    </script>
    <form method="POST" action="manage-profile-process.php">
        <caption><h2>My Profile</h2>
            <fieldset>
            <legend><img src="../images/personalDetailsIcon.png"></legend>
            <table>
                <caption>Personal Details</caption>
                <tbody>
                    <tr>
                        <td><label>Name: </label></td>
                        <td><input readonly type="text" id="cs-name" name="cs_name" value="<?php echo $customer_details[0] ?>" pattern="^[a-zA-Z0-9 ]*+$" title="No special characters allowed" maxlength="50"></td>
                        <td><input type="button" style="width: fit-content;" id="edit-name" value="Edit" onclick="stateToEdit('cs-name', 'edit-name')">
                    </tr>
                    <tr>
                        <td><label>Phone Number: </label></td>
                        <td><input readonly id="phone-number" name="phone-number" type="tel" value="<?php echo $customer_details[1] ?>"></td>
                        <td><input type="button" style="width: fit-content;" id="edit-phone" value="Edit" onclick="stateToEdit('phone-number', 'edit-phone')">
                    </tr>
                    <tr>
                        <td><label>Email:</label></td>
                        <td><input readonly type="email" id="cs-email" name="cs_email" value="<?php echo $customer_details[2] ?>"></td>
                        <td><input type="button" style="width: fit-content;" id="edit-email" value="Edit" onclick="stateToEdit('cs-email', 'edit-email')">
                    </tr>
                    <tr>
                        <td><label>Password:</label></td>
                        <td><input readonly type="password" id="cs_password" name="cs_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title=" The password must contain at least one number, one uppercase, one lowercase letter, and at least 8 or more characters" value="<?php echo $customer_details[3] ?>"></td>
                        <td><input type="button" style="width: fit-content;" id="edit-password" value="Edit" onclick="stateToEdit('cs-password', 'edit-password')">
                    </tr>
                    <tr>
                        <td><label>Date of Birth:</label></td>
                        <td><input readonly type="date" id="cs-dob" name="cs_dob" value="<?php echo $customer_details[5] ?>"></td>
                        <td><input type="button" style="width: fit-content;" id="edit-dob" value="Edit" onclick="stateToEdit('cs-dob', 'edit-dob')">
                    </tr>
                    <tr>
                        <td><label>Nationality:</label></td>
                        <td><input readonly type="text" id="cs-country" name="cs_country" value="<?php echo $customer_details[7] ?>"></td>
                        <td><input type="button" style="width: fit-content;" id="edit-country" value="Edit" onclick="stateToEdit('cs-country', 'edit-country')">
                    </tr>
                    <tr>
                        <td><label>Occupation:</label></td>
                        <td><input readonly type="text" id="cs-occp" name="cs_occupation" value="<?php echo $customer_details[6] ?>"></td>
                        <td><input type="button" style="width: fit-content;" id="edit-occp" value="Edit" onclick="stateToEdit('cs-occp', 'edit-occp')">
                    </tr>
                </tbody>
            </table>
        </fieldset>
        
        <fieldset>
            <legend><img src="../images/travelDocumentIcon.png"></legend>
            <table>
                <caption>Travel Document</caption>
                <tbody>
                    <tr>
                        <td><label>Travel document type:</label></td>
                        <td><input readonly type="text" id="doc-type" name="document_type" value="<?php echo $travel_document[0] ?>"></td>
                    </tr>
                    <tr>
                        <td><label>Travel document number:</label></td>
                        <td><input readonly id="doc-number" type="text" name="document_number" value="<?php echo $travel_document[2] ?>"></td>
                    </tr>
                    <tr>
                        <td><label>Travel document issuance country:</label></td>
                        <td><input readonly type="text" id="doc-country" name="issuance_country" value="<?php echo $travel_document[3] ?>"></td>
                    </tr>
                    <tr>
                        <td><label>Travel document expiry date:</label></td>
                        <td><input readonly id="doc-expiry" type="date" name="expiry_date" value="<?php echo $travel_document[1] ?>"></td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
        <input type="button" id="edit-doc" name="doc-edit" style="width: fit-content;" value="Edit Travel Document Detials" onclick="editTravelDocument()">
        <div>
            <input class="submitButton" type="submit" value="Save">
        </div>
        </form>
        <?php
        $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if (strpos($fullUrl, "credentials=Invalidemail") == true) {
            echo '<script>window.alert("The entered email address is already linked to an existing account!\nPlease use different email");</script>';
        }
        elseif (strpos($fullUrl, "credentials=Invalidtraveldocumentnumber") == true ) {
            echo '<script>window.alert("The entered travel document is already linked to an existing account!\nPlease contact support for help\n");</script>';
        }
        ?>

    </div>

</body>
<?php include('customer-footer.php') ?>
</html>