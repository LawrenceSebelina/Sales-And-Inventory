<?php 
  include('../server/connection.php'); 
  include('../security1.php'); 
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../templates/head.php'); ?>>
  <script src="../js/manage_stock.js"></script>
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
              <center><span class="text-uppercase pd-2 mt-4 text-uppercase fw-bold h3"><i class="fa-solid fa-boxes-stacked fa-sm me-3"></i>Inventory</span></center>
            </a>
          </div>
        <div class="list-group mt-4 mb-3 d-grid gap-1">
            <a href="manage_product.php" type="button" class="fw-bold list-group-item list-group-item-action"><span><i class="fa-solid fa-cart-shopping me-3"></i>Manage Products</span></a>
            <a href="#" type="button" class="fw-bold list-group-item list-group-item-action active" aria-current="true"><span><i class="fa-solid fa-boxes-stacked me-3"></i>Manage Stock</span></a>
            <!-- <button onclick="window.location.href='monitor_stock.php'" type="button" class="bi bi-bar-chart-line list-group-item list-group-item-action"><span class="ms-3">Monitor Stock</span></button> -->
            <!-- <button onclick="window.location.href='adjust_stock.php'" type="button" class="bi bi-inboxes list-group-item list-group-item-action"><span class="ms-3">Adjust Stock</span></button> -->
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
    <main style="margin-top: 2.5rem;"><!-- mt-5 pt-3 -->
      <div class="container-fluid">              
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card border-secondary border-2">
              <div class="card-header text-uppercase fw-bold fs-4 bg-secondary text-light">
                <span><i class="fa-solid fa-boxes-stacked me-3"></i></span> Manage Stock
              </div>
              <div class="card-body">

              <div><div class='box red'></div><b>&nbsp— Good Stock</b></div>
              <div><div class='box green'></div><b>&nbsp— Critical Stock</b></div>
              <div><div class='box blue'></div><b>&nbsp— Out of Stock</b></div>
              <div class="gap-3 d-md-flex justify-content-md-start mt-3">
                <button type="button" title="Fast moving stocks" class="btn btn-primary btn-md fw-bold" data-bs-toggle="modal" data-bs-target="#fastmoving">&nbsp&nbsp<i class="fa-solid fa-arrow-trend-up me-2"></i>Fast Moving Stocks&nbsp&nbsp</button>
                <button type="button" title="Slow moving stocks" class="btn btn-info btn-md fw-bold" data-bs-toggle="modal" data-bs-target="#slowmoving">&nbsp&nbsp<i class="fa-solid fa-arrow-trend-down me-2"></i>Slow Moving Stocks&nbsp&nbsp</button>
              </div>
              

              <div class="gap-3 d-md-flex justify-content-md-end mb-2 mt-3 mx-2">
                <button type="button" title="Product stock logs" class="btn btn-success btn-md fw-bold" data-bs-toggle="modal" data-bs-target="#stocklogs">&nbsp&nbsp<i class="fa-solid fa-book-bookmark me-2"></i>Stocks Logs&nbsp&nbsp</button>
              </div>

                <div class="table-responsive mt-4">
                <?php 
                    $query = "SELECT * FROM product";
                    $query_run = mysqli_query($connection, $query);
                ?>  
                  <table id="example" class="table table-striped data-table" style="width: 100%">
                    <thead class="table-dark">
                      <tr>
                        <th class="fw-bold text-uppercase text-center">Product Id</th>
                        <th class="fw-bold text-uppercase text-center">Product Description</th>
                        <th class="fw-bold text-uppercase text-center">Brand</th>
                        <th class="fw-bold text-uppercase text-center">Unit</th>
                        <th class="fw-bold text-uppercase text-center">Unit Price</th>
                        <th class="fw-bold text-uppercase text-center">Quantity</th>
                        <th class="fw-bold text-uppercase text-center">Actions</th>
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
                          <td align="right">₱<?php echo number_format($row['unit_price'], 2) ?></td>
                          <td align="right" class="text-white"><?php echo $row['quantity'] ?></td>
                          <td>
                            <center>
                            <button type="submit" title="Add product stock" class="btn btn-primary addstockbtn" data-bs-toggle="modal" data-bs-target="#addstockmodal"><i class="fa-solid fa-plus"></i></button>
                            <button type="submit" title="Remove product stock" class="btn btn-danger minusstockbtn" data-bs-toggle="modal" data-bs-target="#minusstockmodal"><i class="fa-solid fa-minus"></i></button>
                            <center>
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
                            <th class="fw-bold text-uppercase text-center">Product Id</th>
                            <th class="fw-bold text-uppercase text-center">Product Description</th>
                            <th class="fw-bold text-uppercase text-center">Brand</th>
                            <th class="fw-bold text-uppercase text-center">Unit</th>
                            <th class="fw-bold text-uppercase text-center">Unit Price</th>
                            <th class="fw-bold text-uppercase text-center">Quantity</th>
                            <th class="fw-bold text-uppercase text-center">Actions</th>
                          </tr>
                        </tfoot>
                      -->
                  </table>
                </div>
              </div>
            </div>

            <!-- Modal add stock-->
              <div class="modal fade" id="addstockmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content border-primary border-2">
                    <div class="modal-header bg-primary">
                      <h5 class="modal-title text-white fw-bold" id="exampleModalLabel"><i class="fa-solid fa-plus me-2"></i>Add Product Stock</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            <!-- Modal add stock end-->

            <!-- Modal body add stock-->
                    <div class="modal-body">
                      <form class="row g-3 mt-2" action="add_stock.php" method="POST" id="form_id">
                          <label for="inputProductId" class="col-sm-5 col-form-label ms-3 fw-bold">Product Id:</label>
                          <div class="col-sm-6">
                            <div class="input-group"><span class="input-group-text bg-primary text-light"><i class="fa-solid fa-cart-shopping"></i></span><input type="text" class="form-control text-end" id="stock_id" name="stock_id" readonly></div>
                          </div>
                          <label for="inputQuantity" class="col-sm-5 col-form-label ms-3 fw-bold">Current Stock:</label>
                          <div class="col-sm-6">
                            <div class="input-group"><span class="input-group-text bg-primary text-light"><i class="fa-solid fa-boxes-stacked"></i></span><input type="text" class="form-control text-end" id="quantity" name="quantity" readonly></div>
                          </div>
                          <label for="inputAddStock" class="col-sm-5 col-form-label ms-3 fw-bold">Add New Stock:</label>
                          <div class="col-sm-6">
                            <div class="input-group"><span class="input-group-text bg-primary text-light"><i class="fa-solid fa-pen-clip" style="margin-right: 0.1rem;"></i></span><input type="text" class="form-control" id="addstock" name="addstock" pattern="[0-9]+" title="Stock must not contain special characters, letters or spaces."></div>
                          </div>
                          <input type="hidden" id="product_desc" name="product_desc">
                          <input type="hidden" id="brand" name="brand">
                          <input type="hidden" id="unit" name="unit">
                          <input type="hidden" id="unit_price" name="unit_price">
                          <label for="inputPosition" class="col-sm-5 col-form-label ms-3 fw-bold">Reason:</label>
                          <div class="col-sm-6">
                            <div class="input-group"><span class="input-group-text bg-primary text-light"><i class="fa-solid fa-square-caret-down fa-lg"></i></span>
                            <select id="reason" name="reason" class="form-control form-select" onchange='CheckReason(this.value);' required>
                              <option value="New Stock">New Stock</option>
                              <option value="Returned Item">Returned Item</option>
                              <option value="Others">Others...</option>
                            </select>
                              <div class="col-sm-12 mt-3">
                                <input type="text" class="form-control col-sm-6" id="reasons" name="reasons" style='display:none;' placeholder="Other reason..." pattern="[a-zA-Z0-9-_.ñ\s]+" title="Insert other reason that must not contain any other special characters.">
                              </div>
                            </div>
                          </div>
                          
                          
                          <input type="hidden" id="action" name="action" value="Added"></div>
                          
                          <?php 
                            if(isset($_SESSION['username'])){
                              $username = $_SESSION['username'];
                              $sql = "SELECT firstname, lastname FROM users WHERE username='$username'";
                              $result	= mysqli_query($connection, $sql);
                              if (mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                          ?>

                            <input type="hidden" id="adjusted_by" name="adjusted_by" value="<?php echo $row['firstname']; echo ' ' ?><?php echo $row['lastname'];}}}?>">
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary fw-bold" name="addstockdata">&nbsp&nbsp<i class="fa-solid fa-plus me-2"></i>Add &nbsp&nbsp</button>
                            <button onclick="myFunction()" type="button" class="btn btn-danger fw-bold" data-bs-dismiss="modal">&nbsp<i class="fa-solid fa-ban me-2"></i>Cancel&nbsp</button>
                          </div>
                      </form>
                    </div> 
                  </div>
                </div>
              </div>
            <!-- Modal body add stock end-->

            <!-- Modal minus stock-->
              <div class="modal fade" id="minusstockmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content border-danger border-2">
                    <div class="modal-header bg-danger">
                      <h5 class="modal-title text-white fw-bold" id="exampleModalLabel"><i class="fa-solid fa-minus me-2"></i>Remove Product Stock</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            <!-- Modal minus stock end-->

            <!-- Modal body minus stock-->
                    <div class="modal-body">
                      <form class="row g-3 mt-2" action="minus_stock.php" method="POST" id="form_id2">
                          <label for="inputProductId" class="col-sm-5 col-form-label ms-3 fw-bold">Product Id:</label>
                          <div class="col-sm-6">
                            <div class="input-group"><span class="input-group-text bg-danger text-light"><i class="fa-solid fa-cart-shopping"></i></span><input type="text" class="form-control text-end" id="stock_id2" name="stock_id2" readonly></div>
                          </div>
                          <label for="inputQuantity" class="col-sm-5 col-form-label ms-3 fw-bold">Current Stock:</label>
                          <div class="col-sm-6">
                            <div class="input-group"><span class="input-group-text bg-danger text-light"><i class="fa-solid fa-boxes-stacked"></i></span><input type="text" class="form-control text-end" id="quantity2" name="quantity2" readonly></div>
                          </div>
                          <label for="inputAddStock" class="col-sm-5 col-form-label ms-3 fw-bold">Remove Stock:</label>
                          <div class="col-sm-6">
                            <div class="input-group"><span class="input-group-text bg-danger text-light"><i class="fa-solid fa-pen-clip" style="margin-right: 0.1rem;"></i></span><input type="text" class="form-control" id="minusstock" name="minusstock" pattern="[0-9]+" title="Stock must not contain special characters, letters or spaces."></div>
                          </div>
                          <input type="hidden" id="product_desc2" name="product_desc2">
                          <input type="hidden" id="brand2" name="brand2">
                          <input type="hidden" id="unit2" name="unit2">
                          <input type="hidden" id="unit_price2" name="unit_price2">
                          <label for="inputPosition" class="col-sm-5 col-form-label ms-3 fw-bold">Reason:</label>
                          <div class="col-sm-6">
                            <div class="input-group"><span class="input-group-text bg-danger text-light"><i class="fa-solid fa-square-caret-down fa-lg"></i></span>
                            <select id="reason2" name="reason2" class="form-control form-select" onchange='CheckReason2(this.value);' title="Choose reason of adding stock." required>
                              <option value="Expired Item">Expired Item</option>
                              <option value="Damaged Item">Damaged Item</option>
                              <option value="Others">Others...</option>
                            </select>
                                <div class="col-sm-12 mt-3">
                                  <input type="text" class="form-control col-sm-6" id="reasons2" name="reasons2" style='display:none;' placeholder="Other reason..." pattern="[a-zA-Z0-9-_.ñ\s]+" title="Insert other reason that must not contain any other special characters.">
                                </div>
                            </div>
                          </div>
                          
                          
                          <input type="hidden" id="action2" name="action2" value="Deducted"></div>
                          
                          <?php 
                            if(isset($_SESSION['username'])){
                              $username = $_SESSION['username'];
                              $sql = "SELECT firstname, lastname FROM users WHERE username='$username'";
                              $result	= mysqli_query($connection, $sql);
                              if (mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                          ?>

                            <input type="hidden" id="adjusted_by2" name="adjusted_by2" value="<?php echo $row['firstname']; echo ' ' ?><?php echo $row['lastname'];}}}?>">

                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary fw-bold" name="minusstockdata"><i class="fa-solid fa-minus me-2"></i>Remove</button>
                            <button onclick="myFunction2()" type="button" class="btn btn-danger fw-bold" data-bs-dismiss="modal">&nbsp<i class="fa-solid fa-ban me-2"></i>Cancel&nbsp</button>
                          </div>
                      </form>
                    </div> 
                  </div>
                </div>
              </div>
            <!-- Modal body minus stock end-->

            <!-- Modal stock logs-->
             <div class="modal fade" id="stocklogs" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal-content border-warning border-2">
                    <div class="modal-header bg-warning">
                      <h5 class="modal-title fw-bold" id="exampleModalLabel"><i class="fa-solid fa-book-bookmark me-2"></i>Stock Logs</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            <!-- Modal stock logs end-->

            <!-- Modal body stock logs-->
                  <div class="modal-body">
                    <form class="row g-3">
                      <div class="card-body"> 
                        <div class="table-responsive">
                          <?php 
                            $query = "SELECT * FROM adjust_stock ORDER BY id DESC";
                            $query_run = mysqli_query($connection, $query);
                          ?>   
                          <table id="example1" class="table table-striped table-sm" style="width: 100%">
                              <thead class="table-dark">
                              <tr>
                                  <th class="fw-bold text-uppercase text-center">Product Id</th>
                                  <th class="fw-bold text-uppercase text-center">Adjusted by</th>
                                  <th class="fw-bold text-uppercase text-center">Product Desc</th>
                                  <th class="fw-bold text-uppercase text-center">Quantity</th>
                                  <th class="fw-bold text-uppercase text-center">Action</th>
                                  <th class="fw-bold text-uppercase text-center">Reason</th>
                                  <th class="fw-bold text-uppercase text-center">Date</th>
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
                                    <td><?php echo $row['product_id'] ?></td>
                                    <td><?php echo $row['adjusted_by'] ?></td>
                                    <td><?php echo $row['product_desc'] ?></td>
                                    <td align='right'><?php echo $row['adjusted'] ?></td>
                                    <td><?php echo $row['action'] ?></td>
                                    <td align='center'><?php echo $row['reason'] ?></td>
                                    <td align='center'><?php echo date('m/d/Y | g:i A', strtotime($row["date"])) ?></td>
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
                                        <th class="fw-bold text-uppercase text-center">Product Id</th>
                                        <th class="fw-bold text-uppercase text-center">Adjusted by</th>
                                        <th class="fw-bold text-uppercase text-center">Product Desc</th>
                                        <th class="fw-bold text-uppercase text-center">Quantity</th>
                                        <th class="fw-bold text-uppercase text-center">Action</th>
                                        <th class="fw-bold text-uppercase text-center">Reason</th>
                                        <th class="fw-bold text-uppercase text-center">Date</th>
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
            <!-- Modal body stock logs end-->

            <!-- Modal fastmoving stock-->
            <div class="modal fade" id="fastmoving" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content border-primary border-2">
                    <div class="modal-header bg-primary">
                      <h5 class="modal-title fw-bold text-white" id="exampleModalLabel"><i class="fa-solid fa-arrow-trend-up me-2"></i>Fast Moving Stock</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            <!-- Modal fastmoving stock end-->

            <!-- Modal body fastmoving stock-->
                  <div class="modal-body">
                    <form class="row g-3">
                      <div class="card-body"> 
                        <div class="table-responsive">
                          <?php 
                            $query = "SELECT * FROM product WHERE quantity_sold > 0";
                            $query_run = mysqli_query($connection, $query);
                          ?>   
                          <table id="example2" class="table table-striped table-sm" style="width: 100%">
                              <thead class="table-dark">
                              <tr>
                                  <th class="fw-bold text-uppercase text-center">Product Id</th>
                                  <th class="fw-bold text-uppercase text-center">Product Description</th>
                                  <th class="fw-bold text-uppercase text-center">Quantity Sold</th>
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
                                    <td><?php echo $row['product_id'] ?></td>
                                    <td><?php echo $row['product_desc'] ?></td>
                                    <td class='bg-primary text-end text-white'><?php echo $row['quantity_sold'] ?></td>
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
                                      <th class="fw-bold text-uppercase text-center">Product Id</th>
                                      <th class="fw-bold text-uppercase text-center">Product Description</th>
                                      <th class="fw-bold text-uppercase text-center">Quantity Sold</th>
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
            <!-- Modal body fastmoving stock end-->

            <!-- Modal slowmoving stock-->
            <div class="modal fade" id="slowmoving" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content border-info border-2">
                    <div class="modal-header bg-info">
                      <h5 class="modal-title fw-bold" id="exampleModalLabel"><i class="fa-solid fa-arrow-trend-down me-2"></i>Slow Moving Stock</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            <!-- Modal slowmoving stock end-->

            <!-- Modal body slowmoving stock-->
                  <div class="modal-body">
                    <form class="row g-3">
                      <div class="card-body"> 
                        <div class="table-responsive">
                          <?php 
                            $query = "SELECT * FROM product WHERE quantity > 0";
                            $query_run = mysqli_query($connection, $query);
                          ?>   
                          <table id="example3" class="table table-striped table-sm" style="width: 100%">
                              <thead class="table-dark">
                              <tr>
                                  <th class="fw-bold text-uppercase text-center">Product Id</th>
                                  <th class="fw-bold text-uppercase text-center">Product Description</th>
                                  <th class="fw-bold text-uppercase text-center">Remaining Quantity</th>
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
                                    <td><?php echo $row['product_id'] ?></td>
                                    <td><?php echo $row['product_desc'] ?></td>
                                    <td class='bg-info text-end text-white'><?php echo $row['quantity'] ?></td>
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
                                      <th class="fw-bold text-uppercase text-center">Product Id</th>
                                      <th class="fw-bold text-uppercase text-center">Product Description</th>
                                      <th class="fw-bold text-uppercase text-center">Remaining Quantity</th>
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
            <!-- Modal body slowmoving stock end-->

          </div>
        </div>
      </div>
    </main>
      <?php include('../templates/footer.php'); ?>

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

      <script src="../js/dataTables.buttons.min.js"></script>
      <script src="../js/vfs_fonts.js"></script>
      <script src="../js/buttons.html5.min.js"></script>
      <script src="../js/buttons.print.min.js"></script>
      <script src="../js/moment.min.js"></script>
      <script src="../js/dataTables.dateTime.min.js"></script>

      <script>


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

                            customize: function ( win ) {
                              $(win.document.body).find('table tbody td:nth-child(5)').css('text-align', 'right');
                              $(win.document.body).find('table tbody td:nth-child(6)').css('text-align', 'right');
                            },

                            text:      '<i class="fa fa-print text-primary" style="font-size: 34px;"></i>',
                            titleAttr: 'Print',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5  ]
                            },
                            title: '',
                            messageTop: '<center><img src="../images/Logo.png" width="200px" height="200px" alt="Logo"><h3><?php echo $roww['store_name']; ?></h3></center> <center><h6><?php echo 'Block&nbsp'; echo $roww['store_block']; echo '&nbspLot&nbsp'; echo $roww['store_lot']; echo '&nbsp'; echo $roww['store_street'];?></h6></center> <center><h6><?php echo 'Barangay&nbsp'; echo $roww['store_barangay']; echo ',&nbsp'; echo $roww['store_city']; echo '&nbsp'; echo $roww['store_province']; echo '&nbsp-&nbsp'; echo $roww['store_zip'];?></h6></center> <center><h6><?php echo 'Contact No.:&nbsp'; echo $roww['store_contact'];?></h6></center> <center><h6><?php echo 'Prepared by:&nbsp'; echo $row['firstname'];?>&nbsp<?php echo $row['lastname'];}}}?></h6></center> <center><h6><?php date_default_timezone_set('Asia/Manila'); $currentDateTime = date('F d, Y | h:i A'); echo 'Date & Time:&nbsp'; echo $currentDateTime; ?></h6></center><br> <center><h3>PRODUCT STOCKS</h3></center><br>'
                        },
                    ],

              "createdRow": function( row, data, dataIndex ) {
              if (data[5] > 20) {        
                $(row).find('td:eq(5)').css('background-color', '#198754');
              }else if (data[5] > 0) {        
                $(row).find('td:eq(5)').css('background-color', '#ffc107');
              }else{
                $(row).find('td:eq(5)').css('background-color', '#dc3545');
              }
            }

            })
          });
              $('.addstockbtn').on('click',function() {
                $('#addstockmodal').modal('show');

                  $tr = $(this).closest('tr');
                  var data = $tr.children("td").map(function() {
                    return $(this).text();
                  }).get();

                    console.log(data);
                    $('#stock_id').val(data[0]);
                    $('#quantity').val(data[5]);
                    $('#addstock');
                    $('#reason');
                    $('#action');
                    $('#product_desc').val(data[1]);
                    $('#brand').val(data[2]);
                    $('#unit').val(data[3]);
                    $('#unit_price').val(data[4]);
            });

            $('.minusstockbtn').on('click',function() {
                $('#minusstockmodal').modal('show');
                    
                  $tr = $(this).closest('tr');
                  var data = $tr.children("td").map(function() {
                    return $(this).text();
                  }).get();

                    console.log(data);
                    $('#stock_id2').val(data[0]);
                    $('#quantity2').val(data[5]);
                    $('#minusstock');
                    $('#reason2');
                    $('#action2');
                    $('#product_desc2').val(data[1]);
                    $('#brand2').val(data[2]);
                    $('#unit2').val(data[3]);
                    $('#unit_price2').val(data[4]);
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

            $(document).ready( function () {
              var table = $('#example2').DataTable( {
                order:[[2,"desc"]],
                pageLength : 10,
                lengthMenu: [[10, 15, 20, 25], [10, 15, 20, 25]],

                dom: 'Blfrtip',
                    dom:
                      "<'row'<'col-sm-12 text-center'B>>" + 
                      "<'row'<'col-sm-7'l><'col-sm-5'f>>" +
                      "<'row'<'col-sm-12'tr>>" +
                      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                    buttons: [
                        {
                            extend:    'print',

                            customize: function ( win ) {
                              $(win.document.body).find('table tbody td:nth-child(3)').css('text-align', 'right');
                            },

                            text:      '<i class="fa fa-print text-primary" style="font-size: 34px;"></i>',
                            titleAttr: 'Print',
                            exportOptions: {
                                columns: [ 0, 1, 2  ]
                            },
                            title: '',
                            messageTop: '<center><img src="../images/Logo.png" width="200px" height="200px" alt="Logo"><h3><?php echo $roww['store_name']; ?></h3></center> <center><h6><?php echo 'Block&nbsp'; echo $roww['store_block']; echo '&nbspLot&nbsp'; echo $roww['store_lot']; echo '&nbsp'; echo $roww['store_street'];?></h6></center> <center><h6><?php echo 'Barangay&nbsp'; echo $roww['store_barangay']; echo ',&nbsp'; echo $roww['store_city']; echo '&nbsp'; echo $roww['store_province']; echo '&nbsp-&nbsp'; echo $roww['store_zip'];?></h6></center> <center><h6><?php echo 'Contact No.:&nbsp'; echo $roww['store_contact'];?></h6></center> <center><h6><?php echo 'Prepared by:&nbsp'; echo $row['firstname'];?>&nbsp<?php echo $row['lastname'];}}}?></h6></center> <center><h6><?php date_default_timezone_set('Asia/Manila'); $currentDateTime = date('F d, Y | h:i A'); echo 'Date & Time:&nbsp'; echo $currentDateTime; ?></h6></center> <br> <center><h3>FAST MOVING STOCKS</h3></center><br>'
                        },
                    ],
              })
            });

            <?php
                }
              }
                else{
              echo "No record found";
                }
            ?>

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

            $(document).ready( function () {
              var table = $('#example3').DataTable( {
                order:[[2,"desc"]],
                pageLength : 10,
                lengthMenu: [[10, 15, 20, 25], [10, 15, 20, 25]],

                dom: 'Blfrtip',
                    dom:
                      "<'row'<'col-sm-12 text-center'B>>" + 
                      "<'row'<'col-sm-7'l><'col-sm-5'f>>" +
                      "<'row'<'col-sm-12'tr>>" +
                      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                    buttons: [
                        {
                            extend:    'print',

                            customize: function ( win ) {
                              $(win.document.body).find('table tbody td:nth-child(3)').css('text-align', 'right');
                            },

                            text:      '<i class="fa fa-print text-primary" style="font-size: 34px;"></i>',
                            titleAttr: 'Print',
                            exportOptions: {
                                columns: [ 0, 1, 2  ]
                            },
                            title: '',
                            messageTop: '<center><img src="../images/Logo.png" width="200px" height="200px" alt="Logo"><h3><?php echo $roww['store_name']; ?></h3></center> <center><h6><?php echo 'Block&nbsp'; echo $roww['store_block']; echo '&nbspLot&nbsp'; echo $roww['store_lot']; echo '&nbsp'; echo $roww['store_street'];?></h6></center> <center><h6><?php echo 'Barangay&nbsp'; echo $roww['store_barangay']; echo ',&nbsp'; echo $roww['store_city']; echo '&nbsp'; echo $roww['store_province']; echo '&nbsp-&nbsp'; echo $roww['store_zip'];?></h6></center> <center><h6><?php echo 'Contact No.:&nbsp'; echo $roww['store_contact'];?></h6></center> <center><h6><?php echo 'Prepared by:&nbsp'; echo $row['firstname'];?>&nbsp<?php echo $row['lastname'];}}}?></h6></center> <center><h6><?php date_default_timezone_set('Asia/Manila'); $currentDateTime = date('F d, Y | h:i A'); echo 'Date & Time:&nbsp'; echo $currentDateTime; ?></h6></center> <br> <center><h3>SLOW MOVING STOCKS</h3></center><br>'
                        },
                    ],
              })
            });

            <?php
                }
              }
                else{
              echo "No record found";
                }
            ?>


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

          $(document).ready( function () {
            var table = $('#example1').DataTable( {
              stateSave: true,
              ordering: false,
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
                              $(win.document.body).find('table tbody td:nth-child(4)').css('text-align', 'right');
                            },

                            text:      '<i class="fa fa-print text-primary" style="font-size: 34px;"></i>',
                            titleAttr: 'Print',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5  ]
                            },
                            title: '',
                            messageTop: '<center><img src="../images/Logo.png" width="200px" height="200px" alt="Logo"><h3><?php echo $roww['store_name']; ?></h3></center> <center><h6><?php echo 'Block&nbsp'; echo $roww['store_block']; echo '&nbspLot&nbsp'; echo $roww['store_lot']; echo '&nbsp'; echo $roww['store_street'];?></h6></center> <center><h6><?php echo 'Barangay&nbsp'; echo $roww['store_barangay']; echo ',&nbsp'; echo $roww['store_city']; echo '&nbsp'; echo $roww['store_province']; echo '&nbsp-&nbsp'; echo $roww['store_zip'];?></h6></center> <center><h6><?php echo 'Contact No.:&nbsp'; echo $roww['store_contact'];?></h6></center> <center><h6><?php echo 'Prepared by:&nbsp'; echo $row['firstname'];?>&nbsp<?php echo $row['lastname'];}}}?></h6></center> <center><h6><?php date_default_timezone_set('Asia/Manila'); $currentDateTime = date('F d, Y | h:i A'); echo 'Date & Time:&nbsp'; echo $currentDateTime; ?></h6></center> <br> <center><h3>STOCKS LOGS</h3></center><br>'
                        },
                    ],
            })
          });

          <?php
              }
            }
              else{
            echo "No record found";
              }
          ?>
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
