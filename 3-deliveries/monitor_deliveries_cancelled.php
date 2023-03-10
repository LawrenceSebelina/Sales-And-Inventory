<?php 
  include('../server/connection.php'); 
  include('../security1.php'); 
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../templates/head.php'); ?>
  
  <script>
    function eraseText() {
      document.getElementById("reason").value = "";
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
              <center><span class="text-uppercase pd-2 mt-4 text-uppercase fw-bold h3"><i class="fa-solid fa-truck fa-sm me-3"></i>Deliveries</span></center>
            </a>
          </div>
        <div class="list-group mt-4 mb-3 d-grid gap-1">
            <a href="#" type="button" class="fw-bold list-group-item list-group-item-action active" aria-current="true"><span><i class="fa-solid fa-truck me-3"></i>Monitor Deliveries</span></a>
            <a href="deliveriesbackup.php" type="button" class="fw-bold list-group-item list-group-item-action" aria-current="true"><span><i class="fa-solid fa-trash-can fa-lg me-3"></i>Deliveries Backup</span></a>
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
              <div class="card-header text-uppercase fw-bold fs-4 bg-secondary text-light">
                <span><i class="fa-solid fa-truck me-2"></i></span> Cancelled Delivery Status 
              </div>       

                <div class="dropdown mt-4 pt-2 mb-4 mx-3">
                  <div class="input-group">
                    <span class="input-group-text ms-2 fw-bold bg-transparent border border-white" style="text-decoration: none;">Delivery Status Type:</span>
                    <span class="input-group-text bg-dark text-light"><i class="fa-solid fa-truck"></i></span>
                    <button class="btn btn-light btn-sm border-dark border-1 dropdown-toggle fw-bold" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    &nbsp&nbsp&nbsp&nbsp Cancelled &nbsp&nbsp&nbsp&nbsp
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="monitor_deliveries.php">Pending</a></li>
                        <li><a class="dropdown-item" href="monitor_deliveries_completed.php">Completed</a></li>
                        <li><a class="dropdown-item active" href="#">Cancelled</a></li>
                    </ul>
                  </div>
                </div>
                
              <!-- 
                <div class="gap-3 d-md-flex justify-content-md-end mt-3 mx-4">
                  <button type="button" title="Archived deliveries" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#archivemodal">Archived Deliveries</button>
                </div>
               -->

              <!-- Modal delete-->
                <div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-danger border-2">
                      <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white fw-bold" id="exampleModalLabel"><i class="fa-solid fa-box-archive me-2"></i>Archive Delivery</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
              <!-- Modal delete end-->

              <!-- Modal body delete-->
                      <div class="modal-body">
                        <form class="row g-3 mt-2" action="archivedelivery_cancelled.php" method="POST">

                            <div class="text-center">
                              <h5 class="mx-3">Are you sure that you want to archive the delivery details of <strong><span id="delete_dii" name="delete_dii" class="text-danger"></span></strong></span>?</h5>            
                            </div>

                            <input type="hidden" name="delete_di" id="delete_di">
                            
                            <textarea type="text" class="form-control border-danger border-2" id="reason" name="reason" placeholder="Reason for archiving..." pattern="[a-zA-Z0-9-_.??\s]+" title="Type the reason/s for archiving the delivery." required></textarea>
                            
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary fw-bold" name="deletedata">&nbsp<i class="fa-solid fa-check me-2"></i>Yes&nbsp</button>
                              <button type="button" onclick="eraseText()" class="btn btn-danger fw-bold" data-bs-dismiss="modal">&nbsp&nbsp<i class="fa-solid fa-xmark me-2"></i>No&nbsp&nbsp</button>
                            </div>
                        </form>
                      </div> 
                    </div>
                  </div>
                </div>
              <!-- Modal body delete end-->

              <div class="mt-3 mb-4" style="margin-left: 2.4rem;">
                <div class="row g-2">
                  <label for="selectYear" class="col-auto col-form-label fw-bold">Select Date:</label>
                  <div class="col-sm-3">
                    <div class="input-group">
                      <div class="input-group-text bg-dark text-light"><i class="fa-solid fa-calendar-days"></i></div>
                      <input type="text" id="min" name="min" class="form-control" value="MMMM DD, YYYY">
                    </div>
                  </div>
                  
                  <div class="col-sm">
                    <button type="button" onClick="window.location.reload();" title="Reset" class="btn btn-success"><i class="fa-solid fa-arrow-rotate-right fa-sm"></i></button>
                  </div>
                </div>
              </div>              

              <div class="card-body">
                <div class="table-responsive">
                <?php                    
                    $query_search = "SELECT receipt_no, transaction_id, username, cashier_name, total, payment, changes, total_quantity, date FROM transaction_logs";
                    $query_run = mysqli_query($connection, $query_search);
                  ?>  


                  <?php
                    $query_search = "SELECT * FROM delivery WHERE status = 'Cancelled' AND delivery_status = 0 ORDER BY DATE(`date`) = CURDATE() DESC, status DESC, time ASC";
                    $query_run = mysqli_query($connection, $query_search);
                  ?>   
                  <table id="example" class="table table-striped data-table" style="width: 100%">
                    <thead class="table-dark">
                      <tr>
                        <th class="fw-bold text-uppercase text-center">Delivery No</th>
                        <th class="fw-bold text-uppercase text-center">Transaction Id</th>
                        <th class="fw-bold text-uppercase text-center">Date</th>
                        <th class="fw-bold text-uppercase text-center">Time</th>
                        <th class="fw-bold text-uppercase text-center">Status</th>
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
                            <td><?php echo $row["delivery_id"];?></td>
                            <td><?php echo '<a href="deliverydetails_cancelled.php?receipt_no='.$row["receipt_no"].'">'.$row["transaction_id"].'</a>';?></td>
                            <td align='center'><?php echo date('m/d/Y', strtotime($row["date"])); ?></td>
                            <td align='center'><?php echo date('h:i A', strtotime($row["time"])); ?></td>
                            <td class="text-white" align='center'><?php echo $row["status"];?></td>
                            <td><center>
                                <a name="editbtn" title="View delivery information" href="deliveryinfo_cancelled.php?delivery_id=<?php echo $row['delivery_id'];?>" class="btn btn-primary"><i class="fa-solid fa-table-list"></i></a>
                                <button type="button" title="Archive this delivery" class="btn btn-danger deletebtn"><i class="fa-solid fa-trash-can"></i></button>
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
                            <th class="fw-bold text-uppercase text-center">Delivery No</th>
                            <th class="fw-bold text-uppercase text-center">Transaction Id</th>
                            <th class="fw-bold text-uppercase text-center">Date</th>
                            <th class="fw-bold text-uppercase text-center">Time</th>
                            <th class="fw-bold text-uppercase text-center">Status</th>
                            <th class="fw-bold text-uppercase text-center">Actions</th>
                          </tr>
                        </tfoot>
                      -->
                  </table>
                </div>
              </div>
            </div>
            
            <!-- Modal archive table
              <div class="modal fade" id="archivemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal-content border-warning border-2">
                    <div class="modal-header bg-warning">
                      <h5 class="modal-title fw-bold" id="exampleModalLabel">Archived Deliveries</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            Modal archive table end-->

            <!-- Modal body table archive
                  <div class="modal-body">
                    <form class="row g-3">
                      <div class="card-body"> 
                        <div class="table-responsive">
                          <?php 
                            $query = "SELECT * FROM delivery WHERE delivery_status = 1";
                            $query_run = mysqli_query($connection, $query);
                          ?>   
                          <table id="example1" class="table table-striped table-sm" style="width: 100%">
                              <thead class="table-dark">
                              <tr>
                                <th class="fw-bold text-uppercase text-center">Delivery Id</th>
                                <th class="fw-bold text-uppercase text-center">Transaction Id</th>
                                <th class="fw-bold text-uppercase text-center">Date</th>
                                <th class="fw-bold text-uppercase text-center">Time</th>
                                <th class="fw-bold text-uppercase text-center">Status</th>
                                <th class="fw-bold text-uppercase text-center">&nbsp Archived Date &nbsp</th>
                                <th class="fw-bold text-uppercase text-center">Action</th>
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
                                    <td><?php echo $row['delivery_id'] ?></td>
                                    <td><?php echo $row['transaction_id']?></td>
                                    <td align='center'><?php echo date('m/d/Y', strtotime($row['date'])); ?></td>
                                    <td align='center'><?php echo date('h:i A', strtotime($row['time'])); ?></td>
                                    <td class="text-white" align='center'><?php echo $row['status'] ?></td>
                                    <td align='center'><?php echo date('m/d/Y | g:i A', strtotime($row['delivery_arch_date'])); ?></td>
                                    <td><center>
                                      <button type="button" title="Recover this delivery" class="btn btn-success bi bi-arrow-repeat recoverbtn" data-bs-toggle="modal" data-bs-target="#recovermodal"></button>
                                      <button type="button" title="Delete this delivery" class="btn btn-danger bi bi-trash deletef" data-bs-toggle="modal" data-bs-target="#deleteforever"></button>
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
                                //
                                  <tfoot>
                                    <tr>
                                      <th class="fw-bold text-uppercase text-center">Delivery Id</th>
                                      <th class="fw-bold text-uppercase text-center">Transaction Id</th>
                                      <th class="fw-bold text-uppercase text-center">Date</th>
                                      <th class="fw-bold text-uppercase text-center">Time</th>
                                      <th class="fw-bold text-uppercase text-center">Status</th>
                                      <th class="fw-bold text-uppercase text-center">Archived Date</th>
                                      <th class="fw-bold text-uppercase text-center">Action</th>
                                    </tr>
                                  </tfoot>
                                
                          </table>
                          </div>
                      </div>
                    </form>
                  </div>       
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            Modal body table archive end-->

            <!-- Modal recover
              <div class="modal fade" id="recovermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content border-success border-2">
                    <div class="modal-header bg-success">
                      <h5 class="modal-title text-white fw-bold" id="exampleModalLabel">Recover Delivery</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            Modal recover end-->

            <!-- Modal body recover
                    <div class="modal-body">
                      <form class="row g-3 mt-2" action="recoverdelivery.php" method="POST">

                          <h5 class="mx-3">Are you sure that you want to recover the delivery details of<span><input type="text" class="fw-bold" style="input: border: none; border-color: transparent; outline: none; text-align: center;" id="recover_di" name="recover_di" size="8" readonly></span>?</h5>
                                  
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="recoverdata">&nbsp&nbspYes&nbsp&nbsp</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">&nbsp&nbsp&nbspNo&nbsp&nbsp&nbsp</button>
                          </div>
                      </form>
                    </div> 
                  </div>
                </div>
              </div>
            Modal body recover end-->

            <!-- Modal delete forever
              <div class="modal fade" id="deleteforever" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content border-danger border-2">
                    <div class="modal-header bg-danger">
                      <h5 class="modal-title text-white fw-bold" id="exampleModalLabel">Delete Delivery Forever</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            Modal delete forever end-->

            <!-- Modal body delete forever
                    <div class="modal-body">
                      <form class="row g-3 mt-2" action="deleteforeverdelivery.php" method="POST">
                          
                          <h5 class="mx-3">Are you sure that you want to permanently delete the delivery details of<span><input type="text" class="fw-bold" style="input: border: none; border-color: transparent; outline: none; text-align: center;" id="deletef_di" name="deletef_di" size="8" readonly></span>?</h5>
                      
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="deletefdata" >&nbsp&nbspYes&nbsp&nbsp</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">&nbsp&nbsp&nbspNo&nbsp&nbsp&nbsp</button>
                          </div>
                      </form>
                    </div> 
                  </div>
                </div>
              </div>
            Modal body delete forever end-->

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

            $(document).ready(function() {
                // Create date inputs
                minDate = new DateTime($('#min'), {
                    format: 'MMMM DD, YYYY'
                });  
            });

              // DataTables initialisation
              var table = $('#example').DataTable({
                "ordering": false,

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
                            columns: [ 0, 1, 2, 3, 4  ]
                        },
                        title: '',
                        messageTop: '<center><img src="../images/Logo.png" width="200px" height="200px" alt="Logo"><h3><?php echo $roww['store_name']; ?></h3></center> <center><h6><?php echo 'Block&nbsp'; echo $roww['store_block']; echo '&nbspLot&nbsp'; echo $roww['store_lot']; echo '&nbsp'; echo $roww['store_street'];?></h6></center> <center><h6><?php echo 'Barangay&nbsp'; echo $roww['store_barangay']; echo ',&nbsp'; echo $roww['store_city']; echo '&nbsp'; echo $roww['store_province']; echo '&nbsp-&nbsp'; echo $roww['store_zip'];?></h6></center> <center><h6><?php echo 'Contact No.:&nbsp'; echo $roww['store_contact'];?></h6></center> <center><h6><?php echo 'Prepared by:&nbsp'; echo $row['firstname'];?>&nbsp<?php echo $row['lastname'];}}}?></h6></center> <center><h6><?php date_default_timezone_set('Asia/Manila'); $currentDateTime = date('F d, Y | h:i A'); echo 'Date & Time:&nbsp'; echo $currentDateTime; ?></h6></center> <br> <center><h3>CANCELLED DELIVERY RECORDS</h3></center><br>'
                    },
                ],

              "createdRow": function( row, data, dataIndex ) {
                if (data[4] == "Pending") {        
                  $(row).find('td:eq(4)').css('background-color', '#ffc107');
                }else if (data[4] == "Completed") {        
                  $(row).find('td:eq(4)').css('background-color', '#198754');
                }else if (data[4] == "Not delivered") {        
                  $(row).find('td:eq(4)').css('background-color', '#fd7e14');
                }else{
                  $(row).find('td:eq(4)').css('background-color', '#dc3545');
                }
              }
              
            });

            var minDate;
            
            $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                  console.log(settings.nTable.id);
                  if ( settings.nTable.id !== 'example' ) {
                    return true;
                  }
                  
                    var min = minDate.val();
                    var createdAt = data[2] || 0; // Our date column in the table

                    if (
                      (min == "") ||
                      (moment(createdAt).isSame(min,'day'))
                    ){
                        return true;
                    }
                    return false;
                }
            );
              
            // Refilter the table
            $('#min').on('change', function () {
                table.draw();
            });

            $('#example tbody').on('click', '.deletebtn', function() {
                $('#deletemodal').modal('show');

                    $tr = $(this).closest('tr');
                    var data = $tr.children("td").map(function() {
                    return $(this).text();
                    }).get();

                    console.log(data);

                    $('#delete_di').val(data[0]);
                    $('#delete_dii').text(data[0]);
            });

            //<?php 
                  //$query = "SELECT * FROM store_info";
                  //$query_run = mysqli_query($connection, $query);

                  //if(mysqli_num_rows($query_run) > 0)
                  //{
                    //while($roww = mysqli_fetch_assoc($query_run))
                      //{   
                //?>  
            //<?php 
                  //if(isset($_SESSION['username'])){
                    //$username = $_SESSION['username'];
                    //$sql = "SELECT firstname, lastname FROM users WHERE username='$username'";
                    //$result	= mysqli_query($connection, $sql);
                    //if (mysqli_num_rows($result) > 0){
                      //while($row = mysqli_fetch_assoc($result)){
                //?>

            //$(document).ready(function() {
                //$(document).ready( function () {
                    //var table = $('#example1').DataTable( {
                        //stateSave: true,
                        //pageLength : 5,
                        //lengthMenu: [[5, 10, 20, 25], [5, 10, 20, 25]],

                        //dom: 'Blfrtip',
                          //dom:
                            //"<'row'<'col-sm-12 text-center'B>>" + 
                            //"<'row'<'col-sm-8'l><'col-sm-4'f>>" +
                            //"<'row'<'col-sm-12'tr>>" +
                            //"<'row'<'col-sm-5'i><'col-sm-7'p>>",
                          //buttons: [
                              //{
                                  //extend:    'print',
                                  //text:      '<i class="fa fa-print text-primary" style="font-size: 34px;"></i>',
                                  //titleAttr: 'Print',
                                  //exportOptions: {
                                      //columns: [ 0, 1, 2, 3, 4  ]
                                  //},
                                  //title: '',
                                 // messageTop: 'DELETED'
                              //},
                          //],

                        //"createdRow": function( row, data, dataIndex ) {
                          //if (data[4] == "Pending") {        
                            //$(row).find('td:eq(4)').css('background-color', '#ffc107');
                          //}else if (data[4] == "Completed") {        
                            //$(row).find('td:eq(4)').css('background-color', '#198754');
                          //}else if (data[4] == "Not delivered") {        
                            //$(row).find('td:eq(4)').css('background-color', '#fd7e14');
                          //}else{
                            //$(row).find('td:eq(4)').css('background-color', '#dc3545');
                          //}
                        //}
                    //});
                //});
                
            //});

            //<?php
                //}
              //}
                //else{
              //echo "No record found";
                //}
            //?>

            //$(document).ready(function() {
                //$('.recoverbtn').on('click',function() {
                   // $('#recovermodal').modal('show');

                    //$tr = $(this).closest('tr');
                    //var data = $tr.children("td").map(function() {
                        //return $(this).text();
                    //}).get();

                        //console.log(data);

                        //$('#recover_di').val(data[0]);
                //});
            //});

            //$(document).ready(function() {
                //$('.deletef').on('click',function() {
                    //$('#deleteforever').modal('show');

                    //$tr = $(this).closest('tr');
                    //var data = $tr.children("td").map(function() {
                    //return $(this).text();
                    //}).get();

                    //console.log(data);

                    //$('#deletef_di').val(data[0]);
                //});
            //});

      </script>
    <?php
        }
      }
        else{
      echo "No record found";
        }
    ?>

    <?php 
        if(isset($_SESSION['status']) && $_SESSION['status'] !='')
        {
            ?>
            <script>
                swal({
                    title: "<?php echo $_SESSION['status']; ?>",
                    // text: "You clicked the button!",
                    icon: "<?php echo $_SESSION['status_code']; ?>",
                    button: "Okay",
                });
            </script> 
            <?php
            unset($_SESSION['status']);
        }
    ?>
  </body>
</html>
