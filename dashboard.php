<?php
 ob_start();
 session_start();
 include_once 'dbconnect.php';
 
  $today_date = Date('Y-m-d H:i:s');
  $errMSG = '';
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
   require_once 'auto_match.php';

    $id = $_SESSION['user'];

    $result = db_query("SELECT * FROM users WHERE Username = '$id'");

    $row = mysqli_fetch_array($result);
    $user_id = $row['id'];

    
    
    
  }
}
$reslt = db_query("SELECT * FROM waiting_list WHERE user_id = '$user_id'");
    $rows = mysqli_fetch_array($reslt);
    $has_donated = $rows['has_donated'];


    if (isset($_POST['btn-provide'])) {
        # code...
        $package = trim($_POST['packages']);
        $package = strip_tags($package);
        $package = htmlspecialchars($package);

        $result = db_query("INSERT INTO waiting_list(user_id,package,ph_date) VALUES('$user_id','$package','$today_date')");

        if ($result === true) {
    // $errMSG = "success! you may login now";
            header("Location:dashboard.php");
   }else{

    $errMSG = "you are not allowed to provide help this moment";
   }
    }
?>

<?php
    // get help logic
    if (isset($_POST['btn-gh'])) {
        # code...
        $package = trim($_POST['package']);
        $package = strip_tags($package);
        $package = htmlspecialchars($package);

        $result = db_query("INSERT INTO gh_pending_list(user_id,package,gh_date) VALUES('$user_id','$package','$today_date')");

        if ($result === true) {
    // $errMSG = "success! you may login now";
            header("Location:dashboard.php");
   }else{

    $errMSG = "you are not allowed to Get help this moment";
   }
    }
?>
<?php
    // confirm get help logic
    if (isset($_POST['btn-gh-confirm'])) {
        # code...
        

        //$result = db_query("INSERT INTO gh_pending_list(user_id,package,gh_date) VALUES('$user_id','$package','$today_date')");

        //if ($result === true) {
    // $errMSG = "success! you may login now";
            //header("Location:dashboard.php");
   //}//else{

    //$errMSG = "you are not allowed to Get help this moment";
   //}
    }
?>


