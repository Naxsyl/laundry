<?php
require 'functions.php';
$status = ['baru','proses','selesai','diambil'];
$query = "SELECT transaksi.*,member.nama_member , detail_transaksi.*,outlet.nama_outlet,paket.nama_paket FROM transaksi 
INNER JOIN member ON member.id_member = transaksi.member_id 
INNER JOIN detail_transaksi ON detail_transaksi.transaksi_id = transaksi.id_transaksi 
INNER JOIN outlet ON outlet.id_outlet = transaksi.outlet_id 
INNER JOIN paket ON paket.outlet_id = transaksi.outlet_id WHERE transaksi.id_transaksi=".$_GET['id'];
$data = ambildata($conn,$query);

if(isset($_POST['btn-simpan'])){
    $status = $_POST['status'];
    $query = "UPDATE transaksi SET status = '$status' WHERE id_transaksi =" . $_GET['id'];
    $execute = bisa($conn,$query);
    if($execut == 1){
        $succes = 'true';
        $title = 'Berhasil';
        $message = 'Berhasil mengubah status transaksi';
        $type = 'success';
        header('location: transaksi.php?crud=' .$success.'&msg='. $message .'&type='. $type .'&title='. $title );
    }else{
        echo "Gagal Tambah Data";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/plugins/images/favicon.png">
    <title>Aplikasi Pengelolaan Laundry</title>
    <!-- Bootstrap Core CSS -->
    <link href="../assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="../assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="../assets/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="../assets/plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="../assets/plugins/bower_components/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="../assets/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="../assets/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="../assets/css/colors/default.css" id="theme" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="../assets/DataTables/datatables.min.css"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <br />
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="index.php">
                        <!-- Logo icon image, you can use font-icon also -->
                        <b style="color:black">
                            LAUNDRY
                        </b>
                        <!-- Logo text image you can use text also -->
                        <span class="hidden-xs text-dark">
                            APP
                        </span> 
                    </a>
                </div>
                <!-- /Logo -->
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <a class="nav-toggler open-close waves-effect waves-light hidden-md hidden-lg" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
                    </li>
                    <li>
                        <a class="profile-pic" href="#"> <img src="../assets/plugins/images/users/varun.jpg" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">ADMIN</b></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
                </div>
                <ul class="nav" id="side-menu">
                    <li style="padding: 70px 0 0;">
                        <a href="index.php" class="waves-effect <br />
<b>Warning</b>:  Undefined variable $title in <b>C:\xampp\htdocs\sepdullah\laundry\admin\layout_header.php</b> on line <b>97</b><br />
"><i class="fa fa-tachometer fa-fw" aria-hidden="true"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="outlet.php" class="waves-effect <br />
<b>Warning</b>:  Undefined variable $title in <b>C:\xampp\htdocs\sepdullah\laundry\admin\layout_header.php</b> on line <b>100</b><br />
"><i class="fa fa-suitcase fa-fw" aria-hidden="true"></i> Outlet</a>
                    </li>
                    <li>
                        <a href="paket.php" class="waves-effect <br />
<b>Warning</b>:  Undefined variable $title in <b>C:\xampp\htdocs\sepdullah\laundry\admin\layout_header.php</b> on line <b>103</b><br />
"><i class="fa fa-archive fa-fw" aria-hidden="true"></i> Paket</a>
                    </li>
                    <li>
                        <a href="pengguna.php" class="waves-effect <br />
<b>Warning</b>:  Undefined variable $title in <b>C:\xampp\htdocs\sepdullah\laundry\admin\layout_header.php</b> on line <b>106</b><br />
"><i class="fa fa-user fa-fw" aria-hidden="true"></i> Pengguna</a>
                    </li>
                    <li>
                        <a href="pelanggan.php" class="waves-effect <br />
<b>Warning</b>:  Undefined variable $title in <b>C:\xampp\htdocs\sepdullah\laundry\admin\layout_header.php</b> on line <b>109</b><br />
"><i class="fa fa-users fa-fw" aria-hidden="true"></i> Pelanggan</a>
                    </li>
                    <li>
                        <a href="transaksi.php" class="waves-effect"><i class="fa fa-shopping-cart fa-fw" aria-hidden="true"></i> Transaksi</a>
                    </li>
                    <li>
                        <a href="laporan.php" class="waves-effect <br />
<b>Warning</b>:  Undefined variable $title in <b>C:\xampp\htdocs\sepdullah\laundry\admin\layout_header.php</b> on line <b>115</b><br />
"><i class="fa fa-file-text fa-fw" aria-hidden="true"></i> Laporan</a>
                    </li>
                </ul>
                <div class="center p-20">
                     <a href="logout.php" class="btn btn-danger btn-block waves-effect waves-light">Logout</a>
                 </div>
            </div>
            
        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
               <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper"> 
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Master Transaksi</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="outlet.php">Transaksi</a></li>
                <li><a href="#">Tambah Transaksi</a></li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-6">
                          <a href="javascript:void(0)" onclick="window.history.back();" class="btn btn-primary box-title"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <form method="post" action="">
                <div class="form-group">
                    <label>Kode Invoice</label>
                    <input type="text" name="kode_invoice" class="form-control" readonly="" value="DRY202309250927">
                </div>
                <div class="form-group">
                    <label>Outlet</label>
                    <input type="text" name="username" class="form-control" readonly="" value="Londre Cab. Palapa Pasar Minggu">
                </div>
                <div class="form-group">
                    <label>Pelanggan</label>
                    <input type="text" name="password" class="form-control" readonly="" value="Kailendra Abidzarabbani"> 
                </div>
                <div class="form-group">
                    <label>Jenis Paket</label>
                    <input type="text" name="password" class="form-control" readonly="" value="Paket Hemat Kilat"> 
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input readonly=""   type="text" name="qty" class="form-control" value="3"> 
                </div>
                <div class="form-group">
                    <label>Total Harga</label>
                    <input readonly=""   type="text" name="biaya_tambahan" class="form-control" value="45000"> 
                </div>
                                    <div class="form-group">
                        <label>Total Bayar</label>
                        <input readonly=""   type="text" name="biaya_tambahan" class="form-control" value="100000"> 
                    </div>
                    <div class="form-group">
                        <label>Di Bayar Pada Tanggal </label>
                        <input readonly=""   type="text" name="biaya_tambahan" class="form-control" value="2023-09-25 05:27:58"> 
                    </div>
                                    <div class="form-group">
                        <label>Status Transaksi</label>
                        <select name="status" class="form-control">
                                                                                    <option value="baru">baru</option>
                                                                                    <option value="proses" selected>proses</option>
                                                        <option value="proses">proses</option>
                                                                                    <option value="selesai">selesai</option>
                                                                                    <option value="diambil">diambil</option>
                                                    </select>
                        <small>Klik Tombol Ubah Untuk Menyimpan Perubahan Transaksi</small>
                    </div>
                <div class="text-right">
                    <button type="submit" name="btn-simpan" class="btn btn-primary">Ubah</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<footer class="footer text-center"> 2023 &copy; SMK Pembangunan Jaya YAKAPI </footer>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="../assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="../assets/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="../assets/js/waves.js"></script>
    <!--Counter js -->
    <script src="../assets/plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="../assets/plugins/bower_components/counterup/jquery.counterup.min.js"></script>
    <!-- chartist chart -->
    <script src="../assets/plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
    <script src="../assets/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="../assets/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script type="text/javascript" src="../assets/DataTables/datatables.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../assets/js/dashboard1.js"></script>
    <script src="../assets/js/custom.min.js"></script>
    <script src="../assets/plugins/bower_components/toast-master/js/jquery.toast.js"></script>
    <script>
        $('#btn_hapus').on('click',() => {
            return confirm('Yakin Menghapus data ?');
        });
        $(document).ready( function () {
            $('[data-toggle="tooltip"]').tooltip();
            var t = $('#table').DataTable({
                "columnDefs": [ {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                } ],
                "order": [[ 1, 'asc' ]],
                "language" : {
                    "sProcessing" : "Sedang memproses ...",
                    "lengthMenu" : "Tampilkan _MENU_ data per halaman",
                    "zeroRecord" : "Maaf data tidak tersedia",
                    "info" : "Menampilkan _PAGE_ halaman dari _PAGES_ halaman",
                    "infoEmpty" : "Tidak ada data yang tersedia",
                    "infoFiltered" : "(difilter dari _MAX_ total data)",
                    "sSearch" : "Cari",
                    "oPaginate" : {
                        "sFirst" : "Pertama",
                        "sPrevious" : "Sebelumnya",
                        "sNext" : "Selanjutnya",
                        "sLast" : "Terakhir"
                    }
                }
            });
            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();

            
        } );
        $('#btn-refresh').on('click',() => {
            $('#ic-refresh').addClass('fa-spin');
            var oldURL = window.location.href;
            var index = 0;
            var newURL = oldURL;
            index = oldURL.indexOf('?');
            if(index == -1){
                window.location = window.location.href;
                
            }
            if(index != -1){
                window.location = oldURL.substring(0,index)
            }
            
        });

    </script>

    <br />
</body>

</html>
 