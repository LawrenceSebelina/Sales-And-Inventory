<?php
	include('server/connection.php');

	if (isset($_POST['products'])){

		$show 	= "SELECT * FROM product";
		$query 	= mysqli_query($connection,$show);
		if(mysqli_num_rows($query)>0){
			while($row = mysqli_fetch_array($query)){
				echo "<tr class='js-add' data-barcode=".$row['product_id']." data-product=".$row['product_desc']." data-price=".$row['unit_price']." data-unt=".$row['unit']."><td>".$row['product_id']."</td><td>".$row['product_desc']."</td>";
				echo "<td>₱".$row['unit_price']."</td>";
				echo "<td>".$row['unit']."</td>";
				echo "<td>".$row['quantity']."</td>";

			}
		}
		else{
			echo "<td></td><td>No Products found!</td><td></td>";
		}
	}?>