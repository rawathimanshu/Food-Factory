
<?php 
include('Partial-front/menu.php');

  ?>

  <section class="food-search">
        <div class="container">

  <h1 class="text-center" style="font-size: 64px;margin-top: -60px;margin-bottom: 60px; color: Maroon;font-family: aerial;letter-spacing: 4px;">Sinup</h1>

  <form action="" method="POST" class="text-center order" style="">	


  <fieldset style="height:470px; border: 4px solid black;padding: 20px;border-radius: 8px;">

                  <div class="order-label" style="font-size: 34px; color: black;letter-spacing: 4px;font-family: bold;">Name</div><br> 
                    <input style="padding: 2%;width: 350px;" type="text" name="name" placeholder="E.g. Himanshu Rawat" class="input-responsive" required>

<br><br>
                   
                    <div class="order-label"style="font-size: 34px; color: black;letter-spacing: 4px;font-family: bold;">Username</div><br>
                    <input style="padding: 2%;width: 350px;" type="email" name="username" placeholder="E.g. Himanshu@gmail.com" class="input-responsive" required>

<br><br>                   

                     <div class="order-label" style="font-size: 34px; color: black;letter-spacing: 4px;font-family: bold;">Password</div><br>
                    <input style="padding: 2%;width: 350px;" type="password" name="password" placeholder="Password" class="input-responsive" required>

<br><br><br>

                    <input  style="width: 90px; height: 40px;" type="submit" name="submit" value="Submit" class="btn btn-primary">
                </fieldset>

  	



  </form>

 <?php

 //  //check whether the submit button is pressed or not

 if(isset($_POST['submit']))
            {
              $name1 = $_POST['name'];

           $name = $_POST['username'];

            $sinup_date = date('Y-m-d h:i:sa');

        $password = $_POST['password'];



        $sql2 = "INSERT INTO tbl_sinup SET 
        full_name='$name1', 
        user_name='$name',
        sinup_date='$sinup_date',
        password='$password'	
        ";


        //execute the Query 

        $res2 = mysqli_query($con,$sql2);

        //chech query executerd or not

        if($res2 == true)
        {
            //query executed and data is saves

          $_SESSION['name'] = $name1;

     $_SESSION['feedback1'] = "<div class='success text-center'><h1> Sinup Successfully<h1></div>";

            header('location:'.SITEURL);
        }

        else
        {
            //Failed to save Data
              $_SESSION['feedback1'] = "<div class='error text-center'>Failed to Signup. Try Again !</div>";
              header('location:'.SITEURL);

        }
              

              }




 ?>

</div>
</section>

  <?php

  include('Partial-front/footer.php');

  ?>