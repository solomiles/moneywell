<?php
 ob_start();
 session_start();
 
 include_once 'dbconnect.php';

if ( isset($_SESSION['user'])) {
  header("location: dashboard.php");
 }

 $error = false;
 $title = 'PCI | Signup';
 $errMSG='';
 
 if ( isset($_POST['btn-signup']) ) {
  
  // clean user inputs to prevent sql injections
  $regusername = trim($_POST['regusername']);
  $regusername = strip_tags($regusername);
  $regusername = htmlspecialchars($regusername);
  
  $regpass = trim($_POST['regpass']);
  $regpass = strip_tags($regpass);
  $regpass = htmlspecialchars($regpass);
  
  $regcpass = trim($_POST['regcpass']);
  $regcpass = strip_tags($regcpass);
  $regcpass = htmlspecialchars($regcpass);
  
  $regemail = trim($_POST['regemail']);
  $regemail = strip_tags($regemail);
  $regemail = htmlspecialchars($regemail);
  
  $regfullname = trim($_POST['regfullname']);
  $regfullname = strip_tags($regfullname);
  $regfullname = htmlspecialchars($regfullname);
  
  $regphone = trim($_POST['regphone']);
  $regphone = strip_tags($regphone);
  $regphone = htmlspecialchars($regphone);

  $bank_acc_name = trim($_POST['bank_acc_name']);
  $bank_acc_name = strip_tags($bank_acc_name);
  $bank_acc_name = htmlspecialchars($bank_acc_name);

  $bank_acc_no = trim($_POST['bank_acc_no']);
  $bank_acc_no = strip_tags($bank_acc_no);
  $bank_acc_no = htmlspecialchars($bank_acc_no);

  $bank_name = trim($_POST['bank_name']);
  $bank_name = strip_tags($bank_name);
  $bank_name = htmlspecialchars($bank_name);
  
  // basic username validation
  if (empty($regusername)) {
   $error = true;
   $errMSG = "Please enter your username.";
  } else if (strlen($regusername) < 7) {
   $error = true;
   $errMSG = "userame must have at least 7 characters.";
  }
  
   // password validation
  if (empty($regpass)){
   $error = true;
   $errMSG = "Please enter password.";
  } else if(strlen($regpass) < 6) {
   $error = true;
   $errMSG = "Password must have atleast 6 characters.";
  }
  
  // password encrypt using SHA256();
  $password = hash('sha256', $regpass);
   // echo $password;

  
   
 
  // password encrypt using SHA256();
  // $password = hash('sha256', $regcpass);
  
  
  //basic email validation
  function db_query($query){ 
    $connection = db_connect();
    $result = mysqli_query($connection,$query);
  if (empty($regemail))
   {
   $error = true;
   $errMSG = "Please enter valid email address.";
  } else {
   // check email exist or not
   $query = "SELECT Email FROM users WHERE Email='$regemail'";
   $result = db_query($query);
   $count = mysqli_fetch_array($result);
   if($count!=0){
    $error = true;
    $errMSG = "Provided Email is already in use.";
   }
  }
  return $result;
}
  
    // basic name validation
  // if (empty($regfullname)) {
  //  $error = true;
  //  $errMSG = "Please enter your full name.";
  // } else if (strlen($regfullname) < 7) {
  //  $error = true;
  //  $regfullError = "full name must have at least 7 characters.";
  // } else if (!preg_match("/^[a-zA-Z ]+$/",$regfullname)) {
  //  $error = true;
  //  $errMSG = "full name must contain alphabets and space.";
  // }
  
    // basic gender validation
  // if (empty($gender)) {
  //  $error = true;
  //  $errMSG = "Please input your phone number.";
  // }

  // if (empty($regphone)) {
  //  $error = true;
  //  $errMSG = "Please input your phone number.";
  // }

  $today_date = Date('Y-m-d H:i:s');
  // die($today_date);
  
    $rest = db_query("SELECT * FROM users  ");
    $check = mysqli_fetch_array($rest);
    $checkemail = $check['Email'];
    $checkuser = $check['Username'];
    if ($checkemail === $regemail) {
      # code...
      $errMSG = 'Email already in use';
    } elseif ($checkuser === $regusername) {
      # code...
      $errMSG = 'Username already in use';
    } elseif ($regpass != $regcpass) { // password validation
      # code...
      $errMSG = "Password and Confirm Password doesn't match.";
    } elseif (strlen($regfullname) < 7) {
      # code...
      $errMSG = "full name must contain alphabets and space.";
    }  
     else if(strlen($regpass) < 8) {
     $error = true;
     $errMSG = "Password must have at least 8 characters.";
    } elseif (!preg_match("/^[a-zA-Z ]+$/",$regfullname)) {
      # code...
      $error = true;
      $errMSG = "full name must contain alphabets and space.";
    } else  {

    $result = db_query("INSERT INTO users(Username,Password,Fullname,Email,Phone,Bank_acc_name,Bank_acc_no,Bank_name,Date_reg) VALUES('$regusername','$password','$regfullname','$regemail','$regphone','$bank_acc_name','$bank_acc_no','$bank_name','$today_date')");
    
   if ($result === true) {
    $errMSG = "success! you may login now";

    // header("Location: login.php");
    // echo $errTyp;
    // echo $errMSG;
   }
    else {
    $errMSG = "Something went wrong, try again later..."; 
   } 
  }
 }

