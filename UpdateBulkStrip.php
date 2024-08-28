<style>

.swal2-warning-icon {
    font-size: 1em !important; 
}
    

.custom-width {
    max-width: 60%; 
}

   

.rwd-table {
    margin: auto;
    width: 100%;
    border-collapse: collapse;
}

.rwd-table tr:first-child {
    border-top: none;
    color: white;
}

.rwd-table tr {
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
}

.rwd-table th {
    color: white;
    white-space: nowrap; /* Prevent table header from wrapping */
}

.rwd-table td {
    text-align: left;
    padding: .5em 1em;
}

.rwd-table th,
.rwd-table td {
    text-align: left;
    padding: .5em 1em;
}

/* Responsive Styles */
@media screen and (max-width: 600px) {
    .rwd-table {
        border: 0;
    }

    .rwd-table thead {
        display:none;
    }

    .rwd-table tr {
        margin-bottom: 10px;
        display: block;
        border-bottom: 2px solid #ddd;
    }

    .rwd-table td {
        display: block;
        text-align: right;
        font-size: 13px;
        border-bottom: 1px dotted #ccc;
    }

    .rwd-table td:last-child {
        border-bottom: 0;
    }

    .rwd-table td:before {
        content: attr(data-th);
        float: left;
        font-weight: bold;
        text-transform: uppercase;
    }

    .rwd-table td:before {
        content: attr(data-th);
        font-weight: bold;
        width: 50%;
        display: inline-block;
        text-align: left;
    }
}

body {
    background: #4B79A1;
    background: -webkit-linear-gradient(to left, #4B79A1, #283E51);
    background: linear-gradient(to left, #4B79A1, #283E51);
}

h1 {
    text-align: center;
    font-size: 2.4em;
    color: #f2f2f2;
}

.container {
    display: block;
    text-align: center;
}

@-webkit-keyframes leftRight {
    0%    { -webkit-transform: translateX(0); }
    25%   { -webkit-transform: translateX(-10px); }
    75%   { -webkit-transform: translateX(10px); }
    100%  { -webkit-transform: translateX(0); }
}

@keyframes leftRight {
    0%    { transform: translateX(0); }
    25%   { transform: translateX(-10px); }
    75%   { transform: translateX(10px); }
    100%  { transform: translateX(0); }
}


</style>

<?php

session_start();
$manufacturerID = $_SESSION['fdRoleUniqueID'];
include "include/connection.php";


$query_generated = "SELECT COUNT(*) AS generated_count FROM tbMedicineStripTest WHERE fdQRCodeCreated = 1 AND fdManufacturerID = '$manufacturerID'";
$query_not_generated = "SELECT COUNT(*) AS remaining_count FROM tbMedicineStripTest WHERE fdQRCodeCreated = 0 AND fdManufacturerID = '$manufacturerID'";


$result_generated = mysqli_query($conn, $query_generated);
$result_not_generated = mysqli_query($conn, $query_not_generated);

if (!$result_generated || !$result_not_generated) {
    die("Query Error: " . mysqli_error($conn));
}


$generated_count = mysqli_fetch_assoc($result_generated)['generated_count'];
$remaining_count = mysqli_fetch_assoc($result_not_generated)['remaining_count'];


?>

                <div class="card">
                        <div class="card-body">
                            <div class="container my-5">
                                <h1 class="card-title">Generate Strip QR Codes in Bulk</h1>
                                 <br>
                                <div class="table-responsive">
                                    <table class="rwd-table">
                                        <thead class="bg-info text-white">
                                            <tr>
                                                <th>Manufacturer ID</th>
                                                <th>Total Strips</th>
                                                <th>Total Qr Generated Strips</th>
                                                <th>Remaining Strips</th>
                                                <th><strong>Action:</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <td><?php echo $manufacturerID; ?></td>
                                            <td><?php echo $generated_count + $remaining_count; ?></td>
                                            <td><?php echo $generated_count; ?></td>
                                            <td><?php echo $remaining_count; ?></td>
                            <td>
                            <?php if ($remaining_count > 0): ?>
                                        <button class="btn btn-primary waves-effect waves-light mb-3" id="generate-bulk-qr">Generate QR Codes</button>
                                    <?php else: ?>
                                        <button class="btn btn-primary waves-effect waves-light mb-3"  data-toggle="modal"
                                        data-target="#scrollable-modal">Strips Details</button>
                                    <?php endif; ?>
                             </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                 </div>




<?php
$manufacturerID = $_SESSION['fdRoleUniqueID'];

$query_strip = "SELECT * FROM tbMedicineStripTest WHERE fdQRCodeCreated = 1 AND fdManufacturerID = '$manufacturerID'";
$result_strip = mysqli_query($conn, $query_strip);

if (!$result_strip) {
    die("Query Error: " . mysqli_error($conn));
}
?>
  <!-- Long Content Scroll Modal -->
                         <div class="modal fade" id="scrollable-modal" tabindex="-1" role="dialog"
                                    aria-labelledby="scrollableModalTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable custom-width" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header d-flex align-items-center">
                                                <h5 class="modal-title" id="scrollableModalTitle">All Strips Details</h5>
                                                <button type="button" class="close ml-auto" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="bg-info text-white">
                                    <tr>
                                        <th>StripID</th>
                                        <th>ManufacturerID</th>
                                        <th>MedicineID</th>
                                        <th>PacketID</th>
                                        <th>CartonID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result_strip)): ?>
                                    <tr>
                                        <td><?php echo $row['fdStripID']; ?></td>
                                        <td><?php echo $row['fdManufacturerID']; ?></td>
                                        <td><?php echo $row['fdMedicineID'] ?></td>  
                                        <td><?php echo $row['fdPacketID']; ?></td>
                                        <td><?php echo $row['fdCartonID']; ?></td>
                                                
                                                </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>


<script>
    $(document).ready(function() {
    $('#generate-bulk-qr').on('click', function() {
        $.ajax({
            url: 'getbulkQr_details.php',
            type: 'POST',
            data: {
                packageType: 'Strip',
                apiUrl: 'https://schedarcloud.com/api/qrencrypt.php'
            },
            success: function(response) {
                let isAllGenerated = response.includes("All Strip QR codes are already generated.");

                if (isAllGenerated) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning!',
                        text: response,
                        confirmButtonText: 'OK',
                        customClass: {
                                icon: 'swal2-warning-icon' 
                            }
                    });
                } else {
                    Swal.fire({
                        title: 'Success',
                        // text: response,
                        text:'Strip QR Code updated successfully',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });

                }
                },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'An error occurred while processing your request.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});

</script>

<!-- Include SweetAlert CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
