<?php
session_start();
include "include/connection.php";

// Check for POST parameters
if (isset($_POST['packageType']) && isset($_POST['apiUrl'])) {
    $packageType = $_POST['packageType'];
    $apiUrl = $_POST['apiUrl'];
    $manufacturerID = $_SESSION['fdRoleUniqueID'];

    // for Strip Type 
   
    
    if ($packageType == "Strip") {
        $query = "SELECT fdManufacturerID,fdMedicineID,fdStripID,fdBatchID,fdExpiryDate FROM tbMedicineStripTest WHERE fdManufacturerID = '$manufacturerID' AND fdQRCodeCreated = 0 ";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query Error: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) == 0) {
            echo "All Strip QR codes are already generated.";
        } else {
            
            $stripDetails = [];
            while ($row = mysqli_fetch_assoc($result)) {

                $medicineID = $row['fdMedicineID'];
                $medicineTypeQuery = "SELECT fdMedicineType FROM tbMedicineMaster WHERE fdMedicineID = '$medicineID'";
                $medicineTypeResult = mysqli_query($conn, $medicineTypeQuery);

                $medicineTypeRow = mysqli_fetch_assoc($medicineTypeResult);
                if (isset($medicineTypeRow['fdMedicineType'])) {
                    $medicineType = $medicineTypeRow['fdMedicineType'];
                }

                $stripDetails[] = [
                    'ManufacturerID' => $row['fdManufacturerID'],
                    'MedicineID' => $medicineID,
                    'PackageType' => 'Strip',
                    'PackageID' => $row['fdStripID'],
                    'MedicineType' => $medicineType,
                    'MedicineBatchID' => $row['fdBatchID'],
                    'MedicineExpiryDate' => $row['fdExpiryDate'],
                    'Countryoforigin' => 'India'
                ];
            }

            // Process each strip individually
            foreach ($stripDetails as $detail) {
                $details1 = implode('|', array_values($detail));
                $resultApi = fnCallApi($details1, $apiUrl);

                if ($resultApi !== null) {
                    $secretkeys = substr($resultApi, 0, 6);
                    $updateMessage = fnUpdateStripQRCode($conn, $detail['ManufacturerID'], $detail['PackageID'], $details1, $secretkeys, $resultApi);
                    echo $updateMessage . "<br>"; 
                } else {
                    echo "Failed to generate QR code for strip ID: " . $detail['PackageID'] . "<br>";
                }
            }
        }
    }

    // for Packet Type

    if ($packageType == "Packet") {
        $query = "SELECT fdManufacturerID,fdMedicineID,fdPacketID,fdBatchID FROM tbPacket WHERE fdManufacturerID = '$manufacturerID' AND fdQRCodeCreated = 0 ";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query Error: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) == 0) {
            echo "All Packet QR codes are already generated.";
        } else {

            
        $PacketDetails = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $medicineID = $row['fdMedicineID'];
            $PacketID = $row['fdPacketID'];


            $medicineTypeQuery = "SELECT fdMedicineType FROM tbMedicineMaster WHERE fdMedicineID = '$medicineID'";
            $medicineTypeResult = mysqli_query($conn, $medicineTypeQuery);
            $medicineTypeRow = mysqli_fetch_assoc($medicineTypeResult);
            if (isset($medicineTypeRow['fdMedicineType'])) {
                $medicineType = $medicineTypeRow['fdMedicineType'];
            }

            $MedicineExpiryDateQuery = "SELECT fdExpiryDate FROM tbMedicineStripTest WHERE fdPacketID = '$PacketID'";
            $Result = mysqli_query($conn, $MedicineExpiryDateQuery);
            $MedicineExpiryDate = "";
            if ($Result) {
                $Row = mysqli_fetch_assoc($Result);
                $MedicineExpiryDate = $Row['fdExpiryDate'];
            }

            // Store carton details in the array
            $PacketDetails[] = [
                'ManufacturerID' => $row['fdManufacturerID'],
                'MedicineID' => $row['fdMedicineID'],
                'PackageType' => 'Packet',
                'PackageID' => $row['fdPacketID'],
                'MedicineType' => $medicineType,
                'MedicineBatchID' => $row['fdBatchID'],
                'MedicineExpiryDate' => $MedicineExpiryDate,
                'Countryoforigin' => 'India'
            ];
        }

        // Process each carton individually
        foreach ($PacketDetails as $detail) {
            $details1 = implode('|', array_values($detail));
            $resultApi = fnCallApi($details1);

            if ($resultApi !== null) {
                $secretkeys = substr($resultApi, 0, 6);
                $updateMessage = fnUpdatePacketQRCode($conn, $detail['ManufacturerID'], $detail['PackageID'], $details1, $secretkeys, $resultApi);
                echo $updateMessage; // Print update message for debugging
            } else {
                echo "Failed to generate QR code for Packet ID: " . $detail['PackageID'];
            }
        }
    }  
   }


