<?php 
include('Partial-front/menu.php');
  ?> 

  <?php 

  //check whether food id is safe or not

  if(isset($_GET['food_id']))
  {
    //get the foodid and detail of the selected food

    $food_id = $_GET['food_id'];

    //get the detail of the Selected food

    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
     //Execution of query

    $res = mysqli_query($con , $sql);

   
    $count = mysqli_num_rows($res);

    //check whwether  the data is avai;able or not

    if($count==1)
    {
        //We have Data
        //get the data frcom Database

        $row =mysqli_fetch_assoc($res);

        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];

    }

    else
    {
        //food not Availble

        //redirect to the HomePage

        header('location:'.SITEURL);


    }


  }

  else
  {
    header('location:'.SITEURL);
  }

  ?>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">

              <?php

              //check whether the image is avail or not


              if($image_name=="")//not avail
              {

                echo "<div class='error'>
                Image Not Available </div>";


              }

              else
              {
                // avail
                ?> 
                  <img src="
                  <?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title;?>" class="img-responsive img-curve">

                  <?php


              }
                      


              ?>


                      
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title;?></h3>

    <input type="hidden" name="food" value="<?php  echo $title;?>">
                        <p class="food-price"><?php echo $price;?></p>
    <input type="hidden" name="price" value="<?php  echo $price;?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Himanshu" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx"  class="input-responsive" 
                      required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. himanshu@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php

            //check whether the submit button is pressed or not

            if(isset($_POST['submit']))
            {
                //get the detail from form


        $food = $_POST['food'];

        $price = $_POST['price'];

        $qty = $_POST['qty'];

        $total = $price * $qty; //total


        $order_date = date('Y-m-d h:i:sa');//order date 'current date'

        $status = "Ordered"; //Ordered ,On deleivery ,Deleivred , Canceled

        $customer_name = $_POST['full-name'];

        $customer_contact = $_POST['contact'];

        $customer_email = $_POST['email'];

        $customer_address = $_POST['address'];


        //save the Order in Database

        //create Sql to save the data in Database

        $sql2 = "INSERT INTO tbl_order SET 
        food='$food',
        price='$price',
        qty='$qty',
        total='$total',
        status='$status',
        order_date='$order_date',
        customer_name='$customer_name',
        customer_contact='$customer_contact',
        customer_email='$customer_email',
        customer_address='$customer_address'
        ";

        //execute the Query 

        $res2 = mysqli_query($con,$sql2);

        //chech query executerd or not

        if($res2    ==true)
        {
            //query executed and data is saves

     $_SESSION['order'] = "<div class='success text-center'><h1>Thanks for Ordering Food Mr $customer_name <h1></div>";

            header('location:'.SITEURL);
        }

        else
        {
            //Failed to save Data
              $_SESSION['order'] = "<div class='error text-center'>Failed to Order Your Food <br><br> Try Again!</div>";
              header('location:'.SITEURL);

        }


            }

            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- social Section Starts Here -->
    <?php 
include('Partial-front/footer.php');
  ?>    
    <!-- footer Section Ends Here -->

</body>
</html>