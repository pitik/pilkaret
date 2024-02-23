<?php
error_reporting(0);
include('ceklogin.php');
?>
<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]> <!-->
<html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>
	<meta charset="UTF-8" />
	<title> Sistem E-Voting Pilkaret Teluk </title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="Sistem Informasi Pool Kendaraan Operasional PT. TASPEN Jakarta" name="description" />
	<meta content="alfan | irfan" name="author" />

	<!-- STYLE -->
	<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="assets/css/custom.css" />
	<link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
	<link rel="stylesheet" href="assets/css/font-awesome.css" />
	<!-- END STYLE -->

	<!-- ICON WEBSITE -->
	<link rel="shortcut icon" href="assets/img/logopil.ico">
	<!-- END ICON -->

</head>
<!-- END HEAD -->
<script type="text/javascript">
	//set timezone
	<?php date_default_timezone_set('Asia/Jakarta'); ?>
	//buat object date berdasarkan waktu di server
	var serverTime = new Date(<?php print date('Y, m, d, H, i, s, 0'); ?>);
	//buat object date berdasarkan waktu di client
	var clientTime = new Date();
	//hitung selisih
	var Diff = serverTime.getTime() - clientTime.getTime();
	//fungsi displayTime yang dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
	function displayServerTime() {
		//buat object date berdasarkan waktu di client
		var clientTime = new Date();
		//buat object date dengan menghitung selisih waktu client dan server
		var time = new Date(clientTime.getTime() + Diff);
		//ambil nilai jam
		var sh = time.getHours().toString();
		//ambil nilai menit
		var sm = time.getMinutes().toString();
		//ambil nilai detik
		var ss = time.getSeconds().toString();
		//tampilkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
		document.getElementById("clock").innerHTML = (sh.length == 1 ? "0" + sh : sh) + ":" + (sm.length == 1 ? "0" + sm : sm) + ":" + (ss.length == 1 ? "0" + ss : ss);
	}
</script>
<?php
function hari($hari)
{
	switch ($hari) {
		case 0:
			$hari = "Minggu";
			break;
		case 1:
			$hari = "Senin";
			break;
		case 2:
			$hari = "Selasa";
			break;
		case 3:
			$hari = "Rabu";
			break;
		case 4:
			$hari = "Kamis";
			break;
		case 5:
			$hari = "Jum'at";
			break;
		case 6:
			$hari = "Sabtu";
			break;
	}
	return $hari;
}
?>
<?php
function DateToIndo($date)
{ // fungsi atau method untuk mengubah tanggal ke format indonesia
	// variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
	$BulanIndo = array(
		"Januari", "Februari", "Maret",
		"April", "Mei", "Juni",
		"Juli", "Agustus", "September",
		"Oktober", "November", "Desember"
	);
	$tgl   = substr($date, 0, 2); // memisahkan format tanggal menggunakan substring	
	$bulan = substr($date, 3, 2); // memisahkan format bulan menggunakan substring	
	$tahun = substr($date, 6, 4); // memisahkan format tahun menggunakan substring

	$result = $tgl . " " . $BulanIndo[(int)$bulan - 1] . " " . $tahun;
	return ($result);
}
?>
<!-- BODY -->

<body onload="setInterval('displayServerTime()', 1000);">
	<div id="wrapper">
		<header class="modal-header" style="background:url(assets/img/bak.jpg);">
			<div style="height:80px;padding-right:20px;">
				<div style="position:inherit; float:left">
					<img src="assets/img/logop.png" class="user-image img-responsive" />
				</div>
				<div style="float:left; padding-left:25px;">
					<h2 style="color:black;"><b>Sistem e-Voting Pilkaret<br>
							Pemilihan Ketua RT 04 RW 09 Perumahan Teluk</b></h2>
				</div>
				<div style="position:inherit; float:right">
					<a style="color:white;" class="dateset"><?php print hari(date('w')); ?>, <?php print DateToIndo(date('d-m-Y')); ?> ~ <span id="clock"><?php print date('H:i:s'); ?></span> </a>
					&nbsp;&nbsp;&nbsp;&nbsp; <label style="color:white;">
						<?php
						if ($_SESSION['username'] == "") {
							echo "None";
						} else {
							echo $_SESSION['username'];
						}
						?>
					</label>
					<!--
			<a href="index.php?hl=logout" style="color:#FFFFFF">
				<button type="button" class="btn btn-sm btn-embossed btn-primary">
			<i class="icon-signout icon-white"></i> Keluar</button></a>
			-->
				</div>
			</div>
		</header>
		<div style="padding:1px; background-color:#036"></div>
		<div id="page-inner">
			<div id="content">
				<?php
				if ($_GET['hl'] == "") {
					$halaman = "pilih";
					include "$halaman.php";
				} else {
					$halaman = $_GET['hl'];
					include "$halaman.php";
				}
				?>
			</div>
		</div>
</body>
<!-- END BODY -->

<!-- SCRIPT -->
<script src="assets/plugins/jquery-2.0.3.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<!-- END SCRIPT -->
<!-- PAGE LEVEL SCRIPTS -->
<script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
<script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="assets/plugins/jasny/js/bootstrap-fileupload.js"></script>
<script src="assets/plugins/jasny/js/bootstrap-inputmask.js"></script>
<script src="assets/plugins/validationengine/js/jquery.validationEngine.js"></script> <!-- anyar gan -->
<script src="assets/plugins/validationengine/js/languages/jquery.validationEngine-id.js"></script> <!-- anyar gan -->
<script src="assets/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script> <!-- anyar gan -->
<script src="assets/js/validationInit.js"></script> <!-- anyar gan -->


<script>

</script>

<!-- END PAGE LEVEL SCRIPTS -->

</html>