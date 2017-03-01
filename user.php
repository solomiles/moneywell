<?php
 ob_start();
 session_start();
 include_once 'dbconnect.php';
  $today_date = date('D, M Y');
 // if session is not set this will redirect to login page
 if($_SESSION['user']=="" ) {
  header("Location: sign.php");
 }else {
        $now = time(); // Checking the time now when home page starts.

        if ($now > $_SESSION['expire']) {
            session_destroy();
            header('Location: sign.php');
        }
        else { //Starting this else one [else1]



  function db_query($query){ 
   $connection = db_connect();
   $result = mysqli_query($connection,$query);
    return $result;
  }  

    $id = $_SESSION['user'];

    $result = db_query("SELECT * FROM users WHERE Username = '$id'");

    // $row = mysqli_fetch_array($result);
  }
}

if( isset($_POST['btn-update']) ) {
  


 $fullname = trim($_POST['fullname']);
  $fullname = strip_tags($fullname);
  $fullname = htmlspecialchars($fullname);
  
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
  $description = trim($_POST['description']);
  $description = strip_tags($description);
  $description = htmlspecialchars($description);

  $country = trim($_POST['country']);
  $country = strip_tags($country);
  $country = htmlspecialchars($country);
  
  $phone = trim($_POST['phone']);
  $phone = strip_tags($phone);
  $phone = htmlspecialchars($phone);
  

          // $username = $object['username'];
          // $fname  = $object['fullname'];
          // $email  = $object['email'];
          // $descrip  = $object['description'];
          // $phone  = $object['phone'];
        

  $result = db_query("UPDATE users SET Name = '$fullname', Email = '$email', Description = '$description', Country = '$country', Phone = '$phone'  WHERE Username = '$id'");
  if ($result == 1) {
    $errMSG = " Records Updated!";
  }
  else {
    $errMSG = "Something went wrong, try again later..."; 
  } 
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>MONEY WELL | User Data</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <!-- <link href="assets/css/demo.css" rel="stylesheet" /> -->

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">

</head>
<body>

<div class="wrapper">
    <!-- main dashboard sidebar -->
    <div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
        Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
        Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
    -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="" class="simple-text">
                    Money Well
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="index.php">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="active">
                    <a href="user.php">
                        <i class="ti-user"></i>
                        <p>User Data</p>
                    </a>
                </li>
                <li>
                    <a href="helpaccount.php">
                        <i class="ti-view-list-alt"></i>
                        <p>User Help Account</p>
                    </a>
                </li>
                <li>
                    <a href="support.php">
                        <i class="ti-comment-alt"></i>
                        <p>Support</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- end of main sidebar -->
     <!-- start of notification and settings panel -->
    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                        <a class="navbar-brand" href="#">My Profile</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <!-- <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-panel"></i>
                                <p>Stats</p>
                            </a>
                        </li> -->
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-bell"></i>
                                    <p class="notification">5</p>
                                    <p>Notifications</p>
                                    <b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-settings"></i>
                                <p>Settings</p>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="logout.php"><span class="ti-angle-double-right">Logout</span></a></li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
        <!-- end of notification and settings panel -->
        <!-- start of page content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-md-offset-1">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Profile</h4>
                            </div>
                            <div class="content">
                                <form method="post" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <?php
                                while ( $row = mysqli_fetch_array($result))
                                    {
                                        
                                    # code...
                                    echo "
                                    <div class='row'>
                                        <div class='col-md-5'>
                                            <div class='form-group'>
                                                <label>Username</label>
                                                <input type='text' class='form-control border-input' disabled placeholder='Username' value='{$row["Username"]}'>
                                            </div>
                                        </div>
                                        <div class='col-md-3'>
                                            <div class='form-group'>
                                                <label>Fullname</label>
                                                <input type='text' class='form-control border-input' placeholder='Fullname' value='{$row["Fullname"]}'>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label for='exampleInputEmail1'>Email address</label>
                                                <input type='email' class='form-control border-input' placeholder='Email' value='{$row["Email"]}' >
                                            </div>
                                        </div>
                                    </div>

                                    <div class='row'>
                                        <div class='col-md-6'>
                                            <div class='form-group'>
                                                <label>Phone number</label>
                                                <input type='text' class='form-control border-input' placeholder='Phone number' value='{$row["Phone"]}'>
                                            </div>
                                        </div>
                                        <div class='col-md-6'>
                                            <div class='form-group'>
                                                <label>Date Registered</label>
                                                <input type='text' class='form-control border-input' placeholder='2017-02-26' value='{$row["Date_reg"]}' readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Referrer Link</label>
                                                <input type='text' class='form-control border-input' placeholder='Referrer link' value='{$row["Refferer"]}' readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='row'>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Account name</label>
                                                <input type='text' class='form-control border-input' placeholder='Bank Account Name' value='{$row["Bank_acc_name"]}'>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Account Number</label>
                                                <input type='text' class='form-control border-input' placeholder='Account Number' value='{$row["Bank_acc_no"]}'>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Bank Name</label>
                                                <input type='text' class='form-control border-input' placeholder='Bank Name' value='{$row["Bank_name"]}' >
                                            </div>
                                        </div>
                                    </div>
                                        \n";
                                        }
                                    ?>
                                    <div class='text-center'>
                                        <button type='submit' name="btn-update" class='btn btn-success btn-fill btn-wd'>Update Profile</button>
                                    </div>
                                    <div class='clearfix'></div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of main content -->


        <footer class="footer">
            <div class="container-fluid">
                <!-- <nav class="pull-left">
                    <ul>

                        <li>
                            <a href="http://www.creative-tim.com">
                                Creative Tim
                            </a>
                        </li>
                        <li>
                            <a href="http://blog.creative-tim.com">
                               Blog
                            </a>
                        </li>
                        <li>
                            <a href="http://www.creative-tim.com/license">
                                Licenses
                            </a>
                        </li>
                    </ul>
                </nav> -->
				<div class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="#">solomon</a>
                </div>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="assets/js/bootstrap-checkbox-radio.js"></script>

    <!--  Charts Plugin -->
    <!-- <script src="assets/js/chartist.min.js"></script> -->

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script> -->

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
    <script src="assets/js/paper-dashboard.js"></script>

    <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <!-- <script src="assets/js/demo.js"></script> -->

</html>
