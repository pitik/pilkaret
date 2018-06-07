<?php
	include ("koneksi.php");

?>

<div class="row">
	<div class="col-lg-12">
		<h1> Status Bilik </h1>
	</div>
</div>
<hr />
<div class="row">
    <div class="col-lg-12">
     	<div class="panel panel-default">
			<div class="panel-body">
			<?php
				$status =mysql_query("select * from status_bilik"); 
				$cek = mysql_num_rows($status);
				if ($cek>0){
					while ($hasil=mysql_fetch_array($status)){
						if ($hasil[1]==2){
							echo "
							<div align='center' class='col-md-4' style='border:5px ridge; margin:30px; padding-right:0px; padding-left:0px; background: red;' >
							<h2> <b>$hasil[0]</b> [$hasil[2]] </h2><hr>
							<h3> Sudah Memilih </h3>
							</div>
							";
						}else if ($hasil[1]==1){
							echo "
							<div align='center' class='col-md-4' style='border:5px ridge; margin:30px; padding-right:0px; padding-left:0px; background: green;' >
							<h2> <b>$hasil[0]</b> [$hasil[2]]</h2><hr>
							<h3> Proses Memilih </h3>
							</div>
							";
						}else {
							echo "
							<div align='center' class='col-md-4' style='border:5px ridge; margin:30px; padding-right:0px; padding-left:0px; background: grey;' >
							<h2> <b>$hasil[0]</b> [$hasil[2]]</h2><hr>
							<h3> Aktif </h3>
							</div>
							";
						}
					}
				}else{
					echo "<h2> Belum ada bilik yang aktif </h2>";
				}
			?>
			</div>
        </div>
    </div>
</div>

<meta http-equiv=refresh content=1;url=?hl=bilikstatus>
