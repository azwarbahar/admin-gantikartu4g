<?php

function plugins()
{ ?>
    <link rel="stylesheet" href="assets/plugins/bootstrap-more/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/dist/css2/components.css">
    <script src="assets/dist/jquery.min.js"></script>
    <script src="assets/dist/sweetalert/sweetalert.min.js"></script>
    <?php }

require_once 'koneksi.php';

if (!isset($_SESSION['login_super'])) {
    if (!isset($_SESSION['login_admin'])) {
        header("location: login.php");
    }
}

// SUBMIT ADMIN
if (isset($_POST['submit_tambah_admin'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $default_password = "passwordadmin123";
    $password = password_hash($default_password, PASSWORD_DEFAULT);
    $no_hp = $_POST['no_hp'];
    $role = "Admin";
    $bagian = "SBP";
    $cluster = $_POST['cluster'];
    $tap = $_POST['tap'];
    $status = "Active";


    // TAMBAH DATA
    $query = "INSERT INTO tb_admin VALUES (NULL, '$nama', '$username', '$password', '$no_hp','$role',
                                            '$bagian', '$cluster', '$tap', '$status', NULL, NULL)";
    mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) > 0) {
        plugins(); ?>
        <script>
            $(document).ready(function() {
                swal({
                    title: 'Berhasil',
                    text: 'Data Admin Berhasil ditambah!',
                    icon: 'success'
                }).then((data) => {
                    location.href = 'administrator.php';
                });
            });
        </script>
    <?php }
}

// SUBMIT SUPER ADMIN
if (isset($_POST['submit_tambah_super_admin'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $default_password = "passwordadmin123";
    $password = password_hash($default_password, PASSWORD_DEFAULT);
    $no_hp = $_POST['no_hp'];
    $role = "Super";
    $bagian = $_POST['bagian'];
    $cluster = $_POST['cluster'];
    $status = "Active";


    // TAMBAH DATA
    $query = "INSERT INTO tb_admin VALUES (NULL, '$nama', '$username', '$password', '$no_hp','$role',
                                            '$bagian', '$cluster', NULL, '$status', NULL, NULL)";
    mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) > 0) {
        plugins(); ?>
        <script>
            $(document).ready(function() {
                swal({
                    title: 'Berhasil',
                    text: 'Data Admin Berhasil ditambah!',
                    icon: 'success'
                }).then((data) => {
                    location.href = 'administrator.php';
                });
            });
        </script>
    <?php }
}

// UPDATE ADMIN
if (isset($_POST['edit_admin'])) {

    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $no_hp = $_POST['no_hp'];
    $status = $_POST['status'];
    if (isset($_POST['cb_reset_pass-' . $id])) {

        $default_password = "passwordadmin123";
        $password = password_hash($default_password, PASSWORD_DEFAULT);

        $query = "UPDATE tb_admin SET nama = '$nama',
                                        username = '$username',
                                        password = '$password',
                                        divisi = '$no_hp',
                                        status = '$status' WHERE id = '$id'";
    } else {
        $query = "UPDATE tb_admin SET nama = '$nama',
                                        username = '$username',
                                        telpon = '$no_hp',
                                        status = '$status' WHERE id = '$id'";
    }

    mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) > 0) {
        plugins(); ?>
        <script>
            $(document).ready(function() {
                swal({
                    title: 'Berhasil',
                    text: 'Data Admin berhasil diubah',
                    icon: 'success'
                }).then((data) => {
                    location.href = 'administrator.php';
                });
            });
        </script>
    <?php }
}

// HAPUS ADMIN
if (isset($_GET['hapus_admin'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM tb_admin WHERE id = '$id'";
    mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) > 0) {
        plugins(); ?>
        <script>
            $(document).ready(function() {
                swal({
                    title: 'Berhasil Dihapus',
                    text: 'Data Admin berhasil dihapus',
                    icon: 'success'
                }).then((data) => {
                    location.href = 'administrator.php';
                });
            });
        </script>
    <?php }
}

// SUBMIT PENGIRIM
if (isset($_POST['submit_tambah_pengirim'])) {
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $divisi = $_POST['divisi'];
    $tap = $_POST['tap'];


    // TAMBAH DATA
    $query = "INSERT INTO tb_pengirim VALUES (NULL, '$nama', '$no_hp', '$divisi', '$tap')";
    mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) > 0) {
        plugins(); ?>
        <script>
            $(document).ready(function() {
                swal({
                    title: 'Berhasil',
                    text: 'Data Pengirim Berhasil ditambah!',
                    icon: 'success'
                }).then((data) => {
                    location.href = 'pengirim.php';
                });
            });
        </script>
    <?php }
}

// UPDATE PENGIRIM
if (isset($_POST['submit_edit_pengirim'])) {

    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $divisi = $_POST['divisi'];
    $tap = $_POST['tap'];
    $query = "UPDATE tb_pengirim SET nama = '$nama',
                                no_hp = '$no_hp',
                                divisi = '$divisi',
                                tap = '$tap' WHERE id = '$id'";

    mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) > 0) {
        plugins(); ?>
        <script>
            $(document).ready(function() {
                swal({
                    title: 'Berhasil',
                    text: 'Data Pengirim berhasil diubah',
                    icon: 'success'
                }).then((data) => {
                    location.href = 'pengirim.php';
                });
            });
        </script>
    <?php }
}

