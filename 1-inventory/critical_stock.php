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
              <center><span class="text-uppercase pd-2 mt-4 text-uppercase fw-bold h3">Inventory</span></center>
            </a>
          </div>
        <div class="list-group mt-4 mb-3 d-grid gap-1">
            <button onclick="window.location.href='manage_product.php'" type="button" class="bi bi-cart4 list-group-item list-group-item-action"><span class="ms-3">Manage Products</span></button>
            <button onclick="window.location.href='manage_stock.php'" type="button" class="bi bi-box-seam list-group-item list-group-item-action"><span class="ms-3">Manage Stock</span></button>
            <button type="button" class="bi bi-bar-chart-line list-group-item list-group-item-action active" aria-current="true"><span class="ms-3">Monitor Stock</span></button>
            <button onclick="window.location.href='adjust_stock.php'" type="button" class="bi bi-inboxes list-group-item list-group-item-action"><span class="ms-3">Adjust Stock</span></button>
            <button onclick="window.location.href='../dashboard.php'" type="button" class="bi bi-list list-group-item list-group-item-action"><span class="ms-3">Menu</span></button>
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
                <span><i class="bi bi-bar-chart-line me-2"></i></span> Monitor Stock
                <span class="text-info">(Critical Stock)</span> 
              </div>
              <div class="card-body">
                <div class="dropdown mb-4 mt-3">
                <span class="ms-4 fw-bold">Stock Type:</span>
                    <button class="btn btn-light btn-sm border-dark border-1 dropdown-toggle ms-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Critical Stock
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="monitor_stock.php">Stock on hand</a></li>
                        <li><a class="dropdown-item" href="stock_out.php">Out of stock</a></li>
                        <li><a class="dropdown-item bg-primary text-white" href="#">Critical</a></li>
                        <li><a class="dropdown-item" href="fastmoving_stock.php">Fast moving</a></li>
                        <li><a class="dropdown-item" href="slowmoving_stock.php">Slow moving</a></li>
                    </ul>
                </div>
                <div class="table-responsive">
                    <?php 
                        $query = "SELECT * FROM product WHERE quantity <= '20' ";
                        $query_run = mysqli_query($connection, $query);
                    ?> 
                  <table id="example" class="table table-striped data-table" style="width: 100%">
                    <thead class="table-dark">
                      <tr>
                        <th>Product Id</th>
                        <th>Product Description</th>
                        <th>Brand</th>
                        <th>Unit</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                    </thead>
                    <tbody>
                      <?php
                        if(mysqli_num_rows($query_run) > 0)
                        {
                            while($row = mysqli_fetch_assoc($query_run))
                            {
                              ?>
                        <tr>
                          <td><?php echo $row['product_id'] ?></td>
                          <td><?php echo $row['product_desc'] ?></td>
                          <td><?php echo $row['brand'] ?></td>
                          <td><?php echo $row['unit'] ?></td>
                          <td>₱<?php echo number_format($row['unit_price'], 2) ?></td>
                          <td class='bg-warning text-center text-white'><?php echo $row['quantity'] ?></td>
                        </tr>
                        <?php
                            }
                        }
                        else{
                            echo "No record found";
                        }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Product Id</th>
                        <th>Product Description</th>
                        <th>Brand</th>
                        <th>Unit</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
      <?php include('../templates/footer.php'); ?>

      <script>
        $(document).ready( function () {
          var table = $('#example').DataTable( {
            order:[[5,"desc"]],
            pageLength : 10,
            lengthMenu: [[10, 15, 20, 25], [10, 15, 20, 25]]
          })
        });
      </script>
  </body>
</html>
