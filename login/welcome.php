<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}








?>
 
<!DOCTYPE html>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="me-style.css">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
<ul class="nav  navbar-nav navbar-right">
  <li class="nav-item">
  <a href="reset-password.php" class="nav-link" >Reset Your Password</a>
  </li>
  <li class="nav-item">
    <a href="logout.php" class="nav-link" >Sign Out  .</a>
  </li>
  
  
</ul>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Violet print site.</h1>
    </div>
	
	 <ul class="nav nav-tabs">
	 <li class="active"><a href="welcome.php">Home</a></li>
	 <li><a href="canon2020.php">Canon 2020 Printer</a></li>
	 <li><a href="canon2025.php">Canon 2025 Printer</a></li>
	 <li><a href="#">binding</a></li>
    <li><a href="#">color printer</a></li>
	<li><a href="#">envelops</a></li>
	<li><a href="#">Other expenses</a></li>
	 
	 </ul>
	 <div  class="container center_div" id="formContent">
	 
	 
	 <div class="wrapper fadeInDown">
		<div id="formContent">
			<div class="fadeIn first">
		
        
				<img src="violet.jpg" id="icon" alt="violet print" />
			</div>
			
			</div>
			
			</div>
	 
	</div>
	
	
   
</body>
</html>