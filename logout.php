<?php
$nama=$_SESSION['username'];
$cek = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * from login where username='$nama'"));
if ($cek['sebagai']=='bilik'){
	$uplik = mysqli_query($mysqli, "DELETE from status_bilik where nama='$nama'")or die (mysqli_error($mysqli));
}
session_destroy();
echo "<meta http-equiv=refresh content=0;url=login.php>";
?>
