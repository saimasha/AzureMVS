<?php
session_start();
$RoleUniqueID=$_SESSION['fdRoleUniqueID'] ;
require("function.php");
?>

<style>
    .custom-btn {
        height: 25px; /* Adjust the height as needed */
        width: 70px;
    }
</style>
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- File export -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-body">
                <h4 class="card-title">STOCKIST LIST</h4>
            </div>
                        
                        <div class="table-responsive">
                            <table id="file_export" class="table table-striped table-bordered display">

                            <!-- addded by Saima-->
                            <script>
                            function show(id) {
                                var NewName='NewName'+id;
                                document.getElementById(NewName).style.visibility = "visible";
                            }
                            function hide(id) {
                                var NewName='NewName'+id;
                                document.getElementById(NewName).style.visibility = "hidden";
                            }
                            </script>
                                                    <!-- end-->

                                <thead class="bg-info text-white">
                                    <tr style="white-space: nowrap;">
                                        
                                        <th>Sl_No</th>
                                        <th>Stockist ID</th>
                                        <th>Stockist Name</th>
                                        <th>Manufacturer ID</th>
                                        <th>Warehouse ID</th>
                                        <th>Date</th>
                                        
                                        <th>Account Status</th> 
                                        <th>Status</th>
                                        <!-- <th>Image</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php 
                        require ("include/connection.php");
                        $k=1;
                        if ($roleid === "MNFR"){
                            $sql ="SELECT * FROM tbStockistMaster WHERE fdManufacturerID = '$RoleUniqueID'";
                        } 
                        if ($result = mysqli_query($conn, $sql)) {
                            while($rows=mysqli_fetch_assoc($result)) {  
                                ?>  
                                
                                <tr style="white-space: nowrap;">
                                <td>
                                                             <!-- addded by Saima ma'am-->

                            <style type="text/css">
                      #NewNamehide<?php echo $k; ?> {  
                        visibility: hidden; 
                         position:absolute;
                          height:300px;
                          width:480px;
                          z-index:100;
                          border: black;
                          /* border-radius:40px; */
                          margin-left: 50px;
                      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                      text-align: center;
                      overflow: auto;
                      top: 200px;
                      left:50px;
                         
                      }
                    </style>
                    <div  onMouseOver="show('hide<?php echo $k; ?>')" onMouseOut="hide('hide<?php echo $k; ?>')">
                    <a  href="?ViewStockist&sid=<?php echo $rows["fdStockistID"];?>" style="color: #b2b9bf;"><?php echo $k; ?>
                    </a>
                    
    <div id="NewNamehide<?php echo $k; ?>" class="scroll-sidebar">
    <table class="table-responsive table table-bordered">
      <tr><th colspan="2" style="text-align: center; background: #007bff;color: white;"> DETAILS </th></tr>
                    </tr><th>Time</th><td><?php echo $rows["fdTime"]; ?></td></tr>

                            <tr><th>Head Office Name</th><td><?php echo $rows["fdHeadOfficeName"]; ?></td></tr>
                            <tr><th>Head Office Add 1</th><td><?php echo $rows["fdHeadOfficeAddressLine1"]; ?></td></tr>
                            <tr><th>Head Office Add 2</th><td><?php echo $rows["fdHeadOfficeAddressLine2"]; ?></td></tr>
                            
                            
                                 
                            <tr><th>Head Office Postal Code</th><td><?php echo $rows["fdHeadOfficePostalCode"]; ?></td></tr>            
                            <tr><th>Head Office Phone Number</th><td><?php echo $rows["fdHeadOfficePhoneNumber"]; ?></td></tr>        
                            <tr><th>Head Office Email</th><td><?php echo $rows["fdHeadOfficeEmail"]; ?></td></tr>
                            <tr><th>Owner Name</th><td><?php echo $rows["fdOwnerName"]; ?></td></tr>            
                            <tr><th>Owner Phone Number</th><td><?php echo $rows["fdOwnerPhoneNumber"]; ?></td></tr>
                            <tr><th>Owner Email</th><td><?php echo $rows["fdOwnerEmail"]; ?></td></tr>          
                            <tr><th>Contact Person 1 Name</th><td><?php echo $rows["fdContactPerson1Name"]; ?></td></tr>          
                            <tr><th>Contact Person 1 Phone Number</th><td><?php echo $rows["fdContactPerson1PhoneNumber"]; ?></td></tr>            
                            <tr><th>Contact Person 1 Email</th><td><?php echo $rows["fdContactPerson1Email"]; ?></td></tr>
                            <tr><th>Contact Person 2 Name</th><td><?php echo $rows["fdContactPerson2Name"]; ?></td></tr>           
                            <tr><th>Contact Person 2 Phone Number</th><td><?php echo $rows["fdContactPerson2PhoneNumber"]; ?></td></tr>                                       
                            <tr><th>Contact Person 2 Email</th><td><?php echo $rows["fdContactPerson2Email"]; ?></td></tr>                                   
                            <tr><th>Website Url</th><td><?php echo $rows["fdWebsiteURL"]; ?></td></tr>                                        
                            <tr><th>Notes</th><td><?php echo $rows["fdNotes"]; ?></td></tr>
                            <tr><th>Latitude</th><td><?php echo $rows["fdStockistLat"]; ?></td></tr>                                        
                            <tr><th>Longitude</th><td><?php echo $rows["fdStockistLong"]; ?></td></tr>
                            
                            
    </table>
  </div> 
</div>
                        <!-- end-->
                        </td>
                                        
                                        <td><?php echo $rows["fdStockistID"]; ?></td>
                                        <td><?php echo $rows["fdStockistName"]; ?></td>
                                        
                                        <td><?php echo $rows["fdManufacturerID"]; ?></td>
                                        <td><?php echo $rows["fdWareHouseID"]; ?></td>
                                        
                                        <td><?php echo $rows["fdDate"]; ?></td>
                                        
                                        <td style="color: <?php echo getStatusColor($rows['fdStockistID'], $conn); ?>;">
                <?php echo getStatusButton($rows['fdStockistID'], $conn); ?>
            </td>
                                        <td> 
                                        <form method="POST" class="d-flex justify-contain-center">
                                        <button value="<?php echo $rows["fdStockistID"]; ?>" name="btnDelete" id="btnDelete" class="d-inline btn btn-sm text-white m-1" type="submit" onclick="return confirmDelete();" style="background-color: #b60d0df7;"><i class="bi bi-trash-fill"></i></button>       
                                        <a href="?UpdateStockist&sid=<?php echo $rows["fdStockistID"]; ?>"><button class="d-inline btn btn-sm text-white EditBtn m-1" name="UpdBtn" type="button" style="background-color: #044d0b;"><i class="bi bi-pencil-square"></i></button></a>  
                                        </td>
                                        
                                        <!-- <td> <img class="rounded" src="<?php echo $rows["fdProductImage"];?>" style="height:50px;width:50px;"/></td> -->
    
                                        </form>
                                        
                                    </tr>
                                    <?php
                                    $k++;

                                }
                                }?>
                                
