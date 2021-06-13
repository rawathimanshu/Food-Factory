<?php 
include('Partial-front/menu.php');
  ?> 
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
     <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

            //Display Food that are Active

            $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

            //execute the query 

            $res = mysqli_query($con, $sql);

            //count rows

            $count = mysqli_num_rows($res);

            //check whether the foods are available or not

            if($count > 0)
            {

                //food avail

                while($row = mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];

                    $title = $row['title'];

                    $description= $row['description'];

                    $price =$row['price'];
                    $image_name = $row['image_name'];

                    ?>

                    <div class="food-menu-box">
                <div class="food-menu-img">

    <?php 

    //check image avail or not  

    if($image_name =="")
    {
        echo "<div class='error'>Image Not Available </div>";
    }
else
{
    //Image Avail

    ?>

    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve"  height='110' width='125'>



    <?php
}
    ?>
                    
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title; ?></h4>
                    <p class="food-price">$<?php echo $price;?></p>
                    <p class="food-detail">
                        <?php echo $description; ?>
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
                echo "<div class='error'> Food Not Found</div>";
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