<?php 
include('Partial-front/menu.php');
  ?> 
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php

            //get the search keyword

    $search  = $_POST['search'];



            ?>
            <h2>Foods on Your Search <a href="#" class="text-white"><?php echo $search;?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php  

            
            

            //sql Query Based on search keyword

            $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

            //execute the query

            $res = mysqli_query($con , $sql);

            //count rows

            $count = mysqli_num_rows($res);

            //check whether food avail or not

            if($count >0)
            {
                //food Available

                while($row = mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $title =$row['title'];
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

    <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve"  height='110' width='125'>

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

                     <a class='btn btn-primary' <?php 
      

      if(isset($_SESSION["name"] ))
      { 

        ?>

     href='<?php SITEURL;?>order.php?food_id=<?php echo $id;?>' 
     <?php
   }

   elseif(!isset($_SESSION["name"] ))
   {

    ?>
        
     <?php
    echo "alert('Please Login First')";
   }

   ?>
   

        >Order Now</a>  
               
                </div>
            </div>

                    <?php
                }
            }

            else
            {
                //food not Available

                echo "<div class='error text-center'> <h2>Food Not Found</h2></div>";
            }


            ?>


           


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
    <?php 
include('Partial-front/footer.php');
  ?> 
    <!-- footer Section Ends Here -->

</body>
</html>