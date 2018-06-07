<?php
session_start();
	include "koneksi.php";
	$user=$_SESSION['username'];
	$query = mysql_query("SELECT * from login where username='$user'") or die(mysql_error());
	$data = mysql_fetch_array($query);
	$pasl=$data['password'];
?>
<script language="javascript">
	function cek(){
		if (document.login.pass.value==''){
			alert('Password Lama harus diisi!');
			document.login.pass.focus();
			return false;
		}
		else{
			return true;
		}
	}
</script>

<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <header>
                <h1>Ganti Pengaturan Akses:</h1><?php
				if ($data['sebagai']=='admin'){
				?>
				<a style='color:white' href='index.php'>
					<button class="btn btn-danger btn-md" >Kembali</button>
				</a>
				<?php
				}else{
				?>
				<a style='color:white' href='bilik.php'>
					<button class="btn btn-danger btn-md" >Kembali</button>
				</a>
				<?php
				}
				?>
				<hr>
            </header>

			<div id="div-4" class="accordion-body collapse in body">
				<form class="form-horizontal" method="post" name="login" action="" onsubmit="return cek()">
					<div class="form-group">
						<div class="col-lg-12">
						<?php
						if (!empty($_GET['error'])) {
							echo '<p class="text-muted text-center btn-block btn btn-danger btn-rect">';
							if ($_GET['error'] == 1) {
								echo 'Password Lama Salah!';
							}
						}
						if (!empty($_GET['info'])) {
							echo '<p class="text-muted text-center btn-block btn btn-success btn-rect">';
							if ($_GET['info'] == 1) {
								echo 'Username dan Password suskes diupdate!';
							} else if ($_GET['info'] == 2) {
								echo 'Username sukses diupdate!';
							} else if ($_GET['info'] == 3) {
								echo 'Password sukses diupdate!';
							}
							echo '</p>';
						}
						?>
						</div>
					</div>
				`	<div class="form-group">
						<label for="text1" class="control-label col-lg-4">Username</label>
						<div class="col-lg-6">
							<fieldset disabled><input type="text" class="form-control" value="<?=$data['username']?>"></fieldset>
						</div>
					</div>
					<div class="form-group">
						<label for="text1" class="control-label col-lg-4">Username Baru</label>
						<div class="col-lg-6">
							<input name="userbaru" type="text" class="form-control" >
							*NB : Jika tidak ingin diganti, jangan diisi.
						</div>
					</div>
					<div class="form-group">
						<label for="text1" class="control-label col-lg-4">Password Lama</label>
						<div class="col-lg-6">
							<input class="form-control" type="password" name="pass">
						</div>
					</div>
					<div class="form-group">
						<label for="text1" class="control-label col-lg-4">Pssword Baru</label>
						<div class="col-lg-6">
							<input  class="form-control" type="password" name="passbaru">
							*NB : Jika tidak ingin diganti, jangan diisi.
						</div>
					</div>
					<div class="form-action" style="text-align:center;">
						<input type="reset" value="Batal" class="btn btn-danger " >
						<input class="btn btn-success" type="submit" name="update" value="Simpan Pengaturan">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
if ($_POST['update'])
{

	$userbaru=$_POST['userbaru'];
	$pasbaru=$_POST['passbaru'];
	$pasbarum=md5($pasbaru);
	$pass=$_POST['pass'];
	$passm=md5($pass);
	echo $user;
	echo $userbaru;
	echo $passm;
	echo $pasl;
	echo $pasbarum;

	if ($pasl==$passm){
		if (($userbaru!="")&&($pasbaru!="")){
			$query = mysql_query("UPDATE login set username='$userbaru', password='$pasbarum' where username='$user' and password='$passm'") or die(mysql_error());
			$_SESSION['username'] = $userbaru;
			echo "<meta http-equiv=refresh content=0;url=?hl=aturuser&info=1>";
			break;
		}else if (($pasbaru=="")&&($userbaru!="")){
			$query = mysql_query("UPDATE login set username='$userbaru' where username='$user' and password='$passm'") or die(mysql_error());
			$_SESSION['username'] = $userbaru;
			echo "<meta http-equiv=refresh content=0;url=?hl=aturuser&info=2>";
			break;
		}else if (($pasbaru!="")&&($userbaru=="")){
			$query = mysql_query("UPDATE login set password='$pasbarum' where username='$user' and password='$passm'") or die(mysql_error());
			echo "<meta http-equiv=refresh content=0;url=?hl=aturuser&info=3>";
			break;
		}
	}
	else{
		echo "<meta http-equiv=refresh content=0;url=?hl=aturuser&error=1>";
	}
}
?>
