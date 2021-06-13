<?php

//include contant php file

include 'config/constant.php';

//1. Detroy Sessionn 

session_destroy(); // delete user session

//2. reditrect to login page

header('location:'.SITEURL);





?>