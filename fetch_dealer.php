<?php
// Include your database connection file here
require_once "include/connection.php";

// Check if the stockistId is set in the POST request
if (isset($_POST['distributorID'])) {
    $distributorID = $_POST['distributorID'];

    // Escape the input to prevent SQL injection
    $distributorID = mysqli_real_escape_string($conn, $distributorID);

    
    $query = "SELECT * FROM tbDealerMaster WHERE fdDistributorID = '$distributorID'";
    
    // Perform the query
    $result = mysqli_query($conn, $query);

    // Check for errors in the query
    if (!$result) {
        die('Error: ' . mysqli_error($conn));
    }

    // Create options based on the result
    $options = '<option selected value="0">Select Dealer ID</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= '<option value="' . $row["fdDealerID"] . '">' . $row["fdDealerID"] . '</option>';
    }

    // Free the result set
    mysqli_free_result($result);

    // Close the connection
    //mysqli_close($conn);

    // Return the options
    echo $options;
} else {
    // Handle the case where stockistId is not set
    echo '<option value="0">Error: Distributor ID not set</option>';
}
?>