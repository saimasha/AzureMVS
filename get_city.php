<?php
require "include/connection.php";


$state_id = $_POST["state_id"];

$result = mysqli_query($conn, "SELECT * FROM tbCities WHERE state_id = $state_id");

if (mysqli_num_rows($result) > 0) {
    echo '<option value="">Select City</option>';
    while ($row = mysqli_fetch_array($result)) {
        echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
    }
} else {
    echo '<option value="">No cities found</option>';
}


?>
