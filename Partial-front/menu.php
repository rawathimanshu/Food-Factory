<?php

include 'config/constant.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Order</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="<?php echo SITEURL;?>" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
         <a href="<?php echo SITEURL;?>">Home</a>
                    </li>


                    <li>
        <a href="<?php echo SITEURL;?>categories.php">Categories</a>
                    </li>


                    <li>
        <a href="<?php echo SITEURL;?>foods.php">Foods</a>
                    </li>

                    <li>

                    <a href="<?php echo SITEURL;?>feedback.php">Feedback</a>
                  
                    </li>

                    <li>
       
        <a href="<?php echo SITEURL;?>login.php">

            <?php

            
           // session_start();
       
         //$_SESSION['uname'];
         $_SESSION['Login'] = "Login";
         
                    
        if((isset($_SESSION['name'])))
        {

            echo "<a title='You are Login'>".$_SESSION['name']." </a>";


            #ini_set('session.gc_maxlifetime',60); 
             
            // unset($_SESSION['name']);


        }
             else
         {
                        

        echo "<a href='login.php' >". $_SESSION['Login'] ."</a>";

                    
         }
                

        ?>
        </a>
                    </li>  

        <li>
         <a href="<?php echo SITEURL;?>logout.php">Logout  <?php header('location'.SITEURL);
 ?>    </a>
         
                        </li>
   

                    
                    
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->
