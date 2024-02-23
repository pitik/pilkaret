<?php
include('koneksi.php');

session_start();
$username = $_POST['username'];
$password = $_POST['password'];
$username = mysqli_real_escape_string($mysqli, $username);
$password = mysqli_real_escape_string($mysqli, $password);

var_dump($username);

do {
	if (empty($username) && empty($password)) {
		header('location:login.php?error=1');
		break;
	} else if (empty($username)) {
		header('location:login.php?error=2');
		break;
	} else if (empty($password)) {
		header('location:login.php?error=3&user=' . $username . '');
		break;
	}
} while (0);

$passwordmd5 = md5($password);

$q = mysqli_query($mysqli, "SELECT * from login where username='$username' and password='$passwordmd5'");

if (mysqli_num_rows($q) == 1) {
	$baris = mysqli_fetch_array($q);
	$_SESSION['username'] = $baris['username'];
	if ($baris['sebagai'] == 'admin') {
		header('location:index.php');
	} else if ($baris['sebagai'] == 'bilik') {
		$nama = $baris['username'];
		$status = mysqli_num_rows(mysqli_query($mysqli, "SELECT * from status_bilik where nama='$nama'"));
		if ($status == 0) {
			$uplik = mysqli_query($mysqli, "INSERT into status_bilik values ('$nama',0,0)") or die(mysqli_error($mysqli));
		}
		header('location:bilik.php');
	}
} else {
	header('location:login.php?error=4&user=' . $username . '');
}
