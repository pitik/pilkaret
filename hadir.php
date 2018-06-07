<?php 
include("koneksi.php");
$id = $_GET['id'];
$jumlah = mysql_query("update total_antri set jum_antri=jum_antri+1")or die (mysql_error());
$cek = mysql_query("select * from total_antri");
$ambil = mysql_fetch_array($cek);
$skr = $ambil[1];
$query = mysql_query("update pemilih set status_memilih='Antri', antrian=$skr where id_pemilih='$id' ") or die(mysql_error());

if ($query) {
	echo "<meta http-equiv=refresh content=0;url=?hl=daftarhadir>";
}
	
?>