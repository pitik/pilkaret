<?php
include("koneksi.php");

?>

<div class="row">
	<div class="col-lg-12">
		<h1> Proses Pilkaret </h1>
	</div>
</div>
<hr />

<?php
$total = mysqli_num_rows(mysqli_query($mysqli, "SELECT * from pemilih"));
$hadir = mysqli_num_rows(mysqli_query($mysqli, "SELECT * from pemilih where status_memilih='Antri' or  status_memilih='Sudah'"));
$mem = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * from total_suara"));
$memilih = $mem['jumlah'];
$phadir = round(($hadir / $total) * 100, 2);
$psuara = round(($memilih / $total) * 100, 2);
$skosong = $phadir - $psuara;
$skosong = round($skosong, 2);
?>

<h2>
	Jumlah Suara Masuk &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <b> <?= $memilih ?> </b><br>
	Jumlah Pemilih yang Hadir : <b> <?= $hadir ?> </b><br>
	Jumlah Total Pemilih &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b> <?= $total ?> </b><br><br>

	<b>Persentase Kehadiran : <?= $phadir ?> %</b><br>
</h2>

<div class="progress progress-striped active">
	<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?= $phadir ?>%;">
	</div>
</div>
<br>
<h2>
	<b>Persentase Suara Masuk : <?= $psuara ?> %</b>(Warna Biru)<br>
	<b>Persentase Suara Kosong : <?= $skosong ?> %</b>(Warna Merah)
	<br>

	<div class="progress progress-striped active">
		<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?= $psuara ?>%;">
		</div>
		<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?= $skosong ?>%;">
		</div>
	</div>
	<br>
	<?php
	// nantinya bisa di set seperlunya
	$hari_pemilihan = DateToIndo(date('d-m-Y'));
	$jam_selesai_pemilihan = date('H:i:s');
	if (($psuara == 100) || (((DateToIndo(date('d-m-Y')) == $hari_pemilihan)) && (date('H:i:s') >= $jam_selesai_pemilihan))) {
		echo "
		<a style='color:white' href='index.php?hl=akhir&code=aselole1234jos'>
			<button class='btn btn-success btn-md' >Hasil Pilkaret</button>
		</a>";
	}
	?>

	<meta http-equiv=refresh content=10;url=?hl=proses>