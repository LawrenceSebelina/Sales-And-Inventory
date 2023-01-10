<?php 
	include("server/connection.php");

		$id   =   $_GET['receipt_no'];
		$sql  =   "SELECT * FROM delivery WHERE receipt_no='$id'";
		$result1   = mysqli_query($connection, $sql);
		$row1  =   mysqli_fetch_array($result1);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-icons.css"/>
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/dataTables.dateTime.min.css" />
    <link rel="stylesheet" href="css/buttons.dataTables.min.css"/>
    <link rel="stylesheet" href="css/all.min.css" />
    <!-- <link rel="stylesheet" href="js/dataTables.bootstrap5.min.js"/>
    <link rel="stylesheet" href="js/jquery.dataTables.min.js"/> -->
    <script src="js/jszip.min.js"></script>
    <link rel="icon" href="images/Logo.png">
    <title>SALES AND INVENTORY SYSTEM</title>


    <script type="text/javascript">
      function CheckStatus(val){
        var element=document.getElementById('reason');
          if(val=='Cancelled')
            element.style.display='block';
          else  
            element.style.display='none';

      }
    </script>
</head>
<body>
    <!-- top navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasExample">
          <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
        </button>
        <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold" href="#">Karesma Trading</a>
      </div>
    </nav>
    <!-- top navigation bar -->

    <!-- offcanvas -->
    <div class="offcanvas offcanvas-start sidebar-nav bg-light border-secondary border-2" tabindex="-1" id="sidebar">
      <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
          <div class="container bg-secondary"><br>
            <a class="navbar-brand">
              <center><span class="text-uppercase pd-2 mt-4 text-uppercase fw-bold h4">Delivery</span><br><span class="text-uppercase pd-2 mt-4 text-uppercase fw-bold h4">Information</span></center>
            </a>
          </div>
          <?php                    
            $id = $_GET['receipt_no'];
            $sql13 = "SELECT * FROM delivery WHERE receipt_no = '$id'";
            $result13 = mysqli_query($connection,$sql13);
            $row13 = mysqli_fetch_array($result13);
          ?>   
        <div class="list-group mt-4 mb-3 d-grid gap-1">
            <button type="button" class="bi bi-card-checklist list-group-item list-group-item-action" aria-current="true"><span class="ms-3"><?php echo $row13['delivery_id'];?></span></button>
            <button onclick="window.location.href='pos.php'" type="button" class="bi bi-arrow-left-square list-group-item list-group-item-action"><span class="ms-3">Back</span></button>
        </div>
        </nav>
      </div>
        <div class="container bg-secondary">
            <a class="navbar-brand">
              <center><h5 class="text-uppercase text-light pd-1 mt-4" id='clockDisplay'></h5></center>
            </a>
        </div>
    </div>
    <!-- offcanvas -->

    <main class="mt-5 pt-3">
      <div class="container-fluid">              
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card border-secondary border-2">
              <div class="card-header text-uppercase fw-bold fs-4 bg-secondary text-light">
                <span><i class="bi bi-card-checklist me-2"></i></span>Delivery Info > <?php echo $row13['delivery_id'];?>
              </div>   
                
              <?php
                  $id = $_GET['receipt_no']; 
                  $query = "SELECT * FROM delivery WHERE receipt_no = '$id'";
                  $query_run = mysqli_query($connection, $query);
                  $row = mysqli_fetch_assoc($query_run);
                        
                ?>  
                <form class="row g-3 ms-4 mx-4 mb-4 mt-2" action="delivery_notif_update.php" method="POST" id="form_id">
                  <input type="hidden" class="form-control" id="delivery_id" name="delivery_id" value="<?php echo $row["delivery_id"]; ?>" required>
                    <div class="col-md-4">
                        <label for="inputFirstName" class="form-label fw-bold">First Name</label>
                        <div class="input-group"><span class="input-group-text"><i class="bi bi-pen-fill"></i></span><input type="text" class="form-control" id="update_fname" name="update_fname" pattern="[a-zA-Z-ñ\s]+" title="First name must not contain any special characters or numbers." value="<?php echo $row['cust_fname'];?>" required></div>
                    </div>
                    <div class="col-4">
                        <label for="inputLastname" class="form-label fw-bold">Last Name</label>
                        <div class="input-group"><span class="input-group-text"><i class="bi bi-pen-fill"></i></span><input type="text" class="form-control" id="update_lname" name="update_lname" pattern="[a-zA-Z0-9-_.ñ\s]+" title="Last name must not contain any other special characters." value="<?php echo $row['cust_lname'];?>" required></div>
                    </div>
                    <div class="col-4">
                        <label for="inputContact" class="form-label fw-bold">Contact</label>
                        <div class="input-group"><span class="input-group-text"><i class="bi bi-telephone-fill"></i></span><input type="text" class="form-control" id="update_contact" name="update_contact" pattern="[0-9]{11}" title="Contact Number (Format: 09123456789)" value="<?php echo $row['cust_contact'];?>" required></div>
                    </div>

                    <div class="col-2">
                        <label for="inputBlock" class="form-label fw-bold">Block</label>
                        <div class="input-group"><span class="input-group-text"><i class="bi bi-house-fill"></i></span><input type="text" class="form-control" id="update_block" name="update_block" pattern="[0-9]{1,6}" title="Block must not contain any letters or spaces." value="<?php echo $row["cust_block"]; ?>" required></div>
                    </div>
                    <div class="col-2">
                        <label for="inputLot" class="form-label fw-bold">Lot</label>
                        <div class="input-group"><span class="input-group-text"><i class="bi bi-house-fill"></i></span><input type="text" class="form-control" id="update_lot" name="update_lot" pattern="[0-9]{1,6}" title="Block must not contain any letters or spaces." value="<?php echo $row["cust_lot"]; ?>" required></div>
                    </div>
                    <div class="col-5">
                        <label for="inputStreet" class="form-label fw-bold">Street</label>
                        <div class="input-group"><span class="input-group-text"><i class="bi bi-house-fill"></i></span><input type="text" class="form-control" id="update_street" name="update_street" pattern="[a-zA-Z0-9-_.ñ\s]+" title="Street must not contain any other special characters." value="<?php echo $row["cust_street"]; ?>" required></div>
                    </div>
                    <div class="col-3">
                        <label for="inputBarangay" class="form-label fw-bold">Barangay</label>
                        <div class="input-group"><span class="input-group-text"><i class="bi bi-house-fill"></i></span><input type="text" class="form-control" id="update_barangay" name="update_barangay" pattern="[a-zA-Z0-9-_.ñ\s]+" title="Barangay must not contain any special characters." value="<?php echo $row["cust_barangay"]; ?>" required></div>
                    </div>
                    <div class="col-md-3">
                        <label for="inputCity" class="form-label fw-bold">City</label>
                        <div class="input-group"><span class="input-group-text"><i class="bi bi-house-fill"></i></span><input type="text" class="form-control" id="update_city" name="update_city" pattern="[a-zA-Z-_.ñ\s]+" title="City must not contain any special characters or numbers." value="<?php echo $row["cust_city"]; ?>" required></div>
                    </div>
                    <div class="col-md-3">
                      <label for="inputProvince" class="form-label fw-bold">Province</label>
                      <div class="input-group"><span class="input-group-text"><i class="bi bi-house-fill"></i></span><input type="text" class="form-control" id="update_province" name="update_province" pattern="[a-zA-Z-_.ñ\s]+" title="Province must not contain any special characters or numbers." value="<?php echo $row["cust_province"]; ?>" required></div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="inputOthers" class="form-label fw-bold">Other Address Info</label>
                        <div class="input-group"><span class="input-group-text"><i class="bi bi-house-fill"></i></span><input type="text" class="form-control" id="update_others" name="update_others" pattern="[0-9]{1,6}" title="Zip must not contain any special characters, letters or spaces." value="<?php echo $row["cust_others"]; ?>"></div>
                    </div>
                    <hr>
                    <div class="col-5">
                        <label for="inputCurrentSched" class="form-label fw-bold">Current Schedule</label>
                        <div class="input-group"><span class="input-group-text"><i class="bi bi-calendar-week-fill"></i></span><input type="text" class="form-control" id="date" name="date" value="<?php echo date('F d, Y', strtotime($row["date"])); echo " | "; echo date('h:i A', strtotime($row["time"]));?>" readonly></div>
                    </div>
                    <div class="col-4">
                        <label for="inputUpdateSchedDate" class="form-label fw-bold">Update Date</label>
                          <!-- min="<?= date('Y-m-d'); ?>" -->
                        <div class="input-group"><span class="input-group-text"><i class="bi bi-calendar-week-fill"></i></span><input type="date" class="form-control" id="update_scheduledate" name="update_scheduledate" value="<?php echo $row["date"]; ?>"></div>
                    </div>
                    <div class="col-3">
                        <label for="inputUpdateSchedTime" class="form-label fw-bold">Update Time</label>
                        <div class="input-group"><span class="input-group-text"><i class="bi bi-calendar-week-fill"></i></span><input type="time" min="<?= date('TH:i'); ?>" class="form-control" id="update_scheduletime" name="update_scheduletime" value="<?php echo $row["time"]; ?>"></div>
                    </div>
                    <div class="col-5">
                        <label for="inputCurrentStat" class="form-label fw-bold">Current Status</label>
                        <div class="input-group"><span class="input-group-text"><i class="bi bi-file-earmark-bar-graph-fill"></i></span><input type="text" class="form-control" id="status" name="status" value="<?php echo $row['status'];?>" readonly></div>
                    </div>
                    <div class="col-5">
                        <label for="inputUpdateStat" class="form-label fw-bold">Update Status</label>
                        <div class="input-group"><span class="input-group-text"><i class="bi bi-file-earmark-bar-graph-fill"></i></span>
                            <select id="update_status" name="update_status" class="form-control form-control" onchange='CheckStatus(this.value);' required>
                              <option value="Pending">Pending</option>
                              <option value="Completed">Completed</option>
                              <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                      <textarea type="text" class="form-control" id="reason" name="reason" style='display:none;' placeholder="Reason for cancellation" pattern="[a-zA-Z0-9-_.ñ\s]+" title="Type the reason/s for cancelling the delivery."></textarea>
                    </div>

                    <div class="col-12 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary mx-2" name="updatedata">&nbsp&nbsp Save &nbsp&nbsp</button>
                        <button onClick="window.location.reload();" type="button" class="btn btn-danger">&nbspCancel&nbsp</button>
                    </div>
                </form>

                <div class="card border-secondary border-2">
              <div class="card-header text-uppercase fw-bold fs-4 bg-secondary text-light">
                <span><i class="bi bi-card-checklist me-2"></i></span>Transaction Logs > <?php echo $row13['transaction_id'];?>
              </div>   
                
              <?php
                  $id = $_GET['receipt_no'];
                  $query = "SELECT * FROM transaction_logs WHERE receipt_no = '$id'";
                  $query_run = mysqli_query($connection, $query);
                  $row = mysqli_fetch_assoc($query_run);
                        
                ?>  
                <form class="row g-3 ms-4 mx-4 mb-4 mt-2">
                    <div class="col-md-3">
                        <label for="inputGrandTotal" class="form-label fw-bold">Grand Total</label>
                        <div class="input-group"><span class="input-group-text"><i class="bi bi-cash"></i></span><input type="text" class="form-control" id="grandtotal" name="grandtotal" value="₱<?php echo number_format($row['total'], 2 );?>" readonly></div>
                    </div>
                    <div class="col-3">
                        <label for="inputPayment" class="form-label fw-bold">Payment</label>
                        <div class="input-group"><span class="input-group-text"><i class="bi bi-cash"></i></span><input type="text" class="form-control" id="payment" name="payment" value="₱<?php echo number_format($row['payment'], 2 );?>" readonly></div>
                    </div>
                    <div class="col-3">
                        <label for="inputPayment" class="form-label fw-bold">Discount (<?php echo $row['discount'];?>%)</label>
                        <div class="input-group"><span class="input-group-text"><i class="bi bi-cash"></i></span><input type="text" class="form-control" id="payment" name="payment" value="₱<?php echo number_format($row['discounted_amount'], 2 );?>" readonly></div>
                    </div>
                    <div class="col-3">
                        <label for="inputChange" class="form-label fw-bold">Change</label>
                        <div class="input-group"><span class="input-group-text"><i class="bi bi-cash"></i></span><input type="text" class="form-control" id="change" name="change" value="₱<?php echo number_format($row['changes'], 2 );?>" readonly></div>
                    </div>
                    <div class="col-3">
                        <label for="inputTotalItems" class="form-label fw-bold">Total Items</label>
                        <div class="input-group"><span class="input-group-text"><i class="bi bi-basket-fill"></i></span><input type="text" class="form-control" id="total_quantity" name="total_quantity" value="<?php echo $row["total_quantity"]; ?>" readonly></div>
                    </div>
                </form>
              <div class="card-header text-uppercase fw-bold fs-4 bg-secondary text-light">
                <span><i class="bi bi-basket me-2"></i></span> LIST OF ITEMS
              </div>
              <?php 
                    $id = $_GET['receipt_no'];
                    $sql = "SELECT * FROM product_sales WHERE receipt_no = '$id'";
                    $result = mysqli_query($connection,$sql);
                    $row = mysqli_fetch_array($result);
                    $result1 = mysqli_query($connection,$sql); 
                ?>

              <div class="card-body mt-4">
                <div class="table-responsive">
                  <table id="example" class="table table-striped data-table" style="width: 100%">
                    <thead class="table-dark">
                      <tr>
                        <th>Transaction Id</th>
                        <th>Product Id</th>
                        <th>Product Description</th>
                        <th>Brand</th>
                        <th>Unit</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Sub Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        while($row1 = mysqli_fetch_array($result1)){
                        ?>
                      <tr class="table-active">
                        <td><?php echo $row13['transaction_id'];?></td>
                        <td><?php echo $row1['product_id'];?></td>
                        <td><?php echo $row1['product_desc'];?></td>
                        <td><?php echo $row1['brand'];?></td>
                        <td><?php echo $row1['unit'];?></td>
                        <td>₱<?php echo $row1['unit_price'];?></td>
                        <td><?php echo $row1['quantity'];?></td>
                        <td>₱<?php echo number_format($row1['sub_total'], 2 );?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Transaction Id</th>
                        <th>Product Id</th>
                        <th>Product Description</th>
                        <th>Brand</th>
                        <th>Unit</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Sub Total</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>


            </div>    
          </div>
        </div>
      </div>
    </main>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/chart.min.js"></script>
      <script src="js/sweetalert.min.js"></script>
      <script src="js/jquery-3.5.1.js"></script>
      <script src="js/jquery.dataTables.min.js"></script>
      <script src="js/dataTables.bootstrap5.min.js"></script>
      <script src="js/time4.js"></script>
      <script src="js/moment.min.js"></script>
      <script src="js/dataTables.dateTime.min.js"></script>
</body>
</html>