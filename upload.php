<?php
//KONEKSI.. 
include("koneksi.php");
if (isset($_POST['submit'])) {
	 echo "<meta http-equiv=refresh content=0;url=?hl=pemilih>";
}
if (isset($_POST['submit'])) {//Script akan berjalan jika di tekan tombol submit..
 
//Script Upload File..
    if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
        echo "<h1>" . "File ". $_FILES['filename']['name'] ." Berhasil di Upload" . "</h1>";
        echo "<h2>Menampilkan Hasil Upload:</h2>";
        readfile($_FILES['filename']['tmp_name']);
    }
 
    //Import uploaded file to Database, Letakan dibawah sini..
    $handle = fopen($_FILES['filename']['tmp_name'], "r"); //Membuka file dan membacanya
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $import="INSERT into pemilih (id_pemilih,nama,jenis_kelamin,alamat,antrian,status_memilih) values(NULL,'$data[0]','$data[1]','$data[2]',NULL,'Belum')"; //data array sesuaikan dengan jumlah kolom pada CSV anda mulai dari “0” bukan “1”
        mysql_query($import) or die(mysql_error()); //Melakukan Import
    }
 
    fclose($handle); //Menutup CSV file
    echo "<br><strong>Import data selesai.</strong>
	<meta http-equiv=refresh content=2;url=?hl=pemilih>";
    
}else { //Jika belum menekan tombol submit, form dibawah akan muncul.. ?>
	<div class="row">
		<div class="col-lg-12">
			<h1> Upload Data </h1><hr>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-8">
			<div class="panel panel-default">
				<div class="panel-body">
	<!-- Form Untuk Upload File CSV-->
				   <h3>Silahkan masukan file csv yang ingin diupload</h3>
				   <form enctype='multipart/form-data' action='' method='post'>
						<div class="form-group">
							<label for="text1" class="control-label col-lg-4">Cari CSV File anda:</label>
							<div class="col-lg-8">
								<input class="form-control" type='file' name='filename' size='100'>
							</div>
						</div>
						<br>
						<div class="modal-footer" style="margin-top:30px; padding:5px;">
							<input  class="btn btn-danger" action="action" type="button" value="Batal" onclick="history.back();" />	
							<input type='submit' name='submit' class="btn btn-success" value='Upload'>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php 
}
?>
