<?php
session_start();
include "include/connection.php";

// Check for POST parameters
if (isset($_POST['packageType']) && isset($_POST['apiUrl'])) {
    $packageType = $_POST['packageType'];
    $apiUrl = $_POST['apiUrl'];
    $manufacturerID = $_SESSION['fdRoleUniqueID'];

    switch ($packageType) {
        case 'Carton':
            generateQRCodeAndUpdate($conn, 'tbCarton', 'fdCartonID', $apiUrl, 'Carton', $manufacturerID);
            break;
        default:
            // Handle invalid package type
            echo "Invalid package type";
            break;
    }
}

// Function to call API
function fnCallApi($varQRData){
    $apiUrl = 'https://smartiot.mirachinnovations.com/MtsWebservice/QR/qrencrypt.php';
    $jsonData = json_encode(array("data" => $varQRData));
    $context = stream_context_create(array(
        'http' => array(
            'method' => 'POST',
            'header' => "Content-Type: application/json\r\n" . "Content-Length: " . strlen($jsonData) . "\r\n",
            'content' => $jsonData
        )
    ));
    $response = file_get_contents($apiUrl, false, $context);
    $responseData = json_decode($response, true);

    if ($responseData === null && json_last_error() !== JSON_ERROR_NONE) {
        echo "Error decoding API response: " . json_last_error_msg();
    } else {
        if (isset($responseData['data']) && $responseData['status'] == 200) {
            $encrypt = $responseData['data'];
            $_SESSION['qr_data'] = $encrypt;
            return $encrypt;
        } else {
            echo "Error: Invalid API response or hash not present";
        }
    }
}

function fnUpdateCartonQRCode($conn, $fdManufacturerID, $fdCartonID, $fdQRCode, $secretkey, $resultApi) {
    // Update tbCarton
    $updateQueryCarton = "UPDATE tbCarton SET fdQRCode = '$fdQRCode', fdSecretKey = '$secretkey', fdEncryptQRCode = '$resultApi', fdQRCodeCreated = 1 WHERE fdManufacturerID = '$fdManufacturerID' AND fdCartonID = '$fdCartonID'";
    $updateResultCarton = mysqli_query($conn, $updateQueryCarton);

    if ($updateResultCarton) {
        return "Carton QR codes updated successfully for Carton ID: $fdCartonID.";
    } else {
        return "Error updating QR codes for Carton ID: $fdCartonID. " . mysqli_error($conn);
    }
}

function generateQRCodeAndUpdate($conn, $table, $field, $apiUrl, $packagetype, $manufacturerID) {
    // Fetch package details
    if ($packagetype == "Carton") {
        $query = "SELECT * FROM $table WHERE fdManufacturerID = '$manufacturerID'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query Error: " . mysqli_error($conn));
        }

        $cartonDetails = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $medicineID = $row['fdMedicineID'];
            $cartonId = $row['fdCartonID'];
            $medicineTypeQuery = "SELECT fdMedicineType FROM tbMedicineMaster WHERE fdMedicineID = '$medicineID'";
            $medicineTypeResult = mysqli_query($conn, $medicineTypeQuery);

            if (!$medicineTypeResult) {
                die("Medicine Type Query Error: " . mysqli_error($conn));
            }

            $medicineTypeRow = mysqli_fetch_assoc($medicineTypeResult);
            if (isset($medicineTypeRow['fdMedicineType'])) {
                $medicineType = $medicineTypeRow['fdMedicineType'];
            }

            $MedicineExpiryDateQuery = "SELECT fdExpiryDate FROM tbMedicineStripTest WHERE fdCartonID = '$cartonId'";
            $stripTestResult = mysqli_query($conn, $MedicineExpiryDateQuery);
            $MedicineExpiryDate = "";
            if ($stripTestResult) {
                $stripTestRow = mysqli_fetch_assoc($stripTestResult);
                $MedicineExpiryDate = $stripTestRow['fdExpiryDate'];
            }

            // Store carton details in the array
            $cartonDetails[] = [
                'ManufacturerID' => $row['fdManufacturerID'],
                'MedicineID' => $medicineID,
                'PackageType' => 'Carton',
                'PackageID' => $cartonId,
                'MedicineType' => $medicineType,
                'MedicineBatchID' => $row['fdBatchID'],
                'MedicineExpiryDate' => $MedicineExpiryDate,
                'Countryoforigin' => 'India'
            ];
        }

        // Process each carton individually
        foreach ($cartonDetails as $detail) {
            $details1 = implode('|', array_values($detail));
            $resultApi = fnCallApi($details1);

            if ($resultApi !== null) {
                $secretkeys = substr($resultApi, 0, 6);
                $updateMessage = fnUpdateCartonQRCode($conn, $detail['ManufacturerID'], $detail['PackageID'], $details1, $secretkeys, $resultApi);
                echo $updateMessage; // Print update message for debugging
            } else {
                echo "Failed to generate QR code for Carton ID: " . $detail['PackageID'];
            }
        }
    }
}
?>


