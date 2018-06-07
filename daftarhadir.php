<?php
	include ("koneksi.php");
?>

<div class="row">
		<div class="col-lg-6">
			<h1> Daftar Hadir Pemilih </h1>
		<hr>
		</div>

</div>

<div class="row">
    <div class="col-lg-12">
     	<div class="panel panel-default">
			<div class="panel-body">
				<div class="table-responsive"> 
				<table class="table table-striped table-bordered table-hover" id="dataHadir">
						<thead>
						<tr>
							<th width=5%>No</th>
							<th>Nama</th>
							<th width='100px'>Jenis Kelamin</th>
							<th>Alamat</th>
							<th width=10%>No Antrian</th>
							<th width=10%>Status</th>
						</tr>                 
						</thead>
						<tbody>
						<?php
						$i=1;

						$hadir=mysql_query("select * from pemilih order by nama asc")or die (mysql_error());
						while ($hasil=mysql_fetch_array($hadir)){
							echo "<tr>
								<td align=center>$i</td>
								<td>$hasil[1]</td>
								<td>$hasil[2]</td>
								<td>$hasil[3]</td>
								<td align=center>$hasil[4]</td>";
								if ($hasil[5]=='Belum'){?>
									<td align=center> 						
									<a href='index.php?hl=hadir&id=<?=$hasil[0]?>'>
										<button class="btn btn-sm btn-info"><strong>Hadir<strong></button></a>
									</td>
							<?php
								} else if ($hasil[5]=='Antri'){ 
									echo "<td align=center> <a style='color:red'> Antri </a> </td>";
								}else{
									echo "<td align=center> <a style='color:green'> Sudah </a> </td>";
								}
							echo "</tr>";
							$i++;
						}
						?>
						</tbody>
					</table>
				</div>         
			</div>
        </div>
    </div>
</div>
		