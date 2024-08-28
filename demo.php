<?php

// Replace these variables with your actual database connection details
$servername = "185.224.138.37";
$username = "u505822356_usrMTSDev";
$password = "MTSDev@13579$";
$dbname = "u505822356_dbMTSDev";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the JSON data from the request body
$data = json_decode(file_get_contents('php://input'), true);

// Assuming you have a table named 'your_table_name'
$tableName = 'tbScanlog';

// Assuming your table has columns 'contactPerson', 'productName', 'orderNumber', 'quantity', 'unitPrice'
$contactPerson = $data['contactPerson'];
$productName = $data['productName'];
$orderNumber = $data['orderNumber'];
$quantity = $data['quantity'];
$unitPrice = $data['unitPrice'];

// Insert data into the database
$sql = "INSERT INTO $tableName (fdCustomerID, fdManufacturerID, fdStockistID, fdDistributorID, fdDealerID)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $contactPerson, $productName, $orderNumber, $quantity, $unitPrice);

$response = [];

if ($stmt->execute()) {
    $response = [
        'status' => 'success',
        'message' => 'Data inserted successfully!',
        'data' => $data, // Include the received data in the output
    ];
} else {
    $response = [
        'status' => 'error',
        'message' => 'Error inserting data: ' . $stmt->error,
    ];
}

// Close the statement and the database connection
$stmt->close();
$conn->close();

// Convert the response to JSON and echo it
echo json_encode($response);

?>
