<?php
include('koneksi.php');

session_start();
$username = $_POST['username'];
$password = $_POST['password'];
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);

if (empty($username) && empty($password)) {
	header('location:login.php?error=1');
	break;
} else if (empty($username)) {
	header('location:login.php?error=2');
	break;
} else if (empty($password)) {
	header('location:login.php?error=3&user='.$username.'');
	break;
}

$passwordmd5 = md5($password);

$q = mysql_query("select * from login where username='$username' and password='$passwordmd5'");

if (mysql_num_rows($q) == 1) {
	$baris=mysql_fetch_array($q);
	$_SESSION['username'] = $baris['username'];
	if ($baris['sebagai']=='admin'){
		header('location:index.php');
	} else if ($baris['sebagai']=='bilik'){
		$nama=$baris['username'];
		$status = mysql_num_rows(mysql_query("select * from status_bilik where nama='$nama'")); 
		if ($status==0){
			$uplik = mysql_query("insert into status_bilik values ('$nama',0,0)")or die (mysql_error());
		}
		header('location:bilik.php');
	}
} else {
	header('location:login.php?error=4&user='.$username.'');
}
?>