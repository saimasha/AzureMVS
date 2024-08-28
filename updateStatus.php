<?php
// updateStatus.php
session_start();
require("function.php"); // Ensure this file contains the sendEmail function
require("include/connection.php"); // Database connection

if(isset($_GET['ManufacturerID']) && isset($_GET['newStatus'])) {
    $ManufacturerID = $_GET['ManufacturerID'];
    $newStatus = $_GET['newStatus']; // Assuming 1 is active and 2 is inactive

    // Fetch user's email based on ManufacturerID
    $emailQuery = "SELECT fdEmailAsUserID FROM tbUserMaster WHERE fdRoleUniqueID = '$ManufacturerID'";
    $emailResult = mysqli_query($conn, $emailQuery);
    
    if($emailRow = mysqli_fetch_assoc($emailResult)) {
        $email = $emailRow['fdEmailAsUserID'];
        
        // Update status in database (Example query, adjust as needed)
        $updateQuery = "UPDATE tbUserMaster SET fdStatus = '$newStatus' WHERE fdRoleUniqueID = '$ManufacturerID'";
        if(mysqli_query($conn, $updateQuery)) {
            // Send email if status is set to inactive
            if($newStatus == 0) {
                sendEmail($conn, 1, $email);
            }
            header("Location: /medicineverifications_new/?ListManufacture");
exit();

        } else {
            echo "Failed to update status.";
        }
    } else {
        echo "Email not found for ManufacturerID: $ManufacturerID";
    }
}

if(isset($_GET['stockistID']) && isset($_GET['newStatus'])) {
    $stockistID = $_GET['stockistID'];
    $newStatus = $_GET['newStatus']; // Assuming 1 is active and 2 is inactive

    // Fetch user's email based on stockistID
    $emailQuery = "SELECT fdEmailAsUserID FROM tbUserMaster WHERE fdRoleUniqueID = '$stockistID'";
    $emailResult = mysqli_query($conn, $emailQuery);
    
    if($emailRow = mysqli_fetch_assoc($emailResult)) {
        $email = $emailRow['fdEmailAsUserID'];
        
        // Update status in database (Example query, adjust as needed)
        $updateQuery = "UPDATE tbUserMaster SET fdStatus = '$newStatus' WHERE fdRoleUniqueID = '$stockistID'";
        if(mysqli_query($conn, $updateQuery)) {
            // Send email if status is set to inactive
            if($newStatus == 0) {
                sendEmail($conn, 2, $email);
            }
            header("Location: /medicineverifications_new/?ListStockist");
exit();

        } else {
            echo "Failed to update status.";
        }
    } else {
        echo "Email not found for stockistID: $stockistID";
    }
}



if(isset($_GET['DistributorId']) && isset($_GET['newStatus'])) {
    $DistributorId = $_GET['DistributorId'];
    $newStatus = $_GET['newStatus']; // Assuming 1 is active and 2 is inactive

    // Fetch user's email based on DistributorId
    $emailQuery = "SELECT fdEmailAsUserID FROM tbUserMaster WHERE fdRoleUniqueID = '$DistributorId'";
    $emailResult = mysqli_query($conn, $emailQuery);
    
    if($emailRow = mysqli_fetch_assoc($emailResult)) {
        $email = $emailRow['fdEmailAsUserID'];
        
        // Update status in database (Example query, adjust as needed)
        $updateQuery = "UPDATE tbUserMaster SET fdStatus = '$newStatus' WHERE fdRoleUniqueID = '$DistributorId'";
        if(mysqli_query($conn, $updateQuery)) {
            // Send email if status is set to inactive
            if($newStatus == 0) {
                sendEmail($conn, 3, $email);
            }
            header("Location: /medicineverifications_new/?ListDistributor");
exit();

        } else {
            echo "Failed to update status.";
        }
    } else {
        echo "Email not found for DistributorId: $DistributorId";
    }
}

if(isset($_GET['dealerId']) && isset($_GET['newStatus'])) {
    $dealerId = $_GET['dealerId'];
    $newStatus = $_GET['newStatus']; // Assuming 1 is active and 2 is inactive

    // Fetch user's email based on dealerId
    $emailQuery = "SELECT fdEmailAsUserID FROM tbUserMaster WHERE fdRoleUniqueID = '$dealerId'";
    $emailResult = mysqli_query($conn, $emailQuery);
    
    if($emailRow = mysqli_fetch_assoc($emailResult)) {
        $email = $emailRow['fdEmailAsUserID'];
        
        // Update status in database (Example query, adjust as needed)
        $updateQuery = "UPDATE tbUserMaster SET fdStatus = '$newStatus' WHERE fdRoleUniqueID = '$dealerId'";
        if(mysqli_query($conn, $updateQuery)) {
            // Send email if status is set to inactive
            if($newStatus == 0) {
                sendEmail($conn, 4, $email);
            }
            header("Location: /medicineverifications_new/?ListDealer");
exit();

        } else {
            echo "Failed to update status.";
        }
    } else {
        echo "Email not found for dealerId: $dealerId";
    }
}

if(isset($_GET['fdRetailerID']) && isset($_GET['newStatus'])) {
    $fdRetailerID = $_GET['fdRetailerID'];
    $newStatus = $_GET['newStatus']; // Assuming 1 is active and 2 is inactive

    // Fetch user's email based on fdRetailerID
    $emailQuery = "SELECT fdEmailAsUserID FROM tbUserMaster WHERE fdRoleUniqueID = '$fdRetailerID'";
    $emailResult = mysqli_query($conn, $emailQuery);
    
    if($emailRow = mysqli_fetch_assoc($emailResult)) {
        $email = $emailRow['fdEmailAsUserID'];
        
        // Update status in database (Example query, adjust as needed)
        $updateQuery = "UPDATE tbUserMaster SET fdStatus = '$newStatus' WHERE fdRoleUniqueID = '$fdRetailerID'";
        if(mysqli_query($conn, $updateQuery)) {
            // Send email if status is set to inactive
            if($newStatus == 0) {
                sendEmail($conn, 5, $email);
            }
            header("Location: /medicineverifications_new/?ListRetailer");
exit();

        } else {
            echo "Failed to update status.";
        }
    } else {
        echo "Email not found for fdRetailerID: $fdRetailerID";
    }
}
?>
