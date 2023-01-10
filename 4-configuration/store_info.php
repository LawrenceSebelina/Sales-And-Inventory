<?php 
  include('../server/connection.php'); 
  include('../security1.php'); 
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../templates/head.php'); ?>
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
              <center><span class="text-uppercase pd-2 mt-4 text-uppercase fw-bold h4"><i class="fa-solid fa-gear fa-sm me-2"></i>Configuration</span></center>
            </a>
          </div>
        <div class="list-group mt-4 mb-3 d-grid gap-1">
            <a href="#" type="button" class="fw-bold list-group-item list-group-item-action active" aria-current="true"><span><i class="fa-solid fa-file-pen me-3"></i>Update Store Info</span></a>
            <a href="manage_accounts.php" type="button" class="fw-bold list-group-item list-group-item-action"><span><i class="fa-solid fa-user fa-lg me-3"></i>Manage Accounts</span></a>
            <a href="../dashboard.php" type="button" class="fw-bold list-group-item list-group-item-action"><span><i class="fa-solid fa-bars fa-lg me-3"></i>Menu</span></a>
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
                <?php 
                  $query = "SELECT * FROM store_info";
                  $query_run = mysqli_query($connection, $query);

                  if(mysqli_num_rows($query_run) > 0)
                  {
                      while($row = mysqli_fetch_assoc($query_run))
                      {
                        
                ?>  
              <div class="card-header text-uppercase fw-bold fs-4 bg-secondary text-light">
                <span><i class="fa-solid fa-file-pen me-2"></i></span> Update Store Information
              </div>
                <form class="row g-3 ms-4 mx-4 mb-4 mt-4" action="storeinfo_update.php" method="POST">
                        <input type="hidden" class="form-control" id="store_id" name="store_id" value="<?php echo $row["store_id"]; ?>" required>
                    <div class="col-md-12">
                        <label for="inputName" class="form-label fw-bold">Name</label>
                        <div class="input-group"><span class="input-group-text bg-dark text-light"><i class="fa-solid fa-pen-clip"></i></span><input type="text" class="form-control" id="store_name" name="store_name" pattern="[a-zA-Z0-9-_.ñ\s]+" title="Store name must not contain any other special characters." value="<?php echo $row["store_name"]; ?>" required></div>
                    </div>
                    <div class="col-3">
                        <label for="inputBlock" class="form-label fw-bold">Block</label>
                        <div class="input-group"><span class="input-group-text bg-dark text-light"><i class="fa-solid fa-house"></i></span><input type="text" class="form-control" id="store_block" name="store_block" pattern="[0-9]{1,6}" title="Block must not contain any letters or spaces." value="<?php echo $row["store_block"]; ?>" required></div>
                    </div>
                    <div class="col-3">
                        <label for="inputLot" class="form-label fw-bold">Lot</label>
                        <div class="input-group"><span class="input-group-text bg-dark text-light"><i class="fa-solid fa-house"></i></span><input type="text" class="form-control" id="store_lot" name="store_lot" pattern="[0-9]{1,6}" title="Block must not contain any letters or spaces." value="<?php echo $row["store_lot"]; ?>" required></div>
                    </div>
                    <div class="col-6">
                        <label for="inputStreet" class="form-label fw-bold">Street</label>
                        <div class="input-group"><span class="input-group-text bg-dark text-light"><i class="fa-solid fa-house"></i></span><input type="text" class="form-control" id="store_street" name="store_street" pattern="[a-zA-Z0-9-_.ñ\s]+" title="Street must not contain any other special characters." value="<?php echo $row["store_street"]; ?>" required></div>
                    </div>
                    <div class="col-3">
                        <label for="inputBarangay" class="form-label fw-bold">Barangay</label>
                        <div class="input-group"><span class="input-group-text bg-dark text-light"><i class="fa-solid fa-house"></i></span><input type="text" class="form-control" id="store_barangay" name="store_barangay" pattern="[a-zA-Z0-9-_.ñ\s]+" title="Barangay must not contain any special characters." value="<?php echo $row["store_barangay"]; ?>" required></div>
                    </div>
                    <div class="col-md-3">
                        <label for="inputCity" class="form-label fw-bold">City</label>
                        <div class="input-group"><span class="input-group-text bg-dark text-light"><i class="fa-solid fa-house"></i></span><input type="text" class="form-control" id="store_city" name="store_city" pattern="[a-zA-Z-_.ñ\s]+" title="City must not contain any special characters or numbers." value="<?php echo $row["store_city"]; ?>" required></div>
                    </div>
                    <div class="col-md-4">
                      <label for="inputProvince" class="form-label fw-bold">Province</label>
                      <div class="input-group"><span class="input-group-text bg-dark text-light"><i class="fa-solid fa-house"></i></span><input type="text" class="form-control" id="store_province" name="store_province" pattern="[a-zA-Z-_.ñ\s]+" title="Province must not contain any special characters or numbers." value="<?php echo $row["store_province"]; ?>" required></div>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label fw-bold">Zip</label>
                        <div class="input-group"><span class="input-group-text bg-dark text-light"><i class="fa-solid fa-house"></i></span><input type="text" class="form-control" id="store_zip" name="store_zip" pattern="[0-9]{1,6}" title="Zip must not contain any special characters, letters or spaces." value="<?php echo $row["store_zip"]; ?>" required></div>
                    </div>
                    <div class="col-md-6">
                        <label for="inputContact" class="form-label fw-bold">Contact No.</label>
                        <div class="input-group"><span class="input-group-text bg-dark text-light"><i class="fa-solid fa-phone"></i></span><input type="text" class="form-control" id="store_contact" name="store_contact" pattern="[0-9]{11}" title="Contact Number (Format: 09123456789)" value="<?php echo $row["store_contact"]; ?>" required></div>
                    </div>
                    <div class="col-12 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary fw-bold" name="updatedata"><i class="fa-solid fa-paper-plane me-2"></i>Save</button>
                    </div>
                    <?php
                          }

                        }
                      else{
                        echo "No record found";
                      }
                    ?>
                </form>
            </div>
          </div>
        </div>
      </div>
    </main>
      <?php include('../templates/footer.php'); ?>
  </body>
</html>
