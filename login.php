<html>
<head>
	<title> Login Sistem E-Voting Pilkaret Teluk </title>
	<!-- STYLE -->
	<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="assets/css/font-awesome.css" />
	<link rel="stylesheet" href="assets/css/login.css" />
	<!-- END STYLE -->
	
	<!-- ICON WEBSITE -->
	<link rel="shortcut icon" href="assets/img/logopil.ico">
	<!-- END ICON -->
	
</head>
<body>
<?php
session_start();
error_reporting(0);
include "koneksi.php";
	
if (!empty($_SESSION['username'])) {
	header('location:index.php?hl=welcome');
}
?>
<div class="container">
    <div class="text-center">
        <img src="assets/img/logopil.png"  alt="Logo" />
		<br><h1><strong> Sistem E-voting Pilkaret </strong></h1>
    </div>
    
    <div class="tab-content">
        <div id="login" class="tab-pane active">
			<form name="login" method="post" action="otentikasi.php" class="form-horizontal form-signin" >
				<?php
					if (!empty($_GET['error'])) {
						$user=$_GET['user'];
						echo '<p class="text-muted text-center btn-block btn btn-danger btn-rect">';
						if ($_GET['error'] == 1) {
							echo 'Username dan Password belum diisi!';
						} else if ($_GET['error'] == 2) {
							echo 'Username belum diisi!';
						} else if ($_GET['error'] == 3) {
							echo 'Password belum diisi!';
						} else if ($_GET['error'] == 4) {
							echo 'Username atau Password salah!';
						}
						echo '</p>';
					}else{
						echo '<p class="text-muted text-center btn-block btn btn-primary btn-rect">';
						echo "Masukan username dan password";
						echo '</p>';
					}
				?>
				<input type="text" name="username" placeholder="Username" class="form-control" value="<?=$user?>" 
					<?php if((!empty($_GET['error'])=='1')OR(!empty($_GET['error'])=='2')) { ?> autofocus <?php } ?> />
				<input type="password" name="password" placeholder="Password" class="form-control"
					<?php if((!empty($_GET['error'])=='1')OR(!empty($_GET['error'])=='3')) { ?> autofocus <?php } ?> />
				<button class="btn text-muted text-center btn-success btn-lg" type="submit">Log in</button>
			</form>
		</div>
	</div>
</div>

</body>
</html>