<?php 
include('Partial-front/menu.php');
  ?> 
    <!-- Navbar Section Ends Here -->



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php

            //Dispaly all the category that are active

                //sql query 

            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

            //execute the query

            $res = mysqli_query($con,$sql);


    $count = mysqli_num_rows($res);

    //check the cataegorues avail or not

    if($count > 0)
    {

        //Categories Available

        While($row = mysqli_fetch_assoc($res))
        {

        $id = $row['id'];

         $title = $row['title'];

          $image_name = $row['image_name'];

          ?>
      

           <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id;?>">
            <div class="box-3 float-container">

                <?php

                if($image_name =="")
                {
                    //Image Not Available
                       echo "<div error='error'>Image Not Found  </div>";
                }

                    else
                    {
                        //Image Available

                        ?>

         <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" height='380px' alt="Pizza" class="img-responsive img-curve">


                        <?php
                    }

                ?>

                

                <h3 class="float-text text-white"><?php echo $title;?></h3>
            </div>
            </a>



          <?php

    }
}

    else
    {
        echo "<div error='error'>
        Category Not Found  </div>";
    }




            ?>

           

            
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <!-- social Section Starts Here -->
    <?php 
include('Partial-front/footer.php');
  ?> 
    <!-- footer Section Ends Here -->

</body>
</html>