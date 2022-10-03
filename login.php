<?php

require 'koneksi.php';

if (isset($_COOKIE['login_super'])) $_SESSION['login_super'] = $_COOKIE['login_super'];
else if (isset($_COOKIE['login_admin'])) $_SESSION['login_admin'] = $_COOKIE['login_admin'];

if (isset($_COOKIE['get_id'])) $_SESSION['get_id'] = $_COOKIE['get_id'];

if (isset($_SESSION['login_super'])) header("location: index.php");
else if (isset($_SESSION['login_admin'])) header("location: index.php");

$password = null;
$email = null;
$err_user = false;
$err_pass = false;
$err_stss = false;

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM tb_admin_2 WHERE username = '$username'");
    $get_admin = mysqli_fetch_assoc($result);

    if ($get_admin) {
        $get_password = $get_admin['password'];
        $get_id = $get_admin['id'];
        $status = $get_admin['status'];
        $role = $get_admin['role'];

        if (password_verify($password, $get_password)) {
            $_SESSION['get_id'] = $get_id;
            setcookie('get_id', $get_id, time() + 172800);

            if ($status != 'Active') {
                $err_stss = true;
            } else {
                if ($role == "Super") {
                    $_SESSION['login_super'] = $get_password;
                    if (isset($_POST['remember'])) {
                        setcookie('login_super', $get_password, time() + 172800);
                    }
                    header("location: index.php");
                    exit();
                } else {
                    $_SESSION['login_admin'] = $get_password;
                    if (isset($_POST['remember'])) {
                        setcookie('login_admin', $get_password, time() + 172800);
                    }
                    header("location: index.php");
                    exit();
                }
            }
        } else {
            $err_pass = true;
        }
    } else {
        $err_user = true;
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Web Admin untuk mengontrol data Ganti Kartu 4G">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="assets/images/favicon_1.ico">

    <title>Admin | Ganti Kart 4G</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    <script src="assets/js/modernizr.min.js"></script>

</head>

<body>

    <div class="account-pages"></div>
    <div class="clearfix"></div>
    <div class="wrapper-page">
        <div class=" card-box">
            <div class="panel-heading">
                <h3 class="text-center"> Sign In to <strong class="text-custom">Ganti Kartu 4G</strong> admin </h3>
            </div>


            <div class="panel-body">
                <form method="POST" class="form-horizontal m-t-20" action="#">

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="username" id="username" required="" placeholder="Username">
                        </div>

                        <?php if ($err_user == true) { ?>
                            <div class="text-danger">
                                Username tidak ditemukan
                            </div>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" id="password" name="password" tabindex="2" required="" placeholder="Password">
                        </div>
                        <?php if ($err_pass == true) { ?>
                            <div class="text-danger">
                                Password tidak sesuai
                            </div>
                        <?php } ?>

                        <?php if ($err_stss == true) { ?>
                            <div class="text-danger">
                                Akun belum diverifikasi atau sedang dinonaktifkan
                            </div>
                        <?php } ?>
                    </div>

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <div class="checkbox checkbox-primary">
                                <input id="checkbox-signup" name="remember" type="checkbox">
                                <label for="checkbox-signup">
                                    Remember me
                                </label>
                            </div>

                        </div>
                    </div>

                    <div class="form-group text-center m-t-40">
                        <div class="col-xs-12">
                            <button name="login" class="btn btn-success btn-block text-uppercase waves-effect waves-light" type="submit">Masuk</button>
                        </div>
                    </div>

                    <!-- <div class="form-group m-t-30 m-b-0">
                    <div class="col-sm-12">
                        <a href="page-recoverpw.html" class="text-dark"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                    </div>
                </div> -->
                </form>

            </div>
            <!-- </div>                              
                <div class="row">
            	<div class="col-sm-12 text-center">
            		<p>Don't have an account? <a href="page-register.html" class="text-primary m-l-5"><b>Sign Up</b></a></p>
                        
                    </div>
            </div> -->

        </div>




        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>


        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

</body>

</html>