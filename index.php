<?php
include('../config.php');
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

if($rows['superAdmin'] == 'true') {
    $sAdmin = true;
}

?>
<!DOCTYPE html>
<html lang="en">
<!-- Copied from http://themes.pixelstrap.com/bigdeal/admin/index.html by Cyotek WebCopy 1.7.0.600, Friday, November 1, 2019, 2:36:32 PM -->

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bigdeal admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Bigdeal admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="../assets/images/favicon/favicon-1.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon/favicon-1.ico" type="image/x-icon">
    <title>Mako - Dashboard</title>

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome-1.css">

    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/flag-icon.css">

    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="../assets/css/icofont.css">

    <!-- Prism css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/prism.css">

    <!-- Chartist css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">

    <!-- vector map css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vector-map.css">

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
                                <h3>Dashboard
                                    <small>Mako Admin panel</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-md-6 xl-50">
                        <div class="card o-hidden  widget-cards">
                            <div class="bg-secondary card-body">
                                <div class="media static-top-widget">
                                    <div class="media-body"><span class="m-0">Daily Revenue</span>
                                        <?php
                                        if($sAdmin === true) {
                                            $y = Date('Y');
                                            $m = Date('n');
                                            $d = Date('d');
    
                                            $filter = $y . '-' . $m . '-' . $d;
                                            $stmt = $conn->prepare('SELECT * FROM orders WHERE timestamp = :ts');
                                            $stmt->bindParam(':ts', $filter);
                                            $stmt->execute();
                                            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            $total = 0;
                                            foreach($rows as $row) {
                                                $total = $total+$row['price'];
                                            }
                                        } else {
                                            $y = Date('Y');
                                        $m = Date('n');
                                        $d = Date('d');

                                        $filter = $y . '-' . $m . '-' . $d;
                                        $stmt = $conn->prepare('SELECT * FROM orders WHERE seller_id = :id AND timestamp = :ts');
                                        $stmt->bindParam(':id', $user_id);
                                        $stmt->bindParam(':ts', $filter);
                                        $stmt->execute();
                                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        $total = 0;
                                        foreach($rows as $row) {
                                            $total = $total+$row['price'];
                                        }
                                        }
                                        
                                        ?>
                                        <h3 class="mb-0">$ <span class="counter"><?php echo $total; ?></span><small>Today</small></h3>
                                    </div>
                                    <div class="icons-widgets">
                                        <i data-feather="box"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 xl-50">
                        <div class="card o-hidden widget-cards">
                            <div class="bg-primary card-body">
                                <div class="media static-top-widget">
                                    <div class="media-body"><span class="m-0">Daily Orders</span>
                                        <?php
                                        if($sAdmin === true) {
                                            $y = Date('Y');
                                            $m = Date('n');
                                            $d = Date('d');
    
                                            $filter = $y . '-' . $m . '-' . $d;
                                            $stmt = $conn->prepare('SELECT * FROM orders WHERE timestamp = :ts');
                                            $stmt->bindParam(':ts', $filter);
                                            $stmt->execute();
                                        } else {
                                            $y = Date('Y');
                                        $m = Date('n');
                                        $d = Date('d');

                                        $filter = $y . '-' . $m . '-' . $d;
                                        $stmt = $conn->prepare('SELECT * FROM orders WHERE seller_id = :id AND timestamp = :ts');
                                        $stmt->bindParam(':id', $user_id);
                                        $stmt->bindParam(':ts', $filter);
                                        $stmt->execute();
                                        }
                                        
                                        ?>
                                        <h3 class="mb-0"><span class="counter"><?php echo $stmt->rowCount(); ?></span><small> Today</small></h3>
                                    </div>
                                    <div class="icons-widgets">
                                        <i data-feather="message-square"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 xl-50">
                        <div class="card o-hidden widget-cards">
                            <div class="bg-warning card-body">
                                <div class="media static-top-widget">
                                    <div class="media-body"><span class="m-0">Total Orders</span>
                                        <?php
                                        if($sAdmin === true) {
                                            $stmt = $conn->prepare('SELECT * FROM orders');
                                            $stmt->execute();
                                        } else {
                                            $stmt = $conn->prepare('SELECT * FROM orders WHERE seller_id = :id');
                                        $stmt->bindParam(':id', $user_id);
                                        $stmt->execute();
                                        }
                                        ?>
                                        <h3 class="mb-0"><span class="counter"><?php echo $stmt->rowCount(); ?></span><small></small></h3>
                                    </div> 
                                    <div class="icons-widgets">
                                        <i data-feather="navigation"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 xl-50">
                        <div class="card o-hidden widget-cards">
                            <div class="bg-success card-body">
                                <div class="media static-top-widget">
                                    <div class="media-body"><span class="m-0">Total Income</span>
                                        <?php
                                        if($sAdmin === true) {
                                            $stmt = $conn->prepare('SELECT * FROM orders');
                                        $stmt->execute();
                                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        $total = 0;
                                        foreach($rows as $row) {
                                            $total = $total+$row['price'];
                                        }
                                        } else {
                                            $stmt = $conn->prepare('SELECT * FROM orders WHERE seller_id = :id');
                                        $stmt->bindParam(':id', $user_id);
                                        $stmt->execute();
                                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        $total = 0;
                                        foreach($rows as $row) {
                                            $total = $total+$row['price'];
                                        }
                                        }
                                        ?>
                                        <h3 class="mb-0">$ <span class="counter"><?php echo $total; ?></span><small></small></h3>
                                    </div>
                                    <div class="icons-widgets">
                                        <i data-feather="users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-12 xl-100">
                        <div class="card">
                            <div class="card-header">
                                <h5>Monthly Sales</h5>
                                <div class="chart-value-box pull-right">
                                </div>
                            </div>
                            <div class="card-body">
                                <?php
                                    $d = date("d");

                                    if($sAdmin === true) {
                                        $y = Date('Y');
                                        $m = Date('n');
                                        $d = Date('d');

                                        $filter = $y . '-' . $m . '-' . $d;
                                        $stmt = $conn->prepare('SELECT * FROM orders WHERE timestamp = :ts AND seller_id = :id');
                                        $stmt->bindParam(':ts', $filter);
                                        $stmt->bindParam(':id', $user_id);
                                        $stmt->execute();
                                        $seven = $stmt->rowCount();

                                        $filter = $y . '-' . $m . '-' . $d-1;
                                        $stmt = $conn->prepare('SELECT * FROM orders WHERE timestamp = :ts AND seller_id = :id');
                                        $stmt->bindParam(':ts', $filter);
                                        $stmt->bindParam(':id', $user_id);
                                        $stmt->execute();
                                        $six = $stmt->rowCount();

                                        $filter = $y . '-' . $m . '-' . $d-2;
                                        $stmt = $conn->prepare('SELECT * FROM orders WHERE timestamp = :ts AND seller_id = :id');
                                        $stmt->bindParam(':ts', $filter);
                                        $stmt->bindParam(':id', $user_id);
                                        $stmt->execute();
                                        $five = $stmt->rowCount();

                                        $filter = $y . '-' . $m . '-' . $d-3;
                                        $stmt = $conn->prepare('SELECT * FROM orders WHERE timestamp = :ts AND seller_id = :id');
                                        $stmt->bindParam(':ts', $filter);
                                        $stmt->bindParam(':id', $user_id);
                                        $stmt->execute();
                                        $four = $stmt->rowCount();

                                        $filter = $y . '-' . $m . '-' . $d-4;
                                        $stmt = $conn->prepare('SELECT * FROM orders WHERE timestamp = :ts AND seller_id = :id');
                                        $stmt->bindParam(':ts', $filter);
                                        $stmt->bindParam(':id', $user_id);
                                        $stmt->execute();
                                        $three = $stmt->rowCount();

                                        $filter = $y . '-' . $m . '-' . $d-5;
                                        $stmt = $conn->prepare('SELECT * FROM orders WHERE timestamp = :ts AND seller_id = :id');
                                        $stmt->bindParam(':ts', $filter);
                                        $stmt->bindParam(':id', $user_id);
                                        $stmt->execute();
                                        $two = $stmt->rowCount();

                                        $filter = $y . '-' . $m . '-' . $d-6;
                                        $stmt = $conn->prepare('SELECT * FROM orders WHERE timestamp = :ts AND seller_id = :id');
                                        $stmt->bindParam(':ts', $filter);
                                        $stmt->bindParam(':id', $user_id);
                                        $stmt->execute();
                                        $one = $stmt->rowCount();
                                    } else {
                                        $y = Date('Y');
                                        $m = Date('n');
                                        $d = Date('d');

                                        $filter = $y . '-' . $m . '-' . $d;
                                        $stmt = $conn->prepare('SELECT * FROM orders WHERE timestamp = :ts');
                                        $stmt->bindParam(':ts', $filter);
                                        $stmt->execute();
                                        $seven = $stmt->rowCount();

                                        $filter = $y . '-' . $m . '-' . $d-1;
                                        $stmt = $conn->prepare('SELECT * FROM orders WHERE timestamp = :ts');
                                        $stmt->bindParam(':ts', $filter);
                                        $stmt->execute();
                                        $six = $stmt->rowCount();

                                        $filter = $y . '-' . $m . '-' . $d-2;
                                        $stmt = $conn->prepare('SELECT * FROM orders WHERE timestamp = :ts');
                                        $stmt->bindParam(':ts', $filter);
                                        $stmt->execute();
                                        $five = $stmt->rowCount();

                                        $filter = $y . '-' . $m . '-' . $d-3;
                                        $stmt = $conn->prepare('SELECT * FROM orders WHERE timestamp = :ts');
                                        $stmt->bindParam(':ts', $filter);
                                        $stmt->execute();
                                        $four = $stmt->rowCount();

                                        $filter = $y . '-' . $m . '-' . $d-4;
                                        $stmt = $conn->prepare('SELECT * FROM orders WHERE timestamp = :ts');
                                        $stmt->bindParam(':ts', $filter);
                                        $stmt->execute();
                                        $three = $stmt->rowCount();

                                        $filter = $y . '-' . $m . '-' . $d-5;
                                        $stmt = $conn->prepare('SELECT * FROM orders WHERE timestamp = :ts');
                                        $stmt->bindParam(':ts', $filter);
                                        $stmt->execute();
                                        $two = $stmt->rowCount();

                                        $filter = $y . '-' . $m . '-' . $d-6;
                                        $stmt = $conn->prepare('SELECT * FROM orders WHERE timestamp = :ts');
                                        $stmt->bindParam(':ts', $filter);
                                        $stmt->execute();
                                        $one = $stmt->rowCount();
                                    }

                                    
                                ?>
                                <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js'></script>
                                <canvas id="myChart" width="100%" height="20"></canvas>
                                <script type='text/javascript'>
                                    var ctx = document.getElementById('myChart').getContext('2d');
                                    var myChart = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: [<?php echo $d-6; ?>, <?php echo $d-5; ?>, <?php echo $d-4; ?>, <?php echo $d-3; ?>, <?php echo $d-2; ?>, <?php echo $d-1; ?>, <?php echo $d; ?>],
                                            datasets: [{
                                                label: '# of Orders',
                                                data: [<?php echo $one; ?>, <?php echo $two; ?>, <?php echo $three; ?>, <?php echo $four; ?>, <?php echo $five; ?>, <?php echo $six; ?>, <?php echo $seven; ?>],
                                                backgroundColor: [
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)'
                                                ],
                                                borderColor: [
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)'
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                yAxes: [{
                                                    ticks: {
                                                        beginAtZero: true
                                                    }
                                                }]
                                            }
                                        }
                                    });
                                </script>
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

