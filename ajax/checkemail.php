<?php
require("../include/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['email']) && isset($data['action'])) {
        $email = mysqli_real_escape_string($conn, $data['email']);
        $action = $data['action'];
        
        $table = "";
        switch ($action) {
            case 'createStockist':
                $table = "tbStockistMaster";
                break;
            case 'createDistributor':
                $table = "tbDistributorMaster";
                break;
            case 'createDealer':
                $table = "tbDealerMaster";
                break;
            case 'createRetailer':
                $table = "tbRetailerMaster";
                break;
            default:
                echo json_encode(['error' => 'Invalid action']);
                exit();
        }
        
        $stmt = $conn->prepare("SELECT COUNT(*) FROM $table WHERE fdOwnerEmail = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        
        if ($count > 0) {
            echo json_encode(['exists' => true]);
        } else {
            echo json_encode(['exists' => false]);
        }
    } else {
        echo json_encode(['error' => 'Invalid request']);
    }

    $conn->close();
}
?>
