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
  <?php include('account_id.php'); ?>
    <!-- top navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasExample">
          <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
        </button>
        <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold" href="#">Karesma Trading</a>
      </div>
    </nav>
        <!-- top navigation bar end-->

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
            <a href="store_info.php" type="button" class="fw-bold list-group-item list-group-item-action"><span><i class="fa-solid fa-file-pen me-3"></i>Update Store Info</span></a>
            <a href="#" type="button" class="fw-bold list-group-item list-group-item-action active" aria-current="true"><span><i class="fa-solid fa-user fa-lg me-3"></i>Manage Accounts</span></a>
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
    <!-- offcanvas end-->
    <main class="mt-5 pt-3">
      <div class="container-fluid">              
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card border-secondary border-2">
              <div class="card-header text-uppercase fw-bold fs-4 bg-secondary text-light">
                <span><i class="fa-solid fa-user me-2"></i></span> Manage Accounts
              </div>
                  <?php
                    if(isset($_SESSION['username'])){
                      $username = $_SESSION['username'];
                      $query = "SELECT * FROM users WHERE username='$username'";
                      $results	= mysqli_query($connection, $query);

                      if (mysqli_num_rows($results) == 1) { 
                        $usertypes = mysqli_fetch_array($results);
                        if ($usertypes['position'] == 'Head Admin') {
                          $_SESSION['username'] = $username;
                          echo '<div class="gap-3 d-md-flex justify-content-md-end mb-2 mt-3 mx-4">';
                          echo '<button type="button" title="Add new account" class="btn btn-success fw-bold btn-md" data-bs-toggle="modal" data-bs-target="#addmodal"><i class="fa-solid fa-square-plus me-2"></i> Add New </button>';
                          echo '<button type="button" title="Archived accounts" class="btn btn-success fw-bold btn-md" data-bs-toggle="modal" data-bs-target="#archivemodal"><i class="fa-solid fa-box-archive me-2"></i>Archived Accounts</button>';
                          echo '</div>';	  
                        }else{
                          $_SESSION['username'] = $username;
                          echo '<div class="gap-3 d-md-flex justify-content-md-end mb-2 mt-3 mx-4">';
                          echo '<button type="button" title="Archived accounts" class="btn btn-success fw-bold btn-md" data-bs-toggle="modal" data-bs-target="#archivemodal"><i class="fa-solid fa-box-archive me-2"></i>Archived Accounts</button>';
                          echo '</div>';	 
                        }
                      }
                    }
                  ?> 

                <!--
                  <div class="gap-3 d-md-flex justify-content-md-end mb-2 mt-3 mx-3">
                    <button type="button" title="Add new account" class="btn btn-success btn-md" data-bs-toggle="modal" data-bs-target="#addmodal">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Add New &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
                    <button type="button" title="Archived accounts" class="btn btn-success btn-md" data-bs-toggle="modal" data-bs-target="#archivemodal">Archived Accounts</button>
                  </div>
                  -->
                  
                  <!-- Modal add-->
                    <div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-warning border-2">
                          <div class="modal-header bg-warning">
                            <h5 class="modal-title fw-bold" id="exampleModalLabel"><i class="fa-solid fa-user-plus me-2"></i>Create New Account</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                  <!-- Modal add end-->

                  <!-- Modal body add-->
                          <div class="modal-body">
                            <form class="row g-3 mt-2" action="add_account.php" method="POST">
                                <label for="inputAccountId" class="col-sm-3 col-form-label ms-3 fw-bold">Account Id</label>
                                <div class="col-sm-8">
                                  <div class="input-group"><span class="input-group-text bg-warning"><i class="fa-solid fa-key"></i></span><input type="text" class="form-control" id="account_id" name="account_id" value="<?php echo $number; ?>" readonly></div>
                                </div>
                                <label for="inputLastName" class="col-sm-3 col-form-label ms-3 fw-bold">Last Name</label>
                                <div class="col-sm-8">
                                  <div class="input-group"><span class="input-group-text bg-warning"><i class="fa-solid fa-pen-clip"></i></span><input type="text" class="form-control" id="last_name" name="last_name" pattern="[a-zA-Z0-9-ñ\s]+" title="Last name must not contain any other special characters." placeholder="(e.g. Dela Cruz)" required></div>
                                </div>
                                <label for="inputFirstName" class="col-sm-3 col-form-label ms-3 fw-bold">First Name</label>
                                <div class="col-sm-8">
                                  <div class="input-group"><span class="input-group-text bg-warning"><i class="fa-solid fa-pen-clip"></i></span><input type="text" class="form-control" id="first_name" name="first_name" pattern="[a-zA-Z-ñ\s]+" title="First name must not contain any other special characters or numbers." placeholder="(e.g. Juan)" required></div>
                                </div>
                                <label for="inputContact" class="col-sm-3 col-form-label ms-3 fw-bold">Contact No.</label>
                                <div class="col-sm-8">
                                  <div class="input-group"><span class="input-group-text bg-warning"><i class="fa-solid fa-phone"></i></span><input type="text" class="form-control" id="contact" name="contact" pattern="[0-9]{11}" title="Contact Number (Format: 09123456789)" placeholder="(e.g. 09123456789)" required></div>
                                </div>
                                <label for="inputUsername" class="col-sm-3 col-form-label ms-3 fw-bold">Username</label>
                                <div class="col-sm-8">
                                  <div class="input-group"><span class="input-group-text bg-warning"><i class="fa-solid fa-user"></i></span><input type="text" class="form-control" id="username" name="username" pattern="[a-zA-Z0-9-_.ñ\s]{1,15}" title="Username must not contain any special character or spaces. Maximum of 15 characters." required></div>
                                </div>
                                <label for="inputPassword" class="col-sm-3 col-form-label ms-3 fw-bold">Password</label>
                                <div class="col-sm-8">
                                  <div class="input-group"><span class="input-group-text bg-warning"><i class="fa-solid fa-key"></i></span><input type="password" class="form-control" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required><span class="input-group-text"><i class="fa-solid fa-eye" name="togglePassword" id="togglePassword"></i><span></div>
                                </div>

                                <label for="inputPosition" class="col-sm-3 col-form-label ms-3 fw-bold">Position</label>
                                <div class="col-sm-8">
                                  <div class="input-group"><span class="input-group-text bg-warning"><i class="fa-solid fa-pen-clip"></i></span>
                                  <select id="position" name="position" class="form-control form-control" title="Choose user's position." required>
                                    <option value="Cashier">Cashier</option>
                                    <option value="Admin">Admin</option>
                                  </select>
                                  </div>
                                </div>
                                
                                <div class="modal-footer">
                                  <button type="reset" class="btn btn-success text-white fw-bold"><i class="fa-solid fa-arrow-rotate-right me-2"></i>Reset </button>
                                  <button type="submit" class="btn btn-primary fw-bold" name="insertdata"><i class="fa-solid fa-paper-plane me-2"></i>Save </button>
                                  <button class="btn btn-danger fw-bold" data-bs-dismiss="modal"><i class="fa-solid fa-ban me-2"></i>Cancel</button>
                                </div>
                            </form>
                          </div> 
                        </div>
                      </div>
                    </div>
                  <!-- Modal body add end-->

            <!-- Modal edit-->
            <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content border-primary border-2">
                    <div class="modal-header bg-primary">
                      <h5 class="modal-title text-white fw-bold" id="exampleModalLabel"><i class="fa-solid fa-user-pen me-2"></i>Update Account</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            <!-- Modal edit end-->

            <!-- Modal body edit-->
                    <div class="modal-body">
                      <form class="row g-3 mt-2" action="update_account.php" method="POST">
                          <label for="inputAccountId" class="col-sm-3 col-form-label ms-3 fw-bold">Account Id</label>
                          <div class="col-sm-8">
                            <div class="input-group"><span class="input-group-text bg-primary text-light"><i class="fa-solid fa-key"></i></span><input type="text" class="form-control" id="update_ai" name="update_ai" readonly></div>
                          </div>
                          <label for="inputUsername" class="col-sm-3 col-form-label ms-3 fw-bold">Username</label>
                          <div class="col-sm-8">
                            <div class="input-group"><span class="input-group-text bg-primary text-light"><i class="fa-solid fa-key"></i></span><input type="text" class="form-control" id="update_un" name="update_un" readonly></div>
                          </div>
                          <label for="inputLastName" class="col-sm-3 col-form-label ms-3 fw-bold">Last Name</label>
                          <div class="col-sm-8">
                            <div class="input-group"><span class="input-group-text bg-primary text-light"><i class="fa-solid fa-pen-clip"></i></span><input type="text" class="form-control" id="update_ln" name="update_ln" pattern="[a-zA-Z0-9-ñ\s]+" title="Last name must not contain any other special characters." placeholder="Enter Last Name" required></div>
                          </div>
                          <label for="inputFirstName" class="col-sm-3 col-form-label ms-3 fw-bold">First Name</label>
                          <div class="col-sm-8">
                            <div class="input-group"><span class="input-group-text bg-primary text-light"><i class="fa-solid fa-pen-clip"></i></span><input type="text" class="form-control" id="update_fn" name="update_fn" pattern="[a-zA-Z-ñ\s]+" title="First name must not contain any other special characters or numbers." placeholder="Enter First Name" required></div>
                          </div>
                          <label for="inputContact" class="col-sm-3 col-form-label ms-3 fw-bold">Contact No.</label>
                          <div class="col-sm-8">
                            <div class="input-group"><span class="input-group-text bg-primary text-light"><i class="fa-solid fa-phone"></i></span><input type="text" class="form-control" id="update_contact" name="update_contact" pattern="[0-9]{11}" title="Contact Number (Format: 09123456789)" placeholder="Enter Contact Number" required></div>
                          </div>
                          <label for="inputPosition" class="col-sm-3 col-form-label ms-3 fw-bold">Position</label>
                          <div class="col-sm-8">
                            <div class="input-group"><span class="input-group-text bg-primary text-light"><i class="fa-solid fa-user-tie"></i></span><input type="text" class="form-control" id="update_position" name="update_position" value="Cashier" readonly></div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary fw-bold" name="updatedata"><i class="fa-solid fa-paper-plane me-2"></i>Save</button>
                            <button type="button" class="btn btn-danger fw-bold" data-bs-dismiss="modal"><i class="fa-solid fa-ban me-2"></i>Cancel</button>
                          </div>
                      </form>
                    </div> 
                  </div>
                </div>
              </div>
            <!-- Modal body edit end-->

            <!-- Modal delete-->
              <div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content border-danger border-2">
                    <div class="modal-header bg-danger">
                      <h5 class="modal-title text-white fw-bold" id="exampleModalLabel"><i class="fa-solid fa-box-archive me-2"></i>Archive Account</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            <!-- Modal delete end-->

            <!-- Modal body delete-->
                    <div class="modal-body">
                      <form class="row g-3 mt-2" action="archive_account.php" method="POST">

                          <div class="text-center">
                            <h5 class="mx-3">Are you sure that you want to archive the account details of <strong><span id="delete_aii" name="delete_aii" class="text-danger"></span></strong></span>?</h5>            
                          </div>

                          <input type="hidden" name="delete_ai" id="delete_ai">

                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary fw-bold" name="deletedata">&nbsp<i class="fa-solid fa-check me-2"></i>Yes&nbsp</button>
                            <button type="button" class="btn btn-danger fw-bold" data-bs-dismiss="modal">&nbsp&nbsp<i class="fa-solid fa-xmark me-2"></i>No&nbsp&nbsp</button>
                          </div>
                      </form>
                    </div> 
                  </div>
                </div>
              </div>
            <!-- Modal body delete end-->

            <!-- Modal body add table-->
              <div class="card-body">
                <div class="table-responsive">
                  <?php 
                    $query = "SELECT * FROM users WHERE account_status = 0";
                    $query_run = mysqli_query($connection, $query);
                  ?>  
                  <table id="example" class="table table-striped data-table" style="width: 100%">
                    <thead class="table-dark">
                      <tr>
                        <th class="fw-bold text-uppercase text-center">Account Id</th>
                        <th class="fw-bold text-uppercase text-center">Last Name</th>
                        <th class="fw-bold text-uppercase text-center">First Name</th>
                        <th class="fw-bold text-uppercase text-center">Username</th>
                        <th class="fw-bold text-uppercase text-center">Contact Number</th>
                        <th class="fw-bold text-uppercase text-center">Position</th>
                        <th class="fw-bold text-uppercase text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if(mysqli_num_rows($query_run) > 0)
                        {
                            while($row = mysqli_fetch_assoc($query_run))
                            {
                              ?>
                        <tr>
                          <td><?php echo $row['account_id'] ?></td>
                          <td><?php echo $row['lastname'] ?></td>
                          <td><?php echo $row['firstname'] ?></td>
                          <td><?php echo $row['username'] ?></td>
                          <td align='center'><?php echo $row['contact'] ?></td>
                          <td align='center'><?php echo $row['position'] ?></td>
                          
                          <td><center>
                            <button type="submit" title="Update this account" class="btn btn-primary editbtn"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button type="button" title="Archive this account" class="btn btn-danger deletebtn"><i class="fa-solid fa-trash-can"></i></button>
                            </center>
                          </td>
                        </tr>
                        <?php
                            }
                        }
                        else{
                            echo "No record found";
                        }
                      ?>
                    </tbody>
                      <!--
                        <tfoot>
                          <tr>
                            <th class="fw-bold text-uppercase text-center">Account Id</th>
                            <th class="fw-bold text-uppercase text-center">Last Name</th>
                            <th class="fw-bold text-uppercase text-center">First Name</th>
                            <th class="fw-bold text-uppercase text-center">Username</th>
                            <th class="fw-bold text-uppercase text-center">Contact Number</th>
                            <th class="fw-bold text-uppercase text-center">Position</th>
                            <th class="fw-bold text-uppercase text-center">Actions</th>
                          </tr>
                        </tfoot>
                      -->
                  </table>
                </div>
              </div>
            <!-- Modal body table add end-->

            <!-- Modal archive table-->
            <div class="modal fade" id="archivemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal-content border-warning border-2">
                    <div class="modal-header bg-warning">
                      <h5 class="modal-title fw-bold" id="exampleModalLabel"><i class="fa-solid fa-box-archive me-2"></i>Archive Accounts</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            <!-- Modal archive table end-->

            <!-- Modal body table archive-->
                  <div class="modal-body">
                    <form class="row g-3">
                      <div class="card-body"> 
                        <div class="table-responsive">
                          <?php 
                            $query = "SELECT * FROM users WHERE account_status = 1";
                            $query_run = mysqli_query($connection, $query);
                          ?>   
                          <table id="example1" class="table table-striped table-sm" style="width: 100%">
                              <thead class="table-dark">
                              <tr>
                                <th class="fw-bold text-uppercase text-center">Account Id</th>
                                <th class="fw-bold text-uppercase text-center">First Name</th>
                                <th class="fw-bold text-uppercase text-center">Last Name</th>
                                <th class="fw-bold text-uppercase text-center">Username</th>
                                <th class="fw-bold text-uppercase text-center">Contact Number</th>
                                <th class="fw-bold text-uppercase text-center">Position</th>
                                <th class="fw-bold text-uppercase text-center">&nbsp Archived Date &nbsp</th>
                                <th class="fw-bold text-uppercase text-center">Actions</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                                  if(mysqli_num_rows($query_run) > 0)
                                  {
                                      while($row = mysqli_fetch_assoc($query_run))
                                      {
                                        ?>
                                  <tr>
                                    <td><?php echo $row['account_id'] ?></td>
                                    <td><?php echo $row['firstname'] ?></td>
                                    <td><?php echo $row['lastname'] ?></td>
                                    <td><?php echo $row['username'] ?></td>
                                    <td align='center'><?php echo $row['contact'] ?></td>
                                    <td align='center'><?php echo $row['position'] ?></td>
                                    <td align='center'><?php echo date('m/d/Y | g:i A', strtotime($row["account_arch_date"])) ?></td>
                                    <td><center>
                                      <button type="button" title="Recover this account"class="btn btn-success recoverbtn" data-bs-toggle="modal" data-bs-target="#recovermodal"><i class="fa-solid fa-arrows-rotate"></i></button>
                                      <button type="button" title="Delete this account" class="btn btn-danger deletef" data-bs-toggle="modal" data-bs-target="#deleteforever"><i class="fa-solid fa-trash-can"></i></button>
                                    </center></td>
                                  </tr>
                                  <?php
                                      }

                                  }
                                  else{
                                      echo "No record found";
                                  }
                                ?>
                              </tbody>
                                <!--
                                  <tfoot>
                                    <tr>
                                      <th class="fw-bold text-uppercase text-center">Account Id</th>
                                      <th class="fw-bold text-uppercase text-center">First Name</th>
                                      <th class="fw-bold text-uppercase text-center">Last Name</th>
                                      <th class="fw-bold text-uppercase text-center">Username</th>
                                      <th class="fw-bold text-uppercase text-center">Contact Number</th>
                                      <th class="fw-bold text-uppercase text-center">Position</th>
                                      <th class="fw-bold text-uppercase text-center">Date</th>
                                      <th class="fw-bold text-uppercase text-center">Action</th>
                                    </tr>
                                  </tfoot>
                                -->
                          </table>
                          </div>
                      </div>
                    </form>
                  </div>       
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal"><i class="fa-solid fa-xmark me-2"></i>Close</button>
                    </div>
                  </div>
                </div>
              </div>
            <!-- Modal body table archive end-->
            
            <!-- Modal recover-->
              <div class="modal fade" id="recovermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content border-success border-2">
                    <div class="modal-header bg-success">
                      <h5 class="modal-title text-white fw-bold" id="exampleModalLabel"><i class="fa-solid fa-arrows-rotate me-2"></i>Recover Account</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            <!-- Modal recover end-->

            <!-- Modal body recover-->
                    <div class="modal-body">
                      <form class="row g-3 mt-2" action="recover_account.php" method="POST">

                          <div class="text-center">
                            <h5 class="mx-3">Are you sure that you want to recover the account details of <strong><span id="recover_aii" name="recover_aii" class="text-success"></span></strong></span>?</h5>            
                          </div>

                          <input type="hidden" name="recover_ai" id="recover_ai">
                    
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary fw-bold" name="recoverdata">&nbsp<i class="fa-solid fa-check me-2"></i>Yes&nbsp</button>
                            <button type="button" class="btn btn-danger fw-bold" data-bs-dismiss="modal">&nbsp&nbsp<i class="fa-solid fa-xmark me-2"></i>No&nbsp&nbsp</button>
                          </div>
                      </form>
                    </div> 
                  </div>
                </div>
              </div>
            <!-- Modal body recover end-->

            <!-- Modal delete forever-->
              <div class="modal fade" id="deleteforever" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content border-danger border-2">
                    <div class="modal-header bg-danger">
                      <h5 class="modal-title text-white fw-bold" id="exampleModalLabel"><i class="fa-solid fa-trash-can me-2"></i>Delete Account Forever</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            <!-- Modal delete forever end-->

            <!-- Modal body delete forever-->
                    <div class="modal-body">
                      <form class="row g-3 mt-2" action="deleteforever_account.php" method="POST">

                          <div class="text-center">
                            <h5 class="mx-3">Are you sure that you want to permanently delete the account details of <strong><span id="deletef_idd" name="deletef_idd" class="text-danger"></span></strong></span>?</h5>            
                          </div>
                          
                          <input type="hidden" name="deletef_id" id="deletef_id">

                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary fw-bold" name="deletefdata">&nbsp<i class="fa-solid fa-check me-2"></i>Yes&nbsp</button>
                            <button type="button" class="btn btn-danger fw-bold" data-bs-dismiss="modal">&nbsp&nbsp<i class="fa-solid fa-xmark me-2"></i>No&nbsp&nbsp</button>
                          </div>
                      </form>
                    </div> 
                  </div>
                </div>
              </div>
            <!-- Modal body delete forever end-->

            </div>
          </div>
        </div>
      </div>
    </main>
      <?php include('../templates/footer.php'); ?>
      <script src="../js/moment.min.js"></script>
      <script src="../js/dataTables.dateTime.min.js"></script>
      <script src="../js/dataTables.buttons.min.js"></script>
      <script src="../js/vfs_fonts.js"></script>
      <script src="../js/buttons.html5.min.js"></script>
      <script src="../js/buttons.print.min.js"></script>

      <?php 
            $query = "SELECT * FROM store_info";
            $query_run = mysqli_query($connection, $query);

            if(mysqli_num_rows($query_run) > 0)
            {
              while($roww = mysqli_fetch_assoc($query_run))
                {   
          ?>  
      <?php 
            if(isset($_SESSION['username'])){
              $username = $_SESSION['username'];
              $sql = "SELECT firstname, lastname FROM users WHERE username='$username'";
              $result	= mysqli_query($connection, $sql);
              if (mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
          ?>

  <script>
		// $(function () {
  	// 		$('[data-toggle="popover"]').popover()
	  //   });
    //   $(".toggle-password").click(function() {
    //       $(this).toggleClass("bi bi-eye-slash-fill");
    //       var input = $($(this).attr("toggle"));
    //       if (input.attr("type") == "password") {
    //         input.attr("type", "text");
    //       } else {
    //         input.attr("type", "password");
    //       }
    //   });


    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      this.classList.toggle('fa-eye-slash');
    });

    
    $(document).ready(function() {
      $(document).ready( function () {
            var table = $('#example').DataTable( {
              stateSave: true,
              pageLength : 10,
              lengthMenu: [[10, 15, 20, 25], [10, 15, 20, 25]],

              dom: 'Blfrtip',
                dom:
                  "<'row'<'col-sm-12 text-center'B>>" + 
                  "<'row'<'col-sm-8'l><'col-sm-4'f>>" +
                  "<'row'<'col-sm-12'tr>>" +
                  "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                buttons: [
                    {
                        extend:    'print',
                        text:      '<i class="fa fa-print text-primary" style="font-size: 34px;"></i>',
                        titleAttr: 'Print',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5  ]
                        },
                        title: '',
                        messageTop: '<center><img src="../images/Logo.png" width="200px" height="200px" alt="Logo"><h3><?php echo $roww['store_name']; ?></h3></center> <center><h6><?php echo 'Block&nbsp'; echo $roww['store_block']; echo '&nbspLot&nbsp'; echo $roww['store_lot']; echo '&nbsp'; echo $roww['store_street'];?></h6></center> <center><h6><?php echo 'Barangay&nbsp'; echo $roww['store_barangay']; echo ',&nbsp'; echo $roww['store_city']; echo '&nbsp'; echo $roww['store_province']; echo '&nbsp-&nbsp'; echo $roww['store_zip'];?></h6></center> <center><h6><?php echo 'Contact No.:&nbsp'; echo $roww['store_contact'];?></h6></center> <center><h6><?php echo 'Prepared by:&nbsp'; echo $row['firstname'];?>&nbsp<?php echo $row['lastname'];}}}?></h6></center> <center><h6><?php date_default_timezone_set('Asia/Manila'); $currentDateTime = date('F d, Y | h:i A'); echo 'Date & Time:&nbsp'; echo $currentDateTime; ?></h6></center> <br> <center><h3>SYSTEM ACCOUNTS</h3></center><br>'
                    },
                ],
              
            })
          });
      $('.editbtn').on('click',function() {
        $('#example').on('click', '.editbtn', function() {
          $('#editmodal').modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#update_ai').val(data[0]);
            $('#update_ln').val(data[1]);
            $('#update_fn').val(data[2]);
            $('#update_un').val(data[3]);
            $('#update_contact').val(data[4]); 
            $('#update_position').val(data[5]); 
        });
      });
    });

    <?php 
          $query = "SELECT * FROM store_info";
          $query_run = mysqli_query($connection, $query);

          if(mysqli_num_rows($query_run) > 0)
          {
            while($roww = mysqli_fetch_assoc($query_run))
              {   
        ?>  
    <?php 
          if(isset($_SESSION['username'])){
            $username = $_SESSION['username'];
            $sql = "SELECT firstname, lastname FROM users WHERE username='$username'";
            $result	= mysqli_query($connection, $sql);
            if (mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_assoc($result)){
        ?>

    $(document).ready(function() {
      $(document).ready( function () {
          var table = $('#example1').DataTable( {
            stateSave: true,
            pageLength : 5,
            lengthMenu: [[5, 10, 20, 25], [5, 10, 20, 25]],

            dom: 'Blfrtip',
                dom:
                  "<'row'<'col-sm-12 text-center'B>>" + 
                  "<'row'<'col-sm-8'l><'col-sm-4'f>>" +
                  "<'row'<'col-sm-12'tr>>" +
                  "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                buttons: [
                    {
                        extend:    'print',
                        text:      '<i class="fa fa-print text-primary" style="font-size: 34px;"></i>',
                        titleAttr: 'Print',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6  ]
                        },
                        title: '',
                        messageTop: '<center><img src="../images/Logo.png" width="200px" height="200px" alt="Logo"><h3><?php echo $roww['store_name']; ?></h3></center> <center><h6><?php echo 'Block&nbsp'; echo $roww['store_block']; echo '&nbspLot&nbsp'; echo $roww['store_lot']; echo '&nbsp'; echo $roww['store_street'];?></h6></center> <center><h6><?php echo 'Barangay&nbsp'; echo $roww['store_barangay']; echo ',&nbsp'; echo $roww['store_city']; echo '&nbsp'; echo $roww['store_province']; echo '&nbsp-&nbsp'; echo $roww['store_zip'];?></h6></center> <center><h6><?php echo 'Contact No.:&nbsp'; echo $roww['store_contact'];?></h6></center> <center><h6><?php echo 'Prepared by:&nbsp'; echo $row['firstname'];?>&nbsp<?php echo $row['lastname'];}}}?></h6></center> <center><h6><?php date_default_timezone_set('Asia/Manila'); $currentDateTime = date('F d, Y | h:i A'); echo 'Date & Time:&nbsp'; echo $currentDateTime; ?></h6></center> <br> <center><h3>ARCHIVED ACCOUNTS</h3></center><br>'
                    },
                ],
        });
      });

      <?php
        }
      }
        else{
      echo "No record found";
        }
      ?>

      $('.deletebtn').on('click',function() {
        $('#deletemodal').modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
              return $(this).text();
            }).get();

            console.log(data);

            $('#delete_ai').val(data[0]);
            $('#delete_aii').text(data[0]);
      });
    });

    $(document).ready(function() {
      $('.recoverbtn').on('click',function() {
        $('#recovermodal').modal('show');

          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
            return $(this).text();
          }).get();

            console.log(data);

            $('#recover_ai').val(data[0]);
            $('#recover_aii').text(data[0]);
      });
    });

    $(document).ready(function() {
      $('.deletef').on('click',function() {
        $('#deleteforever').modal('show');

          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function() {
          return $(this).text();
          }).get();

          console.log(data);

          $('#deletef_id').val(data[0]);
          $('#deletef_idd').text(data[0]);
      });
    });

	</script>
      <?php
        }
      }
        else{
      echo "No record found";
        }
      ?>
  </body>
</html>
