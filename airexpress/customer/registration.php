<!DOCTYPE html>
<html>

<head lang="en">
	<meta charset="utf-8">
	<title>Registration</title>
	<link rel="stylesheet" href="../stylesheet.css">
</head>

<body class="home-body">
    <?php include 'header.php' ?>
    
    <form method="POST" action="registration-process.php">
        <caption><h2>New User Registration</h2>
            <fieldset>
            <legend><img src="../images/personalDetailsIcon.png"></legend>
            <table>
                <caption>Personal Details</caption>
                <tbody>
                    <tr>
                        <td><label>Name:</label></td>
                        <td><input type="text" name="cs_name" placeholder="Full name as per travel document" pattern="^[a-zA-Z0-9 ]*+$" title="No special characters allowed" maxlength="50" required></td>
                    </tr>
                    <tr>
                        <td><label>Country Code:</label></td>
                        <td>
                            <select id="country-code" name="country-code">
                                <option value="+61">+60 (Malasyia)</option>
                                <option value="+1">+1 (United States)</option>
                                <option value="+44">+44 (United Kingdom)</option>
                                <option value="+61">+61 (Australia)</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Phone Number:</label></td>
                        <td><input  id="phone-number" name="phone-number" type="tel" placeholder="Eg. 145578985" required></td>
                    </tr>
                    <tr>
                        <td><label>Email:</label></td>
                        <td><input type="email" name="cs_email" placeholder="Eg. smith.john@gmail.com" required></td>
                    </tr>
                    <tr>
                        <td><label>Password:</label></td>
                        <td><input type="password" name="cs_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title=" The password must contain at least one number, one uppercase, one lowercase letter, and at least 8 or more characters" required></td>
                    </tr>
                    <tr>
                        <td><label>Gender:</label></td>
                        <td>
                            <input required  type="radio" name="gender" value="M">Male
                            <input  required  type="radio" name="gender" value="F">Female
                        </td>
                    </tr>
                    <tr>
                        <td><label>Date of Birth:</label></td>
                        <td><input type="date" name="cs_dob" required></td>
                    </tr>
                    <tr>
                        <td><label>Nationality:</label></td>
                        <td>
                            <select id="countries-list" name="cs-country">
                                <option value="American">United States</option>
                                <option value="Egyptian">Egypt</option>
                                <option value="Canadian">Canada</option>
                                <option value="Australian">Australia</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Occupation:</label></td>
                        <td>
                            <select required id="occupation" name="cs_occupation">
                                <option value="student">Student</option>
                                <option value="employed">Employed</option>
                                <option value="unemployed">Unemployed</option>
                            </select>
                        </td>
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
                        <td>
                            <select required id="type" name="document_type">
                                <option value="0">Select</option>
                                <option value="Passport">Passport</option>
                                <option value="National ID">National ID</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Travel document number:</label></td>
                        <td><input required type="text" name="document_number"></td>
                    </tr>
                    <tr>
                        <td><label>Travel document issuance country:</label></td>
                        <td>
                            <select required id="countries-list" name="issuance_country">
                                <option value="United States">United States</option>
                                <option value="Egypt">Egypt</option>
                                <option value="Canada">Canada</option>
                                <option value="Australia">Australia</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Travel document expiry date:</label></td>
                        <td><input required type="date" name="expiry_date"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </fieldset>

        <div>
            <input class="submitButton" type="submit" value="Register">
        </div>
        </form>
        <?php
        $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if (strpos($fullUrl, "credentials=Invalidemailandtraveldocumentnumber") == true) {
            echo '<script>window.alert("The entered email address and travel document are already linked to an existing account!\nPlease try log in instead or contact support for help");</script>';
        }
        elseif (strpos($fullUrl, "credentials=Invalidemail") == true) {
            echo '<script>window.alert("The entered email address is already linked to an existing account!\nPlease try log in instead or contact support for help");</script>';
        }
        elseif (strpos($fullUrl, "credentials=Invalidtraveldocumentnumber") == true ) {
            echo '<script>window.alert("The entered travel document is already linked to an existing account!\nPlease contact support for help");</script>';
        }
        ?>

    </div>

</body>
<?php include('customer-footer.php') ?>
</html>