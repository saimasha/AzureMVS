<?php
session_start();
$RoleUniqueID= $_SESSION['fdRoleUniqueID'] ;
$roleid = $_SESSION['fdRoleID'];

?>
<style>
  .dt-button{
    display:none;
  }
</style>

<div class="card"> 
    <div class="card-body" >
         <div class="container my-5" >
           <form method="POST">
           <div>
             <h4 class="card-title mb-3 text-white"><strong>ENTER RETAILER FOR UPDATE OR DELETE DATA
             </strong></h3>
            </div>
           <div class="input-group">
            <input type="text" class="form-control" placeholder="Search Retailer" name="search" required/>
                <div class="input-group-append"> 
                        <button class="btn btn btn-info" name="submit" >Search</button>
                            <!-- <button class="btn btn btn-dark" type="button" name="submit"> Search</button> -->
                        </div>
                    </div>
            </form>
             </div>

    <!-- <hr> -->
    
        <?php
        
            if(isset($_POST['submit'])){
            $search = $_POST['search'];

            // include ("include/connection.php");
            if ($roleid === "MNFR"){
              
                $sql ="SELECT * FROM tbRetailerMaster WHERE (fdRetailerID = '$search' OR fdRetailerName = '$search' OR fdHeadOfficeName='$search') AND fdManufacturerID = '$RoleUniqueID'";
            } elseif ($roleid === "STKS"){ 
               
                $sql ="SELECT * FROM tbRetailerMaster WHERE (fdRetailerID = '$search' OR fdRetailerName = '$search' OR fdHeadOfficeName='$search') AND fdStockistID = '$RoleUniqueID'";
            } elseif ($roleid === "DSTR"){
                
                $sql ="SELECT * FROM tbRetailerMaster WHERE (fdRetailerID = '$search' OR fdRetailerName = '$search' OR fdHeadOfficeName='$search') AND fdDistributorID = '$RoleUniqueID'";
            } else {
                
                $sql ="SELECT * FROM tbRetailerMaster WHERE (fdRetailerID = '$search' OR fdRetailerName = '$search' OR fdHeadOfficeName='$search') AND fdDealerID = '$RoleUniqueID'";
                
            }
            // $sql="SELECT * FROM tbRetailerMaster WHERE fdRetailerID = '$search' or fdRetailerName = '$search' or fdDealerID = '$search' ";
            $result = mysqli_query($conn, $sql);
            if($result){
                if(mysqli_num_rows($result)>0){
                    // table heading
        ?>

<div class="container-fluid">
<div class="row">
<div class="col-12">
<!-- <div class="card">  -->
<!-- <div class="card-body"> -->
<div class="table-responsive">
<table id="file_export" class="table table-striped table-bordered display">
<thead style="text-align: center; background: #1e88e566;color: white;">
<tr style="white-space: nowrap;">
                            
    <th>SINO</th>
    <th>Retailer ID</th>

    <th>Retailer Name</th>
    <th>Distributor ID</th>
    <th>Dealer ID</th>

    <!-- <th>HeadOfficeName</th>
    <th>HeadOfficeAddressLine1</th>
    <th>HeadOfficeAddressLine2</th>
    <th>HeadOfficeCity</th>
    <th>HeadOfficeState</th>
    <th>HeadOfficeCountry</th> -->
    <!-- <th>HeadOfficePostalCode</th>
    <th>HeadOfficePhoneNumber</th>
    <th>HeadOfficeEmail</th>
    <th>RetailerLat</th>
    <th>RetailerLong</th>
    <th>OwnerName</th>
    <th>OwnerPhoneNumber</th>
    <th>OwnerEmail</th>
    <th>ContactPerson1Name</th>
    <th>ContactPerson1PhoneNumber</th>
    <th>ContactPerson1Email</th> -->
    <!-- <th>ContactPerson2Name</th>
    <th>ContactPerson2PhoneNumber</th>
    <th>ContactPerson2Email</th>
    <th>WebsiteURL</th>
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
        <td><?php echo $rows['fdSlNo'];?></td>
        <td><?php echo $rows['fdRetailerID'];?></td>
        
        <td><?php echo $rows['fdRetailerName'];?></td>
        <td><?php echo $rows['fdDistributorID'];?></td>
        <td><?php echo $rows['fdDealerID'];?></td>

        <td>
        <form method="POST" class="d-flex justify-contain-center">
        <button type="button" class="btn btn-info " style="margin-left:20px;" data-toggle="modal" data-target="#top-modal"><i class="fas fa-tasks">
        </i></button>      
        </form>
        </td>

    </tr>
<!-- Top modal content -->
<div id="top-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-top">
        <div class="modal-content">
        <div class="modal-header d-flex align-items-center">
            <h3 class="modal-title" id="topModalLabel">Action For Retailer ID - <?php echo $rows["fdRetailerID"]; ?></h3>
            <button type="button" class="close ml-auto" data-dismiss="modal"
                aria-hidden="true">x</button>
        </div>
        <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 text-center mb-3">
                        <form method="POST">
                            <a href="?UpdateRetailer&rid=<?php echo $rows["fdRetailerID"]; ?>"><button class="d-inline btn btn-md bg-success text-white EditBtn p-1 m-1 mr-3" name="updatebtn" type="button" style="width:75px;">Update</button></a> 

                            <a href="?ViewRetailer&rid=<?php echo $rows["fdRetailerID"]; ?>"><button class="d-inline btn btn-md bg-success text-white EditBtn p-1 m-1 mr-3" name="updatebtn" type="button" style="width:75px;">View</button></a> 
                            
                            <button name="deletebtn" type="submit" id="deletebtn" value="<?php echo $rows["fdRetailerID"]; ?>" class="d-inline btn btn-md bg-danger text-white p-1 m-1" style="width:75px;" onclick="return confirmDelete();">Delete</button>
                        
            
                        <!-- <button value="<?php echo $rows["fdRetailerID"]; ?>" name="deletebtn" type="submit" class="d-inline btn btn-md bg-danger text-white p-1 m-1" style="width:75px;">Reject</button> -->

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
    echo'<script> Swal.fire({ 
        title:"Data Not Found!",
        text: "Please Enter Valid Details ",
        icon: "error",
    })
    .then(function(){ 
        window.location="?SearchRetailer"; 
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
    if(isset($_POST['deletebtn'])){
        $rid =$_POST['deletebtn'];
        $deleteSql= "DELETE FROM tbRetailerMaster WHERE fdRetailerID = '$rid'";
    
        if ($result = mysqli_query($conn, $deleteSql)){
            $sql1="DELETE FROM tbUserMaster WHERE fdRoleUniqueID = '$rid'";
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

