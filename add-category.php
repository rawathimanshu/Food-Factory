<?php include 'Partial/menu.php';?>

<div class="main-content">
	
	<div class="wrapper">
		<h1>Add Category</h1>
		<br><br>
		<!-- Add Category start -->

		<?php 

		if(isset($_SESSION['add']))
		{
			echo $_SESSION['add'];

			unset($_SESSION['add']);
		}

	if(isset($_SESSION['upload']))
		{
		echo $_SESSION['upload'];

		unset($_SESSION['upload']);
		}

		 ?>
		 <br>
		 <br>

		<form action="" method="POST" enctype="multipart/form-data">
			
		<table class="tbl-30">
			<tr>
		<td>Title</td>
<td><input type="text" name="title" placeholder="Category Title"></td>
				

			</tr>

			<tr>
		<td>Select Image</td>

		<td><input type="file" name="image"></td>

			</tr>

		<tr>
			<td>Featured :  </td>
			<td>
				<input type="radio" name="featured" value="Yes">Yes

				<input type="radio" name="featured" value="No">No
			</td>
			

		</tr>

		<tr>
			<td>Active</td>

			<td>

<input type="radio" name="active" value="Yes">Yes

<input type="radio" name="active" value="No">No
			</td>
		</tr>

		<tr>
			<td colspan="2">
			<input type="submit" name="submit" value="Add Category" class="btn-secondary">
			</td>
		</tr>
			

		</table>

		</form>

		<!-- Add Category form ends-->
		<?php

			//Whether the Submit BUTTON is clicked otr not

if(isset($_POST['submit']))
		{
			//get the value from form cateory

	$title = $_POST['title'];
			//for radio input ,we need to check whether button is selected or not

			if(isset($_POST['featured']))
			{
				//Get the Value grom the form

		$featured = $_POST['featured'];
			}

			else
			{
				//See the default Value

			$featured = "No";
			}

	if(isset($_POST['active']))
			{

			$active = $_POST['active'];
			}

			else
			{
				$active = "No";
			}

			//check whether the image is selected or not and set the value for image name accordingly

	 //print_r($_FILES['image']);

			//die(); //Break the Code Here


if(isset($_FILES['image']['name']))
	{
		//Upload the Image 
		//to uplaod the image we need image name ,sourse path and destination path

	$image_name = $_FILES['image']['name'];

	//upload the image only if image is selected

	if($image_name != "")
	{




	//Auto rename our Image 
	//get the Extension of our image (jpg,png,gif) e.g food.jpg

	$ext  =end(explode('.', $image_name));

	//Rename the Image

	$image_name = "Food_Category".rand(000,999).'.'.$ext;

	$sourse_path = $_FILES['image']['tmp_name'];

	$destination_path = "../images/category/".$image_name;


    $upload =move_uploaded_file($sourse_path, $destination_path);

		//check whether the image is uplaoded or not

		//and if the image is not uploaded then we will stop the process

		if($upload == false)
		{
	$_SESSION['upload']="<div class='error'> <h2> Failed to Upload Image </h2></div>";

			header('location:'.SITEURL.'admin/add-category.php');

			//stop the process
			die();

		}

	}
	}

	else
	{
		//don't upload the Image and set the Image_name value as blank
		$image_name="";
	}




				//2. Create Sql query to insert Category into Database

	$sql = "INSERT INTO tbl_category SET title='$title',
	image_name='$image_name',featured='$featured',active='$active'";

			//execute the query and save in database

			$res =mysqli_query($con,$sql);

			//check whether the query executed added or not

			if($res == true)
			{
	$_SESSION['add']= "<div class='success'> <h2>Category Added Successfully</div></h2>";

				//redirect to manage Category
				header("location:".SITEURL.'admin/manage-category.php');
			}

			else
			{
	$_SESSION['add']= "<div class='success'><h2>Failed to Add Category </h2></div>";

				//redirect to manage Category
		header("location:".SITEURL.'admin/add-category.php');
			}

		}


		 ?>
	</div>
</div>



<?php include 'Partial/footer.php';?>


