<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]> <!--><html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->
<head>
</head>
<a style='text-decoration:none;' href='index.php?hl=calonrt'>
	<button type="button" class="btn btn-info">Kembali</button>
</a>
<!-- BODY -->
<body onload="setInterval('displayServerTime()', 1000);">
<div id="wrapper">
<header class="modal-header" style="background:url(assets/img/bak.jpg);">
	<div style="height:80px;padding-right:20px;">
		<div style="position:inherit; float:left">
			<img src="assets/img/logop.png" class="user-image img-responsive"/>
		</div>
		<div style="float:left; padding-left:25px;">
			<h2 style="color:black;"><b>Sistem e-Voting Pilkaret<br>
			Pemilihan Ketua RT 04 RW 09 Perumahan Teluk</b></h2>
		</div>
    </div>
</header>
	<div style="padding:1px; background-color:#036"></div>        
	<div id="page-inner">
		<div id="content">
			<div class="row" style="margin-right:-10px;">
				<div class="col-lg-12" style="padding-left:30px;">
					<h2><b> Cara Memilih :</b> <br>
					dengan pilih (klik) <b>GAMBAR Calon Ketua RT</b> yang tersedia dibawah ini.</h2>
				</div>
			</div>
			<br>

			<div  align="center" class="row" style="margin-right:-10px; text-align:center">
				<div class="col-lg-12" style="padding-left:280px;">
					<?php 
					$calon=mysql_query("select * from calon_rt")or die (mysql_error());
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
				</div>
			</div>
		</div>
	</div>
</body>
</html>