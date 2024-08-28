<?php
// require("../include/connection.php");

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $email = mysqli_real_escape_string($conn, $_POST['email']);
//     $sql = "SELECT * FROM tbUserMaster WHERE fdEmailAsUserID='$email'";
//     $result = mysqli_query($conn, $sql);

//     if (mysqli_num_rows($result) > 0) {
//         // Email exists in the database
//         echo "exists";
//     } else {
//         // Email doesn't exist in the database
//         echo "available";
//     }
// }

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $email = mysqli_real_escape_string($conn, $_POST['email']);
//     $sql = "SELECT * FROM tbCustomerMaster WHERE fdEmailAsUserID='$email'";
//     $result = mysqli_query($conn, $sql);

//     if (mysqli_num_rows($result) > 0) {
//         // Email exists in the database
//         echo "exists";
//     } else {
//         // Email doesn't exist in the database
//         echo "available";
//     }
// }
?>

<?php
require("../include/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['email']) && isset($data['action'])) {
        $email = mysqli_real_escape_string($conn, $data['email']);
        $action = $data['action'];
        
        $table = "";
        switch ($action) {
            case 'register':
                $table = "tbUserMaster";
                break;
            case 'Cregister':
                $table = "tbCustomerMaster";
            default:
                echo json_encode(['error' => 'Invalid action']);
                exit();
        }
        
        $stmt = $conn->prepare("SELECT COUNT(*) FROM $table WHERE fdEmailAsUserID = ?");
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

