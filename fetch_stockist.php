<?php
// Include your database connection file here
require_once "include/connection.php";


// Check if the manufacturerId is set in the POST request
if (isset($_POST['manufacturerId'])) {
    $manufacturerId = $_POST['manufacturerId'];

    // Escape the input to prevent SQL injection
    $manufacturerId = mysqli_real_escape_string($conn, $manufacturerId);

    // Query to fetch Stockist options
    $query = "SELECT * FROM tbStockistMaster WHERE fdManufacturerID = '$manufacturerId'";
    
    // Perform the query
    $result = mysqli_query($conn, $query);

    // Check for errors in the query
    if (!$result) {
        die('Error: ' . mysqli_error($conn));
    }

    // Create options based on the result
    $options = '<option selected value="0">Select Stockist ID</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= '<option value="' . $row["fdStockistID"] . '">' . $row["fdStockistID"] . '</option>';
    }

    // Free the result set
    mysqli_free_result($result);

    // Close the connection
    //mysqli_close($conn);

    // Return the options
    echo $options;
} else {
    // Handle the case where manufacturerId is not set
    echo '<option value="0">Error: Manufacturer ID not set</option>';
}
?>