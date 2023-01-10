<?php include('../server/connection.php');
  $id = $_GET['receipt_no'];
	$sql = "SELECT * FROM product_sales WHERE receipt_no = '$id'";
	$result = mysqli_query($connection,$sql);
	$row = mysqli_fetch_array($result);
	$result1 = mysqli_query($connection,$sql); 
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
              <center><span class="text-uppercase pd-2 mt-4 text-uppercase fw-bold h3"><i class="fa-solid fa-rectangle-list fa-sm me-3"></i>List of Items</span></center>
            </a>
          </div>
          <?php                    
            $id = $_GET['receipt_no'];
            $sql13 = "SELECT * FROM transaction_logs WHERE receipt_no = '$id'";
            $result13 = mysqli_query($connection,$sql13);
            $row13 = mysqli_fetch_array($result13);
          ?>   
        <div class="list-group mt-4 mb-3 d-grid gap-1">
            <a href="#" type="button" class="fw-bold list-group-item list-group-item-action" aria-current="true"><span><i class="fa-solid fa-rectangle-list fa-lg me-3"></i><?php echo $row13['transaction_id'];?></span></a>
            <a href="monitor_deliveries.php" type="button" class="fw-bold list-group-item list-group-item-action"><span><i class="fa-solid fa-circle-arrow-left fa-lg me-3"></i>Back</span></a>
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
                <span><i class="fa-solid fa-rectangle-list me-2"></i></span>Transaction Logs > <?php echo $row13['transaction_id'];?>
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
                        <div class="input-group"><span class="input-group-text bg-dark text-light"><i class="fa-solid fa-cash-register"></i></span><input type="text" class="form-control text-end" id="grandtotal" name="grandtotal" value="₱<?php echo number_format($row['total'], 2 );?>" readonly></div>
                    </div>
                    <div class="col-3">
                        <label for="inputPayment" class="form-label fw-bold">Payment</label>
                        <div class="input-group"><span class="input-group-text bg-dark text-light"><i class="fa-solid fa-money-bill-transfer"></i></span><input type="text" class="form-control text-end" id="payment" name="payment" value="₱<?php echo number_format($row['payment'], 2 );?>" readonly></div>
                    </div>
                    <div class="col-3">
                        <label for="inputPayment" class="form-label fw-bold">Discount (<?php echo $row['discount'];?>%)</label>
                        <div class="input-group"><span class="input-group-text bg-dark text-light"><i class="fa-solid fa-percent fa-lg"></i></span><input type="text" class="form-control text-end" id="payment" name="payment" value="₱<?php echo number_format($row['discounted_amount'], 2 );?>" readonly></div>
                    </div>
                    <div class="col-3">
                        <label for="inputChange" class="form-label fw-bold">Change</label>
                        <div class="input-group"><span class="input-group-text bg-dark text-light"><i class="fa-solid fa-hand-holding-dollar"></i></span><input type="text" class="form-control text-end" id="change" name="change" value="₱<?php echo number_format($row['changes'], 2 );?>" readonly></div>
                    </div>
                    <div class="col-3">
                        <label for="inputTotalItems" class="form-label fw-bold">Total Items</label>
                        <div class="input-group"><span class="input-group-text bg-dark text-light"><i class="fa-solid fa-basket-shopping"></i></span><input type="text" class="form-control text-end" id="total_quantity" name="total_quantity" value="<?php echo $row["total_quantity"]; ?>" readonly></div>
                    </div>
                </form>

              <div class="card-header text-uppercase fw-bold fs-4 bg-secondary text-light">
                <span><i class="fa-solid fa-basket-shopping me-2"></i></span> LIST OF ITEMS
              </div>
              <div class="card-body mt-4">
                <div class="table-responsive">
                  <table id="example" class="table table-striped data-table" style="width: 100%">
                    <thead class="table-dark">
                      <tr>
                        <th class="fw-bold text-uppercase text-center">Transaction Id</th>
                        <th class="fw-bold text-uppercase text-center">Product Id</th>
                        <th class="fw-bold text-uppercase text-center">Product Description</th>
                        <th class="fw-bold text-uppercase text-center">Brand</th>
                        <th class="fw-bold text-uppercase text-center">Unit</th>
                        <th class="fw-bold text-uppercase text-center">Price</th>
                        <th class="fw-bold text-uppercase text-center">Quantity</th>
                        <th class="fw-bold text-uppercase text-center">Sub Total</th>
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
						<td align="right">₱<?php echo $row1['unit_price'];?></td>
						<td align="right"><?php echo $row1['quantity'];?></td>
            <td align="right">₱<?php echo number_format($row1['sub_total'], 2 );?></td>
					</tr>
					<?php } ?>
                    </tbody>
                      <!--
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
                      -->
                  </table>
                </div>
              </div>
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

      <?php
            $id = $_GET['receipt_no']; 
            $query = "SELECT * FROM transaction_logs WHERE receipt_no = '$id'";
            $query_run = mysqli_query($connection, $query);
            $rowww = mysqli_fetch_assoc($query_run);    
          ?>  
      <script>
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

                            customize: function ( win ) {
                              $(win.document.body).find('table tbody td:nth-child(6)').css('text-align', 'right');
                              $(win.document.body).find('table tbody td:nth-child(7)').css('text-align', 'right');
                              $(win.document.body).find('table tbody td:nth-child(8)').css('text-align', 'right');
                            },

                            text:      '<i class="fa fa-print text-primary" style="font-size: 34px;"></i>',
                            titleAttr: 'Print',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7  ]
                            },
                            title: '',
                            messageTop: '<center><img src="../images/Logo.png" width="200px" height="200px" alt="Logo"><h3><?php echo $roww['store_name']; ?></h3></center> <center><h6><?php echo 'Block&nbsp'; echo $roww['store_block']; echo '&nbspLot&nbsp'; echo $roww['store_lot']; echo '&nbsp'; echo $roww['store_street'];?></h6></center> <center><h6><?php echo 'Barangay&nbsp'; echo $roww['store_barangay']; echo ',&nbsp'; echo $roww['store_city']; echo '&nbsp'; echo $roww['store_province']; echo '&nbsp-&nbsp'; echo $roww['store_zip'];?></h6></center> <center><h6><?php echo 'Contact No.:&nbsp'; echo $roww['store_contact'];?></h6></center> <center><h6><?php echo 'Prepared by:&nbsp'; echo $row['firstname'];?>&nbsp<?php echo $row['lastname'];}}}?></h6></center> <center><h6><?php date_default_timezone_set('Asia/Manila'); $currentDateTime = date('F d, Y | h:i A'); echo 'Date & Time:&nbsp'; echo $currentDateTime; ?></h6></center> <br> <center><h3>LIST OF ITEMS >  <?php echo $row13['transaction_id']; ?></h3></center><br>',
                            messageBottom: '<br><span class="fw-bold mx-5 mt-2 d-flex justify-content-end text-end"><?php echo 'Total Items:&nbsp'; echo $rowww['total_quantity'];?><br><br><?php echo 'Discount&nbsp'; echo '('; echo $rowww['discount']; echo '%):&nbsp'; echo '₱ '; echo number_format($rowww['discounted_amount'], 2 );?><br><br><?php echo 'Grand Total:&nbsp'; echo '₱ '; echo number_format($rowww['total'], 2 );?><br><br><?php echo 'Payment:&nbsp'; echo '₱ '; echo number_format($rowww['payment'], 2 );?><br><br><?php echo 'Change:&nbsp'; echo $rowww['changes'];?><span>' 
                        },
                    ],
              });
          });
      </script>
  </body>
    <?php
        }
      }
        else{
      echo "No record found";
        }
    ?>
</html>
