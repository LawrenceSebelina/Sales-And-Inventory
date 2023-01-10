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
        body{
          font-family: "Inter", sans-serif;
        }
        
        .sidebar-nav {
          width: 270px;
          float: right;
        }

        .header_price{
          border: 1px white;
          background-color: black;
          margin: 10px;
          color: #39FF14;
          width: 30%;
          float: right;
          height: 123px;
        }

        .cart-logo{
          border: 1px white;
          margin: 10px;
          color: #39FF14;
          float: left;
          padding-left: 10px;
        }

        .my-custom-scrollbar {
          position: relative;
          height: 400px;
          overflow-x: hidden;
          overflow-y: auto;
        }

        .table-wrapper-scroll-y {
          display: block;
        }

        #notifications_counter {
          position: absolute;
          background: #E1141E;
          color: #FFF;
          font-size: 12px;
          font-weight: normal;
          padding: 1px 3px;
          border-radius: 2px;
          -moz-border-radius: 2px; 
          -webkit-border-radius: 2px;
          z-index: 1;
        }

        #alert_popover{
          display: block;
          position: fixed;
          bottom: 70px;
          left: 25px;
          height: auto;
        }
        
        .wrapper{
          display: table-cell;
          vertical-align: bottom;
          height: auto;
          width: 300px;
        }
        

        .table td, .table th {
          vertical-align: middle;
        }

        input[type='number']{
          width: 80px;
        } 
    </style>

