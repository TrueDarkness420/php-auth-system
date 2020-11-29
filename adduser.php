<?php

include('../config.php');
$error = false;

if(!isset($_SESSION['loggedIn']) && empty($_SESSION['loggedIn'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['userId'];
$stmt = $conn->prepare('SELECT * FROM users WHERE id = :id');
$stmt->bindParam(':id', $user_id);
$stmt->execute();
$rows = $stmt->fetch();
$profile_picture = $rows['profilePicture'];
$u_username = $rows['username'];
$u_email = $rows['email'];
$sAdmin = false;

if(isset($_POST['submit'])) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $pfp = filter_input(INPUT_POST, 'pfp', FILTER_SANITIZE_STRING);
    $superAdmin = filter_input(INPUT_POST, 'superAdmin', FILTER_SANITIZE_STRING);
    $newPass = password_hash($password, PASSWORD_BCRYPT);
    if($superAdmin == 'on') {
        $superAdmin = 'true';
    } else {
        $superAdmin = 'false';
    }
    $stmt = $conn->prepare('INSERT INTO users (username, password, email, superAdmin, profilePicture) VALUES (:user, :pass, :email, :admin, :pfp)');
    $stmt->bindParam(':user', $username);
    $stmt->bindParam(':pass', $newPass);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':admin', $superAdmin);
    $stmt->bindParam(':pfp', $pfp);
    $stmt->execute();
    header('Location: users.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bigdeal admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Bigdeal admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="../assets/images/favicon/favicon-1.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon/favicon-1.ico" type="image/x-icon">
    <title>Add User</title>

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

        <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>Add User
                                    <small>Admin panel</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.php"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">Add User</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Add User</h5>
                            </div>
                            <div class="card-body">
                                <div class="row product-adding">
                                    <div class="col-xl-7">
                                        <form class="needs-validation add-product-form" action method='POST'>
                                            <div class="form">
                                                <div class="form-group mb-3 row">
                                                    <label for="validationCustom01" class="col-xl-3 col-sm-4 mb-0">Username :</label>
                                                    <input class="form-control col-xl-8 col-sm-7" id="validationCustom01" type="text" name='username' required="">
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <label for="validationCustom02" class="col-xl-3 col-sm-4 mb-0">Password :</label>
                                                    <input class="form-control col-xl-8 col-sm-7" id="validationCustom02" type="password" name='password' required="">
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <label for="validationCustomUsername" class="col-xl-3 col-sm-4 mb-0">Email :</label>
                                                    <input class="form-control col-xl-8 col-sm-7" id="validationCustomUsername" type="email" name='email' required="">
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <label for="validationCustomUsername" class="col-xl-3 col-sm-4 mb-0">Profile Picture URL :</label>
                                                    <input class="form-control col-xl-8 col-sm-7" id="validationCustomUsername" type="text" name='pfp' required="">
                                                </div>
                                                <div class="form-terms">
                                                    <div class="custom-control custom-checkbox mr-sm-2">
                                                        <input type="checkbox" class="custom-control-input" name='superAdmin' id="customControlAutosizing">
                                                        <label class="custom-control-label" for="customControlAutosizing">Give Super Admin Permissions?</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="offset-xl-3 offset-sm-4" style='margin-top: 40px;'>
                                                <button type="submit" name='submit' class="btn btn-primary">+ Add User</button>
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

        <!-- footer start-->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 footer-copyright">
                        <p class="mb-0">Copyright 2019 © Mako All rights reserved.</p>
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

<!-- touchspin js-->
<script src="../assets/js/touchspin/vendors.min.js"></script>
<script src="../assets/js/touchspin/touchspin.js"></script>
<script src="../assets/js/touchspin/input-groups.min.js"></script>

<!-- form validation js-->
<script src="../assets/js/dashboard/form-validation-custom.js"></script>

<!-- ckeditor js-->
<script src="../assets/js/editor/ckeditor/ckeditor.js"></script>
<script src="../assets/js/editor/ckeditor/styles.js"></script>
<script src="../assets/js/editor/ckeditor/adapters/jquery.js"></script>
<script src="../assets/js/editor/ckeditor/ckeditor.custom.js"></script>

<!-- Zoom js-->
<script src="../assets/js/jquery.elevatezoom.js"></script>
<script src="../assets/js/zoom-scripts.js"></script>

<!--Customizer admin-->
<script src="../assets/js/admin-customizer.js"></script>

<!-- lazyload js-->
<script src="../assets/js/lazysizes.min.js"></script>

<!--right sidebar js-->
<script src="../assets/js/chat-menu.js"></script>

<!--script admin-->
<script src="../assets/js/admin-script.js"></script>

</body>
<!-- Copied from http://themes.pixelstrap.com/bigdeal/admin/add-product.html by Cyotek WebCopy 1.7.0.600, Friday, November 1, 2019, 2:36:32 PM -->
</html>