<?php
function getStatusColor($stockistID, $conn) {
    $sql = "SELECT fdStatus FROM tbUserMaster WHERE fdRoleUniqueID = '$stockistID'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['fdStatus'] == 1 ? 'green' : 'red';
    } else {
        // Handle if no rows are found or if the query fails
        return 'red'; // Default to red color or handle as needed
    }
}
   
function getStatusButton($stockistID, $conn) {
    $sql = "SELECT fdStatus, fdEmailAsUserID FROM tbUserMaster WHERE fdRoleUniqueID = '$stockistID'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['fdStatus'] == 1) {
            // Active status display
            echo '<div class="text-center"><button class="btn btn-sm text-white custom-btn" disabled style="background-color: #044d0b;">Active</button></div>';
        } else {
            // Inactive status display
            echo '<div class="text-center"><a href="updateStatus.php?stockistID=' . $stockistID . '&newStatus=0" class="btn btn-sm text-white custom-btn" style="background-color: #b60d0df7;" onclick="return confirm(\'Are you sure you want to make this user active? Send Email\');">Resend Email</a></div>';
        }
    } else {
        // If the status is not available or if there's an error fetching it
        echo '<div class="text-center"><a href="updateStatus.php?stockistID=' . $stockistID . '&newStatus=0" class="btn btn-sm text-white custom-btn" style="background-color: #b60d0df7;" onclick="return confirm(\'Are you sure you want to make this user active? Send Email\');">Resend Email</a></div>';
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
    if(isset($_POST['btnDelete'])){
        $stockistid = $_POST['btnDelete'];
        $sql="DELETE FROM tbStockistMaster WHERE fdStockistID = '$stockistid'";
        if ($result = mysqli_query($conn, $sql)){
            $sql1="DELETE FROM tbUserMaster WHERE fdRoleUniqueID = '$stockistid'";
            if($result1 = mysqli_query($conn, $sql1)) {
        echo'<script>
        swal.fire({
            icon: "success",
            title: "Delete successfully!.." 
          }).then(function(){
            window.location="?ListStockist";
          });
          </script>';
            }
    }else
            {
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