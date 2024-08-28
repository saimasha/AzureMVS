<?php
// Include your database connection and other necessary files here
include "include/connection.php";

if(isset($_POST['strip_id']) && isset($_POST['packageType']) && isset($_POST['apiUrl'])){
    $strip_id = $_POST['strip_id'];
    $packageType = $_POST['packageType'];
    $apiUrl = $_POST['apiUrl'];

    switch ($packageType) {
            case 'C':
                generateQRCodeAndUpdate($conn, $strip_id, 'tbMedicineStripTest', 'fdCartonID', $apiUrl, 'Carton');
                break;
            case 'P':
                generateQRCodeAndUpdate($conn, $strip_id, 'tbMedicineStripTest', 'fdPacketID', $apiUrl, 'Packet');
                break;
            case 'S':
                generateQRCodeAndUpdate($conn, $strip_id, 'tbMedicineStripTest', 'fdStripID', $apiUrl, 'Strip');
                break;
            default:
                // Handle invalid package type
                echo "Invalid package type";
                break;
        }
}



//function for calling Api
function fnCallApi($varQRData){
    include "include/connection.php";

    // Encode the modified details
    $apiUrl = 'https://schedarcloud.com/api/qrencrypt.php';

    // Encode the $varQRData as JSON
    $jsonData = json_encode(array("data" => $varQRData));
    
    // Make API call to generate QR code
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
        // Check if the API response contains the data field
        if (isset($responseData['data']) && $responseData['status'] == 200) {
            $encrypt = $responseData['data'];
            $_SESSION['qr_data'] = $encrypt;
            return $encrypt;
        } else {
            echo "Error: Invalid API response or hash not present";
        }
    }
}


 function fnUpdateCartonQRCode($fdManufacturerID,$fdMedicineID,$Packet,$packageID,$fdMedicineType,$fdBatchID,$fdExpiryDate,$Countryoforigin,$resultApi,$fdQRCode,$secretkey){
            include "include/connection.php";


        // Fetch fdPacketID and fdStripID from tbRelation
        // Update tbCarton
        $updateQueryCarton = "UPDATE tbCarton SET fdQRCode = '$fdQRCode', fdSecretKey = '$secretkey', fdEncryptQRCode = '$resultApi' ,fdQRCodeCreated = 1 WHERE fdCartonID = '$packageID'";
        $updateResultCarton = mysqli_query($conn, $updateQueryCarton);

        if ($updateResultCarton) {
            echo "Carton QR codes updated successfully.";
        } else {
            echo "Error updating QR codes: " . mysqli_error($conn);
        }

    
}
//function for updatePacketqrcode
      function fnUpdatePacketQRCode($fdManufacturerID,$fdMedicineID,$Packet,$packageID,$fdMedicineType,$fdBatchID,$fdExpiryDate,$Countryoforigin,$resultApi,$fdQRCode,$secretkey){
       include "include/connection.php";

        // Update tbPacket
          $updateQueryPacket = "UPDATE tbPacket SET fdQRCode = '$fdQRCode', fdSecretKey = '$secretkey', fdEncryptQRCode = '$resultApi' ,fdQRCodeCreated = 1 WHERE fdPacketID = '$packageID'";
        $updateResultPacket = mysqli_query($conn, $updateQueryPacket);
       
        if ($updateResultPacket) {
            echo "Packet QR code updated successfully.";
        } else {
            echo "Error updating Packet QR codes: " . mysqli_error($conn);
        }
           
       }
       
       
       //function for updateStripqrcode

       function fnUpdateStripQRCode($fdManufacturerID,$fdMedicineID,$Packet,$fdStripID,$fdMedicineType,$fdBatchID,$fdExpiryDate,$Countryoforigin,$resultApi,$fdQRCode,$secretkey){
        include "include/connection.php";

        // Update tbMedicineStripTest
         $updateQueryStrip = "UPDATE tbMedicineStripTest SET fdQRCode = '$fdQRCode', fdSecretKey = '$secretkey', fdEncryptQRCode = '$resultApi', fdQRCodeCreated = 1 WHERE fdStripID = '$fdStripID'";
        $updateResultStrip = mysqli_query($conn, $updateQueryStrip);

        if ($updateResultStrip) {
            echo "Strip QR codes updated successfully.";
        } else {
            echo "Error updating Strip QR codes: " . mysqli_error($conn);
        }

}


function getMedicineType($conn, $medicineID) {
    $medicineTypeQuery = "SELECT fdMedicineType FROM tbMedicineMaster WHERE fdMedicineID = '$medicineID'";
    $medicineTypeResult = mysqli_query($conn, $medicineTypeQuery);

    if (!$medicineTypeResult) {
        die("Medicine Type Query Error: " . mysqli_error($conn));
    }

    $medicineTypeRow = mysqli_fetch_assoc($medicineTypeResult);
    return isset($medicineTypeRow['fdMedicineType']) ? $medicineTypeRow['fdMedicineType'] : null;
}



