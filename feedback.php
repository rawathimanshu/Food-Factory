<!DOCTYPE html>
<html>
<head>
	<title>Feedback</title>
</head>
<body >

<?php 
include('Partial-front/menu.php');

  ?>
  <section class="food-search">
        <div class="container">

  <h1 class="text-center" style="font-size: 64px;margin-top: -60px;margin-bottom: 60px; color: Maroon;font-family: aerial;letter-spacing: 4px;">Feedback</h1>

  <form action="" method="POST" class="text-center order" style="">	


  <fieldset style="height:450px; border: 5px solid black;padding: 7%;border-radius: 8px;">
                   
                    <div class="order-label" style="font-size: 34px; color: black;letter-spacing: 4px;font-family: bold;">Full Name</div><br>


                    <input style="padding: 2%;width: 350px;" type="text" name="full-name" placeholder="E.g. Himanshu" class="input-responsive" >

            <br><br>

                    <div class="order-label" style="font-size: 34px; color: black;letter-spacing: 4px;font-family: bold;" >Feedback</div><br>

                    <textarea style="padding: 2%;width: 350px;" name="feedback" rows="10" placeholder="Tell us About Your Experiance ...." class="input-responsive" ></textarea>

                    <br><br>

                    <input style="width: 90px; height: 40px;font-family: bold;font-size: 21px;" type="submit" name="submit" value="Submit" class="btn btn-primary">
                </fieldset>

  	



  </form>

 <?php

 //  //check whether the submit button is pressed or not

 if(isset($_POST['submit']))
            {

           $name = $_POST['full-name'];

            $feedback_date = date('Y-m-d h:i:sa');

        $feedback = $_POST['feedback'];



        $sql2 = "INSERT INTO tbl_feedback SET  
        full_name='$name',
        feedback_date='$feedback_date',
        feedback='$feedback'	
        ";


        //execute the Query 

        $res2 = mysqli_query($con,$sql2);

        //chech query executerd or not

        if($res2==true)
        {
            //query executed and data is saves

     $_SESSION['feedback1'] = "<div class='success text-center'><h1>Your Feedback is Submitted Successfully <h1></div>";

            header('location:'.SITEURL);
        }

        else
        {
            //Failed to save Data
              $_SESSION['feedback1'] = "<div class='error text-center'>Failed to Submit Your Feedback. Try Again</div>";
              header('location:'.SITEURL);

        }
              

              }




 ?>

</div>
</section>
  <?php 
include('Partial-front/footer.php');

  ?>
  </body>
</html>