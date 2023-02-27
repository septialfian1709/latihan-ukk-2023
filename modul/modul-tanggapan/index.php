<?php
// SESSION
session_start();
include('../../config/database.php');
if (empty($_SESSION['username'])) {
    @header('location:../modul-auth/index.php');
} else {
    if ($_SESSION['level'] == 'petugas') {
        $id_petugas = $_SESSION['id_petugas'];
    }
}


// hapus
if (isset($_POST['hapus'])) {
    $id_tanggapan = $_POST['id_tanggapan'];
    $q = "DELETE FROM `tanggapann` WHERE id_tanggapan = $id_tanggapan";
    $r = mysqli_query($con, $q);
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php include('../../assets/header.php') ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../../assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include('../../assets/menu.php')
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tanggapan</h3><br>
                                <div class="card">
                                    <div class="card-header">
                                        <button data-toggle="modal" data-target="#modal-lg" class="btn btn-success">buat Tanggapan &nbsp;<i class="fa fa-pen"></i></button>
                                    </div>
                                </div>
                                <div class="modal fade" id="modal-lg">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                Buat Tanggapan
                                            </div>

                                            <div class="modal-body">
                                            <div class="form-group">
                                                <label for="isi_laporan">PILIH ID PETUGAS</label>
                                                  <select name="nim" id="nim" class="form-control" onchange='changeValue(this.value)' required>
                                                  <option value="">choose</option>
                                                       <?php 
                                                        $query=mysqli_query($con, "select * from petugass order by nim asc"); 
                                                        $result = mysqli_query($con, "select * from tanggapann");  
                                                        $jsArray = "var prdName = new Array();\n";
                                                        while ($row = mysqli_fetch_array($result)) {  
                                                        echo '<option name="nim"  value="' . $row['nim'] . '">' . $row['nim'] . '</option>';  
                                                        $jsArray .= "prdName['" . $row['nim'] . "'] = {tanggapann:'" . addslashes($row['tgl_tanggapan']) . "',kode_tuk:'".addslashes($row['tanggapan'])."',nama_tuk:'".addslashes($row[''])."'};\n";
                                                        }
                                                        ?>
                                                        </select>

                                                    <form action="" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="nik" value="">
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="dataTablesNya" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Id Pengaduan</th>
                                                <th>Tanggapan</th>
                                                <th>Petugas</th>
                                            </tr>
                                        </thead>
                                        <?php  ?>
                                        <tbody>
                                            <?php
                                            if ($_SESSION['level'] == 'petugas') {
                                                $q = "SELECT * FROM `tanggapann` WHERE `id_petugas` = $id_petugas";
                                            } else {
                                                $q = "SELECT * FROM `tanggapann`";
                                            }
                                            $r = mysqli_query($con, $q);
                                            $no = 1;
                                            while ($d = mysqli_fetch_object($r)) {
                                            ?>
                                        
                                            <?php $no++;
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 3.2.0
                </div>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
        <?php include('../../assets/footer.php') ?>

</body>

</html>