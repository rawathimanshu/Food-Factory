	<?php

//include contant file
include ('../config/constant.php');
		//echo "Delete Page";

//chck  whether the id and image value is set or not

if(isset($_GET['id']) && isset($_GET['image_name']))

{
	//Get ehe value and Delete
	//echo "Get value and Dlete ";

	$id = $_GET['id'];
	$image_name = $_GET['image_name'];

	//remove the physical image file is available
	if($image_name != "") 
	{
		//image is available so remove it
		$path = "../images/category/".$image_name;
		
		//remove the image
		$remove = unlink($path);

		//if failed to remove the image then add an error and stop the process
		if($remove == false)
		{


//Set the Session Message
	$_SESSION['remove'] = "<div class='error'><h2>Failed to Remove Category Image</h2></div>";


			//redirect to manage Catgory Page
header('location:'.SITEURL.'admin/manage-category.php');

			//Stop the Process

			die();

		}
	}
	//delete data from Database
	$sql = "DELETE FROM tbl_category WHERE id=$id";
	//execute the query 
	$res = mysqli_query($con,$sql);

	//check whether the data is deleted from database or not
	if($res==true)
	{
		//set success mesg snd redirect
	$_SESSION['delete'] = "<div class='success'><h2> Category Deleted Successfully</h2></div>";
		//redirect to manage category
	header('location:'.SITEURL.'admin/manage-category.php');


	}
	else
	{ 
		$_SESSION['delete'] = "<div class='error'><h2>Failed to Delete Category</h2></div>";
		//redirect to manage category
		header('location:'.SITEURL.'admin/manage-category.php');


	}
}

else
{
	//redirect to manage Category Page
	header('location:'.SITEURL.'admin/manage-category.php');
}
?>