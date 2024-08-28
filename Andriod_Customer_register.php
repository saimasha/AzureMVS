<?php
require("include/connection.php");

error_log("Received data: " . print_r($_POST, true));
error_log("Response sent: " . $response);

// Retrieve user input from POST request
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$password = $_POST['password'];
$phoneNumber = $_POST['phoneNumber'];

// Prepare SQL statement
$sql = "INSERT INTO tbCustomerMaster (fdUserFName, fdUserLName, fdEmailAsUserID, fdPassword, fdPhoneNumber) 
        VALUES ('$firstName', '$lastName', '$email', '$password', '$phoneNumber')";

// Execute SQL statement
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
// Log the received data from the Android app

// Process the registration data

// Log the response sent back to the Android app

// Close connection
$conn->close();
?>

