<?php

include('../config.php');
$error = false;
$success = false;

if(!isset($_SESSION['loggedIn']) && empty($_SESSION['loggedIn'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['userId'];
$stmt = $conn->prepare('SELECT * FROM users WHERE id = :id');
$stmt->bindParam(':id', $user_id);
$stmt->execute();
$rows = $stmt->fetch();
$currentUser = $rows;
$profile_picture = $rows['profilePicture'];
$u_username = $rows['username'];
$u_email = $rows['email'];
$sAdmin = false;

if($rows['superAdmin'] == 'true') {
    $sAdmin = true;
}

?>
<!DOCTYPE html>
<html lang="en">
<!-- Copied from http://themes.pixelstrap.com/bigdeal/admin/profile.html by Cyotek WebCopy 1.7.0.600, Friday, November 1, 2019, 2:36:32 PM -->
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bigdeal admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Bigdeal admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="../assets/images/favicon/favicon-1.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon/favicon-1.ico" type="image/x-icon">
    <title>Mako - Settings</title>

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome-1.css">

    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/flag-icon.css">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-1.css">

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/admin.css">
</head>
<body>

<!-- page-wrapper Start-->
<div class="page-wrapper">

    <!-- Page Header Start-->
    <div class="page-main-header">
        <div class="main-header-left">
            <div class="logo-wrapper"><a href="index.html"><img class="blur-up lazyloaded" src="../assets/images/layout-2/logo/logo.png" alt=""></a></div>
        </div>
        <div class="main-header-right row">
            <div class="mobile-sidebar">
                <div class="media-body text-right switch-sm">
                    <label class="switch">
                        <input id="sidebar-toggle" type="checkbox" checked="checked"><span class="switch-state"></span>
                    </label>
                </div>
            </div>
            <div class="nav-right col">
                <ul class="nav-menus">
                    <li>
</li>
                    <li class="onhover-dropdown">
                        <div class="media align-items-center"><img class="align-self-center pull-right img-50 rounded-circle blur-up lazyloaded" src="<?php echo $profile_picture; ?>" alt="header-user">
                            <div class="dotted-animation"><span class="animate-circle"></span><span class="main-circle"></span></div>
                        </div>
                        <ul class="profile-dropdown onhover-show-div p-20 profile-dropdown-hover">
                            <li><a href="settings.php">Settings<span class="pull-right"><i data-feather="settings"></i></span></a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
            </div>
        </div>
    </div>
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- Page Sidebar Start-->
        <div class="page-sidebar">
            <div class="sidebar custom-scrollbar">
                <div class="sidebar-user text-center">
                    <div><img class="img-60 rounded-circle lazyloaded blur-up" src="<?php echo $profile_picture; ?>" alt="#">
                    </div>
                    <h6 class="mt-3 f-14"><?php echo $u_username; ?></h6>
                    <p><?php echo $u_email; ?></p>
                </div>
                <ul class="sidebar-menu">
                    <li><a class="sidebar-header" href="index.php"><i data-feather="home"></i><span>Dashboard</span></a></li>
                    <li><a class="sidebar-header" href="products.php"><i data-feather="box"></i><span>Products</span></a></li>
                    <li><a class="sidebar-header" href="orders.php"><i data-feather="dollar-sign"></i><span>Orders</span></a></li>
                    <li><a class="sidebar-header" href="coupons.php"><i data-feather="tag"></i><span>Coupons</span></a></li>
                    <li><a class="sidebar-header" href="settings.php"><i data-feather="settings"></i><span>Settings</span></a></li>
                    <?php
                        if($sAdmin == true) {
                            echo '<li><a class="sidebar-header" href="users.php"><i data-feather="users"></i><span>Users</span></a></li>';
                        }
                    ?>
                    <li><a class="sidebar-header" href="logout.php"><i data-feather="log-in"></i><span>Logout</span></a></li>
                </ul>
            </div>
        </div>
        <!-- Page Sidebar Ends-->

        <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>Profile
                                    <small>Settings Page</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Settings</li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-details text-center">
                                    <img src="<?php echo $currentUser['profilePicture']; ?>" alt="" class="img-fluid img-90 rounded-circle blur-up lazyloaded">
                                    <h5 class="f-w-600 mb-0"><?php echo $currentUser['username']; ?></h5>
                                    <span><?php echo $currentUser['email']; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card tab2-card">
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" id="top-profile-tab" data-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="true"><i data-feather="user" class="mr-2"></i>Details</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" id="contact-top-tab" data-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false"><i data-feather="settings" class="mr-2"></i>Change Password</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="top-tabContent">
                                    <div class="tab-pane fade show active" id="top-profile" role="tabpanel" aria-labelledby="top-profile-tab">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="form row">
                                                    <?php
                                                        if(isset($_POST['detailSubmit'])) {
                                                            $email = $_POST['email'];
                                                            $ppemail = $_POST['ppemail'];
                                                            $webhook = $_POST['webhook'];
                                                            $pre = $_POST['pre'];
                                                            $paypal = $_POST['paypal'];
                                                            $coinbase = $_POST['coinbase'];
                                                            $merchant = $_POST['merchant'];
                                                            $ipnsecret = $_POST['ipnsecret'];
                                                            
                                                            if($paypal == 'on') {
                                                                $paypal = 'on';
                                                            } else {
                                                                $paypal = 'off';
                                                            }
                                                            
                                                            if($coinbase == 'on') {
                                                                $coinbase = 'on';
                                                            } else {
                                                                $coinbase = 'off';
                                                            }

                                                            $stmt = $conn->prepare('UPDATE users SET email = :e, paypal = :pp, webhook_url = :wu, profilePicture = :pre, paypal_enable = :ppe, coinbase_enable = :cbe, coinbase_merchant_id = :mer, coinbase_ipn = :ipn WHERE id = :id');
                                                            $stmt->bindParam(':e', $email);
                                                            $stmt->bindParam(':pp', $ppemail);
                                                            $stmt->bindParam(':wu', $webhook);
                                                            $stmt->bindParam(':pre', $pre);
                                                            $stmt->bindParam(':ppe', $paypal);
                                                            $stmt->bindParam(':cbe', $coinbase);
                                                            $stmt->bindParam(':id', $user_id);
                                                            $stmt->bindParam(':mer', $merchant);
                                                            $stmt->bindParam(':ipn', $ipnsecret);
                                                            $stmt->execute();
                                                            header('Location: settings.php');
                                                        }
                                                    ?>
                                                    <form action method='POST' style='width:100%;'>
                                                        <div class="form-group mb-12 col-12">
                                                            <label for="validationCustom01" class="col-xl-12 col-sm-12 mb-0" style='display: block; padding: 0 0 10px 0; margin: 0; font-weight: normal;'>Email :</label>
                                                            <input class="form-control col-xl-12 col-sm-12" id="validationCustom01" type="email" value='<?php echo $currentUser['email']; ?>' name='email' required="">
                                                        </div>
                                                        <div class="form-group mb-12 col-12">
                                                            <label for="validationCustom01" class="col-xl-12 col-sm-12 mb-0" style='display: block; padding: 0 0 10px 0; margin: 0; font-weight: normal;'>PayPal Email :</label>
                                                            <input class="form-control col-xl-12 col-sm-12" id="validationCustom01" type="email" value='<?php echo $currentUser['paypal']; ?>' name='ppemail' required="">
                                                        </div>
                                                        
                                                        <div class="form-group mb-12 col-12">
                                                            <label for="validationCustom01" class="col-xl-12 col-sm-12 mb-0" style='display: block; padding: 0 0 10px 0; margin: 0; font-weight: normal;'>CoinPayments Merchant ID :</label>
                                                            <input class="form-control col-xl-12 col-sm-12" id="validationCustom01" type="text" value='<?php echo $currentUser['coinbase_merchant_id']; ?>' name='merchant'>
                                                        </div>
                                                        <div class="form-group mb-12 col-12">
                                                            <label for="validationCustom01" class="col-xl-12 col-sm-12 mb-0" style='display: block; padding: 0 0 10px 0; margin: 0; font-weight: normal;'>CoinPayments IPN Secret:</label>
                                                            <input class="form-control col-xl-12 col-sm-12" id="validationCustom01" type="text" value='<?php echo $currentUser['coinbase_ipn']; ?>' name='ipnsecret'>
                                                        </div>
                                                        
                                                        <div class="form-group mb-12 col-12">
                                                            <label for="validationCustom01" class="col-xl-12 col-sm-12 mb-0" style='display: block; padding: 0 0 10px 0; margin: 0; font-weight: normal;'>Discord Webhook :</label>
                                                            <input class="form-control col-xl-12 col-sm-12" id="validationCustom01" type="text" name='webhook' value='<?php echo $currentUser['webhook_url']; ?>' >
                                                        </div>
                                                        <div class="form-group mb-12 col-12">
                                                            <label for="validationCustom01" class="col-xl-12 col-sm-12 mb-0" style='display: block; padding: 0 0 10px 0; margin: 0; font-weight: normal;'>Profile Icon URL :</label>
                                                            <input class="form-control col-xl-12 col-sm-12" id="validationCustom01" type="text" name='pre' value='<?php echo $currentUser['profilePicture']; ?>' required="">
                                                        </div>
                                                        <div class="form-group mb-3 col-12">
                                                            <label for="validationCustom01" class="col-xl-12 col-sm-12 mb-0" style='display: block; padding: 0 0 10px 0; margin: 0; font-weight: normal;'>Enabled Payment Methods:</label>
                                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                                <input type="checkbox" class="custom-control-input" <?php if($currentUser['paypal_enable'] == 'on') {echo 'checked';} ?> name='paypal' id="customControlAutosizingO">
                                                                <label class="custom-control-label" for="customControlAutosizingO">PayPal</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                                <input type="checkbox" class="custom-control-input" <?php if($currentUser['coinbase_enable'] == 'on') {echo 'checked';} ?> name='coinbase' id="customControlAutosizingN">
                                                                <label class="custom-control-label" for="customControlAutosizingN">CoinBase</label>
                                                            </div>
                                                        </div>
                                                        <button type="submit" name='detailSubmit' class="btn btn-primary">Edit Profile</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="top-contact" role="tabpanel" aria-labelledby="contact-top-tab">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="form row">
                                                    <?php
                                                        $error = false;
                                                        if(isset($_POST['changePass'])) {
                                                            $password = $_POST['password'];
                                                            $confPass = $_POST['confPass'];

                                                            if($password !== $confPass) {
                                                                $error = true;
                                                            } else {
                                                                $pass = password_hash($password, PASSWORD_BCRYPT);
                                                                $stmt = $conn->prepare('UPDATE users SET password = :e WHERE id = :id');
                                                                $stmt->bindParam(':e', $pass);
                                                                $stmt->bindParam(':id', $user_id);
                                                                $stmt->execute();
                                                                header('Location: settings.php');
                                                            }
                                                        }
                                                    ?>
                                                    <?php if($error == true) { echo '<p style="color:#ff5a5a;width:100%;display:block;">Your Password Does Not Match</p>'; } ?>
                                                    <form action method='POST'>
                                                        <div class="form-group mb-3 col-12">
                                                            <label for="validationCustom01" class="col-xl-12 col-sm-12 mb-0" style='display: block; padding: 0 0 10px 0; margin: 0; font-weight: normal;'>New Password :</label>
                                                            <input class="form-control col-xl-12 col-sm-12" id="validationCustom01" type="password" name='password' required="">
                                                        </div>
                                                        <div class="form-group mb-3 col-12">
                                                            <label for="validationCustom01" class="col-xl-12 col-sm-12 mb-0" style='display: block; padding: 0 0 10px 0; margin: 0; font-weight: normal;'>Confirm Password :</label>
                                                            <input class="form-control col-xl-12 col-sm-12" id="validationCustom01" type="password" name='confPass' required="">
                                                        </div>
                                                        <button type="submit" name='changePass' class="btn btn-primary">Change Password</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="top-changeicon" role="tabpanel" aria-labelledby="contact-top-tab">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="form row">
                                                    <?php
                                                        $error = false;
                                                        if(isset($_POST['changePass'])) {
                                                            $password = $_POST['password'];
                                                            $confPass = $_POST['confPass'];

                                                            if($password !== $confPass) {
                                                                $error = true;
                                                            } else {
                                                                $pass = password_hash($password, PASSWORD_BCRYPT);
                                                                $stmt = $conn->prepare('UPDATE users SET password = :e WHERE id = :id');
                                                                $stmt->bindParam(':e', $pass);
                                                                $stmt->bindParam(':id', $user_id);
                                                                $stmt->execute();
                                                                header('Location: settings.php');
                                                            }
                                                        }
                                                    ?>
                                                    <?php if($error == true) { echo '<p style="color:#ff5a5a;width:100%;display:block;">Your Password Does Not Match</p>'; } ?>
                                                    <form action method='POST'>
                                                        <div class="form-group mb-3 col-12">
                                                            <label for="validationCustom01" class="col-xl-12 col-sm-12 mb-0" style='display: block; padding: 0 0 10px 0; margin: 0; font-weight: normal;'>New Password :</label>
                                                            <input class="form-control col-xl-12 col-sm-12" id="validationCustom01" type="password" name='password' required="">
                                                        </div>
                                                        <div class="form-group mb-3 col-12">
                                                            <label for="validationCustom01" class="col-xl-12 col-sm-12 mb-0" style='display: block; padding: 0 0 10px 0; margin: 0; font-weight: normal;'>Confirm Password :</label>
                                                            <input class="form-control col-xl-12 col-sm-12" id="validationCustom01" type="password" name='confPass' required="">
                                                        </div>
                                                        <button type="submit" name='changePass' class="btn btn-primary">Change Password</button>
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
            <!-- Container-fluid Ends-->

        </div>

        <!-- footer start-->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 footer-copyright">
                        <p class="mb-0">Copyright 2019 © Bigdeal All rights reserved.</p>
                    </div>
                    <div class="col-md-6">
                        <p class="pull-right mb-0">Hand crafted & made with<i class="fa fa-heart"></i></p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer end-->

    </div>

</div>

<!-- latest jquery-->
<script src="../assets/js/jquery-3.3.1.min.js"></script>

<!-- Bootstrap js-->
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.js"></script>

<!-- feather icon js-->
<script src="../assets/js/icons/feather-icon/feather.min.js"></script>
<script src="../assets/js/icons/feather-icon/feather-icon.js"></script>

<!-- Sidebar jquery-->
<script src="../assets/js/sidebar-menu.js"></script>

<!--Customizer admin-->
<script src="../assets/js/admin-customizer.js"></script>

<!-- lazyload js-->
<script src="../assets/js/lazysizes.min.js"></script>

<!--right sidebar js-->
<script src="../assets/js/chat-menu.js"></script>

<!--script admin-->
<script src="../assets/js/admin-script.js"></script>

</body>
<!-- Copied from http://themes.pixelstrap.com/bigdeal/admin/profile.html by Cyotek WebCopy 1.7.0.600, Friday, November 1, 2019, 2:36:32 PM -->
</html>
