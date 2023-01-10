<?php
  include('../server/connection.php'); 
  include('../security1.php'); 
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../templates/head.php'); ?>
  <script src="../js/manage_product.js"></script>
</head>
<body>
<?php include('product_id.php'); ?>
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
              <center><span class="text-uppercase pd-2 mt-4 text-uppercase fw-bold h3"><i class="fa-solid fa-boxes-stacked fa-sm me-3"></i>Inventory</span></center>
            </a>
          </div>
        <div class="list-group mt-4 mb-3 d-grid gap-1">
            <a href="#" type="button" class="fw-bold list-group-item list-group-item-action active" aria-current="true"><span><i class="fa-solid fa-cart-shopping me-3"></i>Manage Products</span></a>
            <a href="manage_stock.php" type="button" class="fw-bold list-group-item list-group-item-action"><span><i class="fa-solid fa-boxes-stacked me-3"></i>Manage Stock</span></a>
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
    <!-- offcanvas end-->

    <main class="mt-5 pt-3">
      <div class="container-fluid">              
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card border-secondary border-2">
              <div class="card-header text-uppercase fw-bold fs-4 bg-secondary text-light">
                <span><i class="fa-solid fa-cart-shopping me-2"></i></span> Manage Product
              </div>
                  <div class="gap-3 d-md-flex justify-content-md-end mb-2 mt-3 mx-4">
                    <button type="button" title="Add new product" class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#addmodal"><i class="fa-solid fa-square-plus me-2"></i> Add New </button>
                    <button type="button" title="Archived products" class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#archivemodal"><i class="fa-solid fa-box-archive me-2"></i>Archived Products</button>
                  </div>
                  
            <!-- Modal add-->
              <div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content border-warning border-2">
                    <div class="modal-header bg-warning">
                      <h5 class="modal-title fw-bold" id="exampleModalLabel"><i class="fa-solid fa-cart-shopping me-2"></i>New Product</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            <!-- Modal add end-->

            <!-- Modal body add-->
                    <div class="modal-body">
                      <form class="row g-3 mt-2" action="add_product.php" method="POST" id="form_id">
                          <label for="inputProductId" class="col-sm-3 col-form-label ms-3 fw-bold text-dark">Product Id</label>
                          <div class="col-sm-8">
                            <div class="input-group"><span class="input-group-text bg-warning"><i class="fa-solid fa-key"></i></span><input type="text" class="form-control" id="product_id" name="product_id" value="<?php echo $number; ?>" readonly></div>
                          </div>
                          <label for="inputProductDesc" class="col-sm-5 col-form-label ms-3 fw-bold text-dark">Product Description</label>
                          <div class="col-sm-6">
                            <div class="input-group"><span class="input-group-text bg-warning"><i class="fa-solid fa-pen-clip"></i></span><input type="text" class="form-control" id="product_desc" name="product_desc" pattern="[a-zA-Z0-9-_.ñ\s()]+" title="Product description must not contain any other special characters." placeholder="(e.g. Cement)" required></div>
                          </div>
                          <label for="inputBrand" class="col-sm-3 col-form-label ms-3 fw-bold text-dark">Brand</label>
                          <div class="col-sm-8">
                            <div class="input-group"><span class="input-group-text bg-warning"><i class="fa-solid fa-pen-clip"></i></span><input type="text" class="form-control" id="brand" name="brand" pattern="[a-zA-Z0-9-_.ñ/\s]+" title="Brand must not contain any other special characters." placeholder="(e.g. Holcim)" required></div>
                          </div>
                          

                          <label for="inputUnit" class="col-sm-3 col-form-label ms-3 fw-bold text-dark">Unit</label>
                          <div class="col-sm-8">
                            <div class="input-group"><span class="input-group-text bg-warning"><i class="fa-solid fa-pen-clip"></i></span>
                            <select id="unit" name="unit" class="form-control form-control" onchange='CheckUnit(this.value);' title="Choose unit or input other unit." required> 
                              <option value="Sack">Sack</option>
                              <option value="Piece">Piece</option>
                              <option value="Liter">Liter</option>
                              <option value="Cubic Meter">Cubic Meter</option>
                              <option value="Kilogram">Kilogram</option>
                              <option value="Others">Others...</option>
                            </select>
                            <input type="text" class="form-control" id="units" name="units" style='display:none;' placeholder="Other unit..." pattern="[a-zA-Z0-9-_.ñ\s/()]+" title="Insert other unit that must not contain any other special characters.">
                            </div>
                          </div>

                          
                          <label for="inputUnitPrice" class="col-sm-3 col-form-label ms-3 fw-bold text-dark">Unit Price</label>
                          <div class="col-sm-8">
                            <div class="input-group"><span class="input-group-text bg-warning"><i class="fa-solid fa-pen-clip"></i></span><input type="text" class="form-control" id="unit_price" name="unit_price" pattern="[0-9]+" title="Unit price must not contain special characters, letters or spaces." placeholder="(e.g. 100)" required></div>
                          </div>
                          <div class="modal-footer">
                            <button onclick="myFunction()" type="reset" class="btn btn-success text-white fw-bold"><i class="fa-solid fa-arrow-rotate-right me-2"></i>Reset </button>
                            <button type="submit" class="btn btn-primary fw-bold" name="insertdata"><i class="fa-solid fa-paper-plane me-2"></i>Save </button>
                            <button onclick="myFunction()" class="btn btn-danger fw-bold" data-bs-dismiss="modal"><i class="fa-solid fa-ban me-2"></i>Cancel</button>
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
                    <div class="modal-header text-white bg-primary">
                      <h5 class="modal-title fw-bold" id="exampleModalLabel"><i class="fa-solid fa-pen-to-square me-2"></i>Update Product</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            <!-- Modal edit end-->

            <!-- Modal body edit-->
                    <div class="modal-body">
                      <form class="row g-3 mt-2" action="update_product.php" method="POST" id="form_id2">
                          <label for="inputProductId" class="col-sm-3 col-form-label ms-3 fw-bold text-dark">Product Id</label>
                          <div class="col-sm-8">
                            <div class="input-group"><span class="input-group-text bg-primary text-light"><i class="fa-solid fa-key"></i></span><input type="text" class="form-control" id="update_id" name="update_id" readonly></div>
                          </div>
                          <label for="inputProductDesc" class="col-sm-5 col-form-label ms-3 fw-bold text-dark">Product Description</label>
                          <div class="col-sm-6">
                            <div class="input-group"><span class="input-group-text bg-primary text-light"><i class="fa-solid fa-pen-clip"></i></span><input type="text" class="form-control" id="update_pd" name="update_pd" pattern="[a-zA-Z0-9-_.ñ\s()]+" title="Product description must not contain any other special characters." required></div>
                          </div>
                          <label for="inputBrand" class="col-sm-3 col-form-label ms-3 fw-bold text-dark">Brand</label>
                          <div class="col-sm-8">
                            <div class="input-group"><span class="input-group-text bg-primary text-light"><i class="fa-solid fa-pen-clip"></i></span><input type="text" class="form-control" id="update_brand" name="update_brand" pattern="[a-zA-Z0-9-_.ñ/\s]+" title="Brand must not contain any other special characters." required></div>
                          </div>
                          

                          <label for="inputUnit" class="col-sm-3 col-form-label ms-3 fw-bold text-dark">Unit</label>
                          <div class="col-sm-8">
                            <div class="input-group"><span class="input-group-text bg-primary text-light"><i class="fa-solid fa-pen-clip"></i></span>
                            <select id="update_unit" name="update_unit" class="form-control form-control" onchange='CheckUpdateUnit(this.value);' title="Choose unit or input other unit." required>
                              <option value="Sack">Sack</option>
                              <option value="Piece">Piece</option>
                              <option value="Liter">Liter</option>
                              <option value="Cubic Meter">Cubic Meter</option>
                              <option value="Kilogram">Kilogram</option>
                              <option value="Others">Others...</option>
                            </select>
                            <input type="text" class="form-control" id="update_units" name="update_units" style='display:none;' placeholder="Other unit..." pattern="[a-zA-Z0-9-_.ñ\s/()]+" title="Insert other unit that must not contain any other special characters.">
                            </div>
                          </div>


                          <label for="inputUnitPrice" class="col-sm-3 col-form-label ms-3 fw-bold text-dark">Unit Price</label>
                          <div class="col-sm-8">
                            <div class="input-group"><span class="input-group-text bg-primary text-light"><i class="fa-solid fa-pen-clip"></i></span><input type="text" class="form-control" id="update_up" name="update_up" pattern="[0-9₱.]+" title="Unit price must not contain special characters, letters or spaces." required></div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary fw-bold" name="updatedata"><i class="fa-solid fa-paper-plane me-2"></i> Save </button>
                            <button onclick="myFunctionn()" type="button" class="btn btn-danger fw-bold" data-bs-dismiss="modal"><i class="fa-solid fa-ban me-2"></i>Cancel</button>
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
                      <h5 class="modal-title text-white fw-bold" id="exampleModalLabel"><i class="fa-solid fa-box-archive me-2"></i>Archive Product</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            <!-- Modal delete end-->

            <!-- Modal body delete-->
                    <div class="modal-body">
                      <form class="row g-3 mt-2" action="archive_product.php" method="POST">
                      
                          <div class="text-center">
                            <h5 class="mx-3">Are you sure that you want to archive the product details of <strong><span name="delete_idd" id="delete_idd" class="text-danger"></span></strong>?</h5>
                          </div>
                          
                          <input type="hidden" name="delete_id" id="delete_id">

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

            <!-- Modal body table add -->
              <div class="card-body">
                <div class="table-responsive">
                <?php 
                  $query = "SELECT * FROM product WHERE product_status = 0";
                  $query_run = mysqli_query($connection, $query);
                ?>  
                  <table id="example" class="table table-striped" style="width: 100%">
                    <thead class="table-dark">
                      <tr>
                        <th class="fw-bold text-uppercase text-center">Product Id</th>
                        <th class="fw-bold text-uppercase text-center">Product Description</th>
                        <th class="fw-bold text-uppercase text-center">Brand</th>
                        <th class="fw-bold text-uppercase text-center">Unit</th>
                        <th class="fw-bold text-uppercase text-center">Unit Price</th>
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
                          <td><?php echo $row['product_id'] ?></td>
                          <td><?php echo $row['product_desc'] ?></td>
                          <td><?php echo $row['brand'] ?></td>
                          <td><?php echo $row['unit'] ?></td>
                          <td align='right'>₱<?php echo  number_format($row['unit_price'], 2) ?></td>
                          <td><center>
                            <button type="submit" title="Update this product" class="btn btn-primary editbtn"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button type="button" title="Archive this product" class="btn btn-danger deletebtn"><i class="fa-solid fa-trash-can"></i></button>
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
                          <th class="fw-bold text-uppercase">Product Id</th>
                          <th class="fw-bold text-uppercase">Product Description</th>
                          <th class="fw-bold text-uppercase">Brand</th>
                          <th class="fw-bold text-uppercase">Unit</th>
                          <th class="fw-bold text-uppercase text-end">Unit Price</th>
                        </tr>
                      </tfoot>
                  </table>
                </div>
              </div> 
            <!-- Modal body table add end -->

            <!-- Modal archive-->
            <div class="modal fade" id="archivemodal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal-content border-warning border-2">
                    <div class="modal-header bg-warning">
                      <h5 class="modal-title fw-bold" id="exampleModalLabel"><i class="fa-solid fa-box-archive me-2"></i>Archived Products</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            <!-- Modal archive end-->

            <!-- Modal body archive-->
                  <div class="modal-body">
                    <form class="row g-3">
                      <div class="card-body"> 
                        <div class="table-responsive">
                          <?php 
                            $query = "SELECT * FROM product WHERE product_status = 1";
                            $query_run = mysqli_query($connection, $query);
                          ?>   
                          <table id="example1" class="table table-striped table-sm" style="width: 100%">
                              <thead class="table-dark">
                              <tr>
                                  <th class="fw-bold text-uppercase text-center">Product Id</th>
                                  <th class="fw-bold text-uppercase text-center">Product Description</th>
                                  <th class="fw-bold text-uppercase text-center">Brand</th>
                                  <th class="fw-bold text-uppercase text-center">Unit</th>
                                  <th class="fw-bold text-uppercase text-center">Unit Price</th>
                                  <th class="fw-bold text-uppercase text-center">Date Archived</th>
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
                                    <td><?php echo $row['product_id'] ?></td>
                                    <td><?php echo $row['product_desc'] ?></td>
                                    <td><?php echo $row['brand'] ?></td>
                                    <td><?php echo $row['unit'] ?></td>
                                    <td align='center'>₱<?php echo  number_format($row['unit_price'], 2) ?></td>
                                    <td align='center'><?php echo date('m/d/Y | g:i A', strtotime($row["product_arch_date"])) ?></td>
                                    <td><center>
                                      <button type="button" title="Recover this product" class="btn btn-success recoverbtn" data-bs-toggle="modal" data-bs-target="#recovermodal"><i class="fa-solid fa-arrows-rotate"></i></button>
                                      <button type="button" title="Delete this product" class="btn btn-danger deletef" data-bs-toggle="modal" data-bs-target="#deleteforever"><i class="fa-solid fa-trash-can"></i></button>
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
                                    <th class="fw-bold text-uppercase text-center">Product Id</th>
                                    <th class="fw-bold text-uppercase text-center">Product Description</th>
                                    <th class="fw-bold text-uppercase text-center">Brand</th>
                                    <th class="fw-bold text-uppercase text-center">Unit</th>
                                    <th class="fw-bold text-uppercase text-center">Unit Price</th>
                                    <th class="fw-bold text-uppercase text-center">Date Archived</th>
                                    <th class="fw-bold text-uppercase text-center">Actions</th>
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
            <!-- Modal body archive end-->
            
            <!-- Modal recover-->
              <div class="modal fade" id="recovermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content border-success border-2">
                    <div class="modal-header bg-success">
                      <h5 class="modal-title text-white fw-bold" id="exampleModalLabel"><i class="fa-solid fa-arrows-rotate me-2"></i>Recover Product</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            <!-- Modal recover end-->

            <!-- Modal body recover-->
                    <div class="modal-body">
                      <form class="row g-3 mt-2" action="recover_product.php" method="POST">
                          
                          <div class="text-center">
                            <h5 class="mx-3">Are you sure that you want to recover the product details of <strong><span id="recover_idd" name="recover_idd" class="text-success"></span></strong></span>?</h5>            
                          </div>
                          
                          <input type="hidden" name="recover_id" id="recover_id">

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
                      <h5 class="modal-title text-white fw-bold" id="exampleModalLabel"><i class="fa-solid fa-trash-can me-2"></i>Delete Product Forever</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            <!-- Modal delete forever end-->

            <!-- Modal body delete forever-->
                    <div class="modal-body">
                      <form class="row g-3 mt-2" action="deleteforever_product.php" method="POST">
                          
                          <div class="text-center">
                            <h5 class="mx-3">Are you sure that you want to permanently delete the product details of <strong><span id="deletef_idd" name="deletef_idd" class="text-danger"></span></strong>?</h5>
                          </div> 
                          
                          <input type="hidden" name="deletef_id" id="deletef_id">

                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary fw-bold" name="deletefdata" >&nbsp<i class="fa-solid fa-check me-2"></i>Yes&nbsp</button>
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
                  
                  initComplete: function () {
                    this.api().columns().every( function () {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo( $(column.footer()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
        
                                column
                                    .search( val ? '^'+val+'$' : '', true, false )
                                    .draw();
                            } );
        
                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        } );
                    } );
                },

                  //stateSave: true,
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
                                },

                                text:      '<i class="fa fa-print text-primary" style="font-size: 34px;"></i>',
                                titleAttr: 'Print',
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4  ]
                                },
                                title: '',
                                messageTop: '<center><img src="../images/Logo.png" width="200px" height="200px" alt="Logo"><h3><?php echo $roww['store_name']; ?></h3></center> <center><h6><?php echo 'Block&nbsp'; echo $roww['store_block']; echo '&nbspLot&nbsp'; echo $roww['store_lot']; echo '&nbsp'; echo $roww['store_street'];?></h6><center> <center><h6><?php echo 'Barangay&nbsp'; echo $roww['store_barangay']; echo ',&nbsp'; echo $roww['store_city']; echo '&nbsp'; echo $roww['store_province']; echo '&nbsp-&nbsp'; echo $roww['store_zip'];?></h6></center> <center><h6><?php echo 'Contact No.:&nbsp'; echo $roww['store_contact'];?></h6></center> <center><h6><?php echo 'Prepared by:&nbsp'; echo $row['firstname'];?>&nbsp<?php echo $row['lastname'];}}}?></h6></center> <center><h6><?php date_default_timezone_set('Asia/Manila'); $currentDateTime = date('F d, Y | h:i A'); echo 'Date & Time:&nbsp'; echo $currentDateTime; ?></h6></center> <br> <center><h3>LIST OF PRODUCTS</h3></center><br>'
                            },
                        ]
                  
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

                  $('#update_id').val(data[0]);
                  $('#update_pd').val(data[1]);
                  $('#update_brand').val(data[2]); 
                  $('#update_unit').val(data[3]); 
                  
                  $('#update_up').val(parseInt(data[4].replace(/\₱|,/g, ''),10));         
                  
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

                                customize: function ( win ) {
                                  $(win.document.body).find('table tbody td:nth-child(5)').css('text-align', 'right');
                                },

                                text:      '<i class="fa fa-print text-primary" style="font-size: 34px;"></i>',
                                titleAttr: 'Print',
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5  ]
                                },
                                title: '',
                                messageTop: '<center><img src="../images/Logo.png" width="200px" height="200px" alt="Logo"><h3><?php echo $roww['store_name']; ?></h3></center> <center><h6><?php echo 'Block&nbsp'; echo $roww['store_block']; echo '&nbspLot&nbsp'; echo $roww['store_lot']; echo '&nbsp'; echo $roww['store_street'];?></h6></center> <center><h6><?php echo 'Barangay&nbsp'; echo $roww['store_barangay']; echo ',&nbsp'; echo $roww['store_city']; echo '&nbsp'; echo $roww['store_province']; echo '&nbsp-&nbsp'; echo $roww['store_zip'];?></h6></center> <center><h6><?php echo 'Contact No.:&nbsp'; echo $roww['store_contact'];?></h6></center> <center><h6><?php echo 'Prepared by:&nbsp'; echo $row['firstname'];?>&nbsp<?php echo $row['lastname'];}}}?></h6></center> <center><h6><?php date_default_timezone_set('Asia/Manila'); $currentDateTime = date('F d, Y | h:i A'); echo 'Date & Time:&nbsp'; echo $currentDateTime; ?></h6></center> <br> <center><h3>ARCHIVED PRODUCTS</h3></center><br>'
                            },
                        ]
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

                  $('#delete_id').val(data[0]);
                  $('#delete_idd').text(data[0]);
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

                    $('#recover_id').val(data[0]);
                    $('#recover_idd').text(data[0]); 
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
