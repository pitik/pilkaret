<?php
	include ("koneksi.php");
	$code = $_GET['code'];
	if($code!='pastibisadong'){
		echo"<meta http-equiv=refresh content=0;url=index.php>";
	}
	else{
		$query = mysql_query("update pemilih set antrian=NULL, status_memilih='Belum'") or die(mysql_error());
		$query = mysql_query("update calon_rt set jumlah_suara=0") or die(mysql_error());
		$query = mysql_query("update total_antri set jum_antri=0") or die(mysql_error());
		$query = mysql_query("update total_suara set jumlah=0") or die(mysql_error());
		$query = mysql_query("delete from status_bilik") or die(mysql_error());
		echo"<meta http-equiv=refresh content=0;url=index.php>";
	}
?>