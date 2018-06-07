<?php
	include ("koneksi.php");
	$id = $_GET['id'];
	$nama=$_SESSION['username'];
	$status = mysql_fetch_array(mysql_query("SELECT * from status_bilik where nama='$nama'"));
	$hadir = mysql_num_rows(mysql_query("SELECT * from pemilih where status_memilih='Sudah'"));
	$mem = mysql_fetch_array(mysql_query("SELECT * from total_suara"));
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
?>

<div class="row" style="margin-right:-10px;">
	<div class="col-lg-12" align="center">
		<h2><b> Konfirmasi :</b> <br>
		Apakah anda yakin memilih <b>GAMBAR Calon Ketua RT</b> ini?</h2>
	</div>
</div>
<br>
<div  align="center" class="row" style="margin-right:-10px; text-align:center">
	<div class="col-lg-12" style="padding-left:250px;">
		<?php
		$calon=mysql_query("SELECT * from calon_rt where no_urut=$id")or die (mysql_error());
		while ($hasil=mysql_fetch_array($calon)){
			echo"
			<div align='center' class='col-md-3' style='border:5px ridge; margin:30px; padding-right:0px; padding-left:0px; background: url(assets/img/latar.png);' >
			<h3> <b>Calon No $hasil[0]</b> </h3><hr>
			<img src='foto/$hasil[2]' width='250px' height='250px' class='img-thumbnail'/>
			<h2> $hasil[1]</h2>
			</div>
			";
		}
		?>
		<div class="col-md-6" style="padding-top:150px; color:black;">
			<a style='text-decoration:none;' href='bilik.php?hl=sip&id=<?=$id?>'>
			<button type="button" class="btn btn-success"><p style="font-size:120px; color:black; height:100px; padding-top:60px;">
			&nbsp;<b>Ya</b>&nbsp;<p></button>
			</a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a style='text-decoration:none;' href='bilik.php?hl=pilih'>
			<button type="button" class="btn btn-danger"><p style="font-size:40px; color:black; height:60px; padding-top:35px;">
			&nbsp Tidak &nbsp;<p></button>
			</a>
		</div>
	</div>
</div>
<meta http-equiv=refresh content=5>
<?php
	}
?>
