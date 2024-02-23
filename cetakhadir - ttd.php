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
$sql = mysqli_query($mysqli, "SELECT * from pemilih order by nama asc");
?>

<html>

<head>
	<title>Daftar Hadir Pemilih</title>
	<style>
		body {
			font-family: "Times New Roman";
			height: 35, 56cm;
			width: 21, 59cm;
		}

		table {
			border-collapse: collapse;
			width: 19cm;
		}

		th {
			font-size: 11pt;
		}

		tr {
			border-collapse: collapse;
		}

		td {
			border-collapse: collapse;
			font-size: 10pt;
			height: 25px;
		}
	</style>
</head>

<body>
	<p style="font-size:14pt;" class="header" align=center>
		<b> DAFTAR HADIR PEMILIH </b><br>
		<b> PILKARET RT 04 RW 09 </b><br>
		<b> PERUMAHAN TELUK </b><br>
	<p>
	<table style="border: 1px solid black; border-spacing: 0px;" border="1" align="center">
		<thead>
			<tr style="background-color:#b7b7b7">
				<th>No</th>
				<th>Nama</th>
				<th width=100px>Jenis Kelamin</th>
				<th>Alamat</th>
				<th colspan=2 width=150px>Tanda Tangan</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			while ($hasil = mysqli_fetch_array($sql)) {
				echo "<tr>
		<td align=center>$no</td>
		<td style='text-indent:5px'>$hasil[1]</td>
		<td style='text-indent:5px'>$hasil[2]</td>
		<td style='text-indent:5px'>$hasil[3]</td>";
				if ($no % 2 == 0) {
					echo "<td style='text-indent:95px'> $no. </td>";
				} else {
					echo "<td style='text-indent:5px'> $no. </td>";
				}
				$no++;
			}

			?>
		</tbody>
	</table>

</body>

</html>
<meta http-equiv=refresh content=0;url=index.php?hl=pemilih>