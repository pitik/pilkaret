<?php
$host = 'localhost';
$user = 'local';
$password = '12345';
$dbName = 'pilkaret';

$mysqli = mysqli_connect($host, $user, $password, $dbName);
mysqli_set_charset($mysqli, 'utf8mb4');
?>
