<?php

include 'Partial/menu.php';

?>
<div class="main-content">
	<div class="wrapper">
		<h1> Upadate the Category</h1>
		<br><br>


		<?php

		//check wheteher the id is set or not 

		if(isset($_GET['id']))
		{
			//get the id all other detail
	//echo "Getting the data";

  $id = $_GET['id'];

  //create the query to get all other details

  $sql = "SELECT * FROM tbl_category WHERE id=$id";

  //EXECUTE THE query 
  $res =mysqli_query($con,$sql);

  //count the rows to check whether the id is valid or not

  $count = mysqli_num_rows($res);

  if($count ==1)
  {
  	//get the data

  	$row = mysqli_fetch_assoc($res);
  	$title = $row['title'];

  	$current_image = $row['image_name'];
  	$featured = $row['featured'];
  	$active = $row['active'];
  }
  else
  {
  	$_SESSION['no-category-found']= "<div class='error'> Category Not Found</div>";

header('location:'.SITEURL.'admin/manage-category.php');
  }

		}

		else
		{

	header('location:'.SITEURL.'admin/manage-category.php');



		} 


		?>
<form action="" method="POST"enctype="multipart/form-data">

		<table class="tbl-30">
			<tr>
				<td>Title</td>
		<td>
		<input type="text" name="title" value="<?php echo $title;?>">
				</td>
			</tr>

			<tr>
				<td>Current Image</td>
				<td>
				<?php

if($current_image != "")
{
	// Display yhe image
	?>

	<img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" width="150px">
	<?php
} 

else 
{
	//desiplay the message
	echo "<div class='error'> Image Not Added</div>";
}

				 ?>
				</td>
			</tr>

			<tr>
				<td>New Image:</td>
		<td>
			<input type="file" name="image">
		</td>
			</tr>


			<tr>
				<td>Featured :</td>
	<td>
	<input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes

	<input <?php if($featured=="No"){echo "Checked";} ?> type="radio"  name="featured" value="No">No
				</td>
		</tr>

		<tr>
				<td>Active :</td>
	<td>
	<input <?php if($active=="Yes"){echo "checked";}?>  type="radio" name="active" value ="Yes">Yes

	<input <?php if($active=="No"){echo "checked";}?>  type="radio" name="active" value="No">No
				</td>
		</tr>

		<tr> 
			<td>
	<input type="hidden" name="current_image" value="<?php echo $current_image;?>">

	<input type="hidden" name="id" value="<?php echo $id;?>">



			<input type="submit" name="submit" value="UpadateCategory" class="btn-secondary">
		</td>
		</tr>


			
		</table>
		</form>

		<?php

		if(isset($_POST['submit']))
		{
			//echo "Clicked";

			//get all the values from form

	$id = $_POST['id'];
	$title = $_POST['title'];
	$current_image = $_POST['current_image'];
	$featured = $_POST['featured'];
	$active = $_POST['active'];


	//2 updating new Image

	//check whether imagae is selected or not

	if(isset($_FILES['image']['name']))
	{
		$image_name = $_FILES['image']['name'];

	// check whether the image is available or not

		if($image_name!="")

{
	//Image Available
	//A. uplaod the neww Image
	$ext  =end(explode('.',$image_name));

	//Rename the Image

	$image_name = "Food_Category".rand(000,999).'.'.$ext;

	$sourse_path = $_FILES['image']['tmp_name'];

	$destination_path = "../images/category/".$image_name;


    $upload =move_uploaded_file($sourse_path, $destination_path);

		//check whether the image is uplaoded or not

		//and if the image is not uploaded then we will stop the process

		if($upload == false)
		{
$_SESSION['upload']="<div class='error'>Failed to Upload Image</div>";

			header('location:'.SITEURL.'admin/manage-category.php');

			//stop the process
			die();

		}

	//B. remove the current image if available
		if($current_image!="")
	{
	$remove_path = "../images/category/".$current_image;

	$remove = unlink($remove_path);
	//check wheter the i,age is ermoved or not

		//if failed to remove the dispaly and stop the process

		if($remove == false)
		{
	$_SESSION['failed-remove'] = "<div class='error'>Failed to remove the Current Image</div>";

	header('location:'.SITEURL.'admin/manage-category.php') ;

	die();//remove the process 	
	}

		

		}
}
else
{
$image_name = $current_image;
}

	}
	else
	{
	$image_name =$current_image;
	}

	//3 update the database

$sql2 = "UPDATE tbl_category SET title='$title',
	image_name='$image_name',	
	featured='$featured',
	active='$active'
	WHERE id=$id
	";
	$res2 =mysqli_query($con,$sql2);

	//4 redirect to manage category

	if($res2 ==true)
	{
		//category upadated

$_SESSION['update'] ="<div class='success'> Category Updated Successfully </div>";

header('location:'.SITEURL.'admin/manage-category.php');
	}

	else
	{

$_SESSION['update'] ="<div class='error'> Failed to update Category </div>";

header('location:'.SITEURL.'admin/manage-category.php');

	}
		}

		



		?>

		
	</div>
</div>

<?php

include 'Partial/footer.php';

?>