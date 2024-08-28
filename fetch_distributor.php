<?php
require_once "include/connection.php";
if (isset($_POST['stockistId'])) {
    $stockistId = $_POST['stockistId'];
    $stockistId = mysqli_real_escape_string($conn, $stockistId);
    $query = "SELECT * FROM tbDistributorMaster WHERE fdStockistID = '$stockistId'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die('Error: ' . mysqli_error($conn));
    }
    $options = '<option selected value="0">Select Distributor ID</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= '<option value="' . $row["fdDistributorID"] . '">' . $row["fdDistributorID"] . '</option>';
    }
    mysqli_free_result($result);
    echo $options;
} else {
    echo '<option value="0">Error: Stockist ID not set</option>';
}
?>