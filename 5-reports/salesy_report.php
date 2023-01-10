<?php 
  include('../server/connection.php'); 
  include('../security1.php'); 
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../templates/head.php'); ?>
  <link rel="stylesheet" href="../css/daily_yearlysales.css"/>
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
    <!-- top navigation bar end-->

    <!-- offcanvas -->
    <div class="offcanvas offcanvas-start sidebar-nav bg-light border-secondary border-2" tabindex="-1" id="sidebar">
      <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
          <div class="container bg-secondary"><br>
            <a class="navbar-brand">
              <center><span class="text-uppercase pd-2 mt-4 text-uppercase fw-bold h3">Reports</span></center>
            </a>
          </div>
        <div class="list-group mt-4 mb-3 d-grid gap-1">   
            <a href="salestransac_report.php" type="button" class="fw-bold list-group-item list-group-item-action"><span><i class="fa-solid fa-clipboard-list fa-lg" style="margin-right: 1.3rem;"></i>Transaction Logs</span></a>
            <a href="deliveries_report.php" type="button" class="fw-bold list-group-item list-group-item-action"><span><i class="fa-solid fa-truck me-3"></i>Deliveries</span></a>
            <a href="stock_report.php" type="button" class="fw-bold list-group-item list-group-item-action"><span><i class="fa-solid fa-warehouse me-3"></i>Stock</span></a>
            <a href="inventory_report.php" type="button" class="fw-bold list-group-item list-group-item-action"><span><i class="fa-solid fa-boxes-stacked" style="margin-right: 1.1rem;"></i>Inventory</span></a>
            <a href="#" type="button" class="fw-bold list-group-item list-group-item-action active" aria-current="true"><span><i class="fa-solid fa-money-bill-trend-up" style="margin-right: 1.2rem;"></i>Sales</span></a>
            <a href="../dashboard.php" type="button" class="fw-bold list-group-item list-group-item-action"><span><i class="fa-solid fa-bars fa-lg" style="margin-right: 1.1rem;"></i>Menu</span></a>
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
                <span><i class="fa-solid fa-money-bill-trend-up me-2"></i></span> Yearly Sales
              </div>

              <div class="card-body">
                <div class="dropdown mt-3 mx-3">
                  <div class="input-group">
                    <span class="input-group-text ms-4 fw-bold bg-transparent border border-white" style="text-decoration: none;">Sales Type:</span>
                    <span class="input-group-text bg-dark text-light"><i class="fa-solid fa-calendar-day"></i></span>
                    <button class="btn btn-light btn-sm border-dark border-1 dropdown-toggle fw-bold" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbspYearly&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="sales_report.php">Daily</a></li>
                        <li><a class="dropdown-item" href="salesm_report.php">Monthly</a></li>
                        <li><a class="dropdown-item bg-primary text-white" href="#">Yearly</a></li>
                    </ul>
                  </div>
                </div>

                <!-- <table border="0" cellspacing="5" cellpadding="5" class="ms-2">
                    <tbody><tr>
                        <td><b>Date From:</b></td>
                        <td class="input-group"><i class="bi bi-calendar3 input-group-text"></i><input type="text" id="min" name="min" class="form-control" value="MMMM DD, YYYY"></td>
                        <td><b>Date To:</b></td>
                        <td class="input-group"><i class="bi bi-calendar3 input-group-text"></i><input type="text" id="max" name="max" class="form-control" value="MMMM DD, YYYY"></td>
                    </tr>
                </tbody></table> -->
              </div>  

            <!-- Modal body table add -->
              <div class="card-body">
                <div class="table-responsive">
                  <?php 
                      $sql = "SELECT YEAR(date) as dname, sum(total) as total from transaction_logs GROUP BY YEAR(date) DESC";
                      $result = $connection -> query($sql);
                  ?> 
                  <table id="example" class="table table-striped" style="width: 100%">
                    <thead class="table-dark">
                      <tr>
                        <th class="fw-bold text-uppercase text-center">Date</th>
                        <th class="fw-bold text-uppercase text-center">Total Sales</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($row = $result -> fetch_object()): ?>
                        <tr>
                          <td align='left'><?php echo $row -> dname; ?></td>
                          <td align='right'>₱<?php echo number_format($row -> total, 2); ?></td>
                        </tr>
                      <?php endwhile; ?>
                    </tbody>
                      <tfoot>
                        <tr>
                          <th class="th1">Total:</th>
                          <th class="th2"></th>
                        </tr>
                      </tfoot>
                  </table>
                </div>
              </div> 
            <!-- Modal body table add end -->
                     
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
                  $(document).ready(function() {
                      var numberRenderer = $.fn.dataTable.render.number( ',', '.', 2, ).display;
                    
                      // DataTables initialisation
                      var table = $('#example').DataTable({
                        ordering: false,

                        "footerCallback": function ( row, data, start, end, display ) {
                          var api = this.api(), data;
              
                          // Remove the formatting to get integer data for summation
                          var intVal = function ( i ) {
                              return typeof i === 'string' ?
                                  i.replace(/[\₱,]/g, '')*1 :
                                  typeof i === 'number' ?
                                      i : 0;
                          };
              
                          // Total over all pages
                          total = api
                              .column( 1, { search: 'applied' }  )
                              .data()
                              .reduce( function (a, b) {
                                  return intVal(a) + intVal(b);
                              }, 0 );
              
                          // Total over this page

                          //pageTotal = api
                              //.column( 1, { page: 'current'} )
                              //.data()
                              //.reduce( function (a, b) {
                                  //return intVal(a) + intVal(b);
                              //}, 0 );
              
                          // Update footer
                          $( api.column( 1 ).footer() ).html(
                              //'₱'+ numberRenderer( pageTotal ) +
                              
                              '₱'+ numberRenderer( total ) 
                              
                              //+' Total'
                          );
                        },

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
                                footer: true,
                                title: '',
                                messageTop: '<center><img src="../images/Logo.png" width="200px" height="200px" alt="Logo"><h3><?php echo $roww['store_name']; ?></h3></center> <center><h6><?php echo 'Block&nbsp'; echo $roww['store_block']; echo '&nbspLot&nbsp'; echo $roww['store_lot']; echo '&nbsp'; echo $roww['store_street'];?></h6></center> <center><h6><?php echo 'Barangay&nbsp'; echo $roww['store_barangay']; echo ',&nbsp'; echo $roww['store_city']; echo '&nbsp'; echo $roww['store_province']; echo '&nbsp-&nbsp'; echo $roww['store_zip'];?></h6></center> <center><h6><?php echo 'Contact No.:&nbsp'; echo $roww['store_contact'];?></h6></center> <center><h6><?php echo 'Prepared by:&nbsp'; echo $row['firstname'];?>&nbsp<?php echo $row['lastname'];}}}?></h6></center> <center><h6><?php date_default_timezone_set('Asia/Manila'); $currentDateTime = date('F d, Y | h:i A'); echo 'Date & Time:&nbsp'; echo $currentDateTime; ?></h6></center> <br> <center><h3>MONTHLY SALES</h3></center><br>'
                            },
                        ]
                      });
                    
                      // Refilter the table
                      //$('#min, #max').on('change', function () {
                          //table.draw();
                      //});
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
