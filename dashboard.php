<?php 
  include('server/connection.php'); 
  include('security.php'); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- <link rel="stylesheet" href="css/bootstrap-icons.css"/> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/all.min.css" />
    <!-- <link rel="stylesheet" href="js/dataTables.bootstrap5.min.js"/>
    <link rel="stylesheet" href="js/jquery.dataTables.min.js"/> -->
    <link rel="icon" href="images/Logo.png">
    <title>SALES AND INVENTORY SYSTEM</title>

  <style>
        .my-custom-scrollbar {
        position: relative;
        height: 400px;
        overflow: auto;
        }

        .table-wrapper-scroll-y {
        display: block;
        }

        .table td, .table th {
          vertical-align: middle;
        }

        .box{
          position: relative;
          display: inline-block; /* Make the width of box same as image */
        }

        .box .text{
          position: absolute;
          z-index: 999;
          margin: 0 auto;
          left: 0;
          right: 0;        
          text-align: center;
          top: 67%; /* Adjust this value to move the positioned div up and down */
        }
  </style>
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
          <div class="container bg-secondary box">
          <center><img src="images/Logo.png" style="width:100%;" height="200px" alt="" class="mb-5"></center>
          <?php 
              if(isset($_SESSION['username'])){
                $username = $_SESSION['username'];
                $sql = "SELECT firstname, lastname FROM users WHERE username='$username'";
                $result	= mysqli_query($connection, $sql);
                if (mysqli_num_rows($result) > 0){
                  while($row = mysqli_fetch_assoc($result)){
            ?>

            <center><a class="navbar-brand text"><small class="text-uppercase text-uppercase fw-bold text-info"><?php echo $row['firstname'];?>&nbsp<?php echo $row['lastname'];}}}?></small><br>
            
              <small class="text-uppercase text-uppercase fw-bold text-warning">
                <?php
                if(isset($_SESSION['username'])){
                  $username = $_SESSION['username'];
                  $query = "SELECT * FROM users WHERE username='$username'";
                  $results	= mysqli_query($connection, $query);

                  if (mysqli_num_rows($results) == 1) { 
                    $usertypes = mysqli_fetch_array($results);
                    if ($usertypes['position'] == 'Head Admin') {
                      $_SESSION['username'] = $username;
                      echo 'Head Admin';	  
                    }else{
                      $_SESSION['username'] = $username;
                      echo 'Admin';
                    }
                  }
                }
                ?> 
              </small></a></center>
          </div>
        <div class="list-group mt-3 mb-3 d-grid gap-1">
            <a href="#" type="button" class="fw-bold list-group-item list-group-item-action active" aria-current="true"><span><i class="fa-solid fa-gauge" style="margin-right: 1rem;"></i>Dashboard</span></a>
            <a href="1-inventory/manage_product.php" type="button" class="fw-bold list-group-item list-group-item-action"><span><i class="fa-solid fa-boxes-stacked" style="margin-right: 0.9rem;"></i>Inventory</span></a>
            <a href="2-sales/salestransac_logs.php" type="button" class="fw-bold list-group-item list-group-item-action"><span><i class="fa-solid fa-chart-line" style="margin-right: 1rem;"></i>Sales</span></a>
            <a href="3-deliveries/monitor_deliveries.php" type="button" class="fw-bold list-group-item list-group-item-action"><span><i class="fa-solid fa-truck" style="margin-right: 0.8rem;"></i>Deliveries</span></a>
            <a href="4-configuration/store_info.php" type="button" class="fw-bold list-group-item list-group-item-action"><span><i class="fa-solid fa-gear" style="margin-right: 1rem;"></i>Configuration</span></a>
            <a href="5-reports/salestransac_report.php" type="button" class="fw-bold list-group-item list-group-item-action"><span><i class="fa-solid fa-folder-open" style="margin-right: 1rem;"></i>Reports</span></a>
            <a type="button" name="signout" onclick="out();" class="signout fw-bold list-group-item list-group-item-action"><span><i class="fa-solid fa-arrow-right-from-bracket" style="margin-right: 1.1rem;"></i>Sign Out</span></a>
        </div>
        </nav>
      </div>
    </div>
    <!-- offcanvas -->
    <main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h4 class="fw-bold">Dashboard</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 mb-3">
            <div class="card border-danger border-2 text-white h-100">
              <div class="card-header bg-danger fw-bold"><span><i class="fa-solid fa-basket-shopping"></i>&nbsp&nbsp&nbspTotal Products</span></div>
                <?php
                    $count = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM product WHERE product_status = 0")); 
                    if ($count > 0) {
                ?>
                
                <?php 
                  echo '<div class="card-body py-5 text-danger d-md-flex justify-content-md-center">';
                  echo '<span class= "fs-1">';
                  echo $count;
                  echo '</span>';
                  echo '</div>';
      
                  }else{
                  echo '<div class="card-body py-5 text-danger d-md-flex justify-content-md-center">';
                  echo '<span class= "fs-5 mx-3">';
                  echo "&nbsp&nbsp&nbsp&nbspNo available &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspproduct";
                  echo '</span>';
                  echo '</div>';
                  }
                ?>

              <!-- <div class="card-body py-5 text-danger d-md-flex justify-content-md-center"> </span>
                <span class= "fs-1"><?php echo $count;?></span>
              </div> -->

              <div class="card-footer bg-danger text-white d-flex justify-content-md-center">
                <a href="1-inventory/manage_product.php" style="text-decoration: none;" class="card-link text-white fw-bold">View Details <span class="ms-auto"><i class="fa-solid fa-circle-arrow-right"></i></span></a>
              </div>
            </div>
          </div>

          <div class="col-md-3 mb-3">
            <div class="card border-primary border-2 text-white h-100">
              <div class="card-header bg-primary fw-bold"><span><i class="fa-solid fa-money-bill-trend-up"></i>&nbsp&nbsp&nbspDaily Sales</span></div>
              <?php 
                  $sql = "SELECT sum(total) as total from transaction_logs WHERE DATE(`date`) = CURDATE()";
                  $result = $connection -> query($sql);
              ?> 
              <div class="card-body py-5 text-primary d-md-flex justify-content-md-center">
                <span class= "fs-3 mt-2">₱<?php while ($row = $result -> fetch_object()): echo number_format($row -> total, 2); endwhile; ?></span>
              </div>
              <div class="card-footer bg-primary text-white d-flex justify-content-md-center">
                <a href="2-sales/monitor_sales_daily.php" style="text-decoration: none;" class="card-link text-white fw-bold">View Details <span class="ms-auto"><i class="fa-solid fa-circle-arrow-right"></i></span></a>
              </div>
            </div>
          </div>

          <div class="col-md-3 mb-3">
            <div class="card border-success border-2 text-white h-100">
              <div class="card-header bg-success fw-bold"><span><i class="fa-solid fa-warehouse"></i>&nbsp&nbsp&nbspCritical Stocks</span></div>
                <?php
                    $count = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM product WHERE quantity <= 20 ")); 
                    if ($count > 0) {
                      // output data of each row 
                ?>  

                <?php 
                  echo '<div class="card-body py-5 text-success d-md-flex justify-content-md-center">';
                  echo '<span class= "fs-1 mx-3">';
                  echo $count;
                  echo '</span>';
                  echo '</div>';
      
                  }else{
                  echo '<div class="card-body py-5 text-success d-md-flex justify-content-md-center">';
                  echo '<span class= "fs-5 mx-3">';
                  echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbspNo critical &nbsp&nbsp&nbspproduct stock";
                  echo '</span>';
                  echo '</div>';
                  }
                ?>
                
              <!--<div class="card-body py-5 text-success d-md-flex justify-content-md-center">
                <span class= "fs-1 mx-3"><?php echo $count;?></span>
              </div> -->

              <div class="card-footer bg-success text-white d-flex justify-content-md-center">
                <a href="1-inventory/manage_stock.php" style="text-decoration: none;" class="card-link text-white fw-bold">View Details <span class="ms-auto"><i class="fa-solid fa-circle-arrow-right"></i></span></a>
              </div>
            </div>
          </div>

          <div class="col-md-3 mb-3">
            <div class="card border-secondary border-2 text-white h-100">
              <div class="card-header bg-secondary fw-bold"><span><i class="fa-solid fa-clock"></i>&nbsp&nbsp&nbspScheduled Delivery</span></div>
                <?php 
                  // AND DATE(`date`) = CURDATE() AND TIME(`time`) >= CURTIME()
                  $query = "SELECT * FROM delivery WHERE status = 'Pending' AND delivery_status = 0 ORDER BY DATE(`date`) = CURDATE() DESC, status DESC, time ASC LIMIT 1";
                  $query_run = mysqli_query($connection, $query);

                  //$row = mysqli_fetch_assoc($query_run)

                  if (mysqli_num_rows($query_run) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($query_run)) {

                ?>  
              
                <?php 
                  echo '<div class="card-body py-5 text-secondary d-md-flex justify-content-md-center">';
                  echo '<span class= "fs-5 mx-3">';
                  echo "&nbsp";
                  echo date('m/d/y <\b\r>', strtotime($row["date"]));
                  echo date('h:i A', strtotime($row["time"]));
                  echo '</span>';
                  echo '</div>';
                    }
                  }else{
                  echo '<div class="card-body py-5 text-secondary d-md-flex justify-content-md-center">';
                  echo '<span class= "fs-5 mx-3">';
                  echo "&nbsp&nbsp&nbsp&nbspNo delivery &nbsp&nbspat this moment";
                  echo '</span>';
                  echo '</div>';
                  }
                ?>
                
              <div class="card-footer bg-secondary text-white d-flex justify-content-md-center">
                <a href="3-deliveries/monitor_deliveries.php" style="text-decoration: none;" class="card-link text-white fw-bold">View Details <span class="ms-auto"><i class="fa-solid fa-circle-arrow-right"></i></span></a>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <div class="card border-info border-2 h-100">
              <div class="card-header bg-info fw-bold">
                <span class="me-2"><i class="fa-solid fa-money-bill-trend-up"></i></span>
                Daily Sales
              </div>
              <div class="card-body">
                <canvas id="chart" width="400" height="200"></canvas>
              </div>
              <div class="card-footer bg-info d-flex justify-content-md-center">
                <a href="2-sales/monitor_sales_daily.php" style="text-decoration: none;" class="card-link text-dark fw-bold">View Details <span class="ms-auto"><i class="fa-solid fa-circle-arrow-right"></i></span></a>
              </div>
            </div>
          </div>
        
          <div class="col-md-6 mb-3">
            <div class="card border-warning border-2 h-100">
              <div class="card-header bg-warning fw-bold">
                <span class="me-2"><i class="fa-solid fa-arrow-up-short-wide"></i></span>
                Most Sold Product
              </div>
              <div class="card-body">
                <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" style="width: 100%; height: 220px;">
                    <table id="example1" class="table table-striped data-table">
                    <?php 
                        $query = "SELECT * FROM product WHERE quantity_sold  > 0";
                        $query_run = mysqli_query($connection, $query);
                    ?> 
                      <thead class="table-dark">
                        <tr>
                          <th>Product Description</th>
                          <th>Quantity Sold</th>
                      </thead>
                      <tbody>
                      <?php
                        if(mysqli_num_rows($query_run) > 0)
                        {
                            while($row = mysqli_fetch_assoc($query_run))
                            {
                              ?>
                        <tr>
                          <td><?php echo $row['product_desc'] ?></td>
                          <td class='bg-primary text-center text-white'><?php echo $row['quantity_sold'] ?></td>
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

            </div>
              <div class="card-footer bg-warning d-flex justify-content-md-center">
                <a href="1-inventory/manage_stock.php" style="text-decoration: none;" class="card-link text-dark fw-bold">View Details <span class="ms-auto"><i class="fa-solid fa-circle-arrow-right"></i></span></a>
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
      <script src="js/datatable.js"></script>
      <script type="text/javascript" src="script.js"></script>

      <script>
        $(document).ready( function () {
          var table = $('#example1').DataTable( {
            order:[[1,"desc"]],
            pageLength : 5,
            paging: false,
            searching: false,
            bInfo: false
          })
        });
      </script>
      
      <?php 
         $sql13 ="SELECT DATE_FORMAT(date,'%m/%d/%Y') as dname, sum(total) as total from transaction_logs GROUP BY date(date) DESC LIMIT 5";
         $result13 = mysqli_query($connection,$sql13);
         $chart_data="";
         while ($row = mysqli_fetch_array($result13)) { 
            $date[]  = $row['dname'];
            $total[] = $row['total'];
        }
      ?>
      <script type="text/javascript">
      var ctx = document.getElementById("chart").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels:<?php echo json_encode($date); ?>,
                        datasets: [{
                            label: "Daily Sales",
                            backgroundColor: 'rgba(0, 0, 255, 0.2)',
                            borderColor: 'rgba(0, 0, 255, 1)',
                            tension: 0.4,
                            fill: true,
                            data:<?php echo json_encode($total); ?>,
                        }]
                    },
                    options: {
                        legend: {
                        display: true,
                        position: 'bottom',
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    },
 
 
                }
                });
      </script>
  </body>
</html>

