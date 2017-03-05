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

    $row = mysqli_fetch_array($result);
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

	<title>MONEY WELL | Support</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />

    <!-- PAGE LEVEL STYLES -->
     <link rel="stylesheet" href="assets/plugins/validationengine/css/validationEngine.jquery.css" />
    <!-- END PAGE LEVEL  STYLES -->

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">

</head>
<body>

<div class="wrapper">
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
                <li>
                    <a href="user.php">
                        <i class="ti-user"></i>
                        <p>User Data</p>
                    </a>
                </li>
                <li >
                    <a href="helpaccount.php">
                        <i class="ti-view-list-alt"></i>
                        <p>User Help Account</p>
                    </a>
                </li>
                <li class="active">
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
                        <a class="navbar-brand" href="#">Real Time Support</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <!-- <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-panel"></i>
                                <p>Stats</p>
                            </a>
                        </li> -->
                        <li>
                            <a href="user.php">
                                <i class="ti-user"></i>
                                <p><?php echo $id; ?></p>
                            </a>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Need Help?</h4>
                                <p class="category">Send Us Your Message</p>
                            </div>
                            <div class="content">

                                <div class="row">
                                    <div class="col-lg-12">

                                        <div class="box">
                                            <header>
                                                <div class="toolbar">
                                                    <ul class="nav">
                                                        <li>
                                                            <div class="btn-group">
                                                                <a class="accordion-toggle btn btn-xs minimize-box" data-toggle="collapse"
                                                                    href="#collapseOne">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>
                                                                <!-- <button class="btn btn-xs btn-danger close-box">
                                                                    <i class="icon-remove"></i>
                                                                </button> -->
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </header>
                                            <div id="collapseOne" class="accordion-body collapse in body">
                                                <form action="#" class="form-horizontal" id="block-validate">

                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">Fullname</label>
                                                        <div class="col-lg-4">
                                                            <input type="text" id="required2" name="" class="form-control border-input" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">E-mail</label>

                                                        <div class="col-lg-4">
                                                            <input type="email" id="" name="email2" class="form-control border-input" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">Phone Number</label>

                                                        <div class="col-lg-4">
                                                            <input type="text" id="" name="digits" class="form-control border-input" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">Message</label>

                                                        <div class="col-lg-4">
                                                            <textarea type="text" name="minsize1" class="form-control validate[required,minSize[6]] border-input" id="minsize1" required></textarea>
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="form-actions no-margin-bottom" style="text-align:center;">
                                                        <button type="submit"  class="btn btn-primary btn-lg ">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

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
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="assets/js/paper-dashboard.js"></script>

    <!-- PAGE LEVEL SCRIPTS -->

     <script src="assets/plugins/validationengine/js/jquery.validationEngine.js"></script>
    <script src="assets/plugins/validationengine/js/languages/jquery.validationEngine-en.js"></script>
    <script src="assets/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
    <script src="assets/js/validationInit.js"></script>
    <script>
        $(function () { formValidation(); });
        </script>
     <!--END PAGE LEVEL SCRIPTS -->

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<!-- <script src="assets/js/demo.js"></script> -->

</html>