//    for Carton Type
   if ($packageType == "Carton") {

    $query = "SELECT fdManufacturerID,fdMedicineID,fdCartonID,fdBatchID FROM tbCarton WHERE fdManufacturerID = '$manufacturerID' AND fdQRCodeCreated = 0 ";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query Error: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) == 0) {
        echo "All Carton QR codes are already generated.";
    } else {

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
        $Result = mysqli_query($conn, $MedicineExpiryDateQuery);
        $MedicineExpiryDate = "";
        if ($Result) {
            $Row = mysqli_fetch_assoc($Result);
            $MedicineExpiryDate = $Row['fdExpiryDate'];
        }

        // Store carton details in the array
        $cartonDetails[] = [
            'ManufacturerID' => $row['fdManufacturerID'],
            'MedicineID' => $row['fdMedicineID'],
            'PackageType' => 'Carton',
            'PackageID' => $row['fdCartonID'],
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
                echo $updateMessage; 
            } else {
                echo "Failed to generate QR code for Carton ID: " . $detail['PackageID'];
            }
        }
        }

    }


}


// Function to call API
function fnCallApi($varQRData){
    $apiUrl = 'https://schedarcloud.com/api/qrencrypt.php';
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


function fnUpdateStripQRCode($conn, $fdManufacturerID, $fdStripID, $fdQRCode, $secretkey, $resultApi) {
    // Update tbCarton
    $updateQueryStrip = "UPDATE tbMedicineStripTest SET fdQRCode = '$fdQRCode',fdSecretKey = '$secretkey', fdEncryptQRCode = '$resultApi', fdQRCodeCreated = 1 WHERE fdStripID = '$fdStripID' AND fdManufacturerID = '$fdManufacturerID' ";
    $updateResultStrip = mysqli_query($conn, $updateQueryStrip);


    if ($updateResultStrip) {
        return "Strip QR codes updated successfully for strip ID: $fdStripID.";
    } else {
        return "Error updating QR codes for Strip ID: $fdStripID. " . mysqli_error($conn);
    }
}

function fnUpdatePacketQRCode($conn, $fdManufacturerID, $fdPacketID, $fdQRCode, $secretkey, $resultApi) {
    // Update tbCarton
    $updateQueryPacket = "UPDATE tbPacket SET fdQRCode = '$fdQRCode', fdSecretKey = '$secretkey', fdEncryptQRCode = '$resultApi' ,fdQRCodeCreated = 1 WHERE fdManufacturerID = '$fdManufacturerID' AND fdPacketID = '$fdPacketID'";
    $updateResultPacket = mysqli_query($conn, $updateQueryPacket);

    if ($updateResultPacket) {
        return "Packet QR code updated successfully for Packet ID: $fdPacketID.";
    } else {
        return "Error updating QR codes for Packet ID: $fdPacketID. " . mysqli_error($conn);
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

?>