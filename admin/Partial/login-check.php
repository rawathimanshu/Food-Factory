
<?php 

	//Authoriation -Access

	//check whether theuser is logged or not

if(!isset($_SESSION['user'])) //if user is not set
{

	//user isnot log in
	//redirect to login page

	$_SESSION['no-login-message'] = "<div class='error text-center' >Please login to access admin Panel</div>";
 
	header('location:'.SITEURL.'admin/login.php');

}



 ?>