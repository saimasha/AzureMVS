<?php
session_start();
$RoleUniqueID= $_SESSION['fdRoleUniqueID'] ;
$roleid = $_SESSION['fdRoleID'];

?>
<style>
    .custom-btn {
        height: 25px; /* Adjust the height as needed */
        width: 70px;
    }
</style>
<!-- <div class="container-fluid"> -->
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<!-- File export -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- <div class="card-header"> -->
                <h4 class="card-title">RETAILER LIST</h4>  
            </div> 
            <div class="table-responsive">
                <table id="file_export" class="table table-striped table-bordered display">
                    <!-- added by Saima-->
                    <script>
                        function show(id) {
                            document.getElementById(id).style.display = "block";
                        }
                        function hide(id) {
                            document.getElementById(id).style.display = "none";
                        }
                    </script>
                    <!-- end-->

                    <thead class="bg-info text-white">
                        <tr style="white-space: nowrap;">
                            <th>SI_No</th>
                            <th>Retailer ID</th>
                            <th>Retailer Name</th>
                            <th>Manufacturer ID</th>
                            <th>Dealer ID</th>
                            <th>Time</th>
                            <th>Date</th>
                            <th>Account Status</th> 
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 
                        require ("include/connection.php");
                        $k=1;
                        if ($roleid === "MNFR"){
                            $sql ="SELECT * FROM tbRetailerMaster WHERE fdManufacturerID = '$RoleUniqueID'";
                        } elseif ($roleid === "STKS"){ 
                            $sql ="SELECT * FROM tbRetailerMaster WHERE fdStockistID = '$RoleUniqueID'";
                        } elseif ($roleid === "DSTR"){
                            $sql ="SELECT * FROM tbRetailerMaster WHERE fdDistributorID = '$RoleUniqueID'";
                        } else {
                            $sql ="SELECT * FROM tbRetailerMaster WHERE fdDealerID = '$RoleUniqueID'";
                        }
                        if ($result = mysqli_query($conn, $sql)) {
                            while($rows=mysqli_fetch_assoc($result)) {  
                                ?>  
                                <tr style="white-space: nowrap;">
                                    <td>
                                        <!-- added by Saima-->
                                        <style type="text/css">
                                            .detail-container {
                                                display: none;
                                                position: absolute;
                                                height: 380px;
                                                width: 480px;
                                                z-index: 100;
                                                border: 1px solid black;
                                                /* background-color: #fff; */
                                                margin-left: 50px;
                                                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                                                text-align: center;
                                                overflow:auto;
                                                top: 160px;
                                                left: 60px;
                                            }
                                        </style>
                                        <div onmouseover="show('details<?php echo $k; ?>')" onmouseout="hide('details<?php echo $k; ?>')">
                                            <a href="?ViewRetailer&rid=<?php echo $rows["fdRetailerID"];?>" style="color: #b2b9bf;"><?php echo $k; ?></a>
                                            <div id="details<?php echo $k; ?>" class="detail-container scroll-sidebar">
                                                <table class="table-responsive table table-bordered">
                                                    <tr>
                                                        <th colspan="2" style="text-align: center; background: #007bff; color: white;"> DETAILS </th>
                                                    </tr>
                                                    <tr>
                                                        <th>Distributor ID</th>
                                                        <td><?php echo $rows["fdDistributorID"]; ?></td>
                                                    </tr>
                                                    <tr>
                <th>Stockist ID</th>
                <td><?php echo $rows["fdStockistID"]; ?></td>
            </tr>
            <tr>
                <th>Head Office Name</th>
                <td><?php echo $rows["fdHeadOfficeName"]; ?></td>
            </tr>
            <tr>
                <th>Head Office Add 1</th>
                <td><?php echo $rows["fdHeadOfficeAddressLine1"]; ?></td>
            </tr>
            <tr>
                <th>Head Office Add 2</th>
                <td><?php echo $rows["fdHeadOfficeAddressLine2"]; ?></td>
            </tr>
            
            
            
            <tr>
                <th>Head Office Postal Code</th>
                <td><?php echo $rows["fdHeadOfficePostalCode"]; ?></td>
            </tr>
            <tr>
                <th>Head Office Phone Number</th>
                <td><?php echo $rows["fdHeadOfficePhoneNumber"]; ?></td>
            </tr>
            <tr>
                <th>Head Office Email</th>
                <td><?php echo $rows["fdHeadOfficeEmail"]; ?></td>
            </tr>
            <tr>
                <th>Owner Name</th>
                <td><?php echo $rows["fdOwnerName"]; ?></td>
            </tr>
            <tr>
                <th>Owner Phone Number</th>
                <td><?php echo $rows["fdOwnerPhoneNumber"]; ?></td>
            </tr>
            <tr>
                <th>Owner Email</th>
                <td><?php echo $rows["fdOwnerEmail"]; ?></td>
            </tr>
            <tr>
                <th>Contact Person 1 Name</th>
                <td><?php echo $rows["fdContactPerson1Name"]; ?></td>
            </tr>
            <tr>
                <th>Contact Person 1 Phone Number</th>
                <td><?php echo $rows["fdContactPerson1PhoneNumber"]; ?></td>
            </tr>
            <tr>
                <th>Contact Person 1 Email</th>
                <td><?php echo $rows["fdContactPerson1Email"]; ?></td>
            </tr>
            <tr>
                <th>Contact Person 2 Name</th>
                <td><?php echo $rows["fdContactPerson2Name"]; ?></td>
            </tr>
            <tr>
                <th>Contact Person 2 Phone Number</th>
                <td><?php echo $rows["fdContactPerson2PhoneNumber"]; ?></td>
            </tr>
            <tr>
                <th>Contact Person 2 Email</th>
                <td><?php echo $rows["fdContactPerson2Email"]; ?></td>
            </tr>
            <tr>
                <th>Website Url</th>
                <td><?php echo $rows["fdWebsiteURL"]; ?></td>
            </tr>
            <tr>
                <th>Latitude</th>
                <td><?php echo $rows['fdRetailerLat'];?></td>
            </tr>
            <tr>
                <th>Longitude</th>
                <td><?php echo $rows['fdRetailerLong'];?></td>
            </tr>
            <tr>
                <th>Notes</th>
                <td><?php echo $rows["fdNotes"]; ?></td>
            </tr>
                                                    <!-- Add more details here as needed -->
                                                </table>
                                            </div>
                                        </div>
                                        <!-- end-->
                                    </td>
                                    <td><?php echo $rows['fdRetailerID'];?></td>
                                    <td><?php echo $rows['fdRetailerName'];?></td>
                                    <td><?php echo $rows['fdManufacturerID'];?></td>
                                    <td><?php echo $rows['fdDealerID'];?></td>
                                    <td><?php echo $rows["fdTime"]; ?></td>
                                    <td><?php echo $rows["fdDate"]; ?></td>
                                    <td style="color: <?php echo getStatusColor($rows['fdRetailerID'], $conn); ?>;">
                <?php echo getStatusButton($rows['fdRetailerID'], $conn); ?>
            </td>
                                    <td>
                                        <form method="POST" class="d-flex justify-contain-center">
                                            <button name="deletebtn" id="deletebtn" value="<?php echo $rows['fdRetailerID'];?>" class="d-inline btn btn-sm text-white p-1 m-1" type="submit" onclick="return confirmDelete();" style="background-color: #b60d0df7;"><i class="bi bi-trash-fill"></i></button>
                                            <a href="?UpdateRetailer&rid=<?php echo $rows['fdRetailerID'];?>"><button class="d-inline btn btn-sm text-white EditBtn p-1 m-1" name="updatebtn" id="updatebtn" type="button" style="background-color: #044d0b;"><i class="bi bi-pencil-square"></i></button></a>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                $k++;
                            }
                        }
                        ?>
                    </tbody>                                
                </table>
            </div>
        </div>
    </div>
