<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require ("../include/connection.php");
session_start();

if (isset($_POST['search'])) {
    $search = $_POST['qrcode1'];
    $RoleUniqueID = $_SESSION['fdRoleUniqueID'];
    $roleid = $_SESSION['fdRoleID'];

    
    // Check in tbMedicineStripTest table
    $sql = "";
    if ($roleid === "MNFR") {
        $sql = "SELECT fdManufacturerID FROM tbManufacturerMaster WHERE fdManufacturerID = '$RoleUniqueID'";
    } elseif ($roleid === "STKS") { 
        $sql = "SELECT fdManufacturerID FROM tbStockistMaster WHERE fdStockistID = '$RoleUniqueID'";
    } elseif ($roleid === "DSTR") {
        $sql = "SELECT fdManufacturerID FROM tbDistributorMaster WHERE fdDistributorID = '$RoleUniqueID'";
    } elseif ($roleid === "DELR") {
        $sql = "SELECT fdManufacturerID FROM tbDealerMaster WHERE fdDealerID = '$RoleUniqueID'";
    } else {
        $sql = "SELECT fdManufacturerID FROM tbRetailerMaster WHERE fdRetailerID = '$RoleUniqueID'";
    }

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $manufacturerID = $row['fdManufacturerID'];

        $checkQuery = "SELECT 'tbMedicineStripTest' AS source_table, COUNT(*) AS count, fdEncryptQRCode AS encrypt_code FROM tbMedicineStripTest WHERE fdQRCode = '$search'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult && $checkResult->num_rows > 0) {
            $row = $checkResult->fetch_assoc();
            $count = $row['count'];

            if ($count > 0) {
                $sql = "SELECT s.*, 
                        (SELECT m.fdMedicineType FROM tbMedicineMaster m WHERE m.fdMedicineID = s.fdMedicineID) AS fdMedicineType 
                        FROM tbMedicineStripTest s
                        WHERE s.fdQRCode = '$search'";

                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    $data = array();
                    while ($row = $result->fetch_assoc()) {
                        $data[] = $row;
                    }
                    echo json_encode(array('success' => true, 'data' => $data, 'source_table' => 'tbMedicineStripTest'));
                    exit(); 
                }
            }
        }
    } else {
       echo "Error: " . mysqli_error($conn);
}

    // If not found in tbMedicineStripTest, check in tbCarton table
    $sql = "";
    if ($roleid === "MNFR") {
        $sql = "SELECT fdManufacturerID FROM tbManufacturerMaster WHERE fdManufacturerID = '$RoleUniqueID'";
    } elseif ($roleid === "STKS") { 
        $sql = "SELECT fdManufacturerID FROM tbStockistMaster WHERE fdStockistID = '$RoleUniqueID'";
    } elseif ($roleid === "DSTR") {
        $sql = "SELECT fdManufacturerID FROM tbDistributorMaster WHERE fdDistributorID = '$RoleUniqueID'";
    } elseif ($roleid === "DELR") {
        $sql = "SELECT fdManufacturerID FROM tbDealerMaster WHERE fdDealerID = '$RoleUniqueID'";
    } else {
        $sql = "SELECT fdManufacturerID FROM tbRetailerMaster WHERE fdRetailerID = '$RoleUniqueID'";
    }

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $manufacturerID = $row['fdManufacturerID'];

        $checkQuery = "SELECT 'Carton' AS package_type, COUNT(*) AS count, fdEncryptQRCode AS encrypt_code FROM tbCarton WHERE fdQRCode = '$search'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult && $checkResult->num_rows > 0) {
            $row = $checkResult->fetch_assoc();
            $count = $row['count'];

            if ($count > 0) {
                $sql = "SELECT s.*, 
                        (SELECT m.fdMedicineType FROM tbMedicineMaster m WHERE m.fdMedicineID = s.fdMedicineID) AS fdMedicineType 
                        FROM tbCarton s
                        WHERE s.fdQRCode = '$search'";

                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    $data = array();
                    while ($row = $result->fetch_assoc()) {
                        $data[] = $row;
                    }
                    echo json_encode(array('success' => true, 'data' => $data, 'source_table' => 'tbCarton'));
                    exit(); 
                }
            }
        }
    } else {
        echo "Error fetching manufacturer ID";
    }

    // If not found in tbCarton, check in tbPacket table
    $sql = "";
    if ($roleid === "MNFR") {
        $sql = "SELECT fdManufacturerID FROM tbManufacturerMaster WHERE fdManufacturerID = '$RoleUniqueID'";
    } elseif ($roleid === "STKS") { 
        $sql = "SELECT fdManufacturerID FROM tbStockistMaster WHERE fdStockistID = '$RoleUniqueID'";
    } elseif ($roleid === "DSTR") {
        $sql = "SELECT fdManufacturerID FROM tbDistributorMaster WHERE fdDistributorID = '$RoleUniqueID'";
    } elseif ($roleid === "DELR") {
        $sql = "SELECT fdManufacturerID FROM tbDealerMaster WHERE fdDealerID = '$RoleUniqueID'";
    } else {
        $sql = "SELECT fdManufacturerID FROM tbRetailerMaster WHERE fdRetailerID = '$RoleUniqueID'";
    }

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $manufacturerID = $row['fdManufacturerID'];

        $checkQuery = "SELECT 'tbPacket' AS source_table, COUNT(*) AS count, fdEncryptQRCode AS encrypt_code FROM tbPacket WHERE fdQRCode = '$search'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult && $checkResult->num_rows > 0) {
            $row = $checkResult->fetch_assoc();
            $count = $row['count'];

            if ($count > 0) {
                $sql = "SELECT s.*, 
                        (SELECT m.fdMedicineType FROM tbMedicineMaster m WHERE m.fdMedicineID = s.fdMedicineID) AS fdMedicineType 
                        FROM tbPacket s
                        WHERE s.fdQRCode = '$search'";

                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    $data = array();
                    while ($row = $result->fetch_assoc()) {
                        $data[] = $row;
                    }
                    echo json_encode(array('success' => true, 'data' => $data, 'source_table' => 'tbPacket'));
                    exit(); 
                }
            }
        }
    } else {
        echo "Error fetching manufacturer ID";
    }

    // If not found in any table, check scan log history and provide appropriate messages
    echo json_encode(array('success' => false, 'message' => 'Search parameter not found'));
} else {
    echo json_encode(array('success' => false, 'message' => 'Search parameter not provided'));
}

$conn->close();
?>