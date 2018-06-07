<?php
$nama=$_SESSION['username'];
$cek = mysql_fetch_array(mysql_query("SELECT * from login where username='$nama'"));
if ($cek['sebagai']=='bilik'){
	$uplik = mysql_query("DELETE from status_bilik where nama='$nama'")or die (mysql_error());
}
session_destroy();
echo "<meta http-equiv=refresh content=0;url=login.php>";
?>
