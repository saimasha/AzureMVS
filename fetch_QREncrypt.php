<?php

require_once("include/connection.php");


if (isset($_POST['qrcode'])) {
    
    $search = mysqli_real_escape_string($conn, $_POST['qrcode']);
    
 
    $sql = "SELECT fdQRCode FROM tbCarton WHERE fdEncryptQRCode = '$search'
            UNION ALL
            SELECT fdQRCode FROM tbPacket WHERE fdEncryptQRCode = '$search'
            UNION ALL
            SELECT fdQRCode FROM tbMedicineStripTest WHERE fdEncryptQRCode = '$search'";
    $result = mysqli_query($conn, $sql);

    
    if ($result && mysqli_num_rows($result) > 0) {
      
        $row = mysqli_fetch_assoc($result);
        
        $encryptedQRCode = $row['fdQRCode'];
        
        // Return the encrypted QR code as plain text
        echo $encryptedQRCode;
    } else {
        // If no matching QR code was found, return an empty string or an appropriate message
        echo "QR code not found";
    }
} else {
    // If the QR code parameter is not set in the POST request, return an error message
    echo "Invalid request";
}

// Close the database connection
mysqli_close($conn);
?>