<?php
 session_start();
 $RoleUniqueID = $_SESSION['fdRoleUniqueID'];
 $roleid = $_SESSION['fdRoleID'];
require 'include/connection.php';
 

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

    $Query = "SELECT fdStripID FROM tbMedicineStripTest WHERE  fdManufacturerID = '$manufacturerID'";
    $Result = mysqli_query($conn,$Query);

 ?>
 
<option value="0">Select Strip ID</option>
<?php
 while($row1 = mysqli_fetch_array($Result)) {
?>
    <option value="<?php echo $row1["fdStripID"];?>"><?php echo $row1["fdStripID"];?></option>
    <?php
 }
} else {
    echo "Error fetching manufacturer ID";
}
?>