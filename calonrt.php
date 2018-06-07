<?php
	include ("koneksi.php");
?>

<div class="row">
		<div class="col-lg-6">
			<h1> Data Calon RT </h1><hr>
		</div>

		<div class="col-lg-4">
		<?php
		if (!empty($_GET['info'])) {
			echo '<div class="alert alert-success alert-dismissable" >';
            echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4>';
			if ($_GET['info'] == 1) {
				echo 'Tambah Calon RT Berhasil!';
			} else if ($_GET['info'] == 2) {
				echo 'Data Calon RT Diubah';
			} else if ($_GET['info'] == 3) {
				echo 'Data Calon RT Dihapus!';
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
			<?php
				if (((DateToIndo(date('d-m-Y'))=='12 Desember 2015'))&&(date('H:i:s')>='18:00:00')){

				} else{
					echo'<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">Tambah Data Calon RT</button>';
				}
			?>
				<a style='color:white' href='?hl=contohbilik'>
					<button class="btn btn-success btn-md" >Gambaran Bilik</button>
				</a>
				<a style='color:white' href='index.php?hl=reset&code=pastibisadong' onclick="return confirm('Apakah anda yakin ingin mereset pemilihan ini?');">
					<button class='btn btn-danger btn-md' >Reset Pilkaret</button>
				</a>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover" id="dataCalon">
						<thead>
						<tr>
							<th width=8%>No Urut</th>
							<th>Nama</th>
							<th>Foto</th>
							<th width=16%>Aksi</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$i=1;
						$calon=mysql_query("SELECT * from calon_rt")or die (mysql_error());
						while ($hasil=mysql_fetch_array($calon)){
							echo "<tr>
								<td align=center>$hasil[0]</td>
								<td>$hasil[1]</td>
								<td><img src='foto/$hasil[2]' width='150px' height='150px' /></td>";?>
								<td align=center> <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editCalon"
							data-id="<?=$hasil[0]?>" data-nama="<?=$hasil[1]?>" data-foto="<?=$hasil[2]?>"><i class="icon-pencil icon-white"></i> Edit</button>
								<a style="color:white; text-decoration:none;" href="javascript:;" data-id="<?php echo $hasil[0] ?>" data-toggle="modal" data-target="#modal-konfirmasirt">
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
        </div>
    </div>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content">
        	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data Calon RT</h4>
            </div>
            <div class="modal-body">
            	<div id="div-4" class="accordion-body collapse in body">
					<div id="collapse2" class="collapse in body">
						<form class="form-horizontal" method="post" name="tambahcalon" action="" id="popup-validation" enctype="multipart/form-data">
							<div class="form-group">
								<label for="text1" class="control-label col-lg-4">No Urut</label>
								<div class="col-lg-6">
									<input id="req" name="nourut" class="validate[required] form-control" type="text" />
								</div>
							</div>
							<div class="form-group">
								<label for="text1" class="control-label col-lg-4">Nama</label>
								<div class="col-lg-6">
									<input id="req" name="nama" class="validate[required] form-control" type="text" />
								</div>
							</div>
							<div class="form-group">
								<label for="text1" class="control-label col-lg-4">Foto</label>
								<div class="col-lg-6">
									<img id="uploadPreview" style="width: 150px; height: 150px;" /><br>
									<input id="uploadImage" type="file" name="foto" onchange="PreviewImage();" />
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input type="submit" name="tambahcalon" value="Tambah Calon RT" class="btn btn-success " />
							</div>
						</form>
					</div>
				</div>
            </div>
    	</div>
	</div>
</div>

<div class="modal fade" id="editCalon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content">
        	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Edit Data Calon RT</h4>
            </div>
            <div class="modal-body">
				<div id="div-4" class="accordion-body collapse in body">
					<div id="collapse2" class="collapse in body">
						<form class="form-horizontal" method="post" name="editcalon" action="" id="popup-validation" enctype="multipart/form-data">
							<div class="form-group">
								<label for="text1" class="control-label col-lg-4">No Urut</label>
								<div class="col-lg-6">
									<input name="id" id="id" class="form-control" type="hidden" />
									<input id="nourut" name="enourut" class="validate[required] form-control" type="text"/>
								</div>
							</div>
							<div class="form-group">
								<label for="text1" class="control-label col-lg-4">Nama</label>
								<div class="col-lg-6">
									<input id="nama" name="enama" class="validate[required] form-control" type="text"/>
								</div>
							</div>
							<div class="form-group">
								<label for="text1" class="control-label col-lg-4">Foto</label>
								<div class="col-lg-6">
									<input name="fotolama" id="foto" class="form-control" type="hidden" />
									<img id="uploadPreview" style="width: 150px; height: 150px;" /><br>
									<input id="uploadImage" type="file" name="foto" onchange="PreviewImage();" />
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input type="submit" name="editcalon" value="Edit Calon RT" class="btn btn-success " />
							</div>
						</form>
					</div>
				</div>
			</div>
    	</div>
	</div>
</div>

<!-- modal konfirmasi-->
<div id="modal-konfirmasirt" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Konfirmasi</h4>
		</div>

		<div class="modal-body btn-info">
			Apakah Anda yakin ingin menghapus data calon rt ini?
		</div>

		<div class="modal-footer">
			<a href="javascript:;" class="btn btn-danger" id="hapus-true">Ya</a>
			<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
		</div>

		</div>
	</div>
</div>

<?php
if ($_POST['tambahcalon'])
{
	$nourut = $_POST['nourut'];
	$nama = $_POST['nama'];
	$lokasi_file = $_FILES['foto']['tmp_name'];
    $tipe_file   = $_FILES['foto']['type'];
    $nama_file   = $_FILES['foto']['name'];
    $direktori   = "foto/$nama_file";
	move_uploaded_file($lokasi_file,$direktori);
	$query = mysql_query("INSERT into calon_rt values('$nourut','$nama','$nama_file',0)") or die(mysql_error());

	if ($query) {
		echo "<meta http-equiv=refresh content=0;url=?hl=calonrt&info=1>";
	}
}
?>

<?php
if ($_POST['editcalon'])
{
	$id = $_POST['id'];
	$nourut = $_POST['enourut'];
	$nama = $_POST['enama'];
	$fotolama = $_POST['fotolama'];
	$lokasi_file = $_FILES['foto']['tmp_name'];
    $tipe_file   = $_FILES['foto']['type'];
    $nama_file   = $_FILES['foto']['name'];
    $direktori   = "foto/$nama_file";
	move_uploaded_file($lokasi_file,$direktori);
	if(empty($nama_file)){
		$query = mysql_query("UPDATE calon_rt set no_urut='$nourut', nama='$nama' where no_urut='$id' ") or die(mysql_error());
	}else{
		$query = mysql_query("UPDATE calon_rt set no_urut='$nourut', nama='$nama', foto='$nama_file' where no_urut='$id' ") or die(mysql_error());
	}
	if ($query) {
		echo "<meta http-equiv=refresh content=0;url=?hl=calonrt&info=2>";
	}
}
?>
