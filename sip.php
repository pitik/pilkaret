<?php
include("koneksi.php");
$id = $_GET['id'];
$wkt = date("H:i:s");
$nama = $_SESSION['username'];
$status = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * from status_bilik where nama='$nama'"));
$hadir = mysqli_num_rows(mysqli_query($mysqli, "SELECT * from pemilih where status_memilih='Sudah'"));
$mem = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * from total_suara"));
$memilih = $mem['jumlah'];
if (($memilih == $hadir) || ($status['kuota'] == 0)) {
	echo '
		<meta http-equiv=refresh content=0;url=?hl=pilih>
		<div class="row" style="margin-right:-10px;">
			<div class="col-lg-12" align="center">
				<p style="font-size:60px; color:black; height:60px; padding-top:80px;">
				<b> Tunggu Sebentar !</b> <br><br><br>
				Menunggu pemilih hadir terlebih dahulu.
				</p>
			</div>
		</div>

			';
} else {
	$jumlah = mysqli_query($mysqli, "UPDATE total_suara set jumlah=jumlah+1") or die(mysqli_error($mysqli));
	$update = mysqli_query($mysqli, "UPDATE calon_rt set jumlah_suara=jumlah_suara+1 where no_urut=$id") or die(mysqli_error($mysqli));
	$uplik = mysqli_query($mysqli, "UPDATE status_bilik set status=2, kuota=kuota-1 where nama='$nama'") or die(mysqli_error($mysqli));
	if ($jumlah && $update && $uplik) {
		echo "<meta http-equiv=refresh content=0;url=?hl=terimakasih>";
	}
}
