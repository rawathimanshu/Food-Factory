<?php 
include('Partial-front/menu.php');

  ?> 

   <?php

  //chck whether id is passed or not

  if(isset($_GET['category_id']))
  {
    $category_id = $_GET['category_id'];

    //get  the category titile based on actegory ID

    $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

    //execute the query

    $res = mysqli_query($con, $sql);

    $row = mysqli_fetch_assoc($res);

    //get the title

    $category_title = $row['title'];


  }

  else
  {
    //category not passed 

    //redirect to home oage

    header('location:'.SITEURL);    
  }
  ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white"><?php echo $category_title; ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

            //Create SQL Query to ge food based on selected Category

            $sql2 = "SELECT * FROM tbl_food WHERE category_id='$category_id'";

            //Execute the Query

            $res2 = mysqli_query($con,$sql2);

            $count2 = mysqli_num_rows($res2);

            //check whether food is available or not

            if($count2 >0)
            {
                //Food available

  while ($row2 =mysqli_fetch_assoc($res2))
                 {
                    $id = $row2['id'];

                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];

                    $image_name = $row2['image_name'];

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

    <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve" >

                        <?php
                    }


                    ?>

                   
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title; ?></h4>
                    <p class="food-price"><?php echo $price; ?></p>
                    <p class="food-detail">
                       <?php echo $description; ?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>


                    <?php
                }
            }

            else
            {
                //food not Available
                echo "<div class='error'> Food Not Availavle</div>";
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

</body>
</html>