</div>
<?php
function getStatusColor($fdRetailerID, $conn) {
    $sql = "SELECT fdStatus FROM tbUserMaster WHERE fdRoleUniqueID = '$fdRetailerID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['fdStatus'] == 1 ? 'green' : 'red';
}
   
function getStatusButton($fdRetailerID, $conn) {
    $sql = "SELECT fdStatus, fdEmailAsUserID FROM tbUserMaster WHERE fdRoleUniqueID = '$fdRetailerID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($result && mysqli_num_rows($result) > 0) {
   // Part of your existing code where you generate the status button
        if ($row['fdStatus'] == 1) {
            // Active status display, adjust as needed
            echo '<div class="text-center"><button class="btn btn-sm text-white custom-btn" disabled style="background-color: #044d0b;">Active</button></div>';
        } else {
            // Link to make user active again or send an email when making inactive
            echo '<div class="text-center"><a href="updateStatus.php?fdRetailerID=' . $fdRetailerID . '&newStatus=0" class="btn btn-sm text-white custom-btn" style="background-color: #b60d0df7;" onclick="return confirm(\'Are you sure you want to make this user active? Send Email\');">Resend Email</a></div>';
        }
    } else {
        echo '<div class="text-center"><a href="updateStatus.php?fdRetailerID=' . $fdRetailerID . '&newStatus=0" class="btn btn-sm text-white custom-btn" style="background-color: #b60d0df7;" onclick="return confirm(\'Are you sure you want to make this user active? Send Email\');">Resend Email</a></div>';
    }
}
?>
<?php
if(isset($_POST['deletebtn'])){
    $rid =$_POST['deletebtn'];
    $deleteSql= "DELETE FROM tbRetailerMaster WHERE fdRetailerID = '$rid'";

    if ($result = mysqli_query($conn, $deleteSql)){
        $sql1="DELETE FROM tbUserMaster WHERE fdRoleUniqueID = '$rid'";
        if($result1 = mysqli_query($conn, $sql1)) {

        echo '<script>Swal.fire({ 
            icon: "success",
            title:"Deleted Successfully!"
            }).then(function(){
            window.location = "?ListRetailer";
            });
            </script>';  
        }    
    } else {
        echo'<script>Swal.fire({ 
            icon: "error",
            title:"Failed  to Delete !"});
            </script>';
    }  
}
?>

<script>
    function confirmDelete() {
        // Display a confirmation dialog
        var confirmation = confirm("Do you want to delete this record?");
        
        // If user confirms, return true to allow form submission
        if (confirmation) {
            return true;
        } else {
            // If user cancels, return false to prevent form submission
            return false;
        }
    }
</script>