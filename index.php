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
    $data_pengajuan = mysqli_query($conn, "SELECT * FROM tb_pengajuans WHERE cluster ='$cluster' ORDER BY id DESC");
} else {
    $login_session = "login_admin";

    // $teritori = mysqli_query($conn, "SELECT * FROM tb_teritori_tap WHERE tap = '$tap'");
    // $dta_teritori = mysqli_fetch_assoc($teritori);
    $data_pengajuan = mysqli_query($conn, "SELECT * FROM tb_pengajuans WHERE tap ='$tap' ORDER BY id DESC");
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

    <!-- DataTables -->
    <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css" />

    <!-- Plugins css-->
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

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
                            <h5 class="page-title">Selamat Datang <?= $get_data_akun_admin['username'] ?> </h5>
                            <ol class="breadcrumb">
                                <li>
                                    <a href="#">Home</a>
                                </li>
                                <li class="active">
                                    Data Pengajuan
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <!-- <h4 class="m-t-0 header-title"><b>Responsive example</b></h4>
                                <p class="text-muted font-13 m-b-30">
                                    Responsive is an extension for DataTables that resolves that problem by optimising the
                                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    table's layout for different screen sizes through the dynamic insertion and removal of
                                    columns from the table.
                                </p> -->
                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Telpon</th>
                                            <th>Terkirim</th>
                                            <th>Pengirim</th>
                                            <th>No Pengirim</th>
                                            <th>Nama Lengkap</th>
                                            <th>No Hp 3G</th>
                                            <th>No Hp Lain</th>
                                            <th>Jam</th>
                                            <th>Tanggal</th>
                                            <th>Alamat</th>
                                            <th>Provinsi</th>
                                            <th>Kota/Kab</th>
                                            <th>Kecamatan</th>
                                            <th>Kelurahan</th>
                                            <th>TAP</th>
                                            <th>Nama PIC</th>
                                            <th>No Hp PIC</th>
                                            <th>Dibuat</th>
                                            <?php
                                            if ($role == "Admin") {
                                                echo "<th>Aksi</th>";
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($data_pengajuan as $dta) { ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <?php
                                                $fullup = $dta['fullup'];
                                                $terkirim = $dta['terkirim'];
                                                $pengirim_id = $dta['pengirim_id'];
                                                if ($fullup == "Belum" && $pengirim_id == null && $terkirim == "Belum") {
                                                    if ($role == "Super") {
                                                        echo "<td class='text-center'> <a type='button' > <span class='label label-table label-danger'>Belum</span></a></td>";
                                                        echo "<td class='text-center'> <span class='label label-table label-danger'>Belum</span></td>";
                                                        echo "<td class='text-center'> <a> - </a> </td>
                                                        <td class='text-center'> - </td>";
                                                    } else {
                                                        echo "<td class='text-center'> <a href='controller.php?fullup=true&id=$dta[id]&value=Sudah' type='button' > <span class='label label-table label-danger'>Belum</span></a></td>";
                                                        echo "<td class='text-center'> <span class='label label-table label-danger'>Belum</span></td>";
                                                        echo "<td class='text-center'> <a> Pilih </a> </td>
                                                        <td class='text-center'> - </td>";
                                                    }
                                                } else if ($fullup == "Sudah" && $pengirim_id == null && $terkirim == "Belum") {
                                                    if ($role == "Super") {
                                                        echo "<td class='text-center'> <a type='button' > <span class='label label-table label-success'>Sudah</span></a></td>";
                                                        echo "<td class='text-center'> <a type='button'> <span class='label label-table label-danger'>Belum</span></a></td>";
                                                        echo "<td class='text-center'> <a> - </a> </td>
                                                        <td class='text-center'> - </td>";
                                                    } else {
                                                        echo "<td class='text-center'> <a href='controller.php?fullup=true&id=$dta[id]&value=Belum' type='button' > <span class='label label-table label-success'>Sudah</span></a></td>";
                                                        echo "<td class='text-center'> <a type='button'> <span class='label label-table label-danger'>Belum</span></a></td>";
                                                        echo "<td class='text-center'> <a data-toggle='modal' data-target='#terkirim-$dta[id]'> Pilih </a> </td>
                                                        <td class='text-center'> - </td>";
                                                    }
                                                } else if ($fullup == "Sudah" && $pengirim_id != null && $terkirim == "Belum") {
                                                    if ($role == "Super") {
                                                        echo "<td class='text-center'> <a type='button' > <span class='label label-table label-success'>Sudah</span></a></td>";
                                                        echo "<td class='text-center'> <a type='button'> <span class='label label-table label-danger'>Belum</span></a></td>";
                                                        echo "<td class='text-center'> <a> $dta[nama_pengirim] </a> </td>
                                                        <td class='text-center'> <a href='tel:$dta[no_hp_pengirim]'> $dta[no_hp_pengirim] </a></td>";
                                                    } else {
                                                        echo "<td class='text-center'> <a type='button' > <span class='label label-table label-success'>Sudah</span></a></td>";
                                                        echo "<td class='text-center'> <a href='controller.php?terkirim=true&id=$dta[id]&value=Sudah' type='button'> <span class='label label-table label-danger'>Belum</span></a></td>";
                                                        echo "<td class='text-center'> <a data-toggle='modal' data-target='#terkirim2-$dta[id]'> $dta[nama_pengirim] </a> </td>
                                                        <td class='text-center'> <a href='tel:$dta[no_hp_pengirim]'> $dta[no_hp_pengirim] </a></td>";
                                                    }
                                                } else if ($fullup == "Sudah" && $pengirim_id != null && $terkirim == "Sudah") {
                                                    echo "<td class='text-center'> <a type='button' > <span class='label label-table label-success'>Sudah</span></a></td>";
                                                    if ($role == "Super") {
                                                        echo "<td class='text-center'> <a type='button'> <span class='label label-table label-success'>Sudah</span></a></td>";
                                                    } else {
                                                        echo "<td class='text-center'> <a href='controller.php?terkirim=true&id=$dta[id]&value=Belum' type='button'> <span class='label label-table label-success'>Sudah</span></a></td>";
                                                    }
                                                    echo "<td class='text-center'> <a > $dta[nama_pengirim] </a> </td>
                                                    <td class='text-center'> <a href='tel:$dta[no_hp_pengirim]'> $dta[no_hp_pengirim] </a></td>";
                                                }
                                                ?>
                                                <td><?= $dta['nama_lengkap'] ?></td>
                                                <td> <a href="tel:<?= $dta['nomor_telpon1'] ?>"><?= $dta['nomor_telpon1'] ?></a> </td>
                                                <td> <a href="tel:<?= $dta['nomor_telpon2'] ?>"><?= $dta['nomor_telpon2'] ?></a> </td>
                                                <td><?= $dta['jam'] ?></td>
                                                <td><?= $dta['tanggal'] ?></td>
                                                <td><?= $dta['alamat'] ?></td>
                                                <td><?= $dta['provinsi'] ?></td>
                                                <td><?= $dta['kota'] ?></td>
                                                <td><?= $dta['kecamatan'] ?></td>
                                                <td><?= $dta['kelurahan'] ?></td>
                                                <?php
                                                $teritori = mysqli_query($conn, "SELECT * FROM tb_teritori_tap WHERE kelurahan = '$dta[kelurahan]'");
                                                $dta_teritori = mysqli_fetch_assoc($teritori);
                                                ?>
                                                <td><?= $dta_teritori['tap'] ?></td>
                                                <td><?= $dta_teritori['nama_pic'] ?></td>
                                                <td><a href="tel:<?= $dta_teritori['no_hp_pic'] ?>"><?= $dta_teritori['no_hp_pic'] ?></a> </td>
                                                <td><?= $dta['created_at'] ?></td>

                                                <?php
                                                if ($role == "Admin") {
                                                    echo "<td class='text-center'> <a type='button' data-toggle='modal' data-target='#hapus-$dta[id]'> <span class='label label-table label-danger'> <i class='fa fa-trash'></i> Hapus</span></a></td>";
                                                }
                                                ?>

                                            </tr>


                                            <!-- MODAL EDIT PENGIRIM -->
                                            <div id="terkirim-<?= $dta['id'] ?>" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title">Pilih Pengirim</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="controller.php" enctype="multipart/form-data">
                                                                <div class="form-group row">
                                                                    <label class="col-sm-3 col-form-label">Kelurahan</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" disabled value="<?= $dta['kelurahan'] ?>" class="nb-edt form-control" required="" autocomplete="off" placeholder="Nama Lengkap" name="nama" id="nama">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-sm-3 col-form-label">Pengirim</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control select2" name="pengirim" id="pengirim" required="">
                                                                            <option>- Pilih -</option>
                                                                            <?php
                                                                            $pengirim = mysqli_query($conn, "SELECT * FROM tb_pengirim");
                                                                            while ($row = mysqli_fetch_assoc($pengirim)) {
                                                                                echo "<option value='$row[id]'>$row[nama] - $row[tap] </option>";
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="hidden" name="terkirim" value="<?= $dta['terkirim'] ?>">
                                                                    <input type="hidden" name="id" value="<?= $dta['id'] ?>">
                                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                                                                    <button type="submit" name="edit_pengirim_pengajuan" class="btn btn-default waves-effect">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- AKHIR MODAL EDIT PENGIRIM -->

                                            <!-- MODAL EDIT PENGIRIM -->
                                            <div id="terkirim2-<?= $dta['id'] ?>" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title">Pilih Pengirim</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="controller.php" enctype="multipart/form-data">
                                                                <div class="form-group row">
                                                                    <label class="col-sm-3 col-form-label">Kelurahan</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" disabled value="<?= $dta['kelurahan'] ?>" class="nb-edt form-control" required="" autocomplete="off" placeholder="Nama Lengkap" name="nama" id="nama">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-sm-3 col-form-label">Pengirim</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control select2" name="pengirim" id="pengirim" required="">
                                                                            <option value="-"> KOSONGKAN </option>
                                                                            <?php
                                                                            $nama_pengirim = $dta['nama_pengirim'];
                                                                            $pengirim = mysqli_query($conn, "SELECT * FROM tb_pengirim");
                                                                            while ($row = mysqli_fetch_assoc($pengirim)) {
                                                                                if ($row['nama'] == $nama_pengirim) {
                                                                                    echo "<option selected value='$row[id]'>$row[nama] - $row[tap] </option>";
                                                                                } else {
                                                                                    echo "<option value='$row[id]'>$row[nama] - $row[tap] </option>";
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="hidden" name="terkirim" value="<?= $dta['terkirim'] ?>">
                                                                    <input type="hidden" name="id" value="<?= $dta['id'] ?>">
                                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                                                                    <button type="submit" name="edit_pengirim_pengajuan2" class="btn btn-default waves-effect">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- AKHIR MODAL EDIT PENGIRIM -->


                                            <!-- MODAL HAPUS -->
                                            <div class="modal fade" tabindex="-1" id="hapus-<?= $dta['id'] ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content bg-inverse">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" style="color: white;">Hapus Data Pengajuan</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p style="color: white;">Anda Yakin Ingin Menghapus Data Pengajuan ?</p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Batal</button>
                                                            <a href="controller.php?hapus_pengajuan=true&id=<?= $dta['id'] ?>" type="button" class="btn btn-outline-dark" style="background-color: white;">Hapus</a>
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
                &copy; 2022 <a href="https://kinarya-solusi.com/">PT. Kinarya Selaras Solusi</a> | Gowa
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

    <script type="text/javascript" src="assets/plugins/multiselect/js/jquery.multi-select.js"></script>
    <script type="text/javascript" src="assets/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
    <script src="assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>


    <script type="text/javascript" src="assets/plugins/autocomplete/jquery.mockjax.js"></script>
    <script type="text/javascript" src="assets/plugins/autocomplete/jquery.autocomplete.min.js"></script>
    <script type="text/javascript" src="assets/plugins/autocomplete/countries.js"></script>
    <script type="text/javascript" src="assets/pages/autocomplete.js"></script>

    <script type="text/javascript" src="assets/pages/jquery.form-advanced.init.js"></script>
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