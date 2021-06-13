<?php 
include('Partial-front/menu.php');
  ?> 




 
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
    <form action="<?php echo SITEURL; ?>food-search.php" method="POST">

                <input type="search" name="search" placeholder="Search for Food.." required>

                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <br>
    <br>
    <br>


<?php


if(isset($_SESSION['order']))
{

    echo $_SESSION['order'];
    unset($_SESSION['order']);
}


if(isset($_SESSION['feedback1']))
{

    echo $_SESSION['feedback1'];
    unset($_SESSION['feedback1']);
}

if(isset($_SESSION['sinup']))
{

    echo $_SESSION['sinup'];
    unset($_SESSION['sinup']);
}

if(isset($_SESSION['login']))
{

    echo $_SESSION['login'];
    unset($_SESSION['login']);
}

if(!isset($_SESSION['name']))
{
if(isset($_SESSION['log-error']))
{

    echo $_SESSION['log-error'];
    unset($_SESSION['log-error']);
}
}   

if(isset($_SESSION['del-det']))
{

    echo $_SESSION['del-det'];
    unset($_SESSION['del-det']);
}
 


?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 

                //Create SQL query to Dispaly Categories from Database 

            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes'" ;

            //execute the Query

            $res = mysqli_query($con,$sql);

            //count rows to check wheter the category is avilable or not 

            $count = mysqli_num_rows($res);

            if($count>0)
            {

                //Categories Available
              while($row = mysqli_fetch_assoc($res))
                {
                    //get the value like title image name

        $id = $row['id'];

         $title = $row['title'];

          $image_name = $row['image_name'];

           ?>

    <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id; ?>">
            <div class="box-3 float-container">

                <?php 
                //check whether image is available or not

                if($image_name =="")
                {
                    //Dispaly Message

                    echo "<div class='error'>Image Not Available</div>";
                }

                else
                {
                    //Image Available
                    ?>

                    <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?> " alt="Pizza" height='380px' class="img-responsive img-curve">



                    <?php
                }

                ?>
                

                <h3 style="color: white;" class="float-text text-white"><?php echo $title; ?></h3>
            </div>
            </a>


           <?php

                }
            }

            else
            {
                //Category Available

                echo "<div class='error'> Category Not Added</div>";
            }


            ?>

          

           
           

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->

    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
             <?php
              if(!isset($_SESSION["name"] ))
   {

             $f =1;

             $f++;

              if($f >1 ) {echo "<h3 style='margin-bottom:35px;color:grey;margin-top:26px;'>Before You Order You Must Login Or Sinup First</h3>";}
          }?>

            <?php


                //Getting Food from Databse that are Active and Featured

            //Sql query

    $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 4";

            //Execute the Query

            $res2 = mysqli_query($con,$sql2);

            //count rows

            $count2 = mysqli_num_rows($res2);


            //whether food avail or not

            if($count2>0)
            {
                //Avail Food

                while($row= mysqli_fetch_assoc($res2))
                {
                    //get the Value
                    $id = $row['id'];

         $title = $row['title'];

         $price = $row['price'];

         $description = $row['description'];

          $image_name = $row['image_name'];

          ?>

           <div class="food-menu-box">
                <div class="food-menu-img">

                    <?php

                    //check whether image is avail or not

                    if($image_name == "")
                    {
                        //image not Avail
                         echo "<div class='error'> Image not Available </div>";
                    }

                    else

                    {
                        //Image Available
                        ?>

    <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve" height='110' width='125'>

                        <?php
                    }


                    ?>
                   
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title;?></h4>
                    <p class="food-price"><?php echo $price;?></p>
                    <p class="food-detail">
                        <?php echo $description;?>
                    </p>
                    <br>

        <!-- checking if the person is login or not -->

      
      <a class='btn btn-primary' <?php 
      
 $f =1;
      if(isset($_SESSION["name"] ))
      { 

        ?>

     href='<?php SITEURL;?>order.php?food_id=<?php echo $id;?>' 
     <?php
   }

   


   

   elseif(!isset($_SESSION["name"] ))
   {


?><?php
   
    echo "alert('Please Login First')";


    $f++;
   }

   ?>
   

        >Order Now  </a> 
               
</div>
            </div>


          <?php


                }
            }

            else
            {
                //Food Not Availabale

            echo "<div class='error'>Food Not Available </div>";
            }


             ?>

           
            

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL;?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

   <?php include 'Partial-front/footer.php';  ?>
    <!-- footer Section Ends Here -->

</body>
</html>