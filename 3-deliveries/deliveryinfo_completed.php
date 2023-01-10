<?php 
	include("../server/connection.php");

		$id   =   $_GET['delivery_id'];
		$sql  =   "SELECT * FROM delivery WHERE delivery_id='$id'";
		$result1   = mysqli_query($connection, $sql);
		$row1  =   mysqli_fetch_array($result1);
?>
<!DOCTYPE html>
<html>
<head>
    <?php include('../templates/head.php'); ?>
    <script src="../js/reason_cancelled.js"></script>
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
              <center><span class="text-uppercase pd-2 mt-4 text-uppercase fw-bold h4"><i class="fa-solid fa-truck fa-sm me-2"></i>Delivery</span><br><span class="text-uppercase pd-2 mt-4 text-uppercase fw-bold h4">Information</span></center>
            </a>
          </div>
          
          <?php                    
            $id = $_GET['delivery_id'];
            $sql13 = "SELECT * FROM delivery WHERE delivery_id = '$id'";
            $result13 = mysqli_query($connection,$sql13);
            $row13 = mysqli_fetch_array($result13);
          ?>   
        <div class="list-group mt-4 mb-3 d-grid gap-1">
            <a href="#" type="button" class="fw-bold list-group-item list-group-item-action" aria-current="true"><span><i class="fa-solid fa-rectangle-list fa-lg me-3"></i><?php echo $row13['delivery_id'];?></span></a>
            <a href="monitor_deliveries_completed.php" type="button" class="fw-bold list-group-item list-group-item-action"><span><i class="fa-solid fa-circle-arrow-left fa-lg me-3"></i>Back</span></a>
        </div>
        </nav>
      </div>
        <div class="container bg-secondary">
            <a class="navbar-brand">
              <center><h5 class="text-uppercase text-light fw-bold pd-1 mt-4" id='clockDisplay'></h5></center>
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
                <span><i class="fa-solid fa-rectangle-list me-2"></i></span>Delivery Info > <?php echo $row13['delivery_id'];?>
              </div>   
                
              <?php
                  $id = $_GET['delivery_id']; 
                  $query = "SELECT * FROM delivery WHERE delivery_id = '$id'";
                  $query_run = mysqli_query($connection, $query);
                  $row = mysqli_fetch_assoc($query_run);
                        
                ?>  
                <form class="row g-3 ms-4 mx-4 mb-4 mt-2" action="deliveryupdate.php" method="POST">
                  <input type="hidden" class="form-control" id="delivery_id" name="delivery_id" value="<?php echo $row["delivery_id"]; ?>" required>
                    <div class="col-md-4">
                        <label for="inputFirstName" class="form-label fw-bold">First Name</label>
                        <div class="input-group"><span class="input-group-text bg-dark text-light"><i class="fa-solid fa-pen-clip"></i></span><input type="text" class="form-control" id="update_fname" name="update_fname" pattern="[a-zA-Z-ñ\s]+" title="First name must not contain any special characters or numbers." value="<?php echo $row['cust_fname'];?>" readonly></div>
                    </div>
                    <div class="col-4">
                        <label for="inputLastname" class="form-label fw-bold">Last Name</label>
                        <div class="input-group"><span class="input-group-text bg-dark text-light"><i class="fa-solid fa-pen-clip"></i></span><input type="text" class="form-control" id="update_lname" name="update_lname" pattern="[a-zA-Z0-9-_.ñ\s]+" title="Last name must not contain any other special characters." value="<?php echo $row['cust_lname'];?>" readonly></div>
                    </div>
                    <div class="col-4">
                        <label for="inputContact" class="form-label fw-bold">Contact</label>
                        <div class="input-group"><span class="input-group-text bg-dark text-light"><i class="fa-solid fa-phone"></i></span><input type="text" class="form-control" id="update_contact" name="update_contact" pattern="[0-9]{11}" title="Contact Number (Format: 09123456789)" value="<?php echo $row['cust_contact'];?>" readonly></div>
                    </div>
                    <div class="col-2">
                        <label for="inputBlock" class="form-label fw-bold">Block</label>
                        <div class="input-group"><span class="input-group-text bg-dark text-light"><i class="fa-solid fa-house"></i></span><input type="text" class="form-control" id="update_block" name="update_block" pattern="[0-9]{1,6}" title="Block must not contain any letters or spaces." value="<?php echo $row["cust_block"]; ?>" readonly></div>
                    </div>
                    <div class="col-2">
                        <label for="inputLot" class="form-label fw-bold">Lot</label>
                        <div class="input-group"><span class="input-group-text bg-dark text-light"><i class="fa-solid fa-house"></i></span><input type="text" class="form-control" id="update_lot" name="update_lot" pattern="[0-9]{1,6}" title="Block must not contain any letters or spaces." value="<?php echo $row["cust_lot"]; ?>" readonly></div>
                    </div>
                    <div class="col-5">
                        <label for="inputStreet" class="form-label fw-bold">Street</label>
                        <div class="input-group"><span class="input-group-text bg-dark text-light"><i class="fa-solid fa-house"></i></span><input type="text" class="form-control" id="update_street" name="update_street" pattern="[a-zA-Z0-9-_.ñ\s]+" title="Street must not contain any other special characters." value="<?php echo $row["cust_street"]; ?>" readonly></div>
                    </div>
                    <div class="col-3">
                        <label for="inputBarangay" class="form-label fw-bold">Barangay</label>
                        <div class="input-group"><span class="input-group-text bg-dark text-light"><i class="fa-solid fa-house"></i></span><input type="text" class="form-control" id="update_barangay" name="update_barangay" pattern="[a-zA-Z0-9-_.ñ\s]+" title="Barangay must not contain any special characters." value="<?php echo $row["cust_barangay"]; ?>" readonly></div>
                    </div>
                    <div class="col-md-3">
                        <label for="inputCity" class="form-label fw-bold">City</label>
                        <div class="input-group"><span class="input-group-text bg-dark text-light"><i class="fa-solid fa-house"></i></span><input type="text" class="form-control" id="update_city" name="update_city" pattern="[a-zA-Z-_.ñ\s]+" title="City must not contain any special characters or numbers." value="<?php echo $row["cust_city"]; ?>" readonly></div>
                    </div>
                    <div class="col-md-3">
                      <label for="inputProvince" class="form-label fw-bold">Province</label>
                      <div class="input-group"><span class="input-group-text bg-dark text-light"><i class="fa-solid fa-house"></i></span><input type="text" class="form-control" id="update_province" name="update_province" pattern="[a-zA-Z-_.ñ\s]+" title="Province must not contain any special characters or numbers." value="<?php echo $row["cust_province"]; ?>" readonly></div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="inputOthers" class="form-label fw-bold">Other Address Info</label>
                        <div class="input-group"><span class="input-group-text bg-dark text-light"><i class="fa-solid fa-house"></i></span><input type="text" class="form-control" id="update_others" name="update_others" pattern="[0-9]{1,6}" title="Zip must not contain any special characters, letters or spaces." value="<?php echo $row["cust_others"]; ?>" readonly></div>
                    </div>
                    <hr>
                    <div class="col-6">
                        <label for="inputCurrentSched" class="form-label fw-bold">Date</label>
                        <div class="input-group"><span class="input-group-text bg-dark text-light"><i class="fa-solid fa-calendar-days"></i></span><input type="text" class="form-control" id="date" name="date" value="<?php echo date('F d, Y', strtotime($row["date"])); echo " | "; echo date('h:i A', strtotime($row["time"]));?>" readonly></div>
                    </div>

                <!--
                    <div class="col-4">
                        <label for="inputUpdateSchedDate" class="form-label fw-bold">Update Date</label>
                           //min="<?= date('Y-m-d'); ?>"
                        <div class="input-group"><span class="input-group-text"><i class="bi bi-calendar-week-fill"></i></span><input type="date" class="form-control" id="update_scheduledate" name="update_scheduledate" value="<?php echo $row["date"]; ?>"></div>
                    </div>
                    <div class="col-3">
                        <label for="inputUpdateSchedTime" class="form-label fw-bold">Update Time</label>
                        <div class="input-group"><span class="input-group-text"><i class="bi bi-calendar-week-fill"></i></span><input type="time" min="<?= date('TH:i'); ?>" class="form-control" id="update_scheduletime" name="update_scheduletime" value="<?php echo $row["time"]; ?>"></div>
                    </div>
                -->

                    <div class="col-6">
                        <label for="inputCurrentStat" class="form-label fw-bold">Status</label>
                        <div class="input-group"><span class="input-group-text bg-dark text-light"><i class="fa-solid fa-square-poll-vertical"></i></span><input type="text" class="form-control" id="status" name="status" value="<?php echo $row['status'];?>" readonly></div>
                    </div>

                <!--
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
                 -->
                </form>
                
            </div>    
          </div>
        </div>
      </div>
    </main>
      <?php include('../templates/footer.php'); ?>
      <script src="../js/moment.min.js"></script>
      <script src="../js/dataTables.dateTime.min.js"></script>
</body>
</html>