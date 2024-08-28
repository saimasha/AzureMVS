<style>
  .dt-button{
    display:none;
  }
</style>

<div class="card"> 
   <div class="card-body" >
      <div class="container my-5">
         <!-- <form method="POST"> -->
         <!-- <div> -->
         <!-- <div class="card-header bg-info"> -->
         <div >
            <h4 class="card-title mb-3 text-white"><strong> ENTER DEALER ID FOR UPDATE OR DELETE DATA</strong></h4>
         </div>

         <!-- <div class="container my-5">  -->
<form method="POST">
       <div class="input-group">
        <input type="text" class="form-control" placeholder="Search Dealer" name="search" required/>
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
            
           require ("include/connection.php");
           $k=1;
           if ($roleid === "MNFR"){
         
            $sql ="SELECT * FROM tbDealerMaster WHERE (fdDealerID = '$search' OR fdDealerName = '$search' OR fdHeadOfficeName='$search') AND fdManufacturerID = '$RoleUniqueID'";
            }elseif ($roleid === "STKS"){ 
            $sql ="SELECT * FROM tbDealerMaster WHERE (fdDealerID = '$search' OR fdDealerName = '$search' OR fdHeadOfficeName='$search') AND fdStockistID = '$RoleUniqueID'";
            }else{
            $sql ="SELECT * FROM tbDealerMaster WHERE (fdDealerID = '$search' OR fdDealerName = '$search' OR fdHeadOfficeName='$search') AND fdDistributorID = '$RoleUniqueID'";

            }
        //    $sql="SELECT * FROM tbDealerMaster WHERE  fdDealerName = '$search' or fdDealerID = '$search' or  fdHeadOfficeName = '$search' ";
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
                                        <th>SI_No</th>
                                        <th>Dealer ID</th>
                                        <th>Dealer Name</th>
                                        <th>Manufacture ID</th>
                                        <!-- <th>Distributor ID</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th>Date</th>
                                        <th>Time</th> -->
                                        <th>Action</th>
                                        
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
                    <td><?php echo $rows["fdDealerID"]; ?></td>
                    <td><?php echo $rows["fdDealerName"]; ?></td>
                    <td><?php echo $rows["fdManufacturerID"]; ?></td>
                    <!-- <td><?php echo $rows["fdDistributorID"]; ?></td> -->
                    <!-- <td><?php echo $rows["fdDealerLat"]; ?></td>
                    <td><?php echo $rows["fdDealerLong"]; ?></td>
                    <td><?php echo $rows["fdDate"]; ?></td>
                    <td><?php echo $rows["fdTime"]; ?></td> -->
                    <td>
                    <form method="POST" class="d-flex justify-contain-center">
                    <button type="button" class="btn btn-info" style="margin-left:30px;" data-toggle="modal"
                    data-target="#top-modal"><i class="fas fa-tasks"></i></button>
                    <!-- <button value="<?php echo $rows["fdDealerID"]; ?>" name="Deletebtn" id="Deletebtn" class="d-inline btn btn-sm bg-danger text-white p-1 m-1" type="submit" ><i class="bi bi-trash-fill"></i></button>      
                    <a href="?UpdateDealer&dealid=<?php echo $rows["fdDealerID"]; ?>"><button class="d-inline btn btn-sm bg-success text-white EditBtn p-1 m-1" name="Updatebtn" id="Updatebtn" type="button"><i class="bi bi-pencil-square"></i></button></a> -->
                    </form>
                    </td>

                </tr>

            <!-- Top modal content --> 
            <div id="top-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-top">
                                        <div class="modal-content">
                                            <div class="modal-header d-flex align-items-center">
                                                <h4 class="modal-title" id="topModalLabel">Action For Dealer ID - <?php echo $rows["fdDealerID"]; ?></h4>
                                                <button type="button" class="close ml-auto" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                        <div class="modal-body">
                                            <div class="row" >  
                                                 <div class="col-sm-12 text-center mr-3">
                                                 <form method="POST">
                                                    <a  href="?UpdateDealer&dealid=<?php echo $rows["fdDealerID"];?>"><button  class="d-inline btn btn-md btn-rounded btn-success text-white EditBtn p-1 m-1 mr-3" name="BtnEdit" type="button" style="width:75px;">Update </button></a>

                                                    <a  href="?ViewDealer&dealid=<?php echo $rows["fdDealerID"];?>"><button  class="d-inline btn btn-md btn-rounded bg-success text-white EditBtn p-1 m-1 mr-3" name="View" type="button" style="width:75px;">View</button></a>
                                        
                                                     <button value="<?php echo $rows["fdDealerID"]; ?>" id="Deletebtn" name="Deletebtn" class="d-inline btn btn-md btn-rounded bg-danger text-white p-1 m-1" type="submit" style="width:75px;" onclick="return confirmDelete();" >Delete</button>
                                                 
                                            
                                                     <!-- <button value="" name="Reject" class="d-inline btn btn-md btn-rounded bg-danger text-white p-1 m-1" type="submit" style="width:75px;">Reject</button>      
                                               -->
                                                     </form>        
                                                 </div>
                                            </div>
                                            </div>
                                            <!-- </div> -->
                                            <!-- <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-dismiss="modal">Close</button> -->
                                                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                            <!-- </div> -->
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal-->

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
// for delete
    if(isset($_POST['Deletebtn'])){
    $dealerid = $_POST['Deletebtn'];
    $delsql="DELETE FROM tbDealerMaster WHERE fdDealerID = '$dealerid'";
    if ($result = mysqli_query($conn, $delsql)){
        $sql1="DELETE FROM tbUserMaster WHERE fdRoleUniqueID = '$dealerid'";
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

