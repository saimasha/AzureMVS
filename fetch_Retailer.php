<?php
require_once "include/connection.php";

if (isset($_POST['dealerID'])) {
    $dealerID = $_POST['dealerID'];
    $dealerID = mysqli_real_escape_string($conn, $dealerID);
    $query = "SELECT * FROM tbRetailerMaster WHERE fdDealerID = '$dealerID'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die('Error: ' . mysqli_error($conn));
    }

    $options = '<option selected value="0">Select Retailer ID</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= '<option value="' . $row["fdRetailerID"] . '">' . $row["fdRetailerID"] . '</option>';
    }

    mysqli_free_result($result);

    echo $options;
} else {
    echo '<option value="0">Error: Retailer ID not set</option>';
}
?>