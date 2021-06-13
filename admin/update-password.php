<?php
include('Partial/menu.php')
?>

<div class="main-content">
				<div class="wrapper">

			<h1>Change Password</h1>
					<br><br>
	<?php

	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
	}

	?>

			<form action="" method="POST">
		<table class="tbl-30">


			<tr>
			<td>Current Password:</td>
			<td><input type="password" name="current _password" placeholder="Current Password"> </td>
			</tr>

			<tr>
				<td>
					New Password:
				</td>
				<td>
	<input type="password" name="new_password" placeholder="New Password">
				</td>
			</tr>



			<tr>
		<td>Confirm Password</td>
				<td>
   <input type="password" name="confirm_password" placeholder="Confirm Password">
				</td>
			</tr>



			<tr>
				<td colspan="2">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" name="submit" class="btn-secondary" value="Change Password">
					
				</td>
			</tr>
				</table>

						
					</form>
					</div>
				</div>


	<?php

	//check whether submit button is clicked or not

	if(isset($_POST['submit']))
	{
		//echo "clicked";

		//1.Get the data from form

$id = $_POST['id'];
$current_password = md5($_POST['current_password']);
$new_password = md5($_POST['new_password']);
$confirm_password = md5($_POST['confirm_password']);
		//2. check whether the user with current Password exits or not

    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

//execute query
$res = mysqli_query($con,$sql);

		if($res==true)
		{
			//check whetehher datda is avail
			$count = mysqli_num_rows($res);

			if($count ==1)
			{
				//user exits and passowrd can be Change
				
				//check new and confir password
	if($new_password==$confirm_password)
				{
				//update the password
					$sql2 = "UPDATE tbl_admin SET
					 password='$new_password'
					  Where id=$id
					  ";
		//execute the qery
		$res2 = mysqli_query($con,$sql2);

		if($res2==true)
		{
							//redirect admoin
$_SESSION['change-pwd'] = "<div class='success'><h2>Password Changed Successfully.</h2></div>"; 	  

	header('location:'.SITEURL.'admin/manage-admin.php');

		}


		else
		{

							//redirect admin
	$_SESSION['change-pwd'] = "<div class='error'><h2>Failed to change password. </h2></div>"; 

	header('location:'.SITEURL.'admin/manage-admin.php');

		}

				}

				else
				{
					//redirect admoin
	$_SESSION['pwd-not-match'] = "<div class='error'><h2>Password  Not Match.</h2></div>"; 

	header('location:'.SITEURL.'admin/manage-admin.php');
				}
	
			}	

else 

{
$_SESSION['user-not-found'] = "<div class='error'><h2>User Not Found.</h2></div>"; 

	header('location:'.SITEURL.'admin/manage-admin.php');
}
	}	 
		//3. check wheter the  new Password and confirm mathch or not

		//4. Change passowrd if all above is true

	}
	?>

	<?php
			include 'Partial/footer.php';
			?>
