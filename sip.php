<?php
	include ("koneksi.php");
	$id = $_GET['id'];
	$wkt=date("H:i:s");
	$nama=$_SESSION['username'];
	$status = mysql_fetch_array(mysql_query("select * from status_bilik where nama='$nama'"));
	$hadir = mysql_num_rows(mysql_query("select * from pemilih where status_memilih='Sudah'"));
	$mem = mysql_fetch_array(mysql_query("select * from total_suara"));
	$memilih = $mem['jumlah'];
	if (($memilih == $hadir) || ($status['kuota']==0) ){
		echo'
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
	}else {
		$jumlah = mysql_query("update total_suara set jumlah=jumlah+1")or die (mysql_error());
		$update = mysql_query("update calon_rt set jumlah_suara=jumlah_suara+1 where no_urut=$id")or die (mysql_error());
		$uplik = mysql_query("update status_bilik set status=2, kuota=kuota-1 where nama='$nama'")or die (mysql_error());
		if ($jumlah && $update && $uplik){
			echo "<meta http-equiv=refresh content=0;url=?hl=terimakasih>";
		}
	}
?>