function getMedicineExpiryDate($conn, $packageID, $packageType) {
    switch ($packageType) {
        case 'Carton':
            $MedicineExpiryDateQuery = "SELECT fdExpiryDate FROM tbMedicineStripTest WHERE fdCartonID = '$packageID'";
            break;
        case 'Packet':
            $MedicineExpiryDateQuery = "SELECT fdExpiryDate FROM tbMedicineStripTest WHERE fdPacketID = '$packageID'";
            break;
        case 'Strip':
            $MedicineExpiryDateQuery = "SELECT fdExpiryDate FROM tbMedicineStripTest WHERE fdStripID = '$packageID'";
            break;
        default:
            return null; 
    }

    $stripTestResult = mysqli_query($conn, $MedicineExpiryDateQuery);

    if (!$stripTestResult) {
        die("Medicine Expiry Date Query Error: " . mysqli_error($conn));
    }

    $stripTestRow = mysqli_fetch_assoc($stripTestResult);
    return isset($stripTestRow['fdExpiryDate']) ? $stripTestRow['fdExpiryDate'] : null;
}



// Function to generate QR code and update the database
function generateQRCodeAndUpdate($conn, $packageID, $table, $field, $apiUrl,$packagetype) {
    // Fetch package details

    // $details1 = array();
    if($packagetype == "Carton"){
       //count no. of packets
       global $i;
        $i=0;    
        echo $query = "SELECT * FROM $table WHERE $field IN ('$packageID')";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query Error: " . mysqli_error($conn));
        }
        while ($row = mysqli_fetch_assoc($result)) {

            $medicineID = $row['fdMedicineID'];
            $medicineType = getMedicineType($conn, $medicineID);
            $MedicineExpiryDate = getMedicineExpiryDate($conn, $packageID, 'Carton');
        if($i==0){
        $details = json_encode([
            'ManufacturerID' => $row['fdManufacturerID'],
            'MedicineID' => $row['fdMedicineID'],
            'PackageType' => 'Carton',
            'PackageID' => $packageID, 
            'MedicineType' => $medicineType,
            'MedicineBatchID' => $row['fdBatchID'],
            'MedicineExpiryDate' => $MedicineExpiryDate,
            'Countryoforigin' => 'India'
        ]);
        // global $details1;

        $details1 = implode('|', array_values(json_decode($details, true)));
        $resultApi = fnCallApi($details1);
        $secretkey = substr($resultApi, 0, 6);

        if($resultApi != " "){
           $varUpdatePacket = fnUpdateCartonQRCode($row['fdManufacturerID'],$row['fdMedicineID'],'Carton',$packageID,$row['fdMedicineType'],$row['fdBatchID'],$row['fdExpiryDate'],'India',$resultApi,$details1,$secretkey);
            
        }
}
            $details = json_encode([
            'ManufacturerID' => $row['fdManufacturerID'],
            'MedicineID' => $row['fdMedicineID'],
            'PackageType' => 'Packet',
            'PackageID' => $row['fdPacketID'], 
            'MedicineType' => $medicineType,
            'MedicineBatchID' => $row['fdBatchID'],
            'MedicineExpiryDate' => $MedicineExpiryDate,
            'Countryoforigin' => 'India'
        ]);
        // global $details1;

        $details1 = implode('|', array_values(json_decode($details, true)));
        $resultApi = fnCallApi($details1);
        $secretkey = substr($resultApi, 0, 6);

        if($resultApi != " "){
           $varUpdatePacket = fnUpdatePacketQRCode($row['fdManufacturerID'],$row['fdMedicineID'],'Packet',$row['fdPacketID'],$row['fdMedicineType'],$row['fdBatchID'],$row['fdExpiryDate'],'India',$resultApi,$details1,$secretkey);
            
        }
        $details = json_encode([
            'ManufacturerID' => $row['fdManufacturerID'],
            'MedicineID' => $row['fdMedicineID'],
            'PackageType' => 'Strip',
            'PackageID' => $row['fdStripID'], 
            'MedicineType' => $medicineType,
            'MedicineBatchID' => $row['fdBatchID'],
            'MedicineExpiryDate' => $MedicineExpiryDate,
            'Countryoforigin' => 'India'
        ]);
        // global $details1;
        $details1 = implode('|', array_values(json_decode($details, true)));
        $resultApi = fnCallApi($details1);
        $secretkey = substr($resultApi, 0, 6);

        if($resultApi != " "){
           $varUpdateStrip = fnUpdateStripQRCode($row['fdManufacturerID'],$row['fdMedicineID'],'Packet',$row['fdStripID'],$row['fdMedicineType'],$row['fdBatchID'],$row['fdExpiryDate'],'India',$resultApi,$details1,$secretkey);
            
        
        
    }
    $i++;
            
        }
        
    }
    
    if($packagetype == "Packet"){
        global $i;
        $i=0;    
        $query = "SELECT * FROM $table WHERE $field IN ('$packageID')";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query Error: " . mysqli_error($conn));
        }
        while ($row = mysqli_fetch_assoc($result)) {

            $medicineID = $row['fdMedicineID'];
            $medicineType = getMedicineType($conn, $medicineID);
            $MedicineExpiryDate = getMedicineExpiryDate($conn, $packageID, 'Packet');
        if($i==0){
        $details = json_encode([
            'ManufacturerID' => $row['fdManufacturerID'],
            'MedicineID' => $row['fdMedicineID'],
            'PackageType' => 'Packet',
            'PackageID' => $packageID, 
            'MedicineType' => $medicineType,
            'MedicineBatchID' => $row['fdBatchID'],
            'MedicineExpiryDate' => $MedicineExpiryDate,
            'Countryoforigin' => 'India'
        ]);
        // global $details1;

        $details1 = implode('|', array_values(json_decode($details, true)));
        $resultApi = fnCallApi($details1);
        $secretkey = substr($resultApi, 0, 6);

        if($resultApi != " "){
           $varUpdatePacket = fnUpdatePacketQRCode($row['fdManufacturerID'],$row['fdMedicineID'],'Packet',$packageID,$row['fdMedicineType'],$row['fdBatchID'],$row['fdExpiryDate'],'India',$resultApi,$details1,$secretkey);
            
        }
}
        $details = json_encode([
            'ManufacturerID' => $row['fdManufacturerID'],
            'MedicineID' => $row['fdMedicineID'],
            'PackageType' => 'Strip',
            'PackageID' => $row['fdStripID'], 
            'MedicineType' => $medicineType,
            'MedicineBatchID' => $row['fdBatchID'],
            'MedicineExpiryDate' => $MedicineExpiryDate,
            'Countryoforigin' => 'India'
        ]);
        // global $details1;
        $details1 = implode('|', array_values(json_decode($details, true)));
        $resultApi = fnCallApi($details1);
        $secretkey = substr($resultApi, 0, 6);

        if($resultApi != " "){
           $varUpdateStrip = fnUpdateStripQRCode($row['fdManufacturerID'],$row['fdMedicineID'],'Packet',$row['fdStripID'],$row['fdMedicineType'],$row['fdBatchID'],$row['fdExpiryDate'],'India',$resultApi,$details1,$secretkey);
            
        
        
    }
    $i++;
            
        }
        
    }
    
    if($packagetype == "Strip"){
        $query = "SELECT * FROM $table WHERE $field IN ('$packageID')";
        $result = mysqli_query($conn, $query);
        if ($result) {

       $row = mysqli_fetch_assoc($result);
            $medicineID = $row['fdMedicineID'];
            $medicineType = getMedicineType($conn, $medicineID);
            $MedicineExpiryDate = getMedicineExpiryDate($conn, $packageID, 'Strip');
        
        $details = json_encode([
            'ManufacturerID' => $row['fdManufacturerID'],
            'MedicineID' => $row['fdMedicineID'],
            'PackageType' => 'Strip',
            'PackageID' => $row[$field], 
            'MedicineType' => $medicineType,
            'MedicineBatchID' => $row['fdBatchID'],
            'MedicineExpiryDate' => $MedicineExpiryDate,
            'Countryoforigin' => 'India'
        ]);
        $details1 = implode('|', array_values(json_decode($details, true)));
        $resultApi = fnCallApi($details1);
        $secretkey = substr($resultApi, 0, 6);

        if($resultApi != " "){
            $varUpdateStrip = fnUpdateStripQRCode($row['fdManufacturerID'],$row['fdMedicineID'],'Strip',$row['fdStripID'],$row['fdMedicineType'],$row['fdBatchID'],$row['fdExpiryDate'],'India',$resultApi,$details1,$secretkey);
            
       }
            
        }
    
        } 
  
}

  
?> 




<?php
include "include/connection.php";

if(isset($_POST['strip_id']) && isset($_POST['packageType'])) {
    $strip_id = $_POST['strip_id'];
    $packageType = $_POST['packageType'];

    $table = '';
    $attribute = '';

    switch ($packageType) {
        case 'C':
            $table = 'tbCarton';
            $attribute = 'fdCartonID';
            break;
        case 'P':
            $table = 'tbPacket';
            $attribute = 'fdPacketID';
            break;
        case 'S':
            $table = 'tbMedicineStripTest';
            $attribute = 'fdStripID';
            break;
        default:
            echo "Invalid package type";
            exit;
    }

    $query = "SELECT fdEncryptQRCode FROM $table WHERE $attribute = '$strip_id'";
    $result = mysqli_query($conn, $query);

    if(!$result) {
        echo "Error executing query: " . mysqli_error($conn);
        exit;
    }

    if ($result && mysqli_num_rows($result) > 0) {                
        $row = mysqli_fetch_assoc($result);

        if(isset($row['fdEncryptQRCode'])) {
            echo $row['fdEncryptQRCode'];
        } else {
            echo "QR code not found"; 
        }
    } else {
        echo "QR code not found"; 
    }
}
?>