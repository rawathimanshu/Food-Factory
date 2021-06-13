<?php

//include constant file

 include '../config/constant.php';

//get the id of Admin to be delete

 $id = $_GET['id'];

//create  aql query to delete admin
 $sql = "DELETE FROM tbl_admin Where id = $id";

 //Execute the query

 $res = mysqli_query($con ,$sql);

 //check whether query execute d succesfully

 if($res ==TRUE)
 {
 	//QUERY executed successfully
 	
 	//create session to dispaly messAge 

 	$_SESSION['delete'] = "<div class='success'>Admin Delete successfully </div";

 	//redierct to manage admin 
 	header('location:'.SITEURL.'admin/manage-admin.php');
 }

else
{
	$_SESSION['delete'] = "<div class='error'> Failed to Delete Admin.</div>";
		header('location:'.SITEURL.'admin/manage-admin.php');
	
}
//redirect to manage admin page with message(Success/error)