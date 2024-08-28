<?php
require("include/connection.php");
file_put_contents('received_data.log', print_r($_POST, true) . PHP_EOL, FILE_APPEND);
// Get the data sent from the Android app
$customer_id = $_POST['customer_id'];
$scanDetails = $_POST['scan_details'];

// Get the data sent from the Android app
// $customer_id = 23; // This should be retrieved from $_POST in a real application

// Decryption code start
// $scanDetails = "CI4UHRQ0k0VUhSICxUVTVHVWpFeU1qTXhPRGsxZkUxRlJEQXdNWHhUZEhKcGNId3lmRWRsYm1WeWFXTjhRbFJEU0RBd01Yd3lNREkwTFRBMUxUQXpmRWx1WkdsaA==";

// Check if scan_details exist in tbMedicineStripTest table
$stmt = $conn->prepare("SELECT COUNT(*) FROM tbMedicineStripTest WHERE fdEncryptQRCode = ?");
$stmt->bind_param("s", $scanDetails);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

if ($count == 0) {
    // scan_details do not exist in the table
    echo json_encode(array("status" => "error", "message" => "Scan details do not exist"));
    exit();
}

// API endpoint URL
$apiUrl = 'https://schedarcloud.com/api/qrdecrypt.php';

// Data to send in JSON format
$data = array(
    "data" => $scanDetails
);

// Convert the data to JSON format
$jsonData = json_encode($data);

// Create a stream context with the request headers
$context = stream_context_create(array(
    'http' => array(
        'method' => 'POST',
        'header' => "Content-Type: application/json\r\n" .
                    "Content-Length: " . strlen($jsonData) . "\r\n",
        'content' => $jsonData
    )
));

// Send the request and get the response
$response = file_get_contents($apiUrl, false, $context);

// Check for errors
if ($response === false) {    
    $error = error_get_last();
    echo json_encode(array("status" => "error", "message" => "Request Error: " . $error['message']));
    exit;
} else {
    // Decode the JSON response
    $responseData = json_decode($response, true);
    $decrptyvalue = $responseData['data'][0];
    // Check if decryption was successful
    if ($responseData['status'] == 200) {
        // Display the decrypted data
        "Decrypted Data: " . $responseData['data'][0];
    } else {
        // Display the status message if decryption failed
        echo json_encode(array("status" => "error", "message" => "Decryption Error: " . $responseData['status_message']));
        exit;
    }
}

// Decryption code end
// Split scan details into individual components
$details = explode("|", $decrptyvalue);
$TrxnOwnerId = $details[0];
$medicineId = $details[1];
$packagetype = $details[2];
$packetId = $details[3];
$medicinetype = $details[4];
$BatchId = $details[5];
$scandate = $details[6];
$countryoforigin = $details[7];

// Get the previous hash from the database
$prevHashQuery = "SELECT fdPrevHash FROM tbBlockchainRecord WHERE fdStripID = '$packetId' AND fdTrxnType = 'MNFROUT'";
$prevHashResult = mysqli_query($conn, $prevHashQuery);
$prevHashRow = mysqli_fetch_assoc($prevHashResult);
$prevHash = $prevHashRow['fdPrevHash'];

// Get the previous hash from the database
$packcartQuery = "SELECT `fdPacketID`,`fdCartonID` FROM tbMedicineStripTest WHERE fdManufacturerID = '$TrxnOwnerId' AND `fdStripID` = '$packetId'";
$packcartResult = mysqli_query($conn, $packcartQuery);
$packcartRow = mysqli_fetch_assoc($packcartResult);
$fdPacketID = $packcartRow['fdPacketID'];
$fdCartonID = $packcartRow['fdCartonID'];

// Generate a unique hash for the strip without timestamp
$stripDataStringWithoutTimestamp = "$TrxnOwnerId,$medicineId,$packagetype,$packetId,$medicinetype,$BatchId,$scandate,$fdCartonID,$fdPacketID,$prevHash";
$stripJsonDataWithoutTimestamp = json_encode(array("data" => $stripDataStringWithoutTimestamp));
$stripHashWithoutTimestamp = generateHash($stripJsonDataWithoutTimestamp);

// Check if the user has already performed hash in or hash out action for the same package
$existingRecordQuery = "SELECT fdCurHash FROM tbBlockchainRecord WHERE fdStripID = '$packetId' AND fdTrxnType = 'MNFROUT'";
$existingRecordResult = mysqli_query($conn, $existingRecordQuery);
$existingRecordRow = mysqli_fetch_assoc($existingRecordResult);
$existingRecordHash = $existingRecordRow['fdCurHash'];

$status = ($existingRecordHash === $stripHashWithoutTimestamp) ? 'Verified' : 'Refute';

// Log the scan details
$sqlStripWithTimestamp = "INSERT INTO tbCustomerScanlog (fdCustomerID, fdScanDate, fdMedicineID, fdStripID, fdBlockchainRecordID, fdStatus)
                         VALUES ('$customer_id', NOW(), '$medicineId', '$packetId', '$stripHashWithoutTimestamp', '$status')";

if ($conn->query($sqlStripWithTimestamp) !== TRUE) {
    echo json_encode(array("status" => "error", "message" => "Failed to log scan details"));
    exit();
}

// Query to count the total number of scans by this user
$userScanCountQuery = "SELECT COUNT(*) AS user_scan_count FROM tbCustomerScanlog WHERE fdCustomerID = '$customer_id' AND fdStripID = '$packetId'";
$userScanCountResult = mysqli_query($conn, $userScanCountQuery);
$userScanCountRow = mysqli_fetch_assoc($userScanCountResult);
$userScanCount = $userScanCountRow['user_scan_count'];

// Query to count the total number of scans by all users for this StripID
$totalScanCountQuery = "SELECT COUNT(*) AS total_scan_count FROM tbCustomerScanlog WHERE fdStripID = '$packetId'";
$totalScanCountResult = mysqli_query($conn, $totalScanCountQuery);
$totalScanCountRow = mysqli_fetch_assoc($totalScanCountResult);
$totalScanCount = $totalScanCountRow['total_scan_count'];

// Return the response including the scan counts
echo json_encode(array(
    "status" => "success",
    "message" => "Scan details logged successfully",
    "verification_status" => $status,
    "user_scan_count" => $userScanCount,
    "Customer_id" => $customer_id,
    "total_scan_count" => $totalScanCount
));

function generateHash($jsonData) {
    $apiUrl = 'https://schedarcloud.com/api/index.php';
    $context = stream_context_create(array(
        'http' => array(
            'method' => 'POST',
            'header' => "Content-Type: application/json\r\n" . "Content-Length: " . strlen($jsonData) . "\r\n",
            'content' => $jsonData
        )
    ));

    $response = file_get_contents($apiUrl, false, $context);
    $responseData = json_decode($response, true);

    if ($responseData && isset($responseData['status']) && $responseData['status'] == 200 && isset($responseData['data'])) {
        return $responseData['data'];
    } else {
        return "Error: Invalid API response";
    }
}
?>
