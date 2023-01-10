<?php include 'server/connection.php';
if(isset($_POST['product'])){
	$username = $_SESSION['username'];
	$name = $_POST['name'];
	$transaction_id = $_POST['transaction_id'];
	$product_name = $_POST['product_name'];
	$product_brand = $_POST['product_brand'];
	$product_unit = $_POST['product_unit'];
	$sub_total = $_POST['sub_total'];
	$change = $_POST['change'];
	$qtynum = $_POST['qtynum'];
	$total = $_POST['totalvalue'];
	$discount = $_POST['discount'];
	$discounted = $_POST['discounted'];
	$TotalQuantity = $_POST['TotalQuantity'];
	$price = $_POST['price'];
	$product = $_POST['product'];
	$quantity = $_POST['quantity'];

	$receipt = array();
	
	$query = '';
		$sql = "INSERT INTO transaction_logs (transaction_id, username, cashier_name, total, discount, discounted_amount, payment, changes, total_quantity) VALUES ('$transaction_id', '$username', '$name', $total, $discount, $discounted, $qtynum, $change, $TotalQuantity)";
		$result = mysqli_query($connection,$sql);

		if($result == true){
			$select = "SELECT receipt_no FROM transaction_logs ORDER BY receipt_no DESC LIMIT 1";
			$res = mysqli_query($connection,$select);
			$id = mysqli_fetch_array($res);
			for($i = 0;  $i < count($product); $i++){
				$receipt[] = $id[0];
			}

			for($num = 0; $num < count($product); $num++){
				$product_id = mysqli_real_escape_string($connection, $product[$num]);
				$qtyold = mysqli_real_escape_string($connection, $quantity[$num]);

				$sql1 = "SELECT quantity FROM product WHERE product_id='$product_id'";
				$result1 = mysqli_query($connection, $sql1);
				$qty = mysqli_fetch_array($result1);

				$newqty = $qty['quantity'] - $qtyold;

				$sql2 = "UPDATE product SET quantity=$newqty WHERE product_id='$product_id'";
				$result2 = mysqli_query($connection, $sql2);
			}

			for($num1 = 0; $num1 < count($product); $num1++){
				$product_id1 = mysqli_real_escape_string($connection, $product[$num1]);
				$qtyold1 = mysqli_real_escape_string($connection, $quantity[$num1]);

				$sql3 = "SELECT quantity_sold FROM product WHERE product_id='$product_id1'";
				$result3 = mysqli_query($connection, $sql3);
				$qty1 = mysqli_fetch_array($result3);

				$newqty1 = $qty1['quantity_sold'] + $qtyold1;

				$sql4 = "UPDATE product SET quantity_sold=$newqty1 WHERE product_id='$product_id1'";
				$result4 = mysqli_query($connection, $sql4);
				mysqli_query($connection,"UPDATE product SET quantitysold_date=current_timestamp WHERE product_id='$product_id1'");
			}

			$query1 = "INSERT INTO logs (username,purpose) VALUES('$username','Product sold')";
	 		$insert = mysqli_query($connection,$query1);

			for($count = 0; $count < count($product); $count++){
				$price1 = mysqli_real_escape_string($connection, $price[$count]);
				$receipt1 = mysqli_real_escape_string($connection, $receipt[$count]);
				$product1 = mysqli_real_escape_string($connection, $product[$count]);
				$product_name1 = mysqli_real_escape_string($connection, $product_name[$count]);
				$product_brand1 = mysqli_real_escape_string($connection, $product_brand[$count]);
				$product_unit1 = mysqli_real_escape_string($connection, $product_unit[$count]);
				$sub_total1 = mysqli_real_escape_string($connection, $sub_total[$count]);
				$quantity1 = mysqli_real_escape_string($connection, $quantity[$count]);
				
				if($receipt1 != '' && $product1 != '' && $product_name1 != '' && $product_brand1 != '' && $product_unit1 != '' && $quantity1 != '' && $price1 != '' && $receipt1 != ''){
					$query .= "INSERT INTO product_sales (receipt_no, product_id, product_desc, brand, unit, unit_price, quantity, sub_total) VALUES ('$receipt1', '$product1', '$product_name1', '$product_brand1', '$product_unit1', '$price1', '$quantity1', '$sub_total1');";
					$query .= "INSERT INTO adjust_stock (product_id, product_desc, adjusted, action, reason, adjusted_by) VALUES ('$product1', '$product_name1', '$quantity1', 'Product stock decreased', 'Product sold', '$name');";
	
				}
			}		 
		}else{
			echo "failure";
		}
	
	if ($query != ''){
		if(mysqli_multi_query($connection,$query)){
			echo "receipt_no=$receipt1";
			
		}else{
			echo "failed";
		}
	}else{
		echo 'failed';
	}
}