</head>
<body>
  <?php include('transac_id.php'); ?>
    <!-- top navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold" href="#">Karesma Trading</a>

        
        <ul class="nav navbar-nav navbar-right mx-3">
          <li class="dropdown">
            <a href="#" class="ddtoggle" data-bs-toggle="dropdown"><span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger mt-2 count" style="border-radius:10px;"></span> <span style="font-size: 25px;"><i class="fa-solid fa-bell"></i></span></a>
            <ul class="dropdown-menu" style="right: 0; left: auto; padding-left: 1px; padding-right: 1px; overflow-y: scroll; height: 270px;"></ul>
          </li>
        </ul>
          
        

      </div>
    </nav>
    <!-- top navigation bar -->

    <!-- bottom navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary fixed-bottom">
      <div class="container-fluid">
        <center><h5 class="text-uppercase text-white fw-bold ms-5 pt-2" id='clockDisplay'></h5></center>
        <a class="navbar-brand text-uppercase fw-bold d-flex justify-content-end" href="#">
          <li class="d-flex ms-5 ps-5">&nbsp&nbsp&nbsp Discount (%):&nbsp&nbsp<input style="width: 100px" class="text-end form-control-sm" type="number" name="discountpercent" value="0" min="0" id="discountpercent" readonly></li>
          <li class="d-flex ms-5">&nbsp&nbsp&nbsp Discounted Amount (₱):&nbsp&nbsp<input style="width: 100px" class="text-end form-control-sm" type="number" name="discounted" value="0" min="0" id="discounted" readonly></li>
        </a>

        <small>
					<ul class="text-white">
            <li class="d-flex mb-0"><p id="totalValue1" class="mb-0 ml-5 pl-3" style="display: none;"></p></li>
						<li class="d-flex mb-0 mt-0"><input style="width: 100px; display: none;" class="text-right form-control-sm" type="number" name="discountpercent" value="0" min="0" id="discountpercent" readonly></li>
						<li class="d-flex mb-0 mt-0"><input style="width: 100px; display: none;" class="text-right form-control-sm" type="number" name="discount" value="0" min="0" id="discount" readonly></li>
					</ul>
				</small>
        
      </div>
    </nav>
    <!-- bottom navigation bar -->

      <div class="cart-logo mt-5 pt-1">
        <img src="images/cart2.png" alt="cart" height="110" width="150">
      </div>

      <div class="header_price border mt-5">
        <h4><b>Grand Total</b></h4>
        <p class="text-black" style="float: right; font-size: 50px;" id="totalValue">₱ 0.00</p>
      </div>

      <div class="text-white fw-bold text-uppercase bg-secondary pt-5 mt-3">
				<table class="table-responsive-sm">
					<tbody>
            <tr>
            <?php 
              if(isset($_SESSION['username'])){
                $username = $_SESSION['username'];
                $sql = "SELECT firstname, lastname FROM users WHERE username='$username'";
                $result	= mysqli_query($connection, $sql);
                if (mysqli_num_rows($result) > 0){
                  while($row = mysqli_fetch_assoc($result)){
            ?>
              <td valign="baseline"><small class="ps-5 ms-5" style="font-size: 15px;">Cashier:</small></td>
							<td valign="baseline"><small><p class="ps-5 ms-3" style="color: #7FFF00;"><i class="fa-solid fa-cash-register">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</i><input type="text" class="bg-secondary" style="input: border: none; border-color: transparent; outline: none; font-weight: bold; color: #7FFF00; text-transform: uppercase; font-size: 15px;" id="name" value="<?php echo $row['firstname'];?> <?php echo $row['lastname'];}}}?>" readonly/></p></small></td>
						</tr>
						<tr>
							<td valign="baseline"><small class="ps-5 ms-5" style="font-size: 15px;">Transaction Id:</small></td>
							<td valign="baseline"><small><p class="ps-5 ms-3" style="color: #FFD700;"><i class="fa-solid fa-key">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</i><input type="text" class="bg-secondary" style="input: border: none; border-color: transparent; outline: none; font-weight: bold; color: #FFD700; font-size: 15px;" id="transaction_id" value="<?php echo $number; ?>" readonly/></p></small></td>
						</tr>
            <tr>
							<td valign="baseline"><small class="ps-5 ms-5" style="font-size: 15px;">Transaction Date:</small></td>
							<td valign="baseline"><small><p class="ps-5 ms-3" style="color: #00FFFF;"><i class="fa-solid fa-calendar-week" style="color: #00FFFF; font-size: 15px;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</i><span id='clockDisplay2'></span></p></small></td>
						</tr>
					</tbody>
				</table>
			</div>

    <!-- sidebar -->
    <div class="sidebar-nav bg-light border border-secondary border-2">
      <div class="p-0 mb-5 pb-5">
        <nav class="navbar-dark">
          <div class="list-group mt-3 mb-4 d-grid gap-1">
              <button type="button" class="fw-bold list-group-item list-group-item-action active" aria-current="true"><span><i class="fa-solid fa-cash-register fa-lg" style="margin-right: 1.1rem;"></i>New Transaction</span></button>
              <button type="button" class="fw-bold list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#searchproduct"><span style="margin-right: 0.6rem;"><i class="fa-solid fa-search fa-lg" style="margin-right: 1.1rem;"></i>Search Product</span><i>(Ctrl + z)</i></button>
              <button type="button" class="enter fw-bold list-group-item list-group-item-action"><span style="margin-right: 0.6rem;"><i class="fa-solid fa-hand-holding-dollar fa-lg" style="margin-right: 1rem;"></i>Settle Payment</span><i>(Ctrl + x)</i></button>
              <button type="button" class="cancel fw-bold list-group-item list-group-item-action"><span style="margin-right: 2.9rem;"><i class="fa-solid fa-shopping-cart fa-lg" style="margin-right: 1rem;"></i>Clear Cart</span><i>(Ctrl + c)</i></button>
              <button type="button" class="discount fw-bold list-group-item list-group-item-action">&nbsp<span style="margin-right: 1.1rem;"><i class="fa-solid fa-percent fa-lg" style="margin-right: 1.2rem;"></i>Add Discount</span><i>(Ctrl + v)</i></button>
              <button type="button" class="fw-bold list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#addmodal">&nbsp<span style="margin-right: 1rem;"><i class="fa-solid fa-plus fa-lg" style="margin-right: 1rem;"></i>Add Schedule</span><i>(Ctrl + b)</i></button>
              <a type="button" class="fw-bold list-group-item list-group-item-action" href="viewdelivery.php">&nbsp<span style="margin-right: 0.7rem;"><i class="fa-solid fa-calendar-days fa-lg" style="margin-right: 1rem;"></i>View Schedule</span><i>(Ctrl + m)</i></a>
              <button type="button" name="signout" onclick="out();" class="signout fw-bold list-group-item list-group-item-action">&nbsp<span style="margin-right: 3.5rem;"><i class="fa-solid fa-right-from-bracket fa-lg" style="margin-right: 0.9rem;"></i>Sign Out</span><i>(Ctrl + i)</i></button>
          </div>
        </nav>
      </div>
    </div>
    <!-- sidebar -->

    <main class="mt-2">
      <div class="container-fluid">              
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card bg-light border-1" style="height: 10 rem;">
              <div class="card-body">
                <div id="content" class="mr-2">
                  <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
                    <form method="POST" action="">
                      <table id="example" class="table table-striped data-table">
                        <thead class="table-dark">
                          <tr>
                            <th class="fw-bold text-uppercase text-center">Product Id</th>
                            <th class="fw-bold text-uppercase text-center">Description</th>
                            <th class="fw-bold text-uppercase text-center">Brand</th>
                            <th class="fw-bold text-uppercase text-center">Unit</th>
                            <th class="fw-bold text-uppercase text-center">Unit Price</th>
                            <th class="fw-bold text-uppercase text-center">Quantity</th>
                            <th class="fw-bold text-uppercase text-center">Sub Total</th>
                            <th class="fw-bold text-uppercase text-center">&nbsp&nbspActions&nbsp&nbsp</th>
                            <th class="fw-bold text-uppercase text-center" style="display:none;">Actions</th>
                        </thead>
                        <tbody id="tabledata">
                          
                        </tbody>
                      </table>
                      <span id="val"></span>
                    <form>
                </div>
              </div>

            <!-- Modal search product-->
            <div class="modal fade" id="searchproduct" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal-content border-warning border-2">
                    <div class="modal-header bg-warning">
                      <h5 class="modal-title fw-bold" id="exampleModalLabel"><i class="fa-solid fa-basket-shopping me-2"></i>Products</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            <!-- Modal search product end-->

            <!-- Modal body search product-->
                  <div class="modal-body">
                    <form class="row g-3" id="form-submit" method="POST">
                      <div class="card-body">    
                        <div class="table-responsive">
                          <?php 
                            $query_search = "SELECT * FROM product WHERE quantity > 0";
                            $query_run = mysqli_query($connection, $query_search);
                          ?>   
                          <table id="example1" class="table table-striped table-sm" style="width: 100%">
                              <thead class="table-dark">
                              <tr>
                                  <th class="fw-bold text-uppercase text-center">Product Id</th>
                                  <th class="fw-bold text-uppercase text-center">Product Description</th>
                                  <th class="fw-bold text-uppercase text-center">Brand</th>
                                  <th class="fw-bold text-uppercase text-center">Unit</th>
                                  <th class="fw-bold text-uppercase text-center">Unit Price</th>
                                  <th class="fw-bold text-uppercase text-center">Stocks</th>
                                  <th class="fw-bold text-uppercase text-center">Action</th>
                              </tr>
                              </thead>
                              <tbody id="tabledata2">
                              <?php
                                  if(mysqli_num_rows($query_run) > 0)
                                  {
                                      while($row = mysqli_fetch_assoc($query_run))
                                      {
                                        echo "<tr class='addbtn' data-prodid=".$row['product_id']." data-product=".$row['product_desc']." data-brand=".$row['brand']." data-price=".$row['unit_price']." data-unit=".$row['unit']." data-quantity=".$row['quantity'].">";
                                        echo "<td class='prod_id'>".$row['product_id']."</td>";
                                        echo "<td class='prod_desc'>".$row['product_desc']."</td>";
                                        echo "<td class='prod_brand'>".$row['brand']."</td>";
                                        echo "<td class='prod_unit'>".$row['unit']."</td>";
                                        echo "<td align='right' class='prod_price'>₱".number_format($row['unit_price'], 2)."</td>";
                                        echo "<td class='text-white prod_qty' align='right'>".$row['quantity']."</td>";  
                                        echo "<td class='text-center'><button class='btn btn-primary addbtn' type='submit' title='Add this to the cart'><i class='fa-solid fa-shopping-cart'></i></button></td>";
                                        echo "</tr>";
                                      }
                                    }
                                    else{
                                      echo "No record found";
                                    }
                                  ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <th class="fw-bold text-uppercase text-center">Product Id</th>
                                  <th class="fw-bold text-uppercase text-center">Product Description</th>
                                  <th class="fw-bold text-uppercase text-center">Brand</th>
                                  <th class="fw-bold text-uppercase text-center">Unit</th>
                                  <th class="fw-bold text-uppercase text-center">Unit Price</th>
                                  <th class="fw-bold text-uppercase text-center">Stocks</th>
                                  <th class="fw-bold text-uppercase text-center">Action</th>
                              </tr>
                              </tfoot>
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
            <!-- Modal body search product end-->
            
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
                                <label for="inputDateTime" class="text-center fw-bold text-uppercase bg-warning"><span><i class="fa-solid fa-calendar-days"></i>&nbsp&nbspDate & Time</span></label>
 
                                    <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" style="height: 250px;">

                                      <?php
                                        $query_search = "SELECT * FROM delivery WHERE status BETWEEN 'Not delivered' AND 'Pending' AND delivery_status = 0 ORDER BY DATE(`date`) = CURDATE() DESC, status DESC, time ASC";
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
                                    <div class="input-group"><span class="input-group-text"><i class="fa-solid fa-clock"></i></span><input type="time" min="07:00" max="17:00" title="Time must around 7:00 AM to 5:00 PM." class="form-control" id="time" name="time" required></div>
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
        </div>
      </div>

        <div id="alert_popover">
          <div class="wrapper">
            <div class="content">

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
      <script src="js/time.js"></script>
      <script src="js/time2.js"></script>
      <script src="js/accounting.min.js"></script>
      <script src="js/moment.min.js"></script>
      <script src="js/dataTables.dateTime.min.js"></script>
      <script type="text/javascript" src="script.js"></script>
      
      <script>
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



        $(document).ready( function () {
            var table = $('#example1').DataTable( {
              stateSave: true,
              pageLength : 5,
              lengthMenu: [[5, 10, 20, 25], [5, 10, 20, 25]],


              "createdRow": function( row, data, dataIndex ) {
              if (data[5] > 20) {        
                $(row).find('td:eq(5)').css('background-color', '#198754');
              }else if (data[5] > 0) {        
                $(row).find('td:eq(5)').css('background-color', '#ffc107');
              }else{
                $(row).find('td:eq(5)').css('background-color', '#dc3545');
              }
            }

              
          });
        });

        $(document).on('keydown', function ( e ) {
            // You may replace `m` with whatever key you want
            if ((e.metaKey || e.ctrlKey) && ( String.fromCharCode(e.which).toLowerCase() === 'z') ) {
            $("#searchproduct").modal('show');
            }
            else if ((e.metaKey || e.ctrlKey) && ( String.fromCharCode(e.which).toLowerCase() === 'x') ) {
            document.querySelector('.enter').click();
            }
            else if ((e.metaKey || e.ctrlKey) && ( String.fromCharCode(e.which).toLowerCase() === 'c') ) {
            document.querySelector('.cancel').click();
            }
            else if ((e.metaKey || e.ctrlKey) && ( String.fromCharCode(e.which).toLowerCase() === 'v') ) {
            document.querySelector('.discount').click();
            }
            else if ((e.metaKey || e.ctrlKey) && ( String.fromCharCode(e.which).toLowerCase() === 'b') ) {
            $("#addmodal").modal('show');
            }
            else if ((e.metaKey || e.ctrlKey) && ( String.fromCharCode(e.which).toLowerCase() === 'm') ) {
            window.location.href = 'viewdelivery.php';
            }
            else if ((e.metaKey || e.ctrlKey) && ( String.fromCharCode(e.which).toLowerCase() === 'i') ) {
            document.querySelector('.signout').click();
            }
            
        });
      </script>

<script>
$(document).ready(function(){
 
    setInterval(function(){
    load_last_notification();
    }, 5000);
 
    function load_last_notification(){
        $.ajax({
        url:"fetch2.php",
        method:"POST",
        success:function(data){
        $('.content').html(data);

        //function showNotification() {
          //const notification = new Notification("New delivery incoming", {
              //body: 'data'
          //})
          //notification.onclick = (e) => {
              //window.location.href = "https://google.com";
        //};
        //}


      //console.log(Notification.permission);
      //if (Notification.permission === "granted") {
           //showNotification();
      //}else if (Notification.permission !== "denied") {
       // Notification.requestPermission().then(permission => {
         // showNotification();
          //});
      //}

        }
    })
    }
});
</script>


<script>
  $(document).ready(function(){
  
    function load_unseen_notification(view = '')
    {
      $.ajax({
      url:"fetch.php",
      method:"POST",
      data:{view:view},
      dataType:"json",
      success:function(data)
      {
        $('.dropdown-menu').html(data.notification);
        if(data.unseen_notification > 0)
        {
        $('.count').html(data.unseen_notification);
        }
      }
      });
    }
    
    load_unseen_notification();
    
    $(document).on('click', '.ddtoggle', function(){
      $('.count').html('');
      load_unseen_notification('yes');
    });
    
    setInterval(function(){ 
      load_unseen_notification();; 
    }, 5000);
  
  });
</script>

<?php 
    if(isset($_SESSION['status']) && $_SESSION['status'] !='')
    {
        ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status']; ?>",
                text: "<?php echo $_SESSION['statustext']; ?>",
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

