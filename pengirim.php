<?php
require_once 'koneksi.php';


if (!isset($_SESSION['login_super'])) {
    if (!isset($_SESSION['login_admin'])) {
        header("location: login.php");
    }
}
$get_id_session = $_SESSION['get_id'];
$query_admin_akun = mysqli_query($conn, "SELECT * FROM tb_admin_2 WHERE id = '$get_id_session'");
$get_data_akun_admin = mysqli_fetch_assoc($query_admin_akun);
$role = $get_data_akun_admin['role'];
$tap = $get_data_akun_admin['tap'];
$cluster = $get_data_akun_admin['cluster'];
$login_session = "";

if ($role == "Super") {
    $login_session = "login_super";
} else {
    $login_session = "login_admin";
}
$data_pengirim = mysqli_query($conn, "SELECT * FROM tb_pengirim ");
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

    <!-- DataTables -->
    <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css" />


    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

    <script src="assets/js/modernizr.min.js"></script>

</head>

<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <div class="text-center">
                    <a href="index.php" class="logo"><i class="icon-magnet icon-c-alert-info"></i></a>
                    <!-- Image Logo here -->
                    <!-- <a href="index.html" class="logo">
                        <i class="icon-c-logo"> <img src="assets/images/logo_sm.png" height="42" /> </i>
                        <span><img src="assets/images/logo_light.png" height="20" /></span>
                    </a> -->
                </div>
            </div>

            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container">
                    <div class="">
                        <div class="pull-left">
                            <button class="button-menu-mobile open-left waves-effect waves-light">
                                <i class="md md-menu"></i>
                            </button>
                            <span class="clearfix"></span>
                        </div>

                        <ul class="nav navbar-nav navbar-right pull-right">
                            <li class="hidden-xs">
                                <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
                            </li>
                            <li class="dropdown top-menu-item-xs">
                                <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><img src="assets/images/users/avatar-1.jpg" alt="user-img" class="img-circle"> </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="ti-user m-r-10 text-custom"></i> <?= $get_data_akun_admin['username'] ?></a></li>
                                    <li class="divider"></li>
                                    <li><a href="" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="ti-power-off m-r-10 text-danger"></i> Logout</a></li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <!-- Top Bar End -->


        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="mySmallModalLabel">Logout Akun</h4>
                    </div>
                    <div class="modal-body">
                        <p>Yakin Ingin Logout Akun ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                        <a href="logout.php?logout=true&for=<?= $login_session ?>" type="button" class="btn btn-primary waves-effect waves-light">Logout</a>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="row col">

        </div>


        <!-- ========== Left Sidebar Start ========== -->

        <div class="left side-menu">
            <div class="sidebar-inner slimscrollleft">
                <!--- Divider -->
                <div id="sidebar-menu">
                    <ul>

                        <li class="text-muted menu-title">Menu</li>

                        <li class="has_sub">
                            <a href="index.php" class="waves-effect"><i class="ti-server"></i> <span> Data Pengajuan </span></a>

                        </li>

                        <?php
                        if ($role == "Super") {
                            echo "<li class='has_sub'>
                                    <a href='administrator.php' class='waves-effect'><i class='ti-user'></i> <span> Administrator </span></a>
                                </li>";
                        }
                        ?>

                        <li class="has_sub">
                            <a href="pengirim.php" class="waves-effect"><i class="ti-user"></i> <span> Pengirim </span></a>
                        </li>


                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">

                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">

                            <h4 class="page-title">Pengirim</h4>
                            <ol class="breadcrumb">
                                <li>
                                    <a href="#">Home</a>
                                </li>
                                <li class="active">
                                    Data Pengirim
                                </li>
                            </ol>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">


                                <!-- MODAL TABAH PENGIRIM -->
                                <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Tambah Pengirim</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="controller.php" enctype="multipart/form-data">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="nb-edt form-control" required="" autocomplete="off" placeholder="Nama Lengkap" name="nama" id="nama">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Nomor Hp</label>
                                                        <div class="col-sm-9">
                                                            <input type="number" class="nb-edt form-control" required="" autocomplete="off" placeholder="Nomor Hp" name="no_hp" id="no_hp">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Divisi</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="nb-edt form-control" required="" autocomplete="off" placeholder="Divisi" name="divisi" id="divisi">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">TAP</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control" id="tap" name="tap">
                                                                <option value="">- Pilih -</option>
                                                                <option value="TAP GOWA">TAP GOWA</option>
                                                                <option value="TAP MALINO">TAP MALINO</option>
                                                                <option value="TAP TAKALAR">TAP TAKALAR</option>
                                                                <option value="TAP JENEPONTO">TAP JENEPONTO</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                                                        <button type="submit" name="submit_tambah_pengirim" class="btn btn-default waves-effect">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- AKHIR MODAL TABAH ADMIN -->

                                <a href="#" class="btn btn-default btn-rounded waves-effect waves-light m-b-30" data-toggle="modal" data-target="#con-close-modal">Tambah Pengirim</a>


                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Nomor HP</th>
                                            <th>Divisi</th>
                                            <th>TAP</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($data_pengirim as $dta) { ?>

                                            <tr>
                                                <td style="text-align: center;"><?= $no ?></td>
                                                <td><?= $dta['nama'] ?></td>
                                                <td><?= $dta['no_hp'] ?></td>
                                                <td><?= $dta['divisi'] ?></td>
                                                <td><?= $dta['tap'] ?></td>
                                                <td style="text-align: center;">
                                                    <a href="#" type="button" data-toggle="modal" data-target="#edit-<?= $dta['id'] ?>" class="btn table-action-btn waves-effect waves-light"><i class="md md-edit"></i></a>
                                                    <a href="#" type="button" data-toggle="modal" data-target="#hapus-<?= $dta['id'] ?>" class="btn table-action-btn waves-effect waves-light"><i class="md md-close"></i></a>
                                                </td>
                                            </tr>


                                            <!-- MODAL EDIT ADMIN -->
                                            <div id="edit-<?= $dta['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title">Edit Data</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="controller.php" enctype="multipart/form-data">
                                                                <div class="form-group row">
                                                                    <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" value="<?= $dta['nama'] ?>" class="nb-edt form-control" required="" autocomplete="off" placeholder="Nama Lengkap" name="nama" id="nama">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-sm-3 col-form-label">Nomor Hp</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="number" value="<?= $dta['no_hp'] ?>" class="nb-edt form-control" required="" autocomplete="off" placeholder="Nomor Hp" name="no_hp" id="no_hp">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-sm-3 col-form-label">Divisi</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" value="<?= $dta['divisi'] ?>" class="nb-edt form-control" required="" autocomplete="off" placeholder="Divisi" name="divisi" id="divisi">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-sm-3 col-form-label">TAP</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control" id="tap" name="tap">
                                                                            <?php

                                                                            $tap = $dta['tap'];
                                                                            if ($tap == "TAP GOWA") {
                                                                                echo "
                                                                                    <option value='TAP GOWA' selected>TAP GOWA</option>
                                                                                    <option value='TAP MALINO'>TAP MALINO</option>
                                                                                    <option value='TAP TAKALAR'>TAP TAKALAR</option>
                                                                                    <option value='TAP JENEPONTO'>TAP JENEPONTO</option>";
                                                                            } else if ($tap == "TAP MALINO") {
                                                                                echo "
                                                                                    <option value='TAP GOWA' >TAP GOWA</option>
                                                                                    <option value='TAP MALINO' selected>TAP MALINO</option>
                                                                                    <option value='TAP TAKALAR'>TAP TAKALAR</option>
                                                                                    <option value='TAP JENEPONTO'>TAP JENEPONTO</option>";
                                                                            } else if ($tap == "TAP TAKALAR") {
                                                                                echo "
                                                                                    <option value='TAP GOWA' >TAP GOWA</option>
                                                                                    <option value='TAP MALINO' >TAP MALINO</option>
                                                                                    <option value='TAP TAKALAR' selected>TAP TAKALAR</option>
                                                                                    <option value='TAP JENEPONTO'>TAP JENEPONTO</option>";
                                                                            } else if ($tap == "TAP JENEPONTO") {
                                                                                echo "
                                                                                    <option value='TAP GOWA' >TAP GOWA</option>
                                                                                    <option value='TAP MALINO' >TAP MALINO</option>
                                                                                    <option value='TAP TAKALAR'>TAP TAKALAR</option>
                                                                                    <option value='TAP JENEPONTO' selected>TAP JENEPONTO</option>";
                                                                            } else {
                                                                                echo "
                                                                                    <option value=''>- Pilih -</option>
                                                                                    <option value='TAP GOWA' >TAP GOWA</option>
                                                                                    <option value='TAP MALINO' >TAP MALINO</option>
                                                                                    <option value='TAP TAKALAR'>TAP TAKALAR</option>
                                                                                    <option value='TAP JENEPONTO'>TAP JENEPONTO</option>";
                                                                            }

                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <input type="hidden" value="<?= $dta['id'] ?>" name="id" id="id">
                                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                                                                    <button type="submit" name="submit_edit_pengirim" class="btn btn-default waves-effect">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- AKHIR MODAL EDIT ADMIN -->

                                            <!-- MODAL HAPUS -->
                                            <div class="modal fade" tabindex="-1" id="hapus-<?= $dta['id'] ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content bg-inverse">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" style="color: white;">Hapus Data Pengirim</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p style="color: white;">Yakin Ingin Menghapus Data Pengirim ?</p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Batal</button>
                                                            <a href="controller.php?hapus_pengirim=true&id=<?= $dta['id'] ?>" type="button" class="btn btn-outline-dark" style="background-color: white;">Hapus</a>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->

                                        <?php
                                            $no = $no + 1;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>




                </div> <!-- container -->

            </div> <!-- content -->

            <footer class="footer">
                © Admin Ganti Kartu 4G | Telkomsel.
            </footer>

        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

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


    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>

    <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="assets/plugins/datatables/buttons.bootstrap.min.js"></script>
    <script src="assets/plugins/datatables/jszip.min.js"></script>
    <script src="assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.keyTable.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="assets/plugins/datatables/responsive.bootstrap.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.scroller.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.colVis.js"></script>
    <script src="assets/plugins/datatables/dataTables.fixedColumns.min.js"></script>

    <script src="assets/pages/datatables.init.js"></script>

    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({
                keys: true
            });
            $('#datatable-responsive').DataTable();
            $('#datatable-colvid').DataTable({
                "dom": 'C<"clear">lfrtip',
                "colVis": {
                    "buttonText": "Change columns"
                }
            });
            $('#datatable-scroller').DataTable({
                ajax: "assets/plugins/datatables/json/scroller-demo.json",
                deferRender: true,
                scrollY: 380,
                scrollCollapse: true,
                scroller: true
            });
            var table = $('#datatable-fixed-header').DataTable({
                fixedHeader: true
            });
            var table = $('#datatable-fixed-col').DataTable({
                scrollY: "300px",
                scrollX: true,
                scrollCollapse: true,
                paging: false,
                fixedColumns: {
                    leftColumns: 1,
                    rightColumns: 1
                }
            });
        });
        TableManageButtons.init();
    </script>

</body>

</html>