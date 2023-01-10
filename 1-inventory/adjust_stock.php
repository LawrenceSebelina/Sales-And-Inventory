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
            <button onclick="window.location.href='monitor_stock.php'" type="button" class="bi bi-bar-chart-line list-group-item list-group-item-action"><span class="ms-3">Monitor Stock</span></button>
            <button type="button" class="bi bi-inboxes list-group-item list-group-item-action active" aria-current="true"><span class="ms-3">Adjust Stock</span></button>
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
                <span><i class="bi bi-inboxes me-2"></i></span> Adjust Stock
              </div>
                  <div class="gap-3 d-md-flex justify-content-md-end mb-2 mt-3 mx-3">
                    <button type="button" class="btn btn-success btn-md" data-bs-toggle="modal" data-bs-target="#adjustedstock">Adjusted Product Stock</button>
                  </div>
              <div class="card-body">
                <div class="table-responsive">
                  <?php 
                    $query = "SELECT * FROM product";
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
                        <th>Actions</th>
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
                          <td><?php echo $row['brand'] ?></td>
                          <td><?php echo $row['unit'] ?></td>
                          <td>₱<?php echo  number_format($row['unit_price'], 2) ?></td>
                          <td><?php echo $row['quantity'] ?></td>
                          <td><center>
                            <button type="submit" class="btn btn-primary bi bi-plus-circle addbtn"></button>
                            <button type="button" class="btn btn-danger bi bi-dash-circle minusbtn"></button>
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
                    <tfoot>
                      <tr>
                        <th>Product Id</th>
                        <th>Product Description</th>
                        <th>Brand</th>
                        <th>Unit</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>

            <!-- Modal add stock-->
              <div class="modal fade" id="adjustaddmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content border-primary border-2">
                    <div class="modal-header bg-primary">
                      <h5 class="modal-title text-white fw-bold" id="exampleModalLabel">Adjust Stock</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            <!-- Modal add stock end-->

            <!-- Modal body add stock-->
                    <div class="modal-body">
                      <form class="row g-3 mt-2" action="adjustadd_stock.php" method="POST">
                          <label for="inputProductId" class="col-sm-6 col-form-label ms-3 fw-bold">Product Id:</label>
                          <div class="col-sm-5">
                            <div class="input-group"><span class="input-group-text"><i class="bi bi-key-fill"></i></span><input type="text" class="form-control text-end" id="adjust_id" name="adjust_id" readonly></div>
                          </div>
                          <label for="inputQuantity" class="col-sm-6 col-form-label ms-3 fw-bold">Stock On Hand:</label>
                          <div class="col-sm-5">
                            <div class="input-group"><span class="input-group-text"><i class="bi bi-box-seam"></i></span><input type="text" class="form-control text-end" id="adjust_quantity" name="adjust_quantity" readonly></div>
                          </div>
                          <label for="inputAction" class="col-sm-6 col-form-label ms-3 fw-bold">Action:</label>
                          <div class="col-sm-5">
                            <div class="input-group"><span class="input-group-text"><i class="bi bi-plus-circle"></i></span><input type="text" class="form-control text-center" id="action" name="action" value="Add" readonly></div>
                          </div>
                          <label for="inputAddStock" class="col-sm-6 col-form-label ms-3 fw-bold">Quantity:</label>
                          <div class="col-sm-5">
                            <div class="input-group"><span class="input-group-text"><i class="bi bi-pen-fill"></i></span><input type="text" class="form-control" id="adjustaddstock" name="adjustaddstock" pattern="[0-9]+" title="Stock must not contain special characters, letters or spaces."></div>
                          </div>

                            <input type="text" id="product_desc" name="product_desc">
                            <input type="text" id="brand" name="brand">
                            <input type="text" id="unit" name="unit">
                            <input type="text" id="unit_price" name="unit_price">

                          <label for="inputReason" class="col-sm-3 col-form-label ms-3 fw-bold">Reason:</label>
                          <div class="input-group">
                            <div class="input-group"><span class="input-group-text"><i class="bi bi-pen-fill"></i></span><textarea class="form-control" id="reason" name="reason" aria-label="With textarea" pattern="[a-zA-Z0-9-_.ñ\s]+" title="Reason must not contain any other special characters." placeholder="Write you reason..."></textarea></div>
                          </div>

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
                            <button type="submit" class="btn btn-primary" name="addstockdata">Save</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                          </div>
                      </form>
                    </div> 
                  </div>
                </div>
              </div>
            <!-- Modal body add stock end-->

            <!-- Modal minus stock-->
              <div class="modal fade" id="adjustminusmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content border-danger border-2">
                    <div class="modal-header bg-danger">
                      <h5 class="modal-title text-white fw-bold" id="exampleModalLabel">Adjust Stock</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            <!-- Modal minus stock end-->

            <!-- Modal body minus stock-->
                    <div class="modal-body">
                      <form class="row g-3 mt-2" action="adjustminus_stock.php" method="POST">
                          <label for="inputProductId" class="col-sm-6 col-form-label ms-3 fw-bold">Product Id:</label>
                          <div class="col-sm-5">
                            <div class="input-group"><span class="input-group-text"><i class="bi bi-key-fill"></i></span><input type="text" class="form-control text-end" id="adjust_id2" name="adjust_id2" readonly></div>
                          </div>
                          <label for="inputQuantity" class="col-sm-6 col-form-label ms-3 fw-bold">Stock On Hand:</label>
                          <div class="col-sm-5">
                            <div class="input-group"><span class="input-group-text"><i class="bi bi-box-seam"></i></span><input type="text" class="form-control text-end" id="adjust_quantity2" name="adjust_quantity2" readonly></div>
                          </div>
                          <label for="inputAction" class="col-sm-6 col-form-label ms-3 fw-bold">Action:</label>
                          <div class="col-sm-5">
                            <div class="input-group"><span class="input-group-text"><i class="bi bi-plus-circle"></i></span><input type="text" class="form-control text-center" id="action2" name="action2" value="Minus" readonly></div>
                          </div>
                          <label for="inputAddStock" class="col-sm-6 col-form-label ms-3 fw-bold">Quantity:</label>
                          <div class="col-sm-5">
                            <div class="input-group"><span class="input-group-text"><i class="bi bi-pen-fill"></i></span><input type="text" class="form-control" id="adjustaddstock2" name="adjustaddstock2" pattern="[0-9]+" title="Stock must not contain special characters, letters or spaces."></div>
                          </div>

                            <input type="hidden" id="product_desc2" name="product_desc2">
                            <input type="hidden" id="brand2" name="brand2">
                            <input type="hidden" id="unit2" name="unit2">
                            <input type="hidden" id="unit_price2" name="unit_price2">

                          <label for="inputReason" class="col-sm-3 col-form-label ms-3 fw-bold">Reason:</label>
                          <div class="input-group">
                            <div class="input-group"><span class="input-group-text"><i class="bi bi-pen-fill"></i></span><textarea class="form-control" id="reason2" name="reason2" aria-label="With textarea" pattern="[a-zA-Z0-9-_.ñ\s]+" title="Reason must not contain any other special characters." placeholder="Write you reason..."></textarea></div>
                          </div>

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
                            <button type="submit" class="btn btn-primary" name="minusstockdata">Save</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                          </div>
                      </form>
                    </div> 
                  </div>
                </div>
              </div>
            <!-- Modal body minus stock end-->

            <!-- Modal adjusted stock-->
              <div class="modal fade" id="adjustedstock" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal-content border-warning border-2">
                    <div class="modal-header bg-warning">
                      <h5 class="modal-title fw-bold" id="exampleModalLabel">Adjusted Stock</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            <!-- Modal adjusted stock end-->

            <!-- Modal body adjusted stock-->
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
                                  <th>Product Id</th>
                                  <th>Adjusted by</th>
                                  <th>Product Desc</th>
                                  <th>Adjusted Qty</th>
                                  <th>Action</th>
                                  <th>Qty</th>
                                  <th>Reason</th>
                                  <th>Date</th>
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
                                    <td><?php echo $row['adjusted'] ?></td>
                                    <td><?php echo $row['action'] ?></td>
                                    <td><?php echo $row['quantity'] ?></td>
                                    <td><?php echo $row['reason'] ?></td>
                                    <td><?php echo date('d M Y, g:i A', strtotime($row["date"])) ?></td>
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
                                  <th>Adjusted by</th>
                                  <th>Product Desc</th>
                                  <th>Adjusted Qty</th>
                                  <th>Action</th>
                                  <th>Qty</th>
                                  <th>Reason</th>
                                  <th>Date</th>
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
            <!-- Modal body adjusted stock end-->

          </div>
        </div>
      </div>
    </main>
      <?php include('../templates/footer.php'); ?>

      <script>
        

        $(document).ready(function() {
          $(document).ready( function () {
          var table = $('#example').DataTable( {
            stateSave: true,
            pageLength : 10,
            lengthMenu: [[10, 15, 20, 25], [10, 15, 20, 25]]
          })
        });
              $('.addbtn').on('click',function() {
                $('#adjustaddmodal').modal('show');

                  $tr = $(this).closest('tr');
                  var data = $tr.children("td").map(function() {
                    return $(this).text();
                  }).get();

                    console.log(data);
                    $('#adjust_id').val(data[0]);
                    $('#adjust_quantity').val(data[5]);
                    $('#adjustaddstock');
                    $('#action');
                    $('#reason');
                    $('#product_desc').val(data[1]);
                    $('#brand').val(data[2]);
                    $('#unit').val(data[3]);
                    $('#unit_price').val(data[4]);
            });
          });


          $(document).ready(function() {
            $(document).ready( function () {
          var table = $('#example1').DataTable( {
            pageLength : 5,
            lengthMenu: [[5, 10, 15, 25], [5, 10, 15, 25]]
          })
        });
              $('.minusbtn').on('click',function() {
                $('#adjustminusmodal').modal('show');

                  $tr = $(this).closest('tr');
                  var data = $tr.children("td").map(function() {
                    return $(this).text();
                  }).get();

                    console.log(data);
                    $('#adjust_id2').val(data[0]);
                    $('#adjust_quantity2').val(data[5]);
                    $('#adjustaddstock2');
                    $('#action2');
                    $('#reason2');
                    $('#product_desc2').val(data[1]);
                    $('#brand2').val(data[2]);
                    $('#unit2').val(data[3]);
                    $('#unit_price2').val(data[4]);
            });
          });
      </script>

  </body>
</html>
