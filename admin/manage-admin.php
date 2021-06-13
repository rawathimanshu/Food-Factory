<?php
include('Partial/menu.php')
?>

			<!-- Main Content-->

			<div class="main-content">
				<div class="wrapper">

		<h1>Manage Admin</h1>
		<br><br><br>

		<!-- btn to add admin-->
		<?php 

	if(isset($_SESSION['add']))
	{
		echo $_SESSION['add'];//display
		unset($_SESSION['add']);//remove
	}


	if(isset($_SESSION['delete']))
	{
		echo $_SESSION['delete'];
		unset($_SESSION['delete']);
	}


	if(isset($_SESSION['update']))
	{
		echo $_SESSION['update'];
		unset($_SESSION['update']);
	}


	if(isset($_SESSION['user-not-found']))
	{
		echo $_SESSION['user-not-found'];
		unset($_SESSION['user-not-found']);
	}


	if(isset($_SESSION['pwd-not-match']))
	{
	echo $_SESSION['pwd-not-match'];
	unset($_SESSION['pwd-not-match']);
	}

	if(isset($_SESSION['change-pwd']))
	{
	echo $_SESSION['change-pwd'];
	unset($_SESSION['change-pwd']);
	}






	
		 ?>
		 <br>
	<br><br>
		<a href="add-admin.php" class="btn-primary">Add Admin</a>
		<br><br>
		<table class="tbl-full">
			<tr>
				<th>S.No</th>
				<th>Full Name</th>
				<th>Username</th>
				<th>Actions</th>

			</tr>

			<?php
				//query to get all admin
				$sql = "SELECT * FROM tbl_admin";
//Execute the query

$res  =mysqli_query($con ,$sql);

if($res == TRUE)
{
	//count rows to check whteher we have data in db or not
	
	$n =1;

	$count = mysqli_num_rows($res);

	if($count>0)
	{
		//we got the data
		while($rows = mysqli_fetch_assoc($res))
		{
			//using while loop to get the a data in database
			//get individual data

			$id = $rows['id'];
			$full_name = $rows['full_name'];
			$username  = $rows['username'];

			//display the col in uor table
			?>
<tr>
				<td><?php echo $n++ ?></td>
				<td><?php echo $full_name ?></td>
				<td><?php echo $username ?></td>
<td>
	<a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary"> Change Password</a>

	<a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>


	<a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
				</td>
			</tr>

			<tr>

			<?php
		}

	}
	else
	{
		//not have any data
	}
}

			 ?>

			
				
		</table>


					</div>
			</div>

			<!--Footer -->
		<?php

			include 'Partial/footer.php';
			?>
