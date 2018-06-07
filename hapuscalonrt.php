<?php 
include("koneksi.php");
$id = $_GET['id'];

$query = mysql_query("delete from calon_rt where no_urut='$id'") or die(mysql_error());

if ($query) {
	echo "<meta http-equiv=refresh content=0;url=index.php?hl=calonrt&info=3>";
}
?>