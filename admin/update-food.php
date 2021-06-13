<?php

include('Partial/menu.php');

?>

<?php

	if(isset($_GET['id']))
	{
		//get all the Detail

		$id = $_GET['id'];

		//Sql Query to get Selected Food

		$sql2 = "SELECT * FROM tbl_food WHERE id=$id";

		//execute the query

		$res2 = mysqli_query($con,$sql2);

		//get the value based on query executed 

		$row2 = mysqli_fetch_assoc($res2);

		//Get the Individual value of selectred food

		$title = $row2['title'];

		$description = $row2['description'];

		$price = $row2['price'];

		$current_image = $row2['image_name'];

		$current_category = $row2['category_id'];

		$featured = $row2['featured'];

		$active = $row2['active'];







	}

	else

	{
		//redirect to manage Food

		header('location:'.SITEURL.'admin/manage-food.php');
	}


?>

<div class="main-content">
	
	<div class="wrapper">

		<h1> Update Food</h1> 

		<br> <br>

		<form action="" method="POST" enctype="multipart/form-data">
			
			<table class="tbl-30">

				<tr>

				<td>Title</td>
				<td>
					
	<input type="text" name="title" placeholder="Food Title " value="<?php echo $title; ?>">

				</td>
				</tr>

				<tr>
					
					<td>Description</td>

					<td>
						

	<textarea name="description" cols='30' rows="5" ><?php echo $description;?></textarea>
					</td>
				</tr>


				<tr>
					
					<td>Price</td>

			<td>

				<input type="number" name="price" value="<?php echo $price;?>">

			</td>
				</tr>

				<tr>
					
					<td>Current Image</td>

					<td>
						
				<?php

			if($current_image =="")
						{
							//Image not Available

			echo "div> Image not Avavailable</div>";
						}

						else
						{

							//Image 

							?>

		<img src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>" width='100px'>



							<?php
						}
						?>

					</td>
				</tr>

				<tr>
					
					<td>Select Image</td>

					<td>
						
		<input type="file" name="images">
					</td>
				</tr>

				<tr>
					
					<td>Category</td>
					<td>
						
						<select name="category">

				<?php

				//query to get categories

				$sql = "SELECT * FROM tbl_category WHERE active='Yes'";

				//execute 

				$res = mysqli_query($con,$sql);

				$count = mysqli_num_rows($res);

				//check Whether the category Available or Not

				if($count>0)
				{
					//category Available

		while($row = mysqli_fetch_assoc($res)) 
					{

				$category_title = $row['title'];

				$category_id = $row['id'];

		
					?>


		<option <?php if($current_category == $category_id) {echo "selected";} ?>  value="<?php echo $category_id; ?>"  > <?php echo $category_title; ?></option>

					<?php
						
					}

				}

				else
				{

					//category Not Available

					echo "<option value='0'> <h2>Category Not Available</h2> </option>";

				}

				?>

							
						</select>
					</td>
				</tr>

				<tr>

					<td>Featured</td>

					<td>
						
		<input <?php if($featured =="Yes")
		{echo "checked";} ?>  type="radio" name="featured" value="Yes">Yes

		<input <?php if($featured =="No")
		{echo "checked";} ?>  type="radio" name="featured" value="No">No

					</td>
				</tr>


					<td>Active</td>

					<td>
						
		<input <?php if($active =="Yes")
		{echo "checked";} ?> type="radio" name="active" value="Yes">Yes

		<input <?php if($active =="No")
		{echo "checked";} ?>  type="radio" name="active" value="No">No
		
					</td>
				</tr>

				<tr>
					<td>

		<input type="hidden" name="id" value="<?php echo $id ;?>">

		<input type="hidden" name="current_image" value="<?php echo $current_image;?>">

						
			<input type="submit" name="submit" value="Update Food"  class="btn-secondary">
					</td>
				</tr>
			</table>
		</form>

		<?php 

		if(isset($_POST['submit']))
		{
			//1.get the detail from the form

			$id = $_POST['id'];

			$title = $_POST['title'];

			$description = $_POST['description'];

			$price =$_POST['price'];

			$current_image = $_POST['current_image'];

			$category = $_POST['category'];

			$featured = $_POST['featured'];

			$active = $_POST['active'];


			//2.uload the Image

			//check whether uplaod image is clicked or  not

		if(isset($_FILES['image']['name']))

			{

	$image_name = $_FILES['image']['name'];	//new Image

					//check whether the file isavail or not

		if($image_name != "")
					{
						//image is avail 

						//rename the Image

	$ext = end(explode('.',$image_name));
 
	$image_name = "Food-Name-".rand(0000,9999).'.'.$ext;	//this will rename the image name

	//get the source path and destination path

	$src_path = $_FILES['image']['tmp_name'];
	$dst_path = "../images/food/".$image_name;

	//upload the image

$upload = move_uploaded_file($src_path, $dst_path);

	//chck twhether the image is uplaoded or not
	if($upload == false)

	{
		$_SESSION['upload'] = "<div class='error'><h2> Failed to Upload New Image </h2></div>";

		header('location:'.SITEURL.'admin/manage-food.php');

		//stop the process

		die();

	}
		//3.remove the image if new Image is uplaod and current image  exits

	//remove the image if available

	if($current_image != "")
	{
		//current image is available

		//redirect the image

		$remove_path = "../images/food/".$current_image;

		$remove = unlink($remove_path);

		//chck whter the image i removed or not
		if($remove == false)
		{
			//failed to remove the image

	$_SESSION['remove-failed'] ="<div class='error'><h2>Failed to remove current Image </h2></div>";

	//redirect to menamge food
	header('location:'.SITEURL.'admin/manage-food.php');

	//stop the process

	die();

			}
		}
	}
	
	else
	{
	$image_name = $current_image;//default Image	
	}
}

			else

			{
		$image_name = $current_image; //Default image when button is not clicked
			}

		
			//4 . Redirect to Manage Food with Session Message

			$sql3 = "UPDATE tbl_food SET
			title='$title',
			description='$description', 
			price='$price',
			image_name='$image_name',
			category_id='$category',
			featured='$featured',
			active='$active'
			WHERE id=$id
			";

			//execute the Query 

	$res3 = mysqli_query($con,$sql3);

	//check whether the query is executed or not

	if($res3 == true)
	{

		//query executed and food updated

		$_SESSION['update'] = "<div class='success'><h2> Food Updated Sucessfully</h2></div>";
 
		header('location:'.SITEURL.'admin/manage-food.php');
	}
	else
	{
		$_SESSION['update'] = "<div class='error'><h2> Failed to Update Food  </h2></div>";

		header('location:'.SITEURL.'admin/manage-food.php');
	}



		}


		?>
		
	</div>
</div>

<?php

include('Partial/footer.php');

?>