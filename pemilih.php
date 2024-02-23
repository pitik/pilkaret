<?php
include("koneksi.php");
?>

<div class="row">
	<div class="col-lg-6">
		<h1> Data Pemilih </h1>
		<hr>
	</div>

	<div class="col-lg-4">
		<?php
		if (!empty($_GET['info'])) {
			echo '<div class="alert alert-success alert-dismissable" >';
			echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4>';
			if ($_GET['info'] == 1) {
				echo 'Tambah Pemilih Berhasil!';
			} else if ($_GET['info'] == 2) {
				echo 'Data Pemilih Diubah';
			} else if ($_GET['info'] == 3) {
				echo 'Data Pemilih Dihapus!';
			}
			echo '</h4></div>';
		}
		?>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="container"><br />
				<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">Tambah Data Pemilih</button>

				<a style='color:white' href='?hl=upload'>
					<button class="btn btn-success btn-md">Upload Data CSV</button>
				</a>
			</div>

			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="dataPemilih">
						<thead>
							<tr>
								<th width=4%>No</th>
								<th>Nama</th>
								<th width='100px'>Jenis Kelamin</th>
								<th>Alamat</th>

								<th width=16%>Aksi</th>

							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;
							$pemilih = mysqli_query($mysqli, "SELECT * from pemilih order by nama asc") or die(mysqli_error($mysqli));
							while ($hasil = mysqli_fetch_array($pemilih)) {
								echo "<tr>
								<td align=center>$i</td>
								<td>$hasil[1]</td>
								<td>$hasil[2]</td>
								<td>$hasil[3]</td>"; ?>

								<td align=center> <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editPemilih" data-id="<?= $hasil[0] ?>" data-nama="<?= $hasil[1] ?>" data-jeniskelamin="<?= $hasil[2] ?>" data-alamat="<?= $hasil[3] ?>"><i class="icon-pencil icon-white"></i> Edit</button>
									<a style="color:white; text-decoration:none;" href="javascript:;" data-id="<?php echo $hasil[0] ?>" data-toggle="modal" data-target="#modal-konfirmasip">
										<button class="btn btn-sm btn-danger"><i class="icon-remove icon-white"></i> Hapus</a></button>

								<?php
								echo "</tr>";
								$i++;
							}
								?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="panel-footer" align=right>
				<a style='color:white' href='cetakhadir.php?tipe=print'>
					<button class="btn btn-success btn-md">Cetak Daftar Hadir</button>
				</a>
				<a style='color:white' href='cetakkartu.php?tipe=print'>
					<button class="btn btn-primary btn-md">Cetak Kartu Pemilih</button>
				</a>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Tambah Data Pemilih</h4>
			</div>
			<div class="modal-body">
				<div id="div-4" class="accordion-body collapse in body">
					<div id="collapse2" class="collapse in body">
						<form class="form-horizontal" method="post" name="tambahpemilih" action="" id="popup-validation">
							<div class="form-group">
								<label for="text1" class="control-label col-lg-4">Nama</label>
								<div class="col-lg-6">
									<input id="req" name="nama" class="validate[required] form-control" type="text" />
								</div>
							</div>
							<div class="form-group">
								<label for="text1" class="control-label col-lg-4">Jenis Kelamin</label>
								<div class="col-lg-6">
									<?php
									//mengeluarkan data field yang bertipe enum.
									echo "<select id='sport' name='jeniskelamin' class='validate[required] form-control ' tabindex='2'>";
									echo '<option value="">- Pilih -</option>';
									$result = mysqli_query($mysqli, "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS
											WHERE TABLE_NAME = 'pemilih' AND COLUMN_NAME = 'jenis_kelamin'")
										or die(mysqli_error($mysqli));

									$row = mysqli_fetch_array($result);
									$enumList = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE']) - 6))));
									foreach ($enumList as $value)
										echo "<option value=\"$value\">$value</option>";

									echo "</select>";
									?>
								</div>
							</div>
							<div class="form-group">
								<label for="text1" class="control-label col-lg-4">Alamat</label>
								<div class="col-lg-6">
									<textarea id="req" name="alamat" class="validate[required] form-control"></textarea>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input type="submit" name="tambahpemilih" value="Tambah Pemilih" class="btn btn-success " />
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="editPemilih" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Edit Data Pemilih</h4>
			</div>
			<div class="modal-body">
				<div id="div-4" class="accordion-body collapse in body">
					<div id="collapse2" class="collapse in body">
						<form class="form-horizontal" method="post" name="editpemilih" action="" id="popup-validation">
							<div class="form-group">
								<label for="text1" class="control-label col-lg-4">Nama</label>
								<div class="col-lg-6">
									<input name="id" id="id" class="form-control" type="hidden" />
									<input id="nama" name="enama" class="validate[required] form-control" type="text" />
								</div>
							</div>
							<div class="form-group">
								<label for="text1" class="control-label col-lg-4">Jenis Kelamin</label>
								<div class="col-lg-6">
									<?php
									//mengeluarkan data field yang bertipe enum.
									echo "<select id='jeniskelamin' name='ejeniskelamin' class='validate[required] form-control ' tabindex='2'>";
									$result = mysqli_query($mysqli, "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS
											WHERE TABLE_NAME = 'pemilih' AND COLUMN_NAME = 'jenis_kelamin'")
										or die(mysqli_error($mysqli));

									$row = mysqli_fetch_array($result);
									$enumList = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE']) - 6))));
									foreach ($enumList as $value)
										echo "<option value=\"$value\">$value</option>";

									echo "</select>";
									?>
								</div>
							</div>
							<div class="form-group">
								<label for="text1" class="control-label col-lg-4">Alamat</label>
								<div class="col-lg-6">
									<textarea name="ealamat" id="alamat" class="validate[required] form-control"></textarea>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input type="submit" name="editpemilih" value="Edit Pemilih" class="btn btn-success " />
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- modal konfirmasi-->
<div id="modal-konfirmasip" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Konfirmasi</h4>
			</div>

			<div class="modal-body btn-info">
				Apakah Anda yakin ingin menghapus data pemilih ini?
			</div>

			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-danger" id="hapus-true">Ya</a>
				<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
			</div>

		</div>
	</div>
</div>

<?php
if ($_POST['tambahpemilih']) {
	$nama = $_POST['nama'];
	$jk = $_POST['jeniskelamin'];
	$alamat = $_POST['alamat'];

	$query = mysqli_query($mysqli, "INSERT into `pilkaret`.`pemilih` values(null,'$nama','$jk','$alamat',0,'Belum')") or die(mysqli_error($mysqli));

	if ($query) {
		echo "<meta http-equiv=refresh content=0;url=?hl=pemilih&info=1>";
	}
}
?>

<?php
if ($_POST['editpemilih']) {
	$id = $_POST['id'];
	$nama = $_POST['enama'];
	$jk = $_POST['ejeniskelamin'];
	$alamat = $_POST['ealamat'];

	$query = mysqli_query($mysqli, "UPDATE pemilih set nama='$nama', jenis_kelamin='$jk', alamat='$alamat' where id_pemilih='$id' ") or die(mysqli_error($mysqli));

	if ($query) {
		echo "<meta http-equiv=refresh content=0;url=?hl=pemilih&info=2>";
	}
}
?>