// HAPUS PENGIRIM
if (isset($_GET['hapus_pengirim'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM tb_pengirim WHERE id = '$id'";
    mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) > 0) {
        plugins(); ?>
        <script>
            $(document).ready(function() {
                swal({
                    title: 'Berhasil Dihapus',
                    text: 'Data Pengirim berhasil dihapus',
                    icon: 'success'
                }).then((data) => {
                    location.href = 'pengirim.php';
                });
            });
        </script>
    <?php }
}

// FULLUP PENGAJUAN
if (isset($_GET['fullup'])) {

    $id = $_GET['id'];
    $value = $_GET['value'];
    $query = "UPDATE tb_pengajuans SET fullup = '$value' WHERE id ='$id'";

    mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) > 0) {
        plugins(); ?>
        <script>
            $(document).ready(function() {
                swal({
                    title: 'Success..',
                    text: 'Berhasil Mengupdate Data..',
                    icon: 'success'
                }).then((data) => {
                    location.href = 'index.php';
                });
            });
        </script>
    <?php }
}

// TERKIRIM PENGAJUAN
if (isset($_GET['terkirim'])) {

    $id = $_GET['id'];
    $value = $_GET['value'];
    $query = "UPDATE tb_pengajuans SET terkirim = '$value' WHERE id ='$id'";

    mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) > 0) {
        plugins(); ?>
        <script>
            $(document).ready(function() {
                swal({
                    title: 'Success..',
                    text: 'Berhasil Mengupdate Data..',
                    icon: 'success'
                }).then((data) => {
                    location.href = 'index.php';
                });
            });
        </script>
    <?php }
}

// PENGIRIMAN PENGAJUAN
if (isset($_POST['edit_pengirim_pengajuan'])) {

    // $value_terkirim = "";
    $id = $_POST['id'];
    $pengirim_id = $_POST['pengirim'];
    // $terkirim = $_POST['terkirim'];

    // if ($terkirim == "Sudah") {
    //     $value_terkirim = "Belum";
    // } else {
    //     $value_terkirim = "Sudah";
    // }

    $get_pengirim = mysqli_query($conn, "SELECT * FROM tb_pengirim WHERE id='$pengirim_id' ");
    $data_get_pengirim = mysqli_fetch_assoc($get_pengirim);

    $query = "UPDATE tb_pengajuans SET pengirim_id = '$pengirim_id',
                                        nama_pengirim = '$data_get_pengirim[nama]',
                                        no_hp_pengirim = '$data_get_pengirim[no_hp]' WHERE id ='$id'";
    // $query = "UPDATE tb_pengajuans SET terkirim = '$value_terkirim',
    //                                     pengirim_id = '$pengirim_id',
    //                                     nama_pengirim = '$data_get_pengirim[nama]',
    //                                     no_hp_pengirim = '$data_get_pengirim[no_hp]' WHERE id ='$id'";

    mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) > 0) {
        plugins(); ?>
        <script>
            $(document).ready(function() {
                swal({
                    title: 'Success..',
                    text: 'Berhasil Mengupdate Data..',
                    icon: 'success'
                }).then((data) => {
                    location.href = 'index.php';
                });
            });
        </script>
    <?php }
}

// PENGIRIMAN PENGAJUAN 2
if (isset($_POST['edit_pengirim_pengajuan2'])) {

    // $value_terkirim = "";
    $id = $_POST['id'];
    $pengirim_id = $_POST['pengirim'];
    // $terkirim = $_POST['terkirim'];

    if ($pengirim_id == "-") {

        $query = "UPDATE tb_pengajuans SET pengirim_id = NULL,
                                            nama_pengirim = NULL,
                                            no_hp_pengirim = NULL WHERE id ='$id'";
    } else {
        $get_pengirim = mysqli_query($conn, "SELECT * FROM tb_pengirim WHERE id='$pengirim_id' ");
        $data_get_pengirim = mysqli_fetch_assoc($get_pengirim);

        $query = "UPDATE tb_pengajuans SET pengirim_id = '$pengirim_id',
                                            nama_pengirim = '$data_get_pengirim[nama]',
                                            no_hp_pengirim = '$data_get_pengirim[no_hp]' WHERE id ='$id'";
    }

    // $query = "UPDATE tb_pengajuans SET terkirim = '$value_terkirim',
    //                                     pengirim_id = '$pengirim_id',
    //                                     nama_pengirim = '$data_get_pengirim[nama]',
    //                                     no_hp_pengirim = '$data_get_pengirim[no_hp]' WHERE id ='$id'";

    mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) > 0) {
        plugins(); ?>
        <script>
            $(document).ready(function() {
                swal({
                    title: 'Success..',
                    text: 'Berhasil Mengupdate Data..',
                    icon: 'success'
                }).then((data) => {
                    location.href = 'index.php';
                });
            });
        </script>
<?php }
}

?>