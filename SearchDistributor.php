<?php
session_start();
$RoleUniqueID=$_SESSION['fdRoleUniqueID'] ;
$roleid = $_SESSION['fdRoleID'];
?>
<style>
  .dt-button{
    display:none;
}
</style>
<div class="card" > 
    <div class="card-body" >
         <div class="container my-5" >
           <div >
             <h4 class="card-title mb-3 text-white"><strong>ENTER DISTRIBUTOR ID FOR UPDATE OR DELETE DATA</strong></h4>
            </div>
            <form method="POST">
             <div class="input-group">
            <input type="text" class="form-control" placeholder="Search Distributor" name="search" required/>
                <div class="input-group-append"> 
                        <button class="btn btn btn-info" name="submit" >Search</button>       
                        </div>
                    </div>
            </form>
             </div>
    <?php
        if(isset($_POST['submit'])){
            $search = $_POST['search'];

            require ("include/connection.php");

            // $sql="SELECT * FROM tbDistributorMaster WHERE fdDistributorID = '$search'  or fdDistributorName = '$search' or fdHeadOfficeName ='$search' ";
            if ($roleid === "MNFR"){
               $sql ="SELECT * FROM tbDistributorMaster WHERE (fdDistributorID = '$search' OR fdDistributorName = '$search' OR fdHeadOfficeName='$search') AND fdManufacturerID = '$RoleUniqueID'";
            } elseif ($roleid === "STKS"){ 
              
                $sql ="SELECT * FROM tbDistributorMaster WHERE (fdDistributorID = '$search' OR fdDistributorName = '$search' OR fdHeadOfficeName='$search') AND fdStockistID = '$RoleUniqueID'";
            } 
            $result = mysqli_query($conn, $sql);
            if($result){
                if(mysqli_num_rows($result)>0){
                    // table heading
    ?>
    
<div class="row">
    <div class="col-12">
      <div class="card">
                <div class="card-body"> 
                   <div class="table-responsive">
                    <table id="file_export" class="table table-striped table-bordered display">
                        <thead style="text-align: center; background: #1e88e566;color: white;">
                            <tr style="white-space: nowrap;">
                                <th>SI_No</th>
                                <th>Distributor ID</th>
                                <th>Distributor Name</th>
                                <!-- <th>Manudfacturer ID</th>
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
                                <th>Owner Name</th>
                                <th>Owner Phone Number</th>
                                <th>Owner Email</th>
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
                                        <td><?php echo $rows["fdSlNo"]; ?> </td>
                                        <td><?php echo $rows["fdDistributorID"]; ?> </td>
                                        <td><?php echo $rows["fdDistributorName"]; ?> </td>
                                        <!-- <td><?php echo $rows["fdManufacturerID"]; ?></td>
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
                                        <td><?php echo $rows["fdOwnerName"]; ?></td>
                                        <td><?php echo $rows["fdOwnerPhoneNumber"]; ?></td>
                                        <td><?php echo $rows["fdOwnerEmail"]; ?></td>
                                        <td><?php echo $rows["fdContactPerson1Name"]; ?></td>
                                        <td><?php echo $rows["fdContactPerson1PhoneNumber"]; ?></td>
                                        <td><?php echo $rows["fdContactPerson1Email"]; ?></td>
                                        <td><?php echo $rows["fdContactPerson2Name"]; ?></td>
                                        <td><?php echo $rows["fdContactPerson2PhoneNumber"]; ?></td>
                                        <td><?php echo $rows["fdContactPerson2Email"]; ?></td>
                                        <td><?php echo $rows["fdWebsiteURL"]; ?></td>
                                        <td><?php echo $rows["fdDistrLat"]; ?></td>
                                        <td><?php echo $rows["fdDistrLong"]; ?></td>
                                        <td><?php echo $rows["fdNotes"]; ?></td>
                                        <td><?php echo $rows["fdDate"]; ?></td>
                                        <td><?php echo $rows["fdTime"]; ?></td> -->
                                        <td >
                                        <form method="POST" class="d-flex justify-contain-center">
                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#top-modal" style="margin-left:60px;"><i class="fas fa-tasks"></i></button>     
                                  </form>       
                                </td>
                                    </tr> 
                                <!-- Top modal content --> 
                                <div id="top-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-top">
                                        <div class="modal-content">
                                            <div class="modal-header d-flex align-items-center">
                                                <h4 class="modal-title" id="topModalLabel">Action For Distributor ID - <?php echo $rows["fdDistributorID"]; ?></h4>
                                                <button type="button" class="close ml-auto" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                        <div class="modal-body">
                                            <div class="row" >  
                                                <div class="col-sm-12 text-center mr-3">
                                                <form method="POST"  class="d-flex justify-content-center flex-wrap">
                                                    <a  href="?UpdateDistributor&did=<?php echo $rows["fdDistributorID"];?>"><button  class="d-inline btn btn-md btn-rounded btn-success text-white EditBtn p-1 m-1 mr-3" name="BtnEdit" type="button" style="width:75px;">Update </button></a>

                                                    <a  href="?ViewDistributor&did=<?php echo $rows["fdDistributorID"];?>"><button  class="d-inline btn btn-md btn-rounded bg-success text-white EditBtn p-1 m-1 mr-3" name="View" type="button" style="width:75px;">View</button></a>
                                        
                                                     <button  type="submit" value="<?php echo $rows["fdDistributorID"]; ?>" name="btnDelete" id="btnDelete" class="d-inline btn btn-md btn-rounded bg-danger text-white p-1 m-1"  style="width:75px;" onclick="return confirmDelete();" >Delete</button>        
                                                     
                                                   
                                                     <!-- <button value="" name="Reject" class="d-inline btn btn-md btn-rounded bg-danger text-white p-1 m-1" type="submit" style="width:75px;">Reject</button>       -->
                                             
                                           </form>
                                            </div>
                                            </div>
                                            </div>
                                         
                                            <!-- </div> -->
                                            <!-- <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
<?php

                }
            }else{
                echo'<script>Swal.fire({ 
                    icon: "error",
                    title:"Data Not FOUND!",
                    text: "Please Enter Valid Distributor ID or Name "
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
 <!-- </div>   -->


<?php
    if(isset($_POST['btnDelete'])){

    $Distributorid = $_POST['btnDelete'];
    $sql="DELETE FROM tbDistributorMaster WHERE fdDistributorID = '$Distributorid' ";
    if ($result = mysqli_query($conn, $sql)){
        $sql1="DELETE FROM tbUserMaster WHERE fdRoleUniqueID = '$Distributorid'";
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





























































