// this section is for sign in
 if( isset($_POST['btn-signin']) ) { 
  
  // prevent sql injections/ clear user invalid inputs
  $lgusername = trim($_POST['lgusername']);
  $lgusername = strip_tags($lgusername);
  $lgusername = htmlspecialchars($lgusername);
  
  $lgpass = trim($_POST['lgpass']);
  $lgpass = strip_tags($lgpass);
  $lgpass = htmlspecialchars($lgpass);
  // prevent sql injections / clear user invalid inputs
  function db_query($query){ 
    $connection = db_connect();
    $result = mysqli_query($connection,$query);

  if(empty($lgusername)){
   $error = true;
   $lgusernameError = "Please enter your username.";
  }
  
  if(empty($lgpass)){
   $error = true;
   $lgpassError = "Please enter your password.";
  }  
  return $result;
}
  // if there's no error, continue to login
  if (!$error) {
   
   $password = hash('sha256', $lgpass); // password hashing using SHA256
  
   $result = db_query("SELECT Username, Password FROM users WHERE Username='$lgusername' AND Password='$password'"); 
   // if uname/pass correct it returns must be 1 row
  
   if($result == 1 ) {
    $row = mysqli_fetch_array($result);
    $_SESSION['user'] = $row['Username'];
    $_SESSION['start'] = time();//taking login time
    $_SESSION['expire'] = $_SESSION['start'] + (130 * 60);//ending the session in 4 hours
    // if ($row['Admin'] == 1) {
    //   header('location: admin.php');
    // } else {
      header("location: dashboard.php");
    }
    else {
    $errMSG = "Incorrect Credentials, Try again...";
     // die($errMSG) ;
   }
    
  }
  
 }
?>

<?php

// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// CHANGE TO 0 TO TURN OFF DEBUG MODE
// IN DEBUG MODE, ONLY THE CAPTCHA CODE IS VALIDATED, AND NO EMAIL IS SENT


?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->
<head>
     <meta charset="UTF-8" >
     <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
    <title>MONEY WELL | Sign-in Page</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" >
	<meta content="" name="author" >
     <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- GLOBAL STYLES -->
     <!-- PAGE LEVEL STYLES -->
     
     <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/login.css" >
    <link rel="stylesheet" href="assets/plugins/magic/magic.css" >
     <!-- END PAGE LEVEL STYLES -->
   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      body {
        background: url(backgrounds/bg6.png)  fixed repeat;
      }
    </style>
</head>

    <!-- END HEAD -->

    <!-- BEGIN BODY -->
