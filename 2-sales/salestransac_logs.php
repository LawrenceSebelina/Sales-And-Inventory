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
              <center><span class="text-uppercase pd-2 mt-4 text-uppercase fw-bold h3"><i class="fa-solid fa-chart-line fa-sm me-3"></i>Sales</span></center>
            </a>
          </div>
        <div class="list-group mt-4 mb-3 d-grid gap-1">
            <a href="#" type="button" class="fw-bold list-group-item list-group-item-action active" aria-current="true"><span><i class="fa-solid fa-clipboard-list fa-lg me-3"></i>Transaction Logs</span></a>
            <a href="monitor_sales_daily.php" type="button" class="fw-bold list-group-item list-group-item-action"><span><i class="fa-solid fa-money-bill-trend-up me-3"></i>Monitor Sales</span></a>
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
                <span><i class="fa-solid fa-clipboard-list me-2"></i></span> Transaction Logs
              </div>

              <div class="d-flex justify-content-center mt-5">
                <div class="row g-2">
                  <label for="dateFrom" class="col-auto col-form-label fw-bold">Date From:</label>
                  <div class="col-sm-4">
                    <div class="input-group">
                      <div class="input-group-text bg-dark text-light"><i class="fa-solid fa-calendar"></i></div>
                      <input type="text" id="min" name="min" onchange="FDate()" class="form-control" value="MMMM DD, YYYY">
                    </div>
                  </div>

                  <label for="dateTo" class="col-auto col-form-label fw-bold">Date To:</label>
                  <div class="col-sm-4">
                    <div class="input-group">
                      <div class="input-group-text bg-dark text-light"><i class="fa-solid fa-calendar"></i></div>
                      <input type="text" id="max" name="max" onchange="TDate()" class="form-control" value="MMMM DD, YYYY">
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
                    $query_search = "SELECT receipt_no, transaction_id, cashier_name, total, discount, payment, changes, total_quantity, date FROM transaction_logs";
                    $query_run = mysqli_query($connection, $query_search);
                  ?>   
                  <table id="example" class="table table-striped data-table" style="width: 100%">
                    <thead class="table-dark">
                      <tr>
                        <th class="fw-bold text-uppercase text-center">Transaction Id</th>
                        <th class="fw-bold text-uppercase text-center">Cashier Name</th>
                        <th class="fw-bold text-uppercase text-center">Grand Total</th>
                        <th class="fw-bold text-uppercase text-center">Discount</th>
                        <th class="fw-bold text-uppercase text-center">Payment</th>
                        <th class="fw-bold text-uppercase text-center">Change</th>
                        <th class="fw-bold text-uppercase text-center">Total Items</th>
                        <th class="fw-bold text-uppercase text-center">&nbspDate&nbsp</th>
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
                            <td><?php echo '<a href="../2-sales/sales_details.php?receipt_no='.$row["receipt_no"].'">'.$row["transaction_id"].'</a>';?></td>
                            <td><?php echo $row["cashier_name"];?></td>
                            <td align='right'>₱<?php echo number_format($row['total'], 2);?></td>
                            <td align='right'><?php echo $row['discount'];?>%</td>
                            <td align='right'>₱<?php echo number_format($row['payment'], 2);?></td>
                            <td align='right'>₱<?php echo number_format($row['changes'], 2);?></td>
                            <td align='right'><?php echo $row['total_quantity']; ?></td>
                            <td align='right'><?php echo date('m/d/Y', strtotime($row["date"])); ?></td>
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
                            <th class="fw-bold text-uppercase text-center">Transaction Id</th>
                            <th class="fw-bold text-uppercase text-center">Cashier Name</th>
                            <th class="fw-bold text-uppercase text-center">Grand Total</th>
                            <th class="fw-bold text-uppercase text-center">Discount</th>
                            <th class="fw-bold text-uppercase text-center">Payment</th>
                            <th class="fw-bold text-uppercase text-center">Change</th>
                            <th class="fw-bold text-uppercase text-center">Total Items</th>
                            <th class="fw-bold text-uppercase text-center">Date</th>
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
      <script src="../js/dataTables.buttons.min.js"></script>
      <script src="../js/vfs_fonts.js"></script>
      <script src="../js/buttons.html5.min.js"></script>
      <script src="../js/buttons.print.min.js"></script>
      <script src="../js/moment.min.js"></script>
      <script src="../js/dataTables.dateTime.min.js"></script>

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

        function FDate() {
          var FromDate = document.getElementById("min").value;
          var ToDate = document.getElementById("max").value;

          if (new Date(FromDate).getTime() >= new Date(ToDate).getTime()) {
                alert("The date 'From' must be smaller to date 'To'");
                location.reload();
                return false;
          }
          return true;
        }

        function TDate() {
          var FromDate = document.getElementById("min").value;
          var ToDate = document.getElementById("max").value;

          if (new Date(ToDate).getTime() <= new Date(FromDate).getTime()) {
                alert("The date 'To' must be bigger to date 'From'");
                location.reload();
                return false;
          }
          return true;
        }

          var minDate, maxDate;
          
          $.fn.dataTable.ext.search.push(
              function( settings, data, dataIndex ) {
                  var min = minDate.val();
                  var max = maxDate.val();
                  var date = new Date( data[7] );
            
                  if (
                      ( min === null && max === null ) ||
                      ( min === null && date <= max ) ||
                      ( min <= date && max === null ) ||
                      ( min <= date && date <= max )
                  ) {
                      return true;
                  }
                  return false;
              }
          );
            
          $(document).ready(function() {
              // Create date inputs
              minDate = new DateTime($('#min'), {
                  format: 'MMMM DD, YYYY'
              });
              maxDate = new DateTime($('#max'), {
                  format: 'MMMM DD, YYYY'
              });
            
              // DataTables initialisation
              var table = $('#example').DataTable({
                order:[[0,"desc"]],

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
                          $(win.document.body).find('table tbody td:nth-child(3)').css('text-align', 'right');
                          $(win.document.body).find('table tbody td:nth-child(4)').css('text-align', 'right');
                          $(win.document.body).find('table tbody td:nth-child(5)').css('text-align', 'right');
                          $(win.document.body).find('table tbody td:nth-child(6)').css('text-align', 'right');
                          $(win.document.body).find('table tbody td:nth-child(7)').css('text-align', 'right');
                        },

                        text:      '<i class="fa fa-print text-primary" style="font-size: 34px;"></i>',
                        titleAttr: 'Print',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7  ]
                        },
                        title: '',
                        messageTop: '<center><img src="../images/Logo.png" width="200px" height="200px" alt="Logo"><h3><?php echo $roww['store_name']; ?></h3></center> <center><h6><?php echo 'Block&nbsp'; echo $roww['store_block']; echo '&nbspLot&nbsp'; echo $roww['store_lot']; echo '&nbsp'; echo $roww['store_street'];?></h6></center> <center><h6><?php echo 'Barangay&nbsp'; echo $roww['store_barangay']; echo ',&nbsp'; echo $roww['store_city']; echo '&nbsp'; echo $roww['store_province']; echo '&nbsp-&nbsp'; echo $roww['store_zip'];?></h6></center> <center><h6><?php echo 'Contact No.:&nbsp'; echo $roww['store_contact'];?></h6></center> <center><h6><?php echo 'Prepared by:&nbsp'; echo $row['firstname'];?>&nbsp<?php echo $row['lastname'];}}}?></h6></center> <center><h6><?php date_default_timezone_set('Asia/Manila'); $currentDateTime = date('F d, Y | h:i A'); echo 'Date & Time:&nbsp'; echo $currentDateTime; ?></h6></center> <br> <center><h3>SALES TRANSACTION LOGS</h3></center><br>'
                    },
                ]
              
              });
            
              // Refilter the table
              $('#min, #max').on('change', function () {
                  table.draw();
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
