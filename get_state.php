<?php
require "include/connection.php";

$country_id = $_POST["country_id"];

$result = mysqli_query($conn, "SELECT * FROM tbStates WHERE country_id = $country_id");

if (mysqli_num_rows($result) > 0) {
    echo '<option value="">Select State</option>';
    while ($row = mysqli_fetch_array($result)) {
        echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
    }
} else {
    echo '<option value="">No states found</option>';
}

?>
