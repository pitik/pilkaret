<?php 
include("koneksi.php");
$id = $_GET['id'];

$query = mysql_query("delete from pemilih where id_pemilih='$id'") or die(mysql_error());

if ($query) {
	echo "<meta http-equiv=refresh content=0;url=index.php?hl=pemilih&info=3>";
}
?>