<?php
 session_start();
 $RoleUniqueID = $_SESSION['fdRoleUniqueID'];
 $roleid = $_SESSION['fdRoleID'];
require 'include/connection.php';
 
   // $carton_id = $_POST["carton_id"];
   
//   $result = mysqli_query($conn,"SELECT DISTINCT fdPacketID FROM tbPacket WHERE fdManufacturerID = '$RoleUniqueID' ");
//  ?>
 
<!-- // <option value="">Select Packet ID</option> -->
// <?php
//  while($row = mysqli_fetch_array($result)) {
// ?>
   <!-- <option value="<?php echo $row["fdPacketID"];?>"><?php echo $row["fdPacketID"];?></option> -->
<?php
//  }

$sql = "";

if ($roleid === "MNFR"){
    $sql = "SELECT fdManufacturerID FROM tbManufacturerMaster WHERE fdManufacturerID = '$RoleUniqueID'";
} elseif ($roleid === "STKS"){ 
    $sql = "SELECT fdManufacturerID FROM tbStockistMaster WHERE fdStockistID = '$RoleUniqueID'";
} elseif ($roleid === "DSTR"){
    $sql = "SELECT fdManufacturerID FROM tbDistributorMaster WHERE fdDistributorID = '$RoleUniqueID'";
}elseif ($roleid === "DELR"){
    $sql = "SELECT fdManufacturerID FROM tbDealerMaster WHERE fdDealerID = '$RoleUniqueID'";
} else {
    $sql = "SELECT fdManufacturerID FROM tbRetailerMaster WHERE fdRetailerID = '$RoleUniqueID'";
}

$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $manufacturerID = $row['fdManufacturerID'];


    $packetQuery = "SELECT DISTINCT fdPacketID FROM tbPacket WHERE fdManufacturerID = '$manufacturerID'";
    $packetResult = mysqli_query($conn, $packetQuery);

    
    ?>
    <!-- Display options for Packet ID -->
    <option value="">Select Packet ID</option>
    <?php
    while ($packetRow = mysqli_fetch_array($packetResult)) {
        ?>
        <option value="<?php echo $packetRow["fdPacketID"]; ?>"><?php echo $packetRow["fdPacketID"]; ?></option>
        <?php
    }

} else {
    echo "Error fetching manufacturer ID";
}

// Free the result sets
mysqli_free_result($stockistResult);
mysqli_free_result($packetResult);
?>