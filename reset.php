<?php
include("koneksi.php");
$code = $_GET['code'];
if ($code != 'pastibisadong') {
	echo "<meta http-equiv=refresh content=0;url=index.php>";
} else {
	$query = mysqli_query($mysqli, "UPDATE pemilih set antrian=NULL, status_memilih='Belum'") or die(mysqli_error($mysqli));
	$query = mysqli_query($mysqli, "UPDATE calon_rt set jumlah_suara=0") or die(mysqli_error($mysqli));
	$query = mysqli_query($mysqli, "UPDATE total_antri set jum_antri=0") or die(mysqli_error($mysqli));
	$query = mysqli_query($mysqli, "UPDATE total_suara set jumlah=0") or die(mysqli_error($mysqli));
	$query = mysqli_query($mysqli, "UPDATE status_bilik set status=0, kuota=0") or die(mysqli_error($mysqli));
	echo "<meta http-equiv=refresh content=0;url=index.php>";
}
