<?php
session_start();
$RoleUniqueID = $_SESSION['fdStripID'];
require("include/connection.php");

// Your PHP code here
$query = "SELECT * FROM tbCustomerMaster WHERE fdCustomerID = '2'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Manufacturer Query Error: " . mysqli_error($conn));
}

$data = array();
$prevHash = ''; // Initialize previous hash

while ($rows = mysqli_fetch_assoc($result)) {
    $fdMedicineID = $rows['fdMedicineID'];
    $fdCartonID = $rows['fdCartonID'];
    $fdPacketID = $rows['fdPacketID'];
    $fdStripID = $rows['fdStripID'];
    $fdManufacturerID = $rows['fdManufacturerID'];
    $fdStockistID = $rows['fdStockistID'];
    $fdDistributorID = $rows['fdDistributorID'];
    $fdDealerID = $rows['fdDealerID'];
    $fdRetailerID = $rows['fdRetailerID'];
    $fdCustomerID = $rows['fdCustomerID'];


    $prevHashQuery = "SELECT fdBlockchainRecordID FROM tbCustomerScanlog WHERE fdMedicineID = '$fdMedicineID' AND fdCartonID = '$fdCartonID' AND fdPacketID = '$fdPacketID' AND fdStripID = '$fdStripID' AND fdManufacturerID = '$fdManufacturerID' AND fdStockistID = '$fdStockistID' AND fdDistributorID = '$fdDistributorID' AND fdDealerID = '$fdDealerID' AND fdRetailerID = '$fdRetailerID' AND fdCustomerID = '$fdCustomerID' ORDER BY fdSlNo DESC LIMIT 1";
    $prevHashResult = mysqli_query($conn, $prevHashQuery);
    $prevHashRow = mysqli_fetch_assoc($prevHashResult);
    $prevHash = $prevHashRow['fdBlockchainRecordID'];

    // Concatenate each attribute within an entry with ","
    $entry = $fdMedicineID . ',' . $fdCartonID . ',' . $fdPacketID . ',' . $fdStripID . ',' . $fdManufacturerID;

    // Add each entry to the $data array, concatenating with the previous hash
    $data[] = $entry . ',' . $prevHash;
}

// Join all entries with "|" to create a single string
$dataString = implode('|', $data);

// Encode the $dataString as JSON
$jsonData = json_encode(array("data" => $dataString));
echo "JSON Data: " . $jsonData;

// Your API call here
$apiUrl = 'https://smartiot.mirachinnovations.com/MtsWebservice/index.php';
$context = stream_context_create(array(
    'http' => array(
        'method' => 'POST',
        'header' => "Content-Type: application/json\r\n" . "Content-Length: " . strlen($jsonData) . "\r\n",
        'content' => $jsonData
    )
));

// Send the request and get the response
$response = file_get_contents($apiUrl, false, $context);
echo "Raw API Response: " . $response . PHP_EOL;

// Decode the JSON response
$responseData = json_decode($response, true);

// Check for errors
if ($responseData === null && json_last_error() !== JSON_ERROR_NONE) {
    echo "Error decoding API response: " . json_last_error_msg();
} else {
    // Check if the API response contains the data field
    if (isset($responseData['data']) && $responseData['status'] == 200) {
        // Explode the data string into an array of hashes
        $hashes = explode('|', trim($responseData['data']));
        // echo $prevHash;
        // Insert each hash into the database
        // Your PHP code here
        $query = "SELECT * FROM tbCustomerMaster WHERE fdCustomerID ='2'";
        $result = mysqli_query($conn, $query);
        
        if (!$result) {
            die("Manufacturer Query Error: " . mysqli_error($conn));
        }
        while ($rows = mysqli_fetch_assoc($result)) {
        $fdMedicineID = $rows['fdMedicineID'];
        $fdCartonID = $rows['fdCartonID'];
        $fdPacketID = $rows['fdPacketID'];
        $fdStripID = $rows['fdStripID'];
        $fdManufacturerID = $rows['fdManufacturerID'];
        $fdStockistID = $rows['fdStockistID'];
    $fdDistributorID = $rows['fdDistributorID'];
    $fdDealerID = $rows['fdDealerID'];
    $fdRetailerID = $rows['fdRetailerID'];
    $fdCustomerID = $rows['fdCustomerID'];
        // $fdManufacturerID = $rows['fdManufacturerID'];
        // $fdManufacturerID = $rows['fdManufacturerID'];
        // $fdManufacturerID = $rows['fdManufacturerID'];
    
    
        // Get the previous hash from the database
        $prevHashQuery = "SELECT fdBlockchainRecordID FROM tbCustomerScanlog WHERE fdMedicineID = '$fdMedicineID' AND fdCartonID = '$fdCartonID' AND fdPacketID = '$fdPacketID' AND fdStripID = '$fdStripID' AND fdManufacturerID = '$fdManufacturerID' AND fdStockistID = '$fdStockistID' AND fdDistributorID = '$fdDistributorID' AND fdDealerID = '$fdDealerID' AND fdRetailerID = '$fdRetailerID' AND fdCustomerID = '$fdCustomerID' ORDER BY fdSlNo DESC LIMIT 1";
        $prevHashResult = mysqli_query($conn, $prevHashQuery);
        $prevHashRow = mysqli_fetch_assoc($prevHashResult);
        $prevHash = $prevHashRow['fdBlockchainRecordID'];



    $currentHash = array_shift($hashes);
            $sql = "INSERT INTO tbCustomerScanlog (fdMedicineID, fdManufacturerID, fdBlockchainRecordID, fdStripID, fdPacketID, fdCartonID)
                    VALUES ('$fdMedicineID', '$fdManufacturerID', '$currentHash','$fdStripID', '$fdPacketID', '$fdCartonID')";

            if ($conn->query($sql) !== TRUE) {
                echo "Error inserting data into the database: " . $conn->error;
            }else{
        
        // Get the last inserted fdSlNo from the tbScanlog table
        $lastSlNo = $conn->insert_id;

        // Insert data into the tbBlockchainRecord table
        $sqlBlockchain = "INSERT INTO tbBlockchainRecord (fdScanlogID, fdCartonID, fdPacketID, fdStripID, fdPrevHash, fdCurHash)
                VALUES ('$lastSlNo','$fdCartonID', '$fdPacketID', '$fdStripID', '$prevHash', '$currentHash')";

        if ($conn->query($sqlBlockchain) !== TRUE) {
            echo "Error inserting data into the tbBlockchainRecord table: " . $conn->error;
        } else {
            echo "Database insertion successful";
        }
        }}  
    } else {
        echo "Error: Invalid API response or hash not present";
    }
}
?>