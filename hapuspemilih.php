<?php
include("koneksi.php");
$id = $_GET['id'];

$query = mysqli_query($mysqli, "DELETE from pemilih where id_pemilih='$id'") or die(mysqli_error($mysqli));

if ($query) {
	echo "<meta http-equiv=refresh content=0;url=index.php?hl=pemilih&info=3>";
}
?>