<!--chartist js-->
<script src="../assets/js/chart/chartist/chartist.js"></script>


<!-- lazyload js-->
<script src="../assets/js/lazysizes.min.js"></script>

<!--copycode js-->
<script src="../assets/js/prism/prism.min.js"></script>
<script src="../assets/js/clipboard/clipboard.min.js"></script>
<script src="../assets/js/custom-card/custom-card.js"></script>

<!--counter js-->
<script src="../assets/js/counter/jquery.waypoints.min.js"></script>
<script src="../assets/js/counter/jquery.counterup.min.js"></script>
<script src="../assets/js/counter/counter-custom.js"></script>

<!--Customizer admin-->
<script src="../assets/js/admin-customizer.js"></script>

<!--map js-->
<script src="../assets/js/vector-map/jquery-jvectormap-2.0.2.min.js"></script>
<script src="../assets/js/vector-map/map/jquery-jvectormap-world-mill-en.js"></script>

<!--apex chart js-->
<script src="../assets/js/chart/apex-chart/apex-chart.js"></script>
<script src="../assets/js/chart/apex-chart/stock-prices.js"></script>

<!--chartjs js-->
<script src="../assets/js/chart/flot-chart/excanvas.js"></script>
<script src="../assets/js/chart/flot-chart/jquery.flot.js"></script>
<script src="../assets/js/chart/flot-chart/jquery.flot.time.js"></script>
<script src="../assets/js/chart/flot-chart/jquery.flot.categories.js"></script>
<script src="../assets/js/chart/flot-chart/jquery.flot.stack.js"></script>
<script src="../assets/js/chart/flot-chart/jquery.flot.pie.js"></script>
<!--dashboard custom js-->
<script src="../assets/js/dashboard/default.js"></script>

<!--right sidebar js-->
<script src="../assets/js/chat-menu.js"></script>

<!--height equal js-->
<script src="../assets/js/equal-height.js"></script>

<!-- lazyload js-->
<script src="../assets/js/lazysizes.min.js"></script>

<!--script admin-->
<script src="../assets/js/admin-script.js"></script>

</body>
<!-- Copied from http://themes.pixelstrap.com/bigdeal/admin/index.html by Cyotek WebCopy 1.7.0.600, Friday, November 1, 2019, 2:36:32 PM -->
</html>
