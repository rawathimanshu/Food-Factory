<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>
	<!-- <div class = "login">
		<p>Created By= <a href="www.Himanshu.com"></a></p>
	</d -->

</body>
</html>

<?php 
include('Partial-front/menu.php');

  ?>

  <section class="food-search">
        <div class="container">

  <h1 class="text-center" style="font-size: 64px;margin-top: -60px;margin-bottom: 60px; color: Maroon;font-family: aerial;letter-spacing: 4px;">Login</h1>

  <form action="" method="POST" class="text-center order" style="">	


  <fieldset style="height:400px; border: 5px solid black;padding: 10%;border-radius: 8px;">
                   
                    <div class="order-label" style="font-size: 34px; color: black;letter-spacing: 4px;font-family: bold;">Username</div><br>
                    <input style="padding: 2%;width: 350px;" type="email" name="username" placeholder="E.g. Himanshu@gmail.com" class="input-responsive" required>
<br><br>
                     <div class="order-label" style="font-size: 34px; color: black;letter-spacing: 4px;font-family: bold;">Password</div><br>
                    <input style="padding: 2%;width: 350px;" type="password" name="password" placeholder="Password" class="input-responsive" required>

<br><br><br>
                    <input style="width: 90px; height: 40px;" type="submit" name="submit" value="Submit" class="btn btn-primary">

<br><br><br><br>
                <b style="font-size: 20px;">  Create Account : </b>
                   <a href="<?php echo SITEURL;?>sinup.php">  <input  type="button" name="signup" value="Sinup" class="btn btn-primary" style="width: 90px;height: 30px;margin-left: 5px;" > </a>
                     
       
                    

                </fieldset>

  	



  </form>

 <?php

  
 //  //check whether the submit button is pressed or not

 if(isset($_POST['submit']))
            {

        $name1 = $_POST['name'];
          

        $name = $_POST['username'];

        $login_date = date('Y-m-d h:i:sa');

        $password = $_POST['password'];


        //Query to check Detail

   $sql2 = "SELECT * FROM tbl_sinup WHERE user_name='$name' AND password='$password'";

 


        //execute the Query 

        $res2 = mysqli_query($con,$sql2);


        $num = mysqli_num_rows($res2);
 

        //chech query executerd or not

        if($num >= 1)
        {
            //query executed and data is saves

        $_SESSION['name'] = $name;


     $_SESSION['feedback1'] = "<div class='success text-center'><h1>Login Successfully <h1></div>";

       $sql3 = "INSERT INTO tbl_login SET 
       user_name = '$name',
       password='$password',
       login_date='$login_date'
       "; 


          mysqli_query($con,$sql3);


            header('location:'.SITEURL);
        }

        else
        {
            //Failed to save Data
              $_SESSION['feedback1'] = "<div class='error text-center'>Failed to Login. Try Again !</div>";
              header('location:'.SITEURL);

        }

   

        //  mysqli_close($con); 

              

              }



        // $num1 = mysqli_num_rows($res);







 ?>

</div>
</section>

  <?php

  include('Partial-front/footer.php');

  ?>