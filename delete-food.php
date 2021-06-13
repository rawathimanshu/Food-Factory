<?php

include('../config/constant.php');

if(isset($_GET['id']) && isset($_GET['image_name']))
{
	//Process to Delete

	// get id and Image Name

	$id = $_GET['id'];
	$image_name = $_GET['image_name'];

	//Remove the Image if Available

	//check whether the image is available or not and delte only if avail

	if($image_name != "")
	{

		//it has Image need to remove from folder

		//get the image path

		$path ="../images/food/".$image_name;

		//Remove Image File from Folder

		$remove = unlink($path);

		//check whether the image is removed or  not

		if($remove == false)
		{
			//failed to remove image
			$_SESSION['upload'] ="<div> Failed to remove File.</div>";

			//Redirect to Mnage Food

			header('location:'.SITEURL.'admin/manage-food.php');

			//stop the process
			die();
		}
	}

	//Delete food from database

	$sql = "DELETE FROM tbl_food WHERE id=$id";

	//Execute the Query

	$res = mysqli_query($con,$sql);

	//check whether the query  executed or not and set the Session message

	if($res == true)
	{
		$_SESSION['delete'] = "<div class='success'> Food Delete Successfully </div>";

		header('location:'.SITEURL.'admin/manage-food.php');
 	} 

 	else
 	{
 		$_SESSION['delete'] = "<div class='success'>Failed to Delete Food </div>";

		header('location:'.SITEURL.'admin/manage-food.php');
 	}

	//Redirect to Manage Food with Session Message

}

else
{
	//Redirect to manage Food Page
	$_SESSION['unauthorize'] = "<div class='error'>Unauthorised Access</div>";

}

?>