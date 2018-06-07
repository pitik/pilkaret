<?php
	include ("koneksi.php");
	$code = $_GET['code'];
	if($code!='pastibisadong'){
		echo"<meta http-equiv=refresh content=0;url=index.php>";
	}
	else{
		$query = mysql_query("UPDATE pemilih set antrian=NULL, status_memilih='Belum'") or die(mysql_error());
		$query = mysql_query("UPDATE calon_rt set jumlah_suara=0") or die(mysql_error());
		$query = mysql_query("UPDATE total_antri set jum_antri=0") or die(mysql_error());
		$query = mysql_query("UPDATE total_suara set jumlah=0") or die(mysql_error());
		$query = mysql_query("UPDATE status_bilik set status=0, kuota=0") or die(mysql_error());
		echo"<meta http-equiv=refresh content=0;url=index.php>";
	}
?>
