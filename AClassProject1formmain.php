<?php


$con=mysqli_connect("localhost","root","","orangecountryresort") or die(mysqli_error($con));
session_start();
$firstname=mysqli_real_escape_string($con,$_POST['firstname']);
$lastname=mysqli_real_escape_string($con,$_POST['lastname']);
$address=mysqli_real_escape_string($con,$_POST['address']);
$phone=mysqli_real_escape_string($con,$_POST['contact']);
$email=$_POST['email'];
$f=$_POST['date'];
$day=$_POST['days'];
$room=$_POST['room'];
$bill=$day*$room*1000;
//$file=$_FILES['file'];
//print_r($file);
$file_name= $_FILES['file']['name'];
$file_type= $_FILES['file']['type'];
$file_size=$_FILES['file']['size'];
$file_tem_loc= $_FILES['file']['tmp_name'];
$file_store= "upload/".$file_name;
move_uploaded_file($file_tem_loc,$file_store);
$_SESSION['sess_username']=$firstname;

$query="insert into createacc(firstname,lastname,emailid,phone,address) values ('$firstname','$lastname','$email','$phone','$address')";
$query_result=mysqli_query($con,$query) or die(mysqli_error($con));
//echo "user Entered";

?>
<html>
    <head>
        <title>Orange Country Resort</title>
        <link rel="stylesheet" type="text/css" href="AClassProject1css.css">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
    </head>
    <body>
<body>
	 <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header"><a href="#" class="navbar-brand">WELCOME <?php echo $_SESSION['sess_username']; ?></a></div>
                <div>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="#">Login Page</a>
                            <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Offers
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Gift Cards</a></li>
          <li><a href="#">Special Offers</a></li>
          <li><a href="#">Special Web Offers</a></li>
        </ul>
                        <li><a href="#">Awards</a>
                            <li><a href="#">Contact Us</a>
                    </ul>
                    
                </div>
  
            </div>
            
        </nav>
	<br>
	<h1><center><font face="Comic Sans MS" color="orange">WELCOME TO ORANGE COUNTRY RESORT</font></center></h1>
	
	<br>
	<!--<?php echo "user Entered"; ?><br> -->
	
	<div class="container jum">
	<div class="jumbotron">
	<?php
	echo "<h4><b>Congratulations</b> Mr./Mrs. </h4>"."<b>".$firstname." ".$lastname."</b>"."<h4>"."The Room is available for you on <b>".$f."</b></h4>"."<h4> Proceed with Payment to confirm your Booking <br><br>The Remaining details have been sent to your 
	Email ID</h4> "."<b>".$email."</b>"." <h4>and your Contact Number</h4> "."<b>".$phone."</b>"."<h4>Also a confirmation letter will be send to your address</h4> "."<b>".$address."</b>"."<h3>Your Total Bill for "."<b>".$room."</b>"." Rooms for "."<b>".$day."</b>"." Days is Rs. "."<b>".$bill."</b>"."</h3>";
	
	$folder="upload/";
	if(is_dir($folder))
	{
		if($open=opendir($folder))
		{
			while(($file=readdir($open)) != false)
			{
				if($file=='.' || $file=='..') continue;
				echo "<h3>Your Vefifiaction ID is</h3>".'<img src="upload/'.$file.'" width=650 height=650>';
			}
			closedir($open);
		}
	}
	

	
	$mailSub="Hello Customer";
	$mailMsg="Your account is now created";
	//mail($email,$mailSub,$mailMsg);
	
	

   require 'PHPMailer-master/PHPMailerAutoload.php';
   $mail = new PHPMailer();
   $mail ->IsSmtp();
   $mail ->SMTPDebug = 0;
   $mail ->SMTPAuth = true;
   $mail ->SMTPSecure = 'ssl';
   $mail ->Host = "smtp.gmail.com";
   $mail ->Port = 465; // or 587
   $mail ->IsHTML(true);
   $mail ->Username = "codeshishir2@gmail.com";
   $mail ->Password = "codingshishir";
   $mail ->SetFrom("codeshishir2@gmail.com");
   $mail ->Subject = $mailSub;
   $mail ->Body = $mailMsg;
   $mail ->AddAddress($email);

   if(!$mail->Send())
   {
       echo "Mail Not Sent";
   }
   else
   {
       echo "Mail Sent";
   }
	
	
	?></div></div>
	
</body>
</html>


