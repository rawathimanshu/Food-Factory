<?php

include ('Partial/menu.php');

?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Food</h1>
		<br>
		<br>

		<?php
		if(isset($_SESSION['upload']))
		{
			echo $_SESSION['upload'];
			unset($_SESSION['upload']);
		}


		 ?>

		<form action="" method="POST" enctype="multipart/form-data">

			<table class="tbl-30">

				<tr>
					<td>Title</td>

					<td>

	<input type="text" name="title" placeholder="Title of Food">		
					</td>
					
				</tr>

				<tr>
					<td>Description</td>
					<td>
			
		<textarea name="description" cols="30" rows="5"></textarea>				

					</td>
				</tr>

				<tr>
					<td>Price</td>
					<td>
						
		<input type="number" name="price">

					</td>
				</tr>

				<tr>
					<td>Select Image</td>
					<td>
	<input type="file" name="image"> 
					</td>


				</tr>

				<tr>
					<td>Category</td>
					<td>
			
			<select  name="category">


		<?php

		//Create php code to dispaly categories from Database

		//1.Create SQL to get all active Categories

		$sql = "SELECT * FROM tbl_category
		WHERE active='Yes'";

		//Execute cubrid_query(query)
		$res = mysqli_query($con,$sql);

		//count rows to check whether we have categories 	or not

		$count =mysqli_num_rows($res);

		//if count is greater then zero ,we have categories else or we dont have categories

		if($count>0)
		{

			while($row = mysqli_fetch_assoc($res))
			{

				//get the dwtail of categories
				$id = $row['id'];
				$title = $row['title'];

				?>

	<option value="<?php echo $id;?>" ><?php echo $title;?></option>



				<?php


			}


		}

		else
		{
			//we do not have category

			?>

	<option value="0">No Category Found</option>

			<?php
		}

		?>

				
			</select>
					</td>
				</tr>

				<tr>
					<td>Featured</td>

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
						
		<input type="submit" name="submit" value="Add Food" class="btn-secondary">


					</td>
				</tr>
				
			</table>
			
		</form>

		<?php

		//Cjeck wheher tje button is pressed or not

		if(isset($_POST['submit']))

		{

			// 1.Get the data from form

			$title = $_POST['title'];
			$description = $_POST['description'];
			$price =  $_POST['price'];
			$category =  $_POST['category'];

			//check whether radio button for featured  and active are checked or not

			if(isset($_POST['featured']))
			{
				$featured = $_POST['featured'];
			}

			else
			{

				$featured = "No";

			}


		if(isset($_POST['active']))
			{
				$active = $_POST['active'];
			}

			else
			{

				$active = "No"; //default

			}

			//2.uplaod the image if selected

			//chck whether the select image is clicked or not and uplaod the image only if the image is selected

			if(isset($_FILES['image']['name']))
			{
				//get the detail of the selected image
	$image_name = $_FILES['image']['name'];

			//chck whether the image is selected or not 	and uplaod the image only if selected

			if($image_name !="")
			{
				//Image is selected

			//1. Rename the image
				//get the extension of selected image i.e jpg
		$ext = end(explode('.', $image_name));

		//create new name for image

		$image_name = "Food-Name-".rand(0000,9999).".".$ext;

		//2. Uplaod the image



		//Get the Source path and Destination path

		//source path is the current location of the image

	$src = $_FILES['image']['tmp_name'];

	$dst = "../images/food/".$image_name;

		//Finally uplaod the food image

$uplaod  =move_uploaded_file($src, $dst);


		//checck wheter image is uplaoded or not

		if($uplaod ==false)
		{
			//failed touplaod the image
			//redirect to add food page with Error message

	$_SESSION['uplaod']="<div class='error'> Failed to uplaod the image</div>";

	header('location:'.SITEURL.'admin/add-food.php');

	//stop the process
	die();

		}

	}

}

			else
			{
				$image_name = ""; //selectig default is blank


			}

			//3.Insert into Database
			//create a sql  query to save or Add food

			//numerical we dont need to pass value inside 

$sql2 = "INSERT INTO tbl_food
SET title='$title',
description='$description',
price='$price',
image_name='$image_name',
category_id=$category,
featured='$featured',
active='$active'
			";

			//ececute the query

		$res2 = mysqli_query($con,$sql2);

		//check whether data inseted or not 

		if($res2 == true)
		{
			$_SESSION['add'] = "<div class='success'> <h2>Food Added Successfully </h2></div>";

	header('location:'.SITEURL.'admin/manage-food.php');
		}

		else
		{
			$_SESSION['add'] = "<div class='error'>Failed to Add Food </div>";

	header('location:'.SITEURL.'admin/manage-food.php');
		}


		//4.Redirect iwth Message to Mnage Food Page



		}

		?>		
	</div>
</div>

<?php

include ('Partial/footer.php');

 ?>
