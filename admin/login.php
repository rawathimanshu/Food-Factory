	<?php

include ('../config/constant.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login - Food Order </title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">

</head>	
<body style="background-image: url('../4.png');">
	<div class="header">

<h1 class="text-center" style="background-image: url('../4.png');font-size: 70px;margin-left:px; padding-top: 30px; height: 90px; letter-spacing: 8px;">Login</h1>


		
	</div>
	<div class ="login text-center">
		

			<fieldset style="height:390px;width: 400px; margin-left: -95px; border: 2px solid black;padding: 15%;border-radius: 8px;background-image: url('../21.jpg');">
		

		<?php 

		if(isset($_SESSION['login']))
		{
			echo $_SESSION['login'];
			unset($_SESSION['login']);

		}
		if(isset($_SESSION['no-login-message']))
		{
	echo ($_SESSION['no-login-message']);
	unset($_SESSION['no-login-message']);

		}


		 ?>
		 

		<form action="" method="POST">
		
 
			<b style="font-size: 30px;">Username:</b><br><br>

			<input style=" width: 80%;margin: 0 auto; padding: 3%;border-radius: 12px" type="text" name="username" placeholder="Enter Your Name"><br><br>

			<b style="font-size: 30px;">Password:</b><br><br>
			<input style=" width: 80%; margin: 0 auto; padding: 3%;border-radius: 12px" type="text" name="password" placeholder="Enter Your Password"><br><br><br>


			<input style="font-size: 20px; width: 80px;border-radius: 8px;height: 34px;" type="submit" name="submit" value="Login" class="btn-primary text-center">

		</form>
		<p class="text-center" style="margin-top: 23px; "><b style="font-size: 25px;">Created By : </b><br> <br><a style="text-decoration: none;font-size: 23px;color: white;" href="www.Himanshu.com"><b>Himanshu Rawat & Chetan Nandwal</b> </p>	

	</fieldset>
	</div>


</body>
</html>

<?php

//check whether the submit is clicked or not

if(isset($_POST['submit']))
{
	//process for login
	//Get the data from the login form

	echo $username = $_POST['username'];
	echo $password = md5($_POST['password']);

	//2. SQL to check the  user with username and passowrd is exit or not 

	$sql  ="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'
	";

	//3.Execute the query 
	$res= mysqli_query($con,$sql);

	//4.Count rows to check whether the user exits or not

	$count = mysqli_num_rows($res);

	if($count == 1)
	{
		//user exits
$_SESSION['login'] = "<div class='success'> <h2>Login Successfull</h2></div>";

$_SESSION['user'] = $username; //To check ewhteeher the user is logout  in or not and logout will unset it

header("location:".SITEURL.'admin/');

	}

	else
	{
		//user not avail
		$_SESSION['login'] = "<div class='error text-center'><h2> Login Failed <h2></div>";

header("location:".SITEURL.'admin/login.php');
	}





}
?>