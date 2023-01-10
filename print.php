<?php 
  include('server/connection.php'); 
  include('security.php');
  $receipt_no = $_GET['receipt_no'];
	$sql = "SELECT * FROM product_sales WHERE receipt_no = '$receipt_no'";
	$result = mysqli_query($connection,$sql);
	$row = mysqli_fetch_array($result);
	$result1 = mysqli_query($connection,$sql);  
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
    <link rel="stylesheet" href="css/dataTables.dateTime.min.css" />
    <link rel="stylesheet" href="css/buttons.dataTables.min.css"/>
    <link rel="stylesheet" href="css/all.min.css" />
    <!-- <link rel="stylesheet" href="js/dataTables.bootstrap5.min.js"/>
    <link rel="stylesheet" href="js/jquery.dataTables.min.js"/> -->
    <script src="js/jszip.min.js"></script>
    <link rel="icon" href="images/Logo.png">
    <title>SALES AND INVENTORY SYSTEM</title>

    <style>
 
    body{}  
      @media print {
        #PrintButton, #Back, #Back1{
        display: none;
        }
      }
      
      @page {
        size: 5.5in 8.5in;
      }
    </style>

</head>
<body>
  <?php 
    $query = "SELECT * FROM store_info";
    $query_run = mysqli_query($connection, $query);

    if(mysqli_num_rows($query_run) > 0)
    {
      while($roww = mysqli_fetch_assoc($query_run))
        {   
  ?>  

  <center><img src="images/Logo.png" width="150px" height="150px" alt="Logo"><h3><?php echo $roww['store_name']; ?></h3></center> 
  <center><h6><?php echo 'Blk&nbsp'; echo $roww['store_block']; echo '&nbspLot&nbsp'; echo $roww['store_lot']; echo '&nbsp'; echo $roww['store_street'];?></h6></center>
  <center><h6><?php echo 'Barangay&nbsp'; echo $roww['store_barangay']; echo ',&nbsp'; echo $roww['store_city']; echo '&nbsp'; echo $roww['store_province']; echo '&nbsp-&nbsp'; echo $roww['store_zip'];?></h6></center> 
  <center><h6><?php echo 'Contact No.:&nbsp'; echo $roww['store_contact'];?></h6></center><br>
  
  <?php
      }
    }
      else{
    echo "No record found";
      }
  ?>

    <main>
      <div class="container-fluid">              
        <div class="row d-flex justify-content-center">
            <?php 
              if(isset($_SESSION['username'])){
                $username = $_SESSION['username'];
                $sql = "SELECT firstname, lastname FROM users WHERE username='$username'";
                $result	= mysqli_query($connection, $sql);
                if (mysqli_num_rows($result) > 0){
                  while($row = mysqli_fetch_assoc($result)){
            ?>
              <div class="card-body d-flex justify-content-center">
                <div id="content" class="mr-2">
                <h6><?php echo 'Cashier:&nbsp'; echo $row['firstname'];?>&nbsp<?php echo $row['lastname'];}}}?></h6>
                <h6><?php date_default_timezone_set('Asia/Manila'); $currentDateTime = date('m/d/Y | h:i A'); echo 'Date:&nbsp'; echo $currentDateTime; ?></h6>
                <?php
                  $receipt_no = $_GET['receipt_no']; 
                  $query = "SELECT * FROM product_sales WHERE receipt_no = '$receipt_no'";
                  $query_run = mysqli_query($connection, $query);
                  $row = mysqli_fetch_assoc($query_run);
                        
                ?>     
                  <div class="table-responsive">
                    <form>
                      <table id="example" class="table data-table">
                        <thead class="table-light">
                            <th class="text-center" style=" vertical-align: middle;">Qty</th>
                            <th class="text-center" style=" vertical-align: middle;">Desc</th>
                            <th class="text-center" style=" vertical-align: middle;">Price</th>
                            <th class="text-center" style=" vertical-align: middle;">Sub Total</th>
                        </thead>
                        <tbody>
                        <?php 
                          while($row1 = mysqli_fetch_array($result1)){
                          ?>
                          <tr>
                            <td class="text-center" style=" vertical-align: middle;"><?php echo $row1['quantity'];?></td>
                            <td class="text-center" style=" vertical-align: middle;"><?php echo $row1['product_desc'];?></td>
                            <td class="text-end" style=" vertical-align: middle;">₱<?php echo $row1['unit_price'];?></td>
                            <td class="text-end" style=" vertical-align: middle;">₱<?php echo number_format($row1['sub_total'], 2 );?></td>
                          </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                          
                        </tfoot>
                      </table>
                    </form>
                    <?php
                      $receipt_no = $_GET['receipt_no']; 
                      $query = "SELECT * FROM transaction_logs WHERE receipt_no = '$receipt_no'";
                      $query_run = mysqli_query($connection, $query);
                      $row = mysqli_fetch_assoc($query_run);
                            
                    ?>                      
                      
                    <label for="inputTotalItems" class="fw-bold col-form-label mb-2">Total Items:&nbsp</label><b><?php echo $row["total_quantity"]; ?></b><br>
                    <label for="inputDiscount" class="fw-bold mb-2">Discount (<?php echo $row["discount"]; ?>%)</label><label class="fw-bold text-right" style="float: right;">₱<?php echo number_format($row['discounted_amount'], 2 );?></label><br>
                    <label for="inputDiscount" class="fw-bold h4 mb-2">TOTAL</label><label class="fw-bold h4" style="float: right;">₱<?php echo number_format($row['total'], 2 );?></label><br>
                    <label for="inputDiscount" class="fw-bold mb-2 mx-5">CASH</label><label class="fw-bold" style="float: right; margin-right: 50px;">₱<?php echo number_format($row['payment'], 2 );?></label><br>
                    <label for="inputDiscount" class="fw-bold h5 mb-3">CHANGE</label><label class="fw-bold h5" style="float: right;">₱<?php echo number_format($row['changes'], 2 );?></label><br>
                    <label class="mb-3">*************************************************</label>
                    <center><label class="mb-2">Please keep this receipt for you record.</label></center>
                    <center><label class="h4 fw-bold">Thank you, Come again!</label></center>
                    

                      
                      <div class="d-flex justify-content-end mt-4">
                        <button id="PrintButton" class="btn btn-primary fw-bold" onclick="PrintPage()"><i class="fa-solid fa-receipt me-2"></i>Print</button>
                        <button id="Back" data-bs-toggle="modal" data-bs-target="#addmodal" type="button" class="btn btn-success fw-bold mx-2"><i class="fa-solid fa-truck me-2"></i>Add to delivery</button>
                        <button id="Back1" onclick="window.location.href='pos.php'" type="button" class="btn btn-danger fw-bold"><i class="fa-solid fa-cash-register me-2"></i>Back to POS</button>
                      </div>
                </div>
              </div>
              

              <?php include('delivery_id.php'); ?>

                 <!-- Modal add-->
                    <div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content border-warning border-2">
                          <div class="modal-header bg-warning">
                            <h5 class="modal-title fw-bold" id="exampleModalLabel"><i class="fa-solid fa-truck me-2"></i>Create New Delivery</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                  <!-- Modal add end-->
                  <?php
                    $query_search = "SELECT * FROM transaction_logs ORDER BY receipt_no DESC";
                    $query_run = mysqli_query($connection, $query_search);
                    $row = mysqli_fetch_assoc($query_run);
                  ?>                    
                  <!-- Modal body add-->
                          <div class="modal-body" style=" overflow-x: hidden;">
                            <form class="row g-3 mt-2" action="add_delivery.php" method="POST">
                                <label for="inputDeliveryNo" class="col-sm-3 col-form-label ms-3 fw-bold">Delivery No.</label>
                                <div class="col-sm-8">
                                  <div class="input-group"><span class="input-group-text"><i class="fa-solid fa-truck"></i></span><input type="text" class="form-control" id="delivery_id" name="delivery_id" value="<?php echo $number1; ?>" readonly></div>
                                </div>
                                <input type="hidden" class="form-control" id="receipt_no" name="receipt_no" value="<?php echo $row['receipt_no'];?>" readonly>
                                <label for="inputTransacID" class="col-sm-4 col-form-label ms-3 fw-bold">Transaction Id</label>
                                <div class="col-sm-7 mb-2">
                                  <div class="input-group"><span class="input-group-text"><i class="fa-solid fa-key"></i></span><input type="text" class="form-control" id="transac_id" name="transac_id" value="<?php echo $row['transaction_id'];?>" readonly></div>
                                </div>

                                <label for="inputAddress" class="text-center fw-bold text-uppercase mb-2 bg-warning"><span><i class="fa-solid fa-home"></i>&nbsp&nbspCustomer Information</span></label>
                                <label for="inputLastName" class="col-sm-3 col-form-label ms-3 fw-bold">Last Name</label>
                                <div class="col-sm-8">
                                  <div class="input-group"><span class="input-group-text"><i class="fa-solid fa-pen-clip"></i></span><input type="text" class="form-control" id="cust_lname" name="cust_lname" pattern="[a-zA-Z0-9-_.ñ\s]+" title="Last name must not contain any other special characters." placeholder="(e.g. Dele Cruz)" required></div>
                                </div>
                                <label for="inputFirstName" class="col-sm-3 col-form-label ms-3 fw-bold">First Name</label>
                                <div class="col-sm-8">
                                  <div class="input-group"><span class="input-group-text"><i class="fa-solid fa-pen-clip"></i></span><input type="text" class="form-control" id="cust_fname" name="cust_fname" pattern="[a-zA-Z-ñ\s]+" title="First name must not contain any special characters or numbers." placeholder="(e.g. Juan)" required></div>
                                </div>
                                <div class="col-6 ms-3">
                                    <label for="inputBlock" class="form-label fw-bold">Block</label>
                                    <div class="input-group"><span class="input-group-text"><i class="fa-solid fa-pen-clip"></i></span><input type="text" class="form-control" id="cust_block" name="cust_block" pattern="[0-9]{1,6}" title="Block must not contain any letters or spaces." placeholder="(e.g. 1)" required></div>
                                </div>
                                <div class="col-5">
                                    <label for="inputLot" class="form-label fw-bold">Lot</label>
                                    <div class="input-group"><span class="input-group-text"><i class="fa-solid fa-pen-clip"></i></span><input type="text" class="form-control" id="cust_lot" name="cust_lot" pattern="[0-9]{1,6}" title="Block must not contain any letters or spaces." placeholder="(e.g. 2)" required></div>
                                </div>
                                <div class="col-11 ms-3">
                                    <label for="inputStreet" class="form-label fw-bold">Street</label>
                                    <div class="input-group"><span class="input-group-text"><i class="fa-solid fa-pen-clip"></i></span><input type="text" class="form-control" id="cust_street" name="cust_street" pattern="[a-zA-Z0-9-_.ñ\s]+" title="Street must not contain any other special characters." placeholder="(e.g. Phase 3 Southville 5-A)" required></div>
                                </div>
                                <div class="col-6 ms-3">
                                    <label for="inputBarangay" class="form-label fw-bold">Barangay</label>
                                    <div class="input-group"><span class="input-group-text"><i class="fa-solid fa-pen-clip"></i></span><input type="text" class="form-control" id="cust_barangay" name="cust_barangay" pattern="[a-zA-Z0-9-_.ñ\s]+" title="Barangay must not contain any special characters." placeholder="(e.g. Langkiwa)" required></div>
                                </div>
                                <div class="col-5">
                                    <label for="inputCity" class="form-label fw-bold">City</label>
                                    <div class="input-group"><span class="input-group-text"><i class="fa-solid fa-pen-clip"></i></span><input type="text" class="form-control" id="cust_city" name="cust_city" pattern="[a-zA-Z-_.ñ\s]+" title="City must not contain any special characters or numbers." placeholder="(e.g. Biñan)" required></div>
                                </div>
                                <div class="col-5 ms-3">
                                    <label for="inputProvince" class="form-label fw-bold">Province</label>
                                    <div class="input-group"><span class="input-group-text"><i class="fa-solid fa-pen-clip"></i></span><input type="text" class="form-control" id="cust_province" name="cust_province" pattern="[a-zA-Z-_.ñ\s]+" title="Province must not contain any special characters or numbers." placeholder="(e.g. Laguna)" required></div>
                                </div>
                                <div class="col-6">
                                    <label for="inputProvince" class="form-label fw-bold">Contact No.</label>
                                    <div class="input-group"><span class="input-group-text"><i class="fa-solid fa-phone"></i></span><input type="text" class="form-control" id="cust_contact" name="cust_contact" pattern="[0-9]{11}" title="Contact Number (Format: 09123456789)" placeholder="(e.g. 09123456789)" required></div>
                                </div>
                                <div class="col-11 ms-3 mb-2">
                                    <label for="inputOthers" class="form-label fw-bold">Other Information (Optional)</label>
                                    <div class="input-group"><span class="input-group-text"><i class="fa-solid fa-pen-clip"></i></span><input type="text" class="form-control" id="cust_others" name="cust_others" pattern="[a-zA-Z0-9-_.ñ\s]+" title="Must not contain any other special characters."></div>
                                </div>
                                <!-- ORDER BY date DESC -->  
                                <label for="inputDateTime" class="text-center fw-bold text-uppercase bg-warning"><span class="bi bi-calendar-week-fill">&nbsp&nbspDateasdas & Time</span></label>
 
                                    <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" style="height: 250px;">

                                      <?php
                                        $query_search = "SELECT * FROM delivery WHERE status BETWEEN 'Not delivered' AND 'Pending' AND delivery_status = 0 ORDER BY DATE(`date`) >= CURDATE() DESC, status DESC, time ASC";
                                        $query_run = mysqli_query($connection, $query_search);
                                      ?>   
                                      <table id="example3" class="table table-striped data-table" style="width: 100%">
                                        <thead class="table-dark">
                                          <tr>
                                            <th class="fw-bold text-uppercase text-center">Delivery No</th>
                                            <th class="fw-bold text-uppercase text-center">Date</th>
                                            <th class="fw-bold text-uppercase text-center">&nbsp&nbspTime&nbsp&nbsp</th>
                                            <th class="fw-bold text-uppercase text-center">Status</th>
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
                                                <td><?php echo date('m/d/Y', strtotime($row["date"])); ?></td>
                                                <td align='center'><?php echo date('h:i A', strtotime($row["time"])); ?></td>
                                                <td class="text-white" align='center'><?php echo $row["status"];?></td>
                                            </tr>
                                            <?php
                                                }
                                            }
                                            else{
                                                echo "No record found";
                                            }
                                          ?>
                                        </tbody>
                                      </table>
                                    </div>
                                    
                                <!--  
                                <div class="gap-3 d-md-flex justify-content-md-start mb-2 mx-3">
                                  <table border="0" cellspacing="5" cellpadding="5" class="ms-2">
                                    <tbody><tr>
                                        <td><b>Select Date:</b></td>
                                        <td class="input-group"><i class="bi bi-calendar3 input-group-text"></i><input type="text" name="min" id="min" class="form-control" placeholder="MMMM DD, YYYY"></td>
                                        
                                    </tr>
                                  </tbody></table>
                                </div>
                              
                                 <div class="col-6 ms-3">
                                    <label for="inputDate" class="form-label fw-bold">Date</label>
                                    <div class="input-group"><span class="input-group-text"><i class="bi bi-calendar-week-fill"></i></span><input type="date" min="<?= date('Y-m-d'); ?>" class="form-control" id="datetime" name="datetime" required></div>
                                </div>
                                -->   
                                
                                <div class="col-6 ms-3">
                                    <label for="inputDate" class="form-label fw-bold">Date</label>
                                    <div class="input-group"><span class="input-group-text"><i class="fa-solid fa-calendar-day"></i></span><input type="text" name="min" id="min" class="form-control" placeholder="MMMM DD, YYYY"></div>
                                </div>
                                <div class="col-5 mb-3">
                                    <label for="inputTime" class="form-label fw-bold">Time</label>
                                    <div class="input-group"><span class="input-group-text"><i class="fa-solid fa-clock"></i></span><input type="time" title="Time must around 7:00 AM to 5:00 PM." class="form-control" id="time" name="time" required></div>
                                </div>                                
                                <label for="inputStatus" class="col-sm-2 col-form-label ms-3 fw-bold">Status</label>
                                <div class="col-sm-6">
                                  <div class="input-group"><span class="input-group-text"><i class="fa-solid fa-square-poll-vertical"></i></span><input type="text" class="form-control" id="status" name="status" value="Pending" readonly></div>
                                </div>


                                <div class="modal-footer">
                                  <button type="reset" class="btn btn-success text-white fw-bold"><i class="fa-solid fa-arrow-rotate-right me-2"></i> Reset</button>
                                  <button type="submit" class="btn btn-primary fw-bold" name="insertdata"><i class="fa-solid fa-paper-plane me-2"></i> Save</button>
                                  <button class="btn btn-danger fw-bold" data-bs-dismiss="modal"><i class="fa-solid fa-ban me-2"></i>Cancel</button>
                                </div>
                            </form>
                          </div> 
                        </div>
                      </div>
                    </div>
                  <!-- Modal body add end-->
                  
            
          
        </div>
      </div>
    </main>
      <!-- <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/chart.min.js"></script>
      <script src="js/sweetalert.min.js"></script>
      <script src="js/jquery-3.5.1.js"></script>
      <script src="js/jquery.dataTables.min.js"></script>
      <script src="js/dataTables.bootstrap5.min.js"></script>
      <script src="js/accounting.min.js"></script>
      <script src="js/moment.min.js"></script>
      <script src="js/dataTables.dateTime.min.js"></script>
      <script type="text/javascript" src="script4.js"></script> -->

      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/chart.min.js"></script>
      <script src="js/sweetalert.min.js"></script>
      <script src="js/jquery-3.5.1.js"></script>
      <script src="js/jquery.dataTables.min.js"></script>
      <script src="js/dataTables.bootstrap5.min.js"></script>
      <script src="js/time.js"></script>
      <script src="js/time2.js"></script>
      <script src="js/accounting.min.js"></script>
      <script src="js/moment.min.js"></script>
      <script src="js/dataTables.dateTime.min.js"></script>

      <script type="text/javascript">
        function PrintPage() {
          window.print();
      }

      $(document).ready(function() {
            // Create date inputs
            minDate = new DateTime($('#min'), {
                minDate: new Date().toISOString().slice(0, 10),
                format: 'MMMM DD, YYYY'
            });
        });

        //function TDate() {
          //var UserDate = document.getElementById("min").value;
          //var ToDate = new Date();

          //if (new Date(UserDate).getTime() <= ToDate.getTime()) {
                //alert("The Date must be Bigger or Equal to today date");
                //document.getElementById('min').value= " ";
               // return false;
          //}
          //return true;
        //}

          // DataTables initialisation
          var table = $('#example3').DataTable({
            "dom": '',
            "ordering": false,
            "language": {
              "zeroRecords": "No delivery record/s found in this day"
            },

            
                
          "createdRow": function( row, data, dataIndex ) {
            if (data[3] == "Pending") {        
              $(row).find('td:eq(3)').css('background-color', '#ffc107');
            }else if (data[3] == "Completed") {        
              $(row).find('td:eq(3)').css('background-color', '#198754');
            }else if (data[3] == "Not delivered") {        
              $(row).find('td:eq(3)').css('background-color', '#fd7e14');
            }else{
              $(row).find('td:eq(3)').css('background-color', '#dc3545');
            }
          }
          
        });

        var minDate;
        
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
              console.log(settings.nTable.id);
              if ( settings.nTable.id !== 'example3' ) {
                return true;
              }
              
                var min = minDate.val();
                var createdAt = data[1] || 0; // Our date column in the table

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
      </script>
  </body>
</html>

