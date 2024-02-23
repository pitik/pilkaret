<?php
error_reporting(0);
include("koneksi.php");
if ($_GET['tipe'] == "print") {
	echo '<script>
			window.load = cetak();
			function cetak(){
				window.print();
			}
			</script>';
}
$sql = mysqli_query($mysqli, "SELECT * from pemilih");
?>

<html>

<head>
	<title>Cetak Kartu Pemilih</title>
	<style>
		body {
			font-family: "Times New Roman";
			height: 35, 56cm;
			width: 21, 59cm;
		}

		p.u {
			margin-top: 2.2cm;
			margin-left: 0.3cm;
			margin-bottom: 0cm;
			position: absolute;
		}

		table.kartu {
			border-collapse: collapse;
			width: 7.2cm;
			margin-top: 2.8cm;
			margin-left: 0.6cm;
			margin-bottom: 0.4cm;
			position: absolute;
		}

		td.kartu {
			font-size: 10pt;
			vertical-align: top;
		}

		p.nb {
			font-size: 10pt;
			margin-top: 4.9cm;
			margin-left: 0.3cm;
			position: absolute;
		}

		div.b {
			background: url(assets/img/kartu.png);
			height: 6cm;
			width: 8.43cm;
			float: left;
			border-collapse: collapse;
			position: relative;
			margin-right: 0.25cm;
			margin-bottom: 0.30cm;
		}

		div.a {
			display: block !important;
			background: url(assets/img/kartu.png);
			height: 6cm;
			width: 8.43cm;
			float: left;
			border-collapse: collapse;
			position: relative;
			margin-right: 0.25cm;
			margin-bottom: 0.23cm;
			/* kalo mau legal margin-bottom: 0.23cm A4 margin-bottom:1.05cm */
		}
	</style>
</head>

<body>

	<table style="border-collapse: collapse; page-break-after: auto;" align="center">
		<?php
		$i = 1;
		while ($hasil = mysqli_fetch_array($sql)) {
			if ($i % 2 == 1) {
				echo "
			<tr style='border-collapse: collapse; page-break-inside: avoid; page-break-after: auto;'>
			<td style='border-collapse: collapse; page-break-inside: avoid; page-break-after: auto;'>
			<div class=a>
			<p class=u><b>UNDANGAN(wajib dibawa)</b></p>
			<table class='kartu' align=left>
			<thead>
				<tr>
					<td class='kartu' width=128px><b>Nama</b></td><td width=10px><b>:</b></td><td width=300px><b>$hasil[1]</b></td>
				</tr>
				<tr>
					<td class='kartu' width=128px>Jenis Kelamin</td><td width=10px>:</td><td width=300px>$hasil[2]</td>
				</tr>
				<tr>
					<td class='kartu' width=128px>Alamat</td><td width=10px>:</td><td width=300px>$hasil[3]</td>
				</tr>
			</thead>
			</table>
			<p class=nb>Hadir untuk memberikan suara pada, Hari <b>Minggu</b> <br>
			Tanggal <b>13 Desember 2015</b> Jam <b>07.00-11.00</b> WIB.</p>
			</div>
			</td>
			";
			} else if ($i % 2 == 0) {
				echo "
			<td style='border-collapse: collapse; page-break-inside: avoid; page-break-after: auto;'>
			<div class=a>
			<p class=u><b><u>UNDANGAN</u> (wajib dibawa)</b></p>
			<table class='kartu' align=left>
			<thead>
				<tr>
					<td class='kartu' width=128px><b>Nama</b></td><td width=10px><b>:</b></td><td width=300px><b>$hasil[1]</b></td>
				</tr>
				<tr>
					<td class='kartu' width=128px>Jenis Kelamin</td><td width=10px>:</td><td width=300px>$hasil[2]</td>
				</tr>
				<tr>
					<td class='kartu' width=128px>Alamat</td><td width=10px>:</td><td width=300px>$hasil[3]</td>
				</tr>
			</thead>
			</table>
			<p class=nb>Hadir untuk memberikan suara pada, Hari <b>Minggu</b> <br>
			Tanggal <b>13 Desember 2015</b> Jam <b>07.00-11.00</b> WIB.</p>
			</div>
			</td>
			</tr>
			";
				$i = 0;
			}
			$i++;
		}
		?>
	</table>

</body>

</html>
<meta http-equiv=refresh content=0;url=index.php?hl=pemilih>