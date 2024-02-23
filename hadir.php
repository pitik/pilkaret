<?php
include("koneksi.php");
$id = $_GET['id'];
$jumlah = mysqli_query($mysqli, "UPDATE total_antri set jum_antri=jum_antri+1") or die(mysqli_error($mysqli));
$cek = mysqli_query($mysqli, "SELECT * from total_antri");
$ambil = mysqli_fetch_array($cek);
$skr = $ambil[1];
$query = mysqli_query($mysqli, "UPDATE pemilih set status_memilih='Antri', antrian=$skr where id_pemilih='$id' ") or die(mysqli_error($mysqli));

if ($query) {
	echo "<meta http-equiv=refresh content=0;url=?hl=daftarhadir>";
}
