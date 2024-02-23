<?php
include("koneksi.php");
$id = $_GET['id'];
$cek1 = mysqli_num_rows(mysqli_query($mysqli, "SELECT * from status_bilik"));
$cek2 = mysqli_num_rows(mysqli_query($mysqli, "SELECT * from status_bilik where status=0"));
if ($cek1 == 0) {
	echo "<meta http-equiv=refresh content=0;url=?hl=daftarantri&error=1>";
} else if ($cek2 == 0) {
	echo "<meta http-equiv=refresh content=0;url=?hl=daftarantri&error=2>";
} else {
	$query = mysqli_query($mysqli, "UPDATE pemilih set status_memilih='Sudah' where id_pemilih='$id' ") or die(mysqli_error($mysqli));
	$order = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * from status_bilik where status=0 order by nama asc,kuota asc limit 1"));
	$setor = mysqli_query($mysqli, "UPDATE status_bilik set kuota=kuota+1 where nama='$order[nama]'") or die(mysqli_error($mysqli));
	$bil = $order['nama'];
	$angka = substr($bil, 6, 1);
	if ($query) {
		echo "<meta http-equiv=refresh content=0;url=?hl=daftarantri&bilik=" . $angka . ">";
	}
}
