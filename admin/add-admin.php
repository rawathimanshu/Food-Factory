<?php
include('Partial/menu.php');
?>
<?php
?>

<div class="main-content">
	<div class="wrapper">
		<h1>
			Add Admin
		</h1>
		<br>

		<?php 

	if(isset($_SESSION['add']))//checking session is set or not 
	{
		echo $_SESSION['add'];//display
		unset($_SESSION['add']);//remove
	}
	
		 ?>
<br><br><br><br>
		<form action="" method="POST">
		<table class="tbl-30">

		<tr>
			<td>Full name</td>
			<td><input type="" name="full_name" placeholder="Enter your name"></td>
			
		</tr> 

		<tr>
			<td>Username</td>
			<td><input type="text" name="username" placeholder="Enter your Username"></td>
		</tr>

		<tr>
			<td>Password</td>
			<td><input type="password" name="password" placeholder="Enter your password"></td>
		</tr>

		<tr>
			<td >
				<input type="submit" name="submit" value="Add admin" class="btn-secondary"></td>
		</tr>
		</table>
		</form>
	</div>
</div>


<?php
include ('Partial/footer.php');
?>

<?php 
//Procees the value from form and save it in database
//check wheter the button is cleck or not 

if(isset($_POST["submit"]))
{
 $full_name = $_POST['full_name'];
 $username = $_POST['username'];
 $password = md5($_POST['password']);	//password encryted by md5

 //sql query to save in database

 $sql = "INSERT INTO tbl_admin SET 
 full_name ='$full_name',
 username = '$username',
 password = '$password'";

//execute quer and save into database


//execute quer and save to dataabse
 $res = mysqli_query($con ,$sql) or die(mysqli_error());

//check wheter the query is executerd  data is inserted or not and display appropriate message


 if($res ==TRUE)
 {
	 	//echo "Data Inserted ";

 	//var to dispaly var
 	$_SESSION['add'] = "Admin Added Succesfully";
 	//redirect page to manage admin
 	header('location:'.SITEURL.'admin/manage-admin.php');
 }

 else
 {
 		//echo "Data Inserted ";

 	//var to dispaly var
 	$_SESSION['add'] = "failed to  Add Admin Succesfully";
 	//redirect page to manage admin
 	header('location:'.SITEURL.'admin/add-admin.php');
 
}

}
 ?>


