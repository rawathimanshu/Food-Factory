<?php

include 'Partial/menu.php';
?>

<div class="main-content"> 
	<div class="wrapper">
		<h1>Update Admin</h1>
		<br><br>

		<?php 

		//get the id of selected Admin

		$id = $_GET['id'];

		//create sql query toget the Detail 
		$sql = "SELECT * FROM tbl_admin WHERE id=$id";

		$res = mysqli_query($con ,$sql);

		//check wheter the query is executer or not
		if($res == TRUE)
		{
			//check data avail 
			$count = mysqli_num_rows($res);
			//check  wheterr we have admin data or not 
			if($count ==1)
			{
				//get the detail
				
				$row =mysqli_fetch_assoc($res);

				$full_name = $row['full_name'];
				$username = $row['username'];  
			}
			else
		{
			//redirect to manage page
		header('location:'.SITEURL.'admin/manage-admin.php');
		}


		}

		 ?>

		<form action="" method="POST">
		<table class="tbl-30">
			
			<tr>
				<td>Full Name </td>

<td> <input type="text" name="full_name" value="<?php echo $full_name?>"></td>
			</tr>

		<tr>
		<td>Username</td>
		<td><input type="text" name="username" value="<?php echo $username?>"></td>


			</tr>


			<tr>
		<td colspan="2">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="submit" name="submit" value="Update Admin" class="btn-secondary">
				</td>
			</tr>

		</table> 
			

		</form>
	</div>
</div>


<?php

//check whteer the sub button is clicked or not 

if(isset($_POST['submit']))
{
	//get all the values from form to update
	$id = $_POST['id'];
$full_name = $_POST['full_name'];
	$username = $_POST['username'];

 //create a sql querry to update admin
	$sql = "UPDATE tbl_admin SET
	full_name ='$full_name',
	username = '$username'	
	WHERE id = '$id'
	";

	//execute the query 
 $res  = mysqli_query($con , $sql);

	//check the execution of query

	if($res == true)
	{
		//query Executed and admin updated

$_SESSION['update'] = "<div class='success'> Admin Updated Successfully.</div>";

header('location:'.SITEURL.'admin/manage-admin.php');


	}

	else
	{
		//failed to update the admin



$_SESSION['update'] = "<div class='error'>Failed to  Updated Admin</div>";

		header('location:'.SITEURL.'admin/manage-admin.php');
	}

}

 
 ?>
<?php

include 'Partial/footer.php';
?>