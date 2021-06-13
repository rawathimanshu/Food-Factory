
<?php
include 'Partial/menu.php';?>
<div class="main-content">
	<div class="wrapper"><h1>Manage Order</h1>
		<br><br>
		<!-- btn to add admin-->

		<?php

		if(isset($_SESSION['update']))
		{
			echo $_SESSION['update'];
			unset($_SESSION['update']);	  	
		}

		?>

		
		<br><br>
		<table class="tbl-full">
			<tr>
				<th >S.N </th>
				<th >Food </th>
				<th style="padding: 20px;">Price </th>
				<th style="padding: 10px;">Qty  </th>
				<th style="padding: 20px;">Total </th>
				<th style="padding: 20px;"> Date </th>
				<th style="padding: 20px;">Status </th>
				<th style="padding: 20px;">Name</th>
				<th style="padding: 20px;">Contact </th>
				<th style="padding: 20px;">E-mail </th>
				<th style="padding: 20px;">Address </th>
				<th style="padding-left: 20px;">Actions </th>

			</tr>
			<?php

			//get all  the order From Data base
			$sql = "SELECT * FROM tbl_order ORDER BY id DESC"; //order by current order

			//Execute Query

			$res = mysqli_query($con,$sql);

			$count = mysqli_num_rows($res);

			$sn = 1;
			if($count>0)
			{

				//Order Available
				while($row = mysqli_fetch_assoc($res))
				{


					$id = $row['id'];

					$food = $row['food'];

					$price = $row['price'];

					$total = $row['total'];

					$qty = $row['qty'];

					$status = $row['status'];

					$order_date= $row['order_date'];

					$customer_name = $row['customer_name'];

					$customer_contact = $row['customer_contact'];

			$customer_email = $row['customer_email'];	

			$customer_address = $row['customer_address'];

			?>

			<tr>

	<td style="fon"><?php echo $sn++;?></td>

	<td><?php echo $food;?></td>

	<td><?php echo $price;?></td>

	<td><?php echo $qty;?></td>

	<td><?php echo $total;?></td>

	<td><?php echo $order_date;?></td>
	<td>

	<?php
	//Ordered on deleivery

	if($status =='Ordered')
	{
		echo "<label>$status </label>";
	}

	else if($status =="On Delivery")
	{
		echo "<label style='color:orange'>$status </label>";
	}

	else if($status =="Delivered")
	{
		echo "<label style='color:green'>$status </label>";
	}

	else if($status =="Cancelled")
	{
		echo "<label style='color:red'>$status </label>";
	}

	?>
</td>



	

	<td><?php echo $customer_name;?></td>

	<td><?php echo $customer_contact;?></td>

	<td><?php echo $customer_email;?></td>

	<td ><?php echo $customer_address;?></td>	
				
	<td> <a href="<?php echo SITEURL;?>admin/update-order.php?id= <?php echo $id;?>" class="btn-secondary">Update Order</a></td>
			</tr>	

			<?php		


						}
			}

		else
		{
			echo "<tr> <td colspan='12' class='error'>Order Not Available <td></tr>";
		}
			?>

			

			
		</table>
	</div>
</div>

<?php
include 'Partial/footer.php';

?>