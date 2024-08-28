<?php
session_start();
require_once("include/connection.php");

if (isset($_POST['qrcode'])) {
    $search = mysqli_real_escape_string($conn, $_POST['qrcode']);
    $sql = "";
    $roleid = $_SESSION['fdRoleID'];
    $RoleUniqueID = $_SESSION['fdRoleUniqueID'];

    // Determine the appropriate SQL query based on $roleid
    if ($roleid === "MNFR") {
        $sql3 = "SELECT fdManufacturerID FROM tbManufacturerMaster WHERE fdManufacturerID = '$RoleUniqueID'";
    } elseif ($roleid === "STKS") {
        $sql3 = "SELECT fdManufacturerID FROM tbStockistMaster WHERE fdStockistID = '$RoleUniqueID'";
    } elseif ($roleid === "DSTR") {
        $sql3 = "SELECT fdManufacturerID FROM tbDistributorMaster WHERE fdDistributorID = '$RoleUniqueID'";
    } elseif ($roleid === "DELR") {
        $sql3 = "SELECT fdManufacturerID FROM tbDealerMaster WHERE fdDealerID = '$RoleUniqueID'";
    } else {
        $sql3 = "SELECT fdManufacturerID FROM tbRetailerMaster WHERE fdRetailerID = '$RoleUniqueID'";
    }
    $result1 = mysqli_query($conn, $sql3);

    if ($result1 && mysqli_num_rows($result1) > 0) {
        $row = mysqli_fetch_assoc($result1);
        $manufacturerID = $row['fdManufacturerID'];

        // Construct the main query with QR code search and manufacturer ID filter
        $sql = "SELECT fdQRCode FROM tbCarton WHERE fdEncryptQRCode = '$search' AND fdManufacturerID = '$manufacturerID'
                UNION ALL
                SELECT fdQRCode FROM tbPacket WHERE fdEncryptQRCode = '$search' AND fdManufacturerID = '$manufacturerID'
                UNION ALL
                SELECT fdQRCode FROM tbMedicineStripTest WHERE fdEncryptQRCode = '$search' AND fdManufacturerID = '$manufacturerID'";

        $result2 = mysqli_query($conn, $sql);

        if ($result2 && mysqli_num_rows($result2) > 0) {
            $row2 = mysqli_fetch_assoc($result2);
            $encryptedQRCode = $row2['fdQRCode'];
            // Return the encrypted QR code as plain text
            echo $encryptedQRCode;
        } else {
            // If no matching QR code was found, return an appropriate message
            echo "QR code not found";
        }
    } else {
        // If no manufacturer ID was found, return an appropriate message
        echo "QR code not found";
    }
} else {
    // If the QR code parameter is not set in the POST request, return an error message
    echo "Invalid request";
}

// Close the database connection
mysqli_close($conn);
?>