<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>MONEY WELL | Dashboard</title>

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
                <li class="active">
                    <a href="dashboard.php">
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
                <li>
                    <a href="notifications.php">
                        <i class="ti-bell"></i>
                        <p>Notifications</p>
                    </a>
                </li>
				<!-- <li class="active-pro">
                    <a href="upgrade.html">
                        <i class="ti-export"></i>
                        <p>Upgrade to PRO</p>
                    </a>
                </li> -->
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
                        <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
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
        <div class="content" id="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Provide And Get Help</h4>
                                <p class="category">Provide help to the community and get rewarded 100%</p>
                            </div><br><br><br>
                            <div class="content" style="margin-top: 80px;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <button class="btn btn-lg btn-primary" data-toggle="modal" data-target="#formModal" style="padding: 70px 75px 70px;"><b>Provide Help</b></button>
                                        </div>
                                        <div class="col-md 6">
                                            <button class="btn btn-lg btn-success" data-toggle="modal" data-target="#buttonedModal" style="padding: 70px 90px 70px;"><b>Get Help</b></button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div><br><br><br>
                            <!-- logic for provide help alert -->
                            <?php
                            $reslt = db_query("SELECT * FROM waiting_list WHERE user_id = '$user_id'");
                            $rows = mysqli_fetch_array($reslt);
                            $has_approved = $rows['has_approved'];
                            $has_donated = $rows['has_donated'];

                            $resltt = db_query("SELECT * FROM gh_pending_list WHERE user_id = '$user_id'");
                            $ghrows = mysqli_fetch_array($resltt);
                            $has_gh = $ghrows['has_gh'];
                            $has_gh_approved = $ghrows['has_gh_approved'];
                            
                                // $reslt = db_query("SELECT * FROM waiting_list WHERE user_id = '$user_id'");
                                // $rows = mysqli_fetch_array($reslt);
                            if ($has_gh_approved == 1) {
                                # code...
                            
                            }
                            elseif ($has_gh == 1) {
                                # code...
                            echo "
                            <div class='content'>
                                <div class='row'>                   
                                    <div class='col-md-4'>
                                        <div class='alert alert-warning'>
                                            <div>
                                                <h4 class='title'>Get help Request</h4>  
                                            </div>
                                            <div class='row' style='margin-bottom: 5px;'>
                                                <div class='col-md-12'>
                                                    <span class='label label-info col-md-6'>Amount:</span><span class='col-md-4 col-md-offset-2 label label-success'>{$ghrows['package']}</span>
                                                </div>
                                            </div>
                                            <div class='row' style='margin-bottom: 5px;'>
                                                <div class='col-md-12'>
                                                    <span class='label label-info col-md-5'>Date:</span><span class='label label-success col-md-5 col-md-offset-2'>{$ghrows['gh_date']}</span>
                                                </div>
                                            </div>
                                            <div class='row' style='margin-bottom: 5px;'>
                                                <div class='col-md-12'>
                                                    <span class='label label-info col-md-6'>Status:</span><span class='label label-success col-md-4 col-md-offset-2'>matched</span>
                                                </div>
                                            </div>
                                            <div class='row' style='margin-bottom: 5px;'>
                                                <div class='col-md-12'>
                                                    <span class='label label-info col-md-6'>order details:</span>
                                                    <button class='col-md-5 col-md-offset-1 btn btn-default' data-toggle='modal' data-target='#gh_details'>Details</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>\n";
                            }
                            elseif ($has_gh == "") {
                                # code...
                            
                            }
                            
                            elseif ($has_gh == 0) {
                                # code...
                            echo "
                            <div class='content'>
                                <div class='row'>                   
                                    <div class='col-md-4'>
                                        <div class='alert alert-warning'>
                                            <div>
                                                <h4 class='title'>Get help Request</h4>  
                                            </div>
                                            <div class='row' style='margin-bottom: 5px;'>
                                                <div class='col-md-12'>
                                                    <span class='label label-info col-md-6'>Amount:</span><span class='col-md-4 col-md-offset-2 label label-danger'>{$ghrows['package']}</span>
                                                </div>
                                            </div>
                                            <div class='row' style='margin-bottom: 5px;'>
                                                <div class='col-md-12'>
                                                    <span class='label label-info col-md-5'>Date:</span><span class='label label-danger col-md-5 col-md-offset-2'>{$ghrows['gh_date']}</span>
                                                </div>
                                            </div>
                                            <div class='row' style='margin-bottom: 5px;'>
                                                <div class='col-md-12'>
                                                    <span class='label label-info col-md-6'>Status:</span><span class='label label-danger col-md-4 col-md-offset-2'>pending</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>\n";
                            }
                            
                            if ($has_approved == 1) {
                                # code...
                            
                            }
                            elseif ($has_donated == 1) {
                                # code...
                            echo "
                            <div class='content'>
                                <div class='row'>                   
                                    <div class='col-md-4'>
                                        <div class='alert alert-warning'>
                                            <div>
                                                <h4 class='title'>Provide help Request</h4>  
                                            </div>
                                            <div class='row' style='margin-bottom: 5px;'>
                                                <div class='col-md-12'>
                                                    <span class='label label-info col-md-6'>Amount:</span><span class='col-md-4 col-md-offset-2 label label-success'>{$rows['package']}</span>
                                                </div>
                                            </div>
                                            <div class='row' style='margin-bottom: 5px;'>
                                                <div class='col-md-12'>
                                                    <span class='label label-info col-md-5'>Date:</span><span class='label label-success col-md-5 col-md-offset-2'>{$rows['ph_date']}</span>
                                                </div>
                                            </div>
                                            <div class='row' style='margin-bottom: 5px;'>
                                                <div class='col-md-12'>
                                                    <span class='label label-info col-md-6'>Status:</span><span class='label label-success col-md-4 col-md-offset-2'>matched</span>
                                                </div>
                                            </div>
                                            <div class='row' style='margin-bottom: 5px;'>
                                                <div class='col-md-12'>
                                                    <span class='label label-info col-md-6'>order details:</span>
                                                    <button class='col-md-5 col-md-offset-1 btn btn-default' data-toggle='modal' data-target='#details'>Details</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>\n";
                            }
                            elseif ($has_donated == "") {
                                # code...
                            
                            }
                            
                            elseif ($has_donated == 0) {
                                # code...
                            echo "
                            <div class='content'>
                                <div class='row'>                   
                                    <div class='col-md-4'>
                                        <div class='alert alert-warning'>
                                            <div>
                                                <h4 class='title'>Provide help Request</h4>  
                                            </div>
                                            <div class='row' style='margin-bottom: 5px;'>
                                                <div class='col-md-12'>
                                                    <span class='label label-info col-md-6'>Amount:</span><span class='col-md-4 col-md-offset-2 label label-danger'>{$rows['package']}</span>
                                                </div>
                                            </div>
                                            <div class='row' style='margin-bottom: 5px;'>
                                                <div class='col-md-12'>
                                                    <span class='label label-info col-md-5'>Date:</span><span class='label label-danger col-md-5 col-md-offset-2'>{$rows['ph_date']}</span>
                                                </div>
                                            </div>
                                            <div class='row' style='margin-bottom: 5px;'>
                                                <div class='col-md-12'>
                                                    <span class='label label-info col-md-6'>Status:</span><span class='label label-danger col-md-4 col-md-offset-2'>pending</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>\n";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- end logic for provide help alert -->
                <!-- logic for provide help modal -->
                <div class="col-md-12">
                    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <?php

                            $reslt = db_query("SELECT * FROM waiting_list WHERE user_id = '$user_id'");
                            $rows = mysqli_fetch_array($reslt);
                            $has_approved = $rows['has_approved'];
                            if ($has_approved == "") {
                                echo "
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                    <h4 class='modal-title' id='H2'>You Are Providing Help</h4>
                                </div>
                                <div class='modal-body'>
                                    <form role='form' method='post' action=' {$_SERVER["PHP_SELF"]}'>
                                        <div class='form-group'>
                                            <div class='row'>
                                                <div class='col-md-6'>
                                                    <label>How much would you like to Provide :</label>
                                                </div>
                                                <div class='col-md-6'>
                                                    <select class='form-control border-input' name='packages' placeholder='Select Amount To Provide'>
                                                        <option >10000</option>
                                                        <option >20000</option>
                                                        <option >50000</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class='row'>
                                                <div class='col-md-12'>
                                                    <p class='help-block alert-danger'>Make sure you are ready to provide help within the time Frame !!!.</p>
                                                </div>
                                            </div>
                                        </div>                           
                            
                                
                                        <div class='modal-footer'>
                                            <span>not ready yet?</span><button type='button' class='btn btn-warning' data-dismiss='modal'>Cancel</button>
                                            <button type='submit' name='btn-provide' class='btn btn-success'>Provide </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            \n";
                            }

                            elseif ($has_gh == 0 ) {
                                echo "
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                    <h4 class='modal-title' id='H1'>You Are cannot Provide Help at this moment </h4>
                                </div>
                                <form role='form' method='post' >
                                    <div class='modal-body'>
                                        Your provide Help is in process
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                        
                                    </div>
                                </form>
                                </div>
                            </div>
                            \n";
                            }
                            elseif ($has_approved == 0) {
                                echo "
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                    <h4 class='modal-title' id='H2'>You Are cannot Provide Help at this moment</h4>
                                </div>
                                <div class='modal-body'> 
                                    Payment awiating confirmation                              
                                    <div class='modal-footer'>
                                    <button type='button' class='btn btn-warning' data-dismiss='modal'>Cancel</button>
                                    </div>
                                </div>
                            </div>
                            \n";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- end logic provide help modal -->
                <!-- logic get help modal -->
                <div class="col-md-12">
                    <div class="modal fade" id="buttonedModal" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <?php
                        $reslt = db_query("SELECT * FROM waiting_list WHERE user_id = '$user_id'");
                        $resltt = db_query("SELECT * FROM gh_pending_list WHERE user_id = '$user_id'");
                            $rows = mysqli_fetch_array($reslt);
                            $gh_rows = mysqli_fetch_array($resltt);
                            $has_approved = $rows['has_approved'];
                            $has_gh = $gh_rows['has_gh'];

                            if ($has_approved == 1 && $has_gh == ""){
                                echo "
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                    <h4 class='modal-title' id='H1'>You are about to request Get Help </h4>
                                </div>
                                <form role='form' method='post' action=' {$_SERVER["PHP_SELF"]}'>
                                    <div class='modal-body'>
                                        <input class='form-control' name='package' type='text' value='40000' readonly>
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                        <button type='submit' name='btn-gh' class='btn btn-primary'>Get Help</button>
                                    </div>
                                </form>
                            </div>
                            \n";
                        }

                            elseif ( $has_gh == 1 || $has_gh == 0 ){
                                echo "
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                    <h4 class='modal-title' id='H1'>You are not allowed to request Get Help at this moment </h4>
                                </div>
                                <form role='form' method='post' >
                                    <div class='modal-body'>
                                         get help in process
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                        
                                    </div>
                                </form>
                            </div>
                            \n";
                            }



                            elseif ($has_donated == "" || $has_donated == 0) {
                                # code...
                            echo "
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                    <h4 class='modal-title' id='H1'>You are not allowed to request Get Help at this moment </h4>
                                </div>
                                <form role='form' method='post' >
                                    <div class='modal-body'>
                                        you cannot get help now Provide help first
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                        
                                    </div>
                                </form>
                            </div>
                            \n";
                            }

                            elseif ($has_approved == 0  ){
                                echo "
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                    <h4 class='modal-title' id='H1'>You are not allowed to request Get Help at this moment </h4>
                                </div>
                                <form role='form' method='post' >
                                    <div class='modal-body'>
                                        you cannot get help now Provide help first
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                        
                                    </div>
                                </form>
                            </div>
                            \n";
                            }

                        
                           
                            
                        ?>
                        </div>
                    </div>
                </div>
                <!-- end logic get help modal -->
                <!-- matched details logic -->
                <div class="col-md-12">
                    <div class="modal fade" id="details" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <?php
                            
                                # code...
                            echo "
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                    <h4 class='modal-title' id='H1'>Provide Help Details</h4>
                                </div>
                                <form role='form' method='post' >
                                    <div class='modal-body'>
                                        <div class='row'><!-- start of first row-->
                                            <div class='col-md-12'>
                                                <div class='col-md-9'>
                                                    <div class='well'>
                                                        <p>Name: </p>
                                                        <p>Phone: </p>
                                                        <p>Account name: </p>
                                                        <p>Account no: </p>
                                                        <p>Bank name: </p>
                                                    </div>
                                                </div>
                                                <div class='col-md-3'>
                                                    <div class='row'>
                                                        <div class='col-md-12'>
                                                            <div class=''>
                                                                Order_id
                                                                <p>mw51223636</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class='col-md-12'>
                                                            <div class=''>
                                                                <span style='color: green;'>If payment made</span>
                                                                <p<button class='btn btn-success'>Complete</button></p>
                                                            </div>
                                                            <p>OR</p>
                                                        </div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class='col-md-12'>
                                                            <div class=''>
                                                                <span style='color: red;'>If unable to make payment<br></span>
                                                                <p<button class='btn btn-danger'>Can't pay</button></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><br> <!--end of first row-->
                                            <div class='row'>
                                                <div class='col-md-12'>
                                                    <div class='col-md-9'>
                                                        <div class='well'>
                                                            <span style='color: red;'>Order Expires exactly</span> 
                                                            <p>10hrs</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                        
                                    </div>
                                </form>
                            </div>
                            \n";
                            
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="modal fade" id="gh_details" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <?php
                            
                                # code...
                            echo "
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                    <h4 class='modal-title' id='H1'>Get Help Details</h4>
                                </div>
                                <form role='form' method='post' >
                                    <div class='modal-body'>
                                        <div class='row'><!-- start of first row-->
                                            <div class='col-md-12'>
                                                <div class='col-md-9'>
                                                    <div class='well'>
                                                        <p>Name: </p>
                                                        <p>Phone: </p>
                                                    </div>
                                                </div>
                                                
                                                <div class='col-md-3'>
                                                    <div class='row'>
                                                        <div class='col-md-12'>
                                                            <div class=''>
                                                                Order_id
                                                                <p>mw51223636</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class='col-md-12'>
                                                            <div class=''>
                                                            <form method='post' action='{$_SERVER["PHP_SELF"]}'>
                                                                <span style='color: green;'>If payment made</span>
                                                                <p<button type='submit' name='btn-gh-confirm' class='btn btn-success'>Confirm</button></p>
                                                            </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><br> <!--end of first row-->
                                        </div>
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                        
                                    </div>
                                </form>
                            </div>
                            \n";
                            
                            ?>
                        </div>
                    </div>
                </div>
                 <!-- end matched details -->
            </div>
        </div>
        <!-- end of page content -->

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
                    &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="">solomon</a>
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
    <script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script> -->

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
    <script src="assets/js/paper-dashboard.js"></script>

    <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="assets/js/demo.js"></script>
	<!-- <script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({
            	icon: 'ti-gift',
            	message: "Welcome to <b>Name of Ponzi site</b> - a beautiful Bootstrap freebie for your next project."

            },{
                type: 'success',
                timer: 4000
            });

    	});
	</script> -->

</html>
