<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

//testing a theory the below link will check rofile creation


// Include config file
require_once "../configs/config.php";
 
// Define variables and initialize with empty values
$prints = $copy = $confirm_copy = "";
$prints_err = $copy_err = $confirm_copy_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate prints
    if(empty(trim($_POST["prints"]))){
        $prints_err = "Please enter a prints number.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM canon2020 WHERE prints = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_prints);
            
            // Set parameters
            $param_prints = trim($_POST["prints"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $prints_err = "This prints is already taken.";
                } else{
                    $prints = trim($_POST["prints"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate copy
    if(empty(trim($_POST["copy"]))){
        $copy_err = "Please enter a copy value.";     
    } elseif(strlen(trim($_POST["copy"])) < 6){
        $copy_err = "copy must have atleast 6 characters.";
    } else{
        $copy = trim($_POST["copy"]);
    }
    
    // Validate confirm copy
    //if(empty(trim($_POST["confirm_copy"]))){
     //   $confirm_copy_err = "Please confirm copy.";     
   // } else{
   //     $confirm_copy = trim($_POST["confirm_copy"]);
    //    if(empty($copy_err) && ($copy != $confirm_copy)){
      //      $confirm_copy_err = "copy did not match.";
      //  }
   // }
    
    // Check input errors before inserting in database
    if(empty($prints_err) && empty($copy_err) && empty($confirm_copy_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO canon2020 (prints,copy) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_prints, $param_copy);
            
            // Set parameters
            $param_prints = $prints;
            $param_copy = $copy; // Creates a copy hash
			
			//$param_copy = copy_hash($copy, copy_DEFAULT); // Creates a copy hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
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
  <a href="reset-copy.php" class="nav-link" >Reset Your copy</a>
  </li>
  <li class="nav-item">
    <a href="logout.php" class="nav-link" >Sign Out  .</a>
  </li>
  
  
</ul>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Violet print site..</h1>
    </div>
	
	 <ul class="nav nav-tabs">
	 <li ><a href="welcome.php">Home</a></li>
	 <li class="active"><a href="canon2020.php">Canon 2020 Printer</a></li>
	 <li><a href="canon2025.php">Canon 2025 Printer</a></li>
	 <li><a href="#">binding</a></li>
    <li><a href="#">color printer</a></li>
	<li><a href="#">envelops</a></li>
	<li><a href="#">Other expenses</a></li>
	 
	 </ul>
	 <div  class="container center_div" id="formContent">
	 
	 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($prints_err)) ? 'has-error' : ''; ?>">
               
                <input type="text" name="prints" class="fadeIn second" placeholder="number of prints" value="<?php echo $prints; ?>">
                <span class="help-block"><?php echo $prints_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($copy_err)) ? 'has-error' : ''; ?>">
               
                <input type="text" name="copy" class="fadeIn third" placeholder="number of copies" value="<?php echo $copy; ?>">
                <span class="help-block"><?php echo $copy_err; ?></span>
            </div>
            
            <div class="form-group">
                <input type="submit" class="fadeIn fourth" value="Submit">
                <input type="reset" class="fadeIn fourth" value="Reset">
            </div>
            
        </form>
	</div>
	
	
   
</body>
</html>