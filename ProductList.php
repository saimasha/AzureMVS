<?php
// for delete
    if(isset($_POST['deletebtn'])){
        $medid = $_POST['deletebtn'];
    $delSql="DELETE FROM tbMedicineMaster WHERE fdMedicineID = '$medid'";
    if ($result = mysqli_query($conn, $delSql)){
        echo '<script>Swal.fire({ 
            icon: "success",
            title:"Deleted Successfully!"
               });
           </script>';      
    }else{
          echo'<script>Swal.fire({ 
            icon: "error",
            title:"Failed  to Delete !"});
         </script>';
      }  
   }
?>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- <div class="card-header"> -->
                <h4 class="card-title">PRODUCT LIST</h4>  
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
                                       <!-- end -->

        <thead class="bg-info text-white">
        <tr style="white-space: nowrap;">
            <th>SI_No</th>
            <th>Medicine ID</th>
            <th>ProductImage</th>
            <th>Medicine Name</th>
            <th>Manufacturer ID</th>
                                        

            <th>Time</th>
            <th>Date</th>
            <th>Status</th>
                                       
    </tr>
    </thead>
    <tbody>

    <?php 
                    require ("include/connection.php");
                    $k=1;
                    $sql ="SELECT * FROM tbMedicineMaster";
                    if ($result = mysqli_query($conn, $sql))
                    {
                    while($rows=mysqli_fetch_assoc($result)) 
                    {
                    ?>
                        <tr style="white-space: nowrap;">
                        <td>
                                                    <!-- addded by Saima-->

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
                      left:60px;                      
                      }
                    </style>
                    <div  onMouseOver="show('hide<?php echo $k; ?>')" onMouseOut="hide('hide<?php echo $k; ?>')">
                    <a  href="" style="color: #b2b9bf;"><?php echo $k; ?>
                    </a>
                    
    <div id="NewNamehide<?php echo $k; ?>" class= "scroll-sidebar">
    <table class="table-responsive table table-bordered">
    <tr><th colspan="2" style="text-align: center; background: #007bff; color: white;"> DETAILS </th></tr>
                                        <tr><th>Batch ID</th><td><?php echo $rows["fdBatchID"]; ?></td></tr>
                                        
                                        <tr><th>Dosage Form</th><td><?php echo $rows["fdDosageForm"]; ?></td></tr>
                                        
                                        <tr><th>Strength</th><td><?php echo $rows["fdStrength"]; ?></td></tr>
                                        
                                        <tr><th>Total Price </th><td><?php echo $rows["fdTotalPrice"]; ?></td></tr>

                                        <tr><th>Total Quantity</th><td><?php echo $rows["fdTotalQuantityInBatch"]; ?></td></tr>

                                        <tr><th>Precription</th><td>
                                        <?php echo $rows["fdPrescriptionRequired"]; ?></td></tr>
                                        
                                        <tr><th>Storage </th><td>
                                        <?php echo $rows["fdStorageConditions"]; ?></td></tr>

                                        <tr><th>SKU ID</th><td> <?php echo $rows["fdSKU_ID"]; ?></td></tr>
                                        
                                        <tr><th>SKU Quantity</th><td><?php echo $rows["fdSKU_Quantity"]; ?></td></tr>
                                        <tr><th>SKU Price</th> <td><?php echo $rows["fdSKUPrice"]; ?></td></tr>
                                        <tr><th>Expiry Date</th><td><?php echo $rows["fdExpiryDate"]; ?></td></tr>
                                        <tr><th>Description</th><td><?php echo $rows["fdDescription"]; ?></td></tr>
                                       
                    </table>
                    </div> 
                </div>
                        <!-- end-->
                    </td>
                    <td><?php echo $rows['fdMedicineID'];?></td>
                    <td><img class= "square" style= "width:50px;height:50px;" src=" image/profile/<?php echo $rows['fdProductImage'];?>"/></td>
                    <td><?php echo $rows['fdMedicineName'];?></td>
                    <td><?php echo $rows['fdManufacturerID'];?></td>

                    <td> <?php echo $rows["fdTime"]; ?> </td>
                    <td> <?php echo $rows["fdDate"]; ?> </td>

    <td>
    <form method="POST" class="d-flex justify-contain-center">
    <button  name="deletebtn" id="deletebtn" value="<?php echo $rows['fdMedicineID'];?>" class="d-inline btn btn-sm bg-danger text-white p-1 m-1" type="submit" ><i class="bi bi-trash-fill"></i></button>
    
    <a href="?UpdateAddProduct&medid=<?php echo $rows["fdMedicineID"]; ?>"><button  class="d-inline btn btn-sm bg-success text-white EditBtn p-1 m-1" name="updatebtn" id="updatebtn" type="button"><i class="bi bi-pencil-square"></i></button></a>
    
    </form>
</td>
</tr>
<?php
    $k++;
}
}?>

            </tbody>                                
            </table>
                        </div>
                    </div>
                </div>
            </div>
        

    