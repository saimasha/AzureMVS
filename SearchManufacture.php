<style>
.dt-button{
    display: none;
}
</style>
<div class="card"> 
<div class="card-body">
<div class="container my-5">
<form method="POST">
<div>
    <h4 class="mb-3 text-white"><strong> ENTER MANUFACTURER ID FOR UPDATE OR DELETE DATA</strong></h4>
    </div>
    <div class="input-group" >
        <input type="text" class="form-control" placeholder="Search  Manufacturer" name="search" required/>
            <div class="input-group-append"> 
                    <button class="btn btn btn-info " name="submit" >Search</button>
                        <!-- <button class="btn btn btn-dark" type="button" name="submit"> Search</button> -->
                    </div>
                    </div>
        </form>
</div> 

<?php

if(isset($_POST['submit'])){
$search = $_POST['search'];

//require ("include/connection.php");

$sql="SELECT * FROM tbManufacturerMaster WHERE fdManufacturerID = '$search'  or fdManufacturerName = '$search' or fdHeadOfficeName = '$search' ";
$result = mysqli_query($conn, $sql);
if($result){
    if(mysqli_num_rows($result)>0){
        // table heading


?>

<div class="container-fluid">
<div class="row">
<div class="col-12">

<div class="table-responsive">
<table id="file_export" class="table table-striped table-bordered display">
<thead style="text-align: center; background: #1e88e566;color: white;">
<tr style="white-space: nowrap;">       
    <th>SI_No</th>                     
    <th>Manufacturer ID</th>
    <th>Manufacturer Name</th>
    <!-- <th>Industry ID</th>
    <th>Group ID</th>
    <th>QR Code Manudfacturer ID</th>
    <th>Hierarchy Level</th>
    <th>Head Office Name</th>
    <th>Head Office Add 1</th>
    <th>Head Office Add 2</th>
    <th>Head Office City</th>
    <th>Head Office State </th>
    <th>Head Office Country</th>
    <th>Head Office Postal Code</th>
    <th>Head Office Phone Number</th>
    <th>Head Office Email</th>
    <th>Highest Authority Name</th>
    <th>Highest Authority Position</th>
    <th>Highest Authority Phone Number</th>
    <th>Highest Authority Email</th>
    <th>Contact Person 1 Name</th>
    <th>Contact Person 1 Phone Number</th>
    <th>Contact Person 1 Email</th>
    <th>Contact Person 2 Name</th>
    <th>Contact Person 2 Phone Number</th>
    <th>Contact Person 2 Email</th>
    <th>Website Url</th>
    <th>Latitude</th>
    <th>Longitude</th>
    <th>Notes</th>  
    <th>Date</th>
    <th>Time</th> -->
    <th>Status</th>
</tr>
</thead>
</div>
<tbody>
<?php
while($rows=mysqli_fetch_assoc($result)) {
// table data
?>
<tr>
    <td><?php echo $rows["fdSlNo"]; ?></td>
    <td><?php echo $rows["fdManufacturerID"]; ?></td>
    <td><?php echo $rows["fdManufacturerName"]; ?></td>
    <!-- <td><?php echo $rows["fdIndustryID"]; ?></td>
    <td><?php echo $rows["fdGroupID"]; ?></td>
    <td><?php echo $rows["fdQRCodeMnfrID"]; ?></td>
    <td><?php echo $rows["fdHierarchyLevel"]; ?></td>
    <td><?php echo $rows["fdHeadOfficeName"]; ?></td>
    <td><?php echo $rows["fdHeadOfficeAddressLine1"]; ?></td>
    <td><?php echo $rows["fdHeadOfficeAddressLine2"]; ?></td>
    <td><?php echo $rows["fdHeadOfficeCity"]; ?></td>
    <td><?php echo $rows["fdHeadOfficeState"]; ?></td>
    <td><?php echo $rows["fdHeadOfficeCountry"]; ?></td>
    <td><?php echo $rows["fdHeadOfficePostalCode"]; ?></td>
    <td><?php echo $rows["fdHeadOfficePhoneNumber"]; ?></td>
    <td><?php echo $rows["fdHeadOfficeEmail"]; ?></td>
    <td><?php echo $rows["fdHighestAuthorityName"]; ?></td>
    <td><?php echo $rows["fdHighestAuthorityPosition"]; ?></td>
    <td><?php echo $rows["fdHighestAuthorityPhoneNumber"]; ?></td>
    <td><?php echo $rows["fdHighestAuthorityEmail"]; ?></td>
    <td><?php echo $rows["fdContactPerson1Name"]; ?></td>
    <td><?php echo $rows["fdContactPerson1PhoneNumber"]; ?></td>
    <td><?php echo $rows["fdContactPerson1Email"]; ?></td>
    <td><?php echo $rows["fdContactPerson2Name"]; ?></td>
    <td><?php echo $rows["fdContactPerson2PhoneNumber"]; ?></td>
    <td><?php echo $rows["fdContactPerson2Email"]; ?></td>
    <td><?php echo $rows["fdWebsiteURL"]; ?></td>                                                          
    <td><?php echo $rows["fdManufacturerLat"]; ?></td>
    <td><?php echo $rows["fdManufacturerLong"]; ?></td>
    <td><?php echo $rows["fdNotes"]; ?></td>                                
    <td><?php echo $rows["fdDate"]; ?></td>
    <td><?php echo $rows["fdTime"]; ?></td> -->
    <td><form method="POST">
        <button type="button"  class="btn btn-info " data-toggle="modal"
            data-target="#top-modal" style="margin-left: 96px;"><i class="fas fa-tasks"></i></button>      
            </form>
    </td>
              
</tr>
<div id="top-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-top">
        <div class="modal-content">
        <div class="modal-header d-flex align-items-center">
            <h3 class="modal-title" id="topModalLabel">Action For Manufacturer ID - <?php echo $rows["fdManufacturerID"]; ?></h3>
            <button type="button" class="close ml-auto" data-dismiss="modal"
                aria-hidden="true">×</button>
        </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 text-center mb-3">
                        <form method="POST">
                            <a href="?UpdateManufacture&mid=<?php echo $rows["fdManufacturerID"]; ?>"><button class="d-inline btn btn-md bg-success text-white EditBtn p-1 m-1 mr-3" name="updatebtn" type="button" style="width:75px;">Update</button></a> 

                            <a href="?ViewManufacture&mid=<?php echo $rows["fdManufacturerID"]; ?>"><button class="d-inline btn btn-md bg-success text-white EditBtn p-1 m-1 mr-3" name="view" type="button" style="width:75px;">View</button></a> 

                            <button name="btnDelete" type="submit" id="btnDelete" value="<?php echo $rows["fdManufacturerID"]; ?>" class="d-inline btn btn-md bg-danger text-white p-1 m-1" style="width:75px;" onclick="return confirmDelete();">Delete</button>
                       
                    <!-- <button value="<?php echo $rows["fdManufacturerID"]; ?>" name="btnDelete" type="submit" class="d-inline btn btn-md bg-danger text-white p-1 m-1" style="width:75px;">Reject</button> -->
                    <!-- </div> -->
                    </form>
                    </div>                                    
                </div>
                </div>

                
            </div>            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
   
      </form>
    </div>
  </div>
</div>

<?php
    }
}else{
    echo'<script> swal.fire({ 
        icon: "error",
        title:"Data Not Found!"
    });
    </script>';
    }
}
}
?>
</tbody>
                    
</table>
    </div>
</div>
</div>
</div>
</div>
</div>
<?php
if(isset($_POST['btnDelete'])){
$manufacturerid = $_POST['btnDelete'];
$sql="DELETE FROM tbManufacturerMaster WHERE fdManufacturerID = '$manufacturerid' ";
if ($result = mysqli_query($conn, $sql)){
    $sql1="DELETE FROM tbUserMaster WHERE fdRoleUniqueID = '$manufacturerid'";
    if($result1 = mysqli_query($conn, $sql1)) {
        echo '<script>
                Swal.fire({ 
                    icon: "success",
                    title: "Deleted Successfully!"
                });
              </script>';
    }
} else {
    echo '<script>
            Swal.fire({ 
                icon: "error",
                title: "Failed to Delete!"
            });
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