<body >

   <!-- PAGE CONTENT --> 
    <div class="container">
    <div class="text-center">
        <img src="assets/img/apple-icon.png" id="logoimg" alt=" Logo" />
    </div>
    <div class="tab-content">
        <div id="login" class="tab-pane active">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="form-signin">
                <p class="text-muted text-center btn-block btn btn-primary btn-rect">
                    Enter your username and password<div class="alert-danger"><?php echo $errMSG; ?></div>
                </p>
                <label class="btn-warning">Username</label>
                <input type="text" placeholder="Username" name="lgusername" class="form-control" required >
                <label class="btn-warning">Password</label>
                <input type="password" placeholder="Password" name="lgpass" class="form-control" required >
                <?php
                  // show captcha HTML using Securimage::getCaptchaHtml()
                  require_once 'securimage.php';
                  $options = array();
                  $options['input_name']             = 'ct_captcha'; // change name of input element for form post
                  $options['disable_flash_fallback'] = false; // allow flash fallback
                  
                  if (!empty($_SESSION['ctform']['captcha_error'])) {
                    // error html to show in captcha output
                    $options['error_html'] = $_SESSION['ctform']['captcha_error'];
                  }

                  echo "<div id='captcha_container_1'>\n";
                  echo Securimage::getCaptchaHtml($options);
                  echo "\n</div>\n";

                  /*
                  // To render some or all captcha components individually
                  $options['input_name'] = 'ct_captcha_2';
                  $options['image_id']   = 'ct_captcha_2';
                  $options['input_id']   = 'ct_captcha_2';
                  $options['namespace']  = 'captcha2';

                  echo "<br>\n<div id='captcha_container_2' class='form-control'>\n";
                  echo Securimage::getCaptchaHtml($options, Securimage::HTML_IMG);

                  echo Securimage::getCaptchaHtml($options, Securimage::HTML_ICON_REFRESH);
                  echo Securimage::getCaptchaHtml($options, Securimage::HTML_AUDIO);

                  echo '<div style="clear: both" class="form-control"></div>';

                  echo Securimage::getCaptchaHtml($options, Securimage::HTML_INPUT_LABEL);
                  echo Securimage::getCaptchaHtml($options, Securimage::HTML_INPUT);
                  echo "\n</div>";
                  */
                ?><br>
                <button class="btn text-center btn-success" name="btn-signin" type="submit">Sign in</button>
            </form>
        </div>
        <div id="forgot" class="tab-pane">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="form-signin">
                <p class="text-muted text-center btn-block btn btn-primary btn-rect">Enter your valid e-mail</p>
                <input type="email"  required="required" placeholder="Your E-mail"  class="form-control" >
                <br />
                <button class="btn text-muted text-center btn-success" type="submit">Recover Password</button>
            </form>
        </div>
        <div id="signup" class="tab-pane">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="form-signin">
                <p class="text-muted text-center btn-block btn btn-primary btn-rect">Please Fill Details To Register</p>
                 <label class="btn-warning">Fullname</label>
                 <input type="text" placeholder="Fullname" name="regfullname" class="form-control" required>
                 <label class="btn-warning">Username</label>
                 <input type="text" placeholder="Username" name="regusername" class="form-control" required >
                 <label class="btn-warning">Password</label>
                 <input type="password" placeholder="password" name="regpass" class="form-control" required>
                 <label class="btn-warning">Confirm-password</label>
                <input type="password" placeholder="Re type password" name="regcpass" class="form-control" required >
                <label class="btn-warning">E-mail</label>
                <input type="email" placeholder="Your E-mail" name="regemail" class="form-control" required >
                <label class="btn-warning">Phone number</label>
                <input type="text" placeholder="Phone number" name="regphone" class="form-control" required >
                <label class="btn-warning">Refferer</label>
                <input type="text" placeholder="Refferer" name="reffrer" class="form-control" >
                <label class="btn-warning">Bank Account Name</label>
                <input type="text" placeholder="Bank Account Name" name="bank_acc_name" class="form-control" required >
                <label class="btn-warning">Bank Account Number</label>
                <input type="text" placeholder="Bank Account Number" name="bank_acc_no" class="form-control" required >
                <label class="btn-warning">Bank Name</label>
                <input type="text" placeholder="Bank Name" name="bank_name" class="form-control" required ><br>
                <?php
      // show captcha HTML using Securimage::getCaptchaHtml()
      require_once 'securimage.php';
      $options = array();
      $options['input_name']             = 'ct_captcha'; // change name of input element for form post
      $options['disable_flash_fallback'] = false; // allow flash fallback

      // if (!empty($_SESSION['ctform']['captcha_error'])) {
      //   // error html to show in captcha output
      //   $options['error_html'] = $_SESSION['ctform']['captcha_error'];
      // }

      echo "<div id='captcha_container_1'>\n";
      echo Securimage::getCaptchaHtml($options);
      echo "\n</div>\n";

      /*
      // To render some or all captcha components individually
      $options['input_name'] = 'ct_captcha_2';
      $options['image_id']   = 'ct_captcha_2';
      $options['input_id']   = 'ct_captcha_2';
      $options['namespace']  = 'captcha2';

      echo "<br>\n<div id='captcha_container_2' class='form-control'>\n";
      echo Securimage::getCaptchaHtml($options, Securimage::HTML_IMG);

      echo Securimage::getCaptchaHtml($options, Securimage::HTML_ICON_REFRESH);
      echo Securimage::getCaptchaHtml($options, Securimage::HTML_AUDIO);

      echo '<div style="clear: both" class="form-control"></div>';

      echo Securimage::getCaptchaHtml($options, Securimage::HTML_INPUT_LABEL);
      echo Securimage::getCaptchaHtml($options, Securimage::HTML_INPUT);
      echo "\n</div>";
      */
    ?>
  
  <br>        <div class="form-group">
                <button class="btn text-muted text-center btn-success" name="btn-signup" type="submit">Register</button>
                </div>
            </form>
        </div>
    </div>
    <div class="text-center">
        <ul class="list-inline">
            <li class="btn-warning"><a class="text-muted" href="#login" data-toggle="tab">Login</a></li>
            <li class="btn-warning"><a class="text-muted" href="#forgot" data-toggle="tab">Forgot Password</a></li><br><br>
            <span style="color: #fff;">Don't Have An Account?</span><li class="btn-warning"><a class="text-muted" href="#signup" data-toggle="tab">Signup</a></li><span style="color: #fff;">Now!</span>
        </ul>
    </div>


</div>

	  <!--END PAGE CONTENT -->     
	      
      <!-- PAGE LEVEL SCRIPTS -->
      <script src="assets/plugins/jquery-2.0.3.min.js"></script>
      <script src="assets/plugins/bootstrap/js/bootstrap.js"></script>
      <script src="assets/js/login.js"></script>
      <!--END PAGE LEVEL SCRIPTS -->

</body>
    <!-- END BODY -->
</html>
<?php ob_end_flush(); ?>
