<?php
	include ("koneksi.php");
	$code = $_GET['code'];
	if($code!='aselole1234jos'){
		echo"<meta http-equiv=refresh content=0;url=?hl=proses>";
	}
	else{
?>

<div class="row">
	<div class="col-lg-12">
		<h1> Hasil Pilkaret </h1>
	</div>
</div>
<hr />

<?php
	$total = mysql_num_rows(mysql_query("SELECT * from pemilih"));
	$hadir = mysql_num_rows(mysql_query("SELECT * from pemilih where status_memilih='Sudah' "));
	$mem = mysql_fetch_array(mysql_query("SELECT * from total_suara"));
	$memilih = $mem['jumlah'];
	$phadir = round(($hadir/$total) * 100);
	$psuara = round(($memilih/$total) * 100);
	$skosong = $phadir - $psuara;
?>

<h2>
Jumlah Suara Masuk &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <b> <?=$memilih?> </b><br>
Jumlah Pemilih yang Hadir : <b> <?=$hadir?> </b><br>
Jumlah Total Pemilih &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b> <?=$total?> </b><br><br>

Persentase Kehadiran : <?=$phadir?> %<br>
Persentase Suara Masuk : <?=$psuara?> %<br>
Persentase Suara Kosong : <?=$skosong?> %<br><br>

<?php
$calon = mysql_query("SELECT * from calon_rt");
$pemenang = '';
$nama_pemenang = '';
$total_pemenang = 0;
$persen_pemenang = 0;
while ($hasil=mysql_fetch_array($calon)){
	$dipilih = $hasil[3];
	$persen = round(($dipilih/$hadir) * 100,2);?>
	<div style="margin-top:5px">
		<div style="margin-bottom:8px">
			Hasil Calon No <?=$hasil[0]?> :

			<input type="button" value="Buka" style="margin: 0px; padding: 0px; width: 55px; font-size: 11px;" onclick="var spoiler = this.parentNode.parentNode.getElementsByTagName('spoilers')[0];
				if ( spoiler.style.display == 'none' ){
					$(spoiler).fadeIn('slow'); this.value = 'Tutup';
				}else{
					$(spoiler).slideUp();
					$(spoiler).fadeOut('slow');
					this.value = 'Buka';
				};" />
			<div style="margin:2px;padding:8px;border:1px inset;background:white;border-radius: 25px;">

				<spoilers style="display:none;">
					<b>Bapak <?=$hasil[1]?> : <?=$hasil[3]?> (<?=$persen?> %)</b><hr style="margin-top:10px;margin-bottom:0px;">
					<div class='progress progress-striped active'>
						<div class='progress-bar progress-bar-info' role='progressbar' aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' style='width: <?=$persen?>%;'>
						</div>
					</div>
				</spoilers>

			</div>
		</div>
	</div>
<?php

	if (($total_pemenang == $dipilih) && $nama_pemenang !== '') {
		$pemenang = 'seri';
		$nama_pemenang =  ''.$nama_pemenang.', Bapak '.$hasil[1].'';
	} else {
		$pemenang = 'tunggal';
		$nama_pemenang = 'Bapak '.$hasil[1].'';
		$total_pemenang = $dipilih;
		$persen_pemenang = $persen;
	}
}
?>
<hr>
<div style="margin-top:5px">
	<div style="margin-bottom:8px">
		Hasilnya :

		<input type="button" value="Show" style="margin: 0px; padding: 0px; width: 55px; font-size: 11px;" onclick="var spoiler = this.parentNode.parentNode.getElementsByTagName('spoilers')[0];
			if ( spoiler.style.display == 'none' ){
				$(spoiler).fadeIn('slow'); this.value = 'Hide';
			}else{
				$(spoiler).slideUp();
				$(spoiler).fadeOut('slow');
				this.value = 'Show';
			};" />
		<div style="margin:2px;padding:8px;border:1px inset;background:white;border-radius: 25px;">

			<spoilers style="display:none;">
				<?php
				if ($pemenang == 'tunggal') {
					echo '<p align="center" style="font-size:24pt;"><b>Pemenang Pilkaret adalah : '.$nama_pemenang.' <br><br>dengan total suara sebanyak '.$total_pemenang.' ('.$persen_pemenang.' %)</b></p>';
				} else if ($pemenang == 'seri') {
					echo '<p align="center" style="font-size:24pt;"><b>Hasil Pemenang Pilkaret Berimbang antara : '.$nama_pemenang.' <br><br>dengan total suara sama sebanyak '.$total_pemenang.' ('.$persen_pemenang.' %)</b></p>';

				}

				?>
			</spoilers>

		</div>
	</div>
</div>

<a style='color:white' href=''>
	<button class="btn btn-success btn-md" >Cetak Laporan Hasil</button>
</a>
<?php
}
?>
