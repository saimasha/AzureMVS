<?php
session_start();
$RoleUniqueID=$_SESSION['fdRoleUniqueID'] ;
?>
<style>
  .dt-button{
    display:none;
  }
</style>
<div class="card"> 
<div class="card-body" >
<div class="container my-5">
 <div>
                <h4 class="card-title mb-3 text-white"><strong>ENTER STOCKIST ID FOR UPDATE OR DELETE DATA</strong></h4>
</div>


<form method="POST">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search Stockist" name="search" required/>
            <div class="input-group-append"> 
                <button class="btn btn btn-info " name="submit" >Search</button>
                            <!-- <button class="btn btn btn-dark" type="button" name="submit"> Search</button> -->
            </div>
       </div>
</form>
</div>
    <!-- <hr> -->
    
    <?php
        
        if(isset($_POST['submit'])){
            $search = $_POST['search'];
            

            //require ("config.php");

            // $sql="SELECT * FROM tbStockistMaster WHERE fdStockistID = '$search'  or fdStockistName = '$search' or fdHeadOfficeName='$search' ";
            $sql = "SELECT * FROM tbStockistMaster WHERE (fdStockistID = '$search' OR fdStockistName = '$search' OR fdHeadOfficeName='$search') AND fdManufacturerID = '$RoleUniqueID'";
                                $result = mysqli_query($conn, $sql);
            if($result){
                if(mysqli_num_rows($result)>0){
                    // table heading
                    ?>
                    <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                            <table id="file_export" class="table table-striped table-bordered display">
                            <thead style="text-align: center; background: #1e88e566;color: white;">
                                <tr style="white-space: nowrap;">
                                    <th>No</th>
                                    <th>Stockist ID</th>
                                    <th>Stockist Name</th>
                                    <!-- <th>Head Office Name</th>
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
                                    <th>Notes</th> -->
                                    <th>Manufacturer ID</th>
                                    <th>Warehouse ID</th>
                                    <!-- <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Date</th>
                                    <th>Time</th>  -->
                                    <th>Action</th>
                                            
                                </tr>
                            </thead>
                        </div>
                    <tbody>
                                <?php
                                while($rows=mysqli_fetch_assoc($result)) {
                                    // table data
                                    ?><tr>
                                    <td><?php echo $rows["fdSlNo"]; ?></td>
                                    <td><?php echo $rows["fdStockistID"]; ?></td>
                                    <td><?php echo $rows["fdStockistName"]; ?></td>
                                    <td><?php echo $rows["fdManufacturerID"]; ?></td>
                                    <td><?php echo $rows["fdWareHouseID"]; ?></td>
                                    <td><form method="POST" class="d-flex justify-contain-center">
                                    <button type="button" class="btn btn-info " style="margin-left:33px;" data-toggle="modal"
                                        data-target="#top-modal"><i class="fas fa-tasks"></i></button>      
                                        </form>
                                </td>

                                </tr>
                                <!-- Top modal content -->
                                <div id="top-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-top">
        <div class="modal-content">
        <div class="modal-header d-flex align-items-center">
            <h3 class="modal-title" id="topModalLabel">Action For Stockist ID - <?php echo $rows["fdStockistID"]; ?></h3>
            <button type="button" class="close ml-auto" data-dismiss="modal"
                aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
         <div class="row">
        <div class="col-lg-12 text-center mb-3">
            <form method="POST" class="d-flex justify-content-center flex-wrap">
                <a href="?UpdateStockist&sid=<?php echo $rows["fdStockistID"]; ?>">
                    <button class="d-inline btn btn-md bg-success text-white EditBtn p-1 m-1 mr-3" name="updatebtn" type="button" style="width:75px;">Update</button>
                </a>
                <a href="?ViewStockist&sid=<?php echo $rows["fdStockistID"]; ?>">
                    <button class="d-inline btn btn-md bg-success text-white EditBtn p-1 m-1 mr-3" name="updatebtn" type="button" style="width:75px;">View</button>
                </a>
                <button name="btnDelete" type="submit" id="btnDelete" value="<?php echo $rows["fdStockistID"]; ?>" class="d-inline btn btn-md bg-danger text-white p-1 m-1" style="width:75px;" onclick="return confirmDelete();">Delete</button>
              
                <!-- <button value="<?php echo $rows["fdStockistID"]; ?>" name="btnDelete" type="submit" class="d-inline btn btn-md bg-danger text-white p-1 m-1" style="width:75px;">Reject</button> -->
            </form>
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


    <?php
    if(isset($_POST['btnDelete'])){
    $stockistid = $_POST['btnDelete'];
    $sql="DELETE FROM tbStockistMaster WHERE fdStockistID = '$stockistid'";
    if ($result = mysqli_query($conn, $sql)){
        $sql1="DELETE FROM tbUserMaster WHERE fdRoleUniqueID = '$stockistid'";
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