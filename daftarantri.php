<?php
	include ("koneksi.php");
?>

<div class="row">
	<div class="col-lg-6">
		<h1> Daftar Antrian </h1>
	<hr>
	</div>
	<div class="col-lg-4">
	<?php
	if (!empty($_GET['error'])) {
		echo '<div class="alert alert-danger alert-dismissable" >';
		echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>';
		if ($_GET['error'] == 1) {
			echo 'Belum ada bilik aktif!';
		}else if ($_GET['error'] == 2) {
			echo 'Bilik Penuh, tunggu sebentar!';
		}
		echo '</h4></div>';
	}
	if (!empty($_GET['bilik'])) {
		echo '<div class="alert alert-success alert-dismissable" >';
		echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>';
		echo 'Antrian masuk <b>Bilik ';
		echo $_GET['bilik'];
		echo '</b>!</h4></div>';
	}
	?>
	</div>
</div>
<div class="row">
    <div class="col-lg-12">
     	<div class="panel panel-default">
			<div class="panel-body">
				<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
						<tbody>
						<?php
						$tot = mysql_query("SELECT * from total_antri");
						$ambil = mysql_fetch_array($tot);
						$antri=mysql_query("SELECT * from pemilih where antrian>0 and status_memilih='Antri' order by antrian asc ")or die (mysql_error());
						$hasil=mysql_fetch_array($antri);
						if (($cek=mysql_num_rows($antri))==0){
							echo "<tr>
									<td width=120px align=center style='vertical-align:center'><b> Total Antrian</b><br><h2> $ambil[1]</td>
									<td align=center> <h2>Belum ada yang antri.</h2></td>
									<tr>";
						}else{

						?>
						<tr>
							<td width=150px rowspan=3 align=center style="vertical-align:center"><b>Antrian</b><br><h2><?=$hasil[4]?></td>
							<td><?=$hasil[1]?></td>
							<?php
							$an=$hasil[4]-1;
							?>
							<td width=120px rowspan=3 align=center style="vertical-align:center"><b> Total Antrian</b><br><h2><?=$an?>/<?=$ambil[1]?></td>
							<td width=250px rowspan=3 align=center style="vertical-align:center">
							<a href='index.php?hl=masuk&id=<?=$hasil[0]?>'>
								<button class="btn btn-primary btn-md" style="margin-top:20px;"><h4>Pemilih Selanjutnya</h4></button>
							</a>
							</td>
						</tr>
						<tr>
							<td><?=$hasil[2]?></td>
						</tr>
						<tr>
							<td><?=$hasil[3]?></td>
						</tr>
						<?php
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
     	<div class="panel panel-default">
			<div class="panel-body">
				<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover" id="dataAntri">
						<thead>
						<tr>
							<th width=10%>No Antrian</th>
							<th>Nama</th>
							<th width='100px'>Jenis Kelamin</th>
							<th>Alamat</th>
							<th width=10%>Status</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$i=1;

						$hadir=mysql_query("SELECT * from pemilih where status_memilih='antri' order by antrian asc")or die (mysql_error());
						while ($hasil=mysql_fetch_array($hadir)){
							echo "<tr>
								<td align=center>$hasil[4]</td>
								<td>$hasil[1]</td>
								<td>$hasil[2]</td>
								<td>$hasil[3]</td>";
								if ($hasil[5]=='Belum'){?>
									<td align=center>
									<a href='index.php?hl=hadir&id=<?=$hasil[0]?>'>
										<button class="btn btn-sm btn-info"><strong>Hadir<strong></button></a>
									</td>
							<?php
								} else if ($hasil[5]=='Antri'){
									echo "<td align=center> <a style='color:red'> Antri </a> </td>";
								}else{
									echo "<td align=center> <a style='color:green'> Sudah </a> </td>";
								}
							echo "</tr>";
							$i++;
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
        </div>
    </div>
</div>

