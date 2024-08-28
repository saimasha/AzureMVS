<?php 
ob_start();
require "include/header.php";
require "include/navbar.php";

// Start the session and retrieve session variables
session_start();
date_default_timezone_set('Asia/Kolkata');
$currentDateTime = date('Y-m-d H:i:s ');
$RoleUniqueID = $_SESSION['fdRoleUniqueID'];

require("include/connection.php");

if(isset($_POST['searchText'])) {
    $searchText = $_POST['searchText'];
    $status = $_POST['status'];
    $roleUniqueId = $_POST['roleUniqueId'];
    $roleID = $_POST['roleid'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $address = $_POST['address']; 
    $medicinebatchid = isset($_POST['medicinebatchid']) ? $_POST['medicinebatchid'] : null; 

    echo "Loading...";

    // Split scan details into individual components
    $details = explode("|", $searchText);
     $manufacturerID = $details[0];
     $medicineId = $details[1];
     $packagetype = $details[2];
     $packageId = $details[3];
     $medicinetype = $details[4];
     $medicinebatchid = $details[5];
     $MedicineExpiryDate = $details[6];
    $timestamp = date('Y-m-d H:i:s');

    // Get the previous hash from the database
    $prevHashQuery = "SELECT fdCurHash FROM tbBlockchainRecord ORDER BY fdSlNo DESC LIMIT 1";
    $prevHashResult = mysqli_query($conn, $prevHashQuery);
    $prevHashRow = mysqli_fetch_assoc($prevHashResult);
     $prevHash = $prevHashRow['fdCurHash'];

    // Check if the user has already performed hash in or hash out action for the same package
    $existingRecordQuery = "SELECT * FROM tbScanlog WHERE fdCartonID = '$packageId' AND fdTrxnOwner = '$roleUniqueId' AND fdTrxnType = '$status'";
    $existingRecordResult = mysqli_query($conn, $existingRecordQuery);

    if ($existingRecordResult && mysqli_num_rows($existingRecordResult) > 0) {
        // Display message indicating that the user has already performed hash in or hash out action
        $script = "<script>
            Swal.fire({
                title: 'Error!',
                text: 'You have already performed Hashed of Carton.',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = 'https://schedarcloud.com/medicineverifications_new/index.php?ScanIn';
                }
            });
        </script>";
    } else {
        // Proceed with inserting the hash into the database
        if ($packagetype == "Carton") {
        $batchIdQuery = "SELECT fdBatchID FROM tbCarton WHERE fdCartonID = '$packageId'";
        $batchIdResult = mysqli_query($conn, $batchIdQuery);

        if (mysqli_num_rows($batchIdResult) > 0) {
            $batchIdRow = mysqli_fetch_assoc($batchIdResult);
            $fdBatchID = $batchIdRow['fdBatchID'];
        } else {
            die("Batch ID not found for Carton ID: " . $packageId);
        }
            // Generate a unique hash for the carton
            $cartonDataStringWithTimestamp = "$manufacturerID,$medicineId,$packagetype,$packageId,$medicinetype,$medicinebatchid,$MedicineExpiryDate,$timestamp,$prevHash";
            $cartonJsonDataWithTimestamp = json_encode(array("data" => $cartonDataStringWithTimestamp));
            $cartonHashWithTimestamp = generateHash($cartonJsonDataWithTimestamp);

            $cartonDataStringWithoutTimestamp = "$manufacturerID,$medicineId,$packagetype,$packageId,$medicinetype,$medicinebatchid,$MedicineExpiryDate,$prevHash";
            $cartonJsonDataWithoutTimestamp = json_encode(array("data" => $cartonDataStringWithoutTimestamp));
            $cartonHashWithoutTimestamp = generateHash($cartonJsonDataWithoutTimestamp);

            $packageId = mysqli_real_escape_string($conn, $packageId);
            $status = mysqli_real_escape_string($conn, $status);
            $latitude = mysqli_real_escape_string($conn, $latitude);
            $longitude = mysqli_real_escape_string($conn, $longitude);
            $address = mysqli_real_escape_string($conn, $address);

            // Insert hash for the carton with timestamp into the database
            $sqlCartonWithTimestamp = "INSERT INTO tbScanlog (fdMedicineID, fdTrxnOwnerType, fdTrxnOwner, fdBlockchainRecordID, fdBlockchainHashRef, fdCartonID, fdTrxnType, fdScanDate, fdScanLat, fdScanLong, fdScanLocation)
                                       VALUES ('$medicineId', '$roleID', '$roleUniqueId', '$cartonHashWithTimestamp', '$cartonHashWithoutTimestamp', '$packageId', '$status', '$currentDateTime', '$latitude', '$longitude', '$address')";

            if ($conn->query($sqlCartonWithTimestamp) !== TRUE) {
                $script = "<script>
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to insert data. Error: " . $conn->error . "',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                </script>";
            } else {
                $sqlCartonWithTimestamp1 = "INSERT INTO tbBlockchainRecord (fdCartonID, fdPrevHash, fdCurHash, fdTrxnType, fdTrxnDate,fdBatchID)
                                            VALUES ('$packageId', '$prevHash', '$cartonHashWithoutTimestamp', '$status', '$currentDateTime','$fdBatchID')";
                if (mysqli_query($conn, $sqlCartonWithTimestamp1)) {
                    $prevHash = $cartonHashWithoutTimestamp; // Update the previous hash for the next insertion
                    $script = "<script>
                        Swal.fire({
                            title: 'Hashed successfully!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = 'https://schedarcloud.com/medicineverifications_new/index.php?ScanIn';
                            }
                        });
                    </script>";
                    // echo "success";
                } else {
                    $script = "<script>
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to insert data. Error: " . $conn->error . "',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    </script>";
                }
            }

            // Fetch all packets associated with the carton from tbMedicineStripTest
            $query = "SELECT DISTINCT fdPacketID FROM tbMedicineStripTest WHERE fdManufacturerID = '$manufacturerID' AND fdCartonID = '$packageId'";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Query Error: " . mysqli_error($conn));
            }

            // Iterate over each packet in the carton
            while ($row = mysqli_fetch_assoc($result)) {
                $fdPacketID = $row['fdPacketID'];

                // Generate a unique hash for the packet
                $packetDataStringWithTimestamp = "$manufacturerID,$medicineId,Packet,$medicinetype,$medicinebatchid,$MedicineExpiryDate,$timestamp,$fdPacketID,$prevHash";
                $packetJsonDataWithTimestamp = json_encode(array("data" => $packetDataStringWithTimestamp));
                $packetHashWithTimestamp = generateHash($packetJsonDataWithTimestamp);

                $packetDataStringWithoutTimestamp = "$manufacturerID,$medicineId,Packet,$medicinetype,$medicinebatchid,$MedicineExpiryDate,$fdPacketID,$prevHash";
                $packetJsonDataWithoutTimestamp = json_encode(array("data" => $packetDataStringWithoutTimestamp));
                $packetHashWithoutTimestamp = generateHash($packetJsonDataWithoutTimestamp);

                // Insert hash for the packet with timestamp into the database
                $sqlPacketWithTimestamp = "INSERT INTO tbScanlog (fdMedicineID, fdTrxnOwnerType, fdTrxnOwner, fdBlockchainRecordID, fdBlockchainHashRef, fdPacketID, fdCartonID, fdTrxnType, fdScanDate, fdScanLat, fdScanLong, fdScanLocation)
                                           VALUES ('$medicineId', '$roleID', '$roleUniqueId', '$packetHashWithTimestamp', '$packetHashWithoutTimestamp', '$fdPacketID', '$packageId', '$status', '$currentDateTime', '$latitude', '$longitude', '$address')";

                if ($conn->query($sqlPacketWithTimestamp) !== TRUE) {
                    "Error inserting data into the database for the packet: " . $conn->error;
                } else {
                    $sqlPacketWithTimestamp1 = "INSERT INTO tbBlockchainRecord (fdPacketID,fdCartonID, fdPrevHash, fdCurHash, fdTrxnType, fdTrxnDate,fdBatchID)
                                                VALUES ('$fdPacketID', '$packageId', '$prevHash', '$packetHashWithoutTimestamp', '$status', '$currentDateTime','$fdBatchID')";
                    if (mysqli_query($conn, $sqlPacketWithTimestamp1)) {
                        $prevHash = $packetHashWithoutTimestamp; // Update the previous hash for the next insertion
                    } else {
                        "Error inserting data into the database for the packet: " . $conn->error;
                    }
                }

                // Fetch all strips associated with the packet from tbMedicineStripTest
                $stripQuery = "SELECT fdStripID, fdExpiryDate FROM tbMedicineStripTest WHERE fdManufacturerID = '$manufacturerID' AND fdCartonID = '$packageId' AND fdPacketID = '$fdPacketID'";
                $stripResult = mysqli_query($conn, $stripQuery);

                if (!$stripResult) {
                    die("Query Error: " . mysqli_error($conn));
                }

                // Iterate over each strip in the packet
                while ($stripRow = mysqli_fetch_assoc($stripResult)) {
                    $fdStripID = $stripRow['fdStripID'];
                    $fdExpiryDate = $stripRow['fdExpiryDate'];

                    // Generate a unique hash for the strip
                    $stripDataStringWithTimestamp = "$manufacturerID,$medicineId,Strip,$fdStripID,$medicinetype,$medicinebatchid,$fdExpiryDate,$packageId,$fdPacketID,$prevHash,$timestamp";
                    $stripJsonDataWithTimestamp = json_encode(array("data" => $stripDataStringWithTimestamp));
                    $stripHashWithTimestamp = generateHash($stripJsonDataWithTimestamp);
                     
                  
                    $stripDataStringWithoutTimestamp = "$manufacturerID,$medicineId,Strip,$fdStripID,$medicinetype,$medicinebatchid,$fdExpiryDate,$packageId,$fdPacketID,$prevHash";
                    // echo $stripDataStringWithoutTimestamp;
                    $stripJsonDataWithoutTimestamp = json_encode(array("data" => $stripDataStringWithoutTimestamp));
                    $stripHashWithoutTimestamp = generateHash($stripJsonDataWithoutTimestamp);

                    // Insert hash for the strip with timestamp into the database
                    $sqlStripWithTimestamp = "INSERT INTO tbScanlog (fdMedicineID, fdTrxnOwnerType, fdTrxnOwner, fdBlockchainRecordID, fdBlockchainHashRef, fdStripID, fdPacketID, fdCartonID, fdTrxnType, fdScanDate, fdScanLat, fdScanLong, fdScanLocation)
                                              VALUES ('$medicineId', '$roleID', '$roleUniqueId', '$stripHashWithTimestamp', '$stripHashWithoutTimestamp', '$fdStripID', '$fdPacketID', '$packageId', '$status', '$currentDateTime', '$latitude', '$longitude', '$address')";

                    if ($conn->query($sqlStripWithTimestamp) !== TRUE) {
                        "Error inserting data into the database for the strip: " . $conn->error;
                    } else {
                        $sqlStripWithTimestamp1 = "INSERT INTO tbBlockchainRecord (fdStripID, fdPacketID, fdCartonID, fdPrevHash, fdCurHash, fdTrxnType, fdTrxnDate,fdBatchID)
                                                   VALUES ('$fdStripID','$fdPacketID', '$packageId','$prevHash', '$stripHashWithoutTimestamp', '$status', '$currentDateTime','$fdBatchID')";
                        if (mysqli_query($conn, $sqlStripWithTimestamp1)) {
                            $prevHash = $stripHashWithoutTimestamp; // Update the previous hash for the next insertion
                        } else {
                            "Error inserting data into the database for the strip: " . $conn->error;
                        }
                    }
                }
            }
        } 
    }
            $existingRecordQuery = "SELECT * FROM tbScanlog WHERE fdPacketID = '$packageId' AND fdTrxnOwner = '$roleUniqueId' AND fdTrxnType = '$status'";
            $existingRecordResult = mysqli_query($conn, $existingRecordQuery);

            if ($existingRecordResult && mysqli_num_rows($existingRecordResult) > 0) {
            // Display message indicating that the user has already performed hash in or hash out action
            $script = "<script>
            Swal.fire({
                title: 'Error!',
                text: 'You have already performed Hashed of Packet.',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = 'https://schedarcloud.com/medicineverifications/index.php?ScanIn';
                }
            });
            </script>";
            // echo "success";
            } else {

         if ($packagetype == "Packet") {
        $batchIdQuery = "SELECT fdBatchID FROM tbPacket WHERE fdPacketID = '$packageId'";
        $batchIdResult = mysqli_query($conn, $batchIdQuery);

        if (mysqli_num_rows($batchIdResult) > 0) {
            $batchIdRow = mysqli_fetch_assoc($batchIdResult);
            $fdBatchID = $batchIdRow['fdBatchID'];
        } else {
            die("Batch ID not found for Carton ID: " . $packageId);
        }
            // Generate a unique hash for the packet
            $packetDataStringWithTimestamp = "$manufacturerID,$medicineId,$packagetype,$packageId,$medicinetype,$medicinebatchid,$MedicineExpiryDate,$timestamp,$prevHash";
            $packetJsonDataWithTimestamp = json_encode(array("data" => $packetDataStringWithTimestamp));
            $packetHashWithTimestamp = generateHash($packetJsonDataWithTimestamp);

            $packetDataStringWithoutTimestamp = "$manufacturerID,$medicineId,$packagetype,$packageId,$medicinetype,$medicinebatchid,$MedicineExpiryDate,$prevHash";
            $packetJsonDataWithoutTimestamp = json_encode(array("data" => $packetDataStringWithoutTimestamp));
            $packetHashWithoutTimestamp = generateHash($packetJsonDataWithoutTimestamp);

            // Insert hash for the packet with timestamp into the database
            $sqlPacketWithTimestamp = "INSERT INTO tbScanlog (fdMedicineID, fdTrxnOwnerType, fdTrxnOwner, fdBlockchainRecordID, fdBlockchainHashRef, fdPacketID, fdTrxnType, fdScanDate, fdScanLat, fdScanLong, fdScanLocation)
                                       VALUES ('$medicineId', '$roleID', '$roleUniqueId', '$packetHashWithTimestamp', '$packetHashWithoutTimestamp', '$packageId', '$status', '$currentDateTime', '$latitude', '$longitude', '$address')";

            if ($conn->query($sqlPacketWithTimestamp) !== TRUE) {
                $script = "<script>
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to insert data. Error: " . $conn->error . "',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                </script>";
            } else {
                $sqlPacketWithTimestamp1 = "INSERT INTO tbBlockchainRecord (fdPacketID, fdPrevHash, fdCurHash, fdTrxnType, fdTrxnDate,fdBatchID)
                                                VALUES ('$packageId', '$prevHash', '$packetHashWithoutTimestamp', '$status', '$currentDateTime','$fdBatchID')";
                if (mysqli_query($conn, $sqlPacketWithTimestamp1)) {
                    $prevHash = $packetHashWithoutTimestamp; // Update the previous hash for the next insertion
                    $script = "<script>
                        Swal.fire({
                            title: 'Hashed successfully!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = 'https://schedarcloud.com/medicineverifications_new/index.php?ScanIn';
                            }
                        });
                    </script>";
                    echo 'success';
                } else {
                    $script = "<script>
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to insert data. Error: " . $conn->error . "',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    </script>";
                }
            }

            // Fetch all strips associated with the packet from tbMedicineStripTest
            $stripQuery = "SELECT fdStripID, fdCartonID FROM tbMedicineStripTest WHERE fdManufacturerID = '$manufacturerID' AND fdPacketID = '$packageId'";
            $stripResult = mysqli_query($conn, $stripQuery);

            if (!$stripResult) {
                die("Query Error: " . mysqli_error($conn));
            }

            // Iterate over each strip in the packet
            while ($stripRow = mysqli_fetch_assoc($stripResult)) {
                $fdStripID = $stripRow['fdStripID'];
                $fdCartonID = $stripRow['fdCartonID'];

                // Generate a unique hash for the strip
                $stripDataStringWithTimestamp = "$manufacturerID,$medicineId,Strip,$fdStripID,$medicinetype,$medicinebatchid,$MedicineExpiryDate,$fdCartonID,$packageId,$prevHash,$timestamp";
                $stripJsonDataWithTimestamp = json_encode(array("data" => $stripDataStringWithTimestamp));
                $stripHashWithTimestamp = generateHash($stripJsonDataWithTimestamp);

                $stripDataStringWithoutTimestamp = "$manufacturerID,$medicineId,Strip,$fdStripID,$medicinetype,$medicinebatchid,$MedicineExpiryDate,$fdCartonID,$packageId,$prevHash";
                $stripJsonDataWithoutTimestamp = json_encode(array("data" => $stripDataStringWithoutTimestamp));
                $stripHashWithoutTimestamp = generateHash($stripJsonDataWithoutTimestamp);

                // Insert hash for the strip with timestamp into the database
                $sqlStripWithTimestamp = "INSERT INTO tbScanlog (fdMedicineID, fdTrxnOwnerType, fdTrxnOwner, fdBlockchainRecordID, fdBlockchainHashRef, fdStripID, fdPacketID, fdTrxnType, fdScanDate, fdScanLat, fdScanLong, fdScanLocation)
                                          VALUES ('$medicineId', '$roleID', '$roleUniqueId', '$stripHashWithTimestamp', '$stripHashWithoutTimestamp', '$fdStripID', '$packageId', '$status', '$currentDateTime', '$latitude', '$longitude', '$address')";

                if ($conn->query($sqlStripWithTimestamp) !== TRUE) {
                    "Error inserting data into the database for the strip: " . $conn->error;
                } else {
                    $sqlStripWithTimestamp1 = "INSERT INTO tbBlockchainRecord (fdStripID, fdPacketID, fdPrevHash, fdCurHash, fdTrxnType, fdTrxnDate,fdBatchID)
                                                   VALUES ('$fdStripID', '$packageId','$prevHash', '$stripHashWithoutTimestamp', '$status', '$currentDateTime','$fdBatchID')";
                    if (mysqli_query($conn, $sqlStripWithTimestamp1)) {
                        $prevHash = $stripHashWithoutTimestamp; // Update the previous hash for the next insertion
                    } else {
                        "Error inserting data into the database for the strip: " . $conn->error;
                    }
                }
            }
        }
    }

            $existingRecordQuery = "SELECT * FROM tbScanlog WHERE fdStripID = '$packageId' AND fdTrxnOwner = '$roleUniqueId' AND fdTrxnType = '$status'";
            $existingRecordResult = mysqli_query($conn, $existingRecordQuery);

            if ($existingRecordResult && mysqli_num_rows($existingRecordResult) > 0) {
            $script = "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'You have already performed Hashed of Strip.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = 'https://schedarcloud.com/medicineverifications/index.php?ScanIn';
                    }
                });
            </script>";
            // echo "success";
            } else {

         if ($packagetype == "Strip") {
            $batchIdQuery = "SELECT fdBatchID,fdPacketID,fdCartonID FROM tbMedicineStripTest WHERE fdStripID = '$packageId'";
            $batchIdResult = mysqli_query($conn, $batchIdQuery);
    
            if (mysqli_num_rows($batchIdResult) > 0) {
                $batchIdRow = mysqli_fetch_assoc($batchIdResult);
                $fdBatchID = $batchIdRow['fdBatchID'];
                $fdCartonID = $batchIdRow['fdCartonID'];
                $fdPacketID = $batchIdRow['fdPacketID'];

            } else {
                die("Batch ID not found for Carton ID: " . $packageId);
            }
            // Generate a unique hash for the strip
            $stripDataStringWithTimestamp = "$manufacturerID,$medicineId,$packagetype,$packageId,$medicinetype,$medicinebatchid,$MedicineExpiryDate,$fdCartonID,$fdPacketID,$prevHash,$timestamp";
            
            $stripJsonDataWithTimestamp = json_encode(array("data" => $stripDataStringWithTimestamp));
            $stripHashWithTimestamp = generateHash($stripJsonDataWithTimestamp);

            $stripDataStringWithoutTimestamp = "$manufacturerID,$medicineId,$packagetype,$packageId,$medicinetype,$medicinebatchid,$MedicineExpiryDate,$fdCartonID,$fdPacketID,$prevHash";

            // echo $stripDataStringWithoutTimestamp;
            $stripJsonDataWithoutTimestamp = json_encode(array("data" => $stripDataStringWithoutTimestamp));
            $stripHashWithoutTimestamp = generateHash($stripJsonDataWithoutTimestamp);

            // Insert hash for the strip with timestamp into the database
            $sqlStripWithTimestamp = "INSERT INTO tbScanlog (fdMedicineID, fdTrxnOwnerType, fdTrxnOwner, fdBlockchainRecordID, fdBlockchainHashRef, fdStripID, fdTrxnType, fdScanDate, fdScanLat, fdScanLong, fdScanLocation)
                                      VALUES ('$medicineId', '$roleID', '$roleUniqueId', '$stripHashWithTimestamp', '$stripHashWithoutTimestamp', '$packageId', '$status', '$currentDateTime', '$latitude', '$longitude', '$address')";

            if ($conn->query($sqlStripWithTimestamp) !== TRUE) {
                $script = "<script>
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to insert data. Error: " . $conn->error . "',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                </script>";
            } else {
                $sqlStripWithTimestamp1 = "INSERT INTO tbBlockchainRecord (fdStripID, fdPrevHash, fdCurHash, fdTrxnType, fdTrxnDate,fdBatchID)
                                                   VALUES ('$packageId','$prevHash', '$stripHashWithoutTimestamp', '$status', '$currentDateTime','$fdBatchID')";
                if (mysqli_query($conn, $sqlStripWithTimestamp1)) {
                    $prevHash = $stripHashWithoutTimestamp; // Update the previous hash for the next insertion
                    $script = "<script>
                        Swal.fire({
                            title: 'Hashed successfully!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = 'https://schedarcloud.com/medicineverifications_new/index.php?ScanIn';
                            }
                        });
                    </script>";
                    // echo "success";
                } else {
                    $script = "<script>
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to insert data. Error: " . $conn->error . "',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    </script>";
                }
            }
        }
    } 
}


function generateHash($jsonData) {
    // Your API call here
    $apiUrl = 'https://schedarcloud.com/api/index.php';
    $context = stream_context_create(array(
        'http' => array(
            'method' => 'POST',
            'header' => "Content-Type: application/json\r\n" . "Content-Length: " . strlen($jsonData) . "\r\n",
            'content' => $jsonData
        )
    ));

    // Send the request and get the response
    $response = file_get_contents($apiUrl, false, $context);

    // Decode the JSON response
    $responseData = json_decode($response, true);

    // Check for errors and return the hash
    if ($responseData && isset($responseData['status']) && $responseData['status'] == 200 && isset($responseData['data'])) {
        return $responseData['data'];
    } else {
        return "Error: Invalid API response";
    }
}
?>

<?php if (!empty($script)) echo $script; ?>

<!-- Rest of your HTML code -->

<?php require "include/footer.php"; ?>

