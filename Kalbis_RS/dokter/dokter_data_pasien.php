<?php
session_start();
	$host = "localhost";
	$user = "root";
	$pass = "";
	$dbname = "kalbis_rs";
	
	$koneksi = mysqli_connect($host, $user, $pass, $dbname);
	
	if(mysqli_connect_errno()){
		die("Koneksi gagal");
	}
	
	if(@$_SESSION['dok001']){
		$query = "SELECT a.*, b.nama_pasien, c.kd_dok
				  FROM pemeriksaan a, pasien b, dokter c
				  WHERE a.kd_pasien = b.kd_pasien AND a.kd_dok = c.kd_dok AND a.kd_dok = 'DOK001'";
		$sql2 = mysqli_query($koneksi, $query);				  
	} else if(@$_SESSION['dok002']){
		$query = "SELECT a.*, b.nama_pasien 
				  FROM pemeriksaan a, pasien b, dokter c
				  WHERE a.kd_pasien = b.kd_pasien AND a.kd_dok = c.kd_dok AND a.kd_dok = 'DOK002'";
		$sql2 = mysqli_query($koneksi, $query);		  
	} else if(@$_SESSION['dok003']){
		$query = "SELECT a.*, b.nama_pasien 
				  FROM pemeriksaan a, pasien b, dokter c
				  WHERE a.kd_pasien = b.kd_pasien AND a.kd_dok = c.kd_dok AND a.kd_dok = 'DOK003'";
		$sql2 = mysqli_query($koneksi, $query);		  
	}
	
	
	if(@$_SESSION['pendaftaran'] || @$_SESSION['dokter'] || @$_SESSION['dok001'] || @$_SESSION['dok002'] || @$_SESSION['dok003'] || 
	@$_SESSION['admin'] || @$_SESSION['farmasi'] || @$_SESSION['keuangan']){
?>


<!DOCTYPE html>
<html>
<head>
	<title>Kalbis Hospital - Data Pasien for Dokter</title>
	<link rel="icon" href="../gambar/logo.jpg" type="image/x-icon">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
<style>
	#tabel {
		margin: 120px auto;
		max-width: 600px;
	}
	
	.container {
		width: 100%;
	}
</style>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
			<a class="navbar-brand" href="#">Kalbis Hospital</a>
		</div>
		<ul class="nav navbar-nav">
			<li><a href="dokter_index.php">Home</a></li>
			<li><a href="dokter_input_diagnosa.php">Input Diagnosa</a></li>
			<li><a href="dokter_data_pasien.php">Data Pasien</a></li>
			<li><a href="dokter_data_obat.php">Data Obat</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="dokter_profile.php"><span class="glyphicon glyphicon-user"></span> Welcome, 
			<?php 
				if($sesi = @$_SESSION['dok001']){
					echo $sesi;
				} else if($sesi = @$_SESSION['dok002']){
					echo $sesi;
				} else if($sesi = @$_SESSION['dok003']){
					echo $sesi;
				}
			?>
			</a></li>
			<li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
		</ul>
	  </div>
	</nav>
	
	<div id="tabel">
		<ul class="list-group ">
			<li class="list-group-item list-group-item-info">
				<span class="badge">
					<?php
					if(@$_SESSION['dok001']){
						$query2 = "SELECT COUNT(*) AS `count`
								  FROM pemeriksaan a, pasien b, dokter c
								  WHERE a.kd_pasien = b.kd_pasien AND a.kd_dok = c.kd_dok AND a.kd_dok = 'DOK001'";
						$sql3 = mysqli_query($koneksi, $query2);				  
					} else if(@$_SESSION['dok002']){
						$query2 = "SELECT COUNT(*) AS `count` 
								  FROM pemeriksaan a, pasien b, dokter c
								  WHERE a.kd_pasien = b.kd_pasien AND a.kd_dok = c.kd_dok AND a.kd_dok = 'DOK002'";
						$sql3 = mysqli_query($koneksi, $query2);		  
					} else if(@$_SESSION['dok003']){
						$query2 = "SELECT COUNT(*) AS `count`
								  FROM pemeriksaan a, pasien b, dokter c
								  WHERE a.kd_pasien = b.kd_pasien AND a.kd_dok = c.kd_dok AND a.kd_dok = 'DOK003'";
						$sql3 = mysqli_query($koneksi, $query2);		  
					}
						$row = mysqli_fetch_assoc($sql3);
						$count = $row['count'];
						echo $count;
					?>
				</span>DATA PASIEN
			</li>
		</ul>
		<div class="container">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Kode Pemeriksaan</th>
						<th>Kode Pasien</th>
						<th>Nama Pasien</th>
						<th>Kode Dokter</th>
						<th>Riwayat Penyakit</th>
					</tr>
				</thead>
				<tbody>
					<?php
							
						while($row = mysqli_fetch_assoc($sql2)){
							$kd_pas = $row['kd_pasien'];
							$query2 = "SELECT a.*, b.* FROM pasien a, diagnosa b
										WHERE b.kd_pasien = {$kd_pas}";
							$sql3 = mysqli_query($koneksi, $query2);
							while($row2 = mysqli_fetch_assoc($sql3)){ 
								$diagnosa = $row2['diagnosa'] . ", ";
							}
							echo "<tr>";
							echo "<td>PR" . $row['kd_periksa'] . "</td>";
							echo "<td>PS00000" . $row['kd_pasien'] . "</td>";
							echo "<td>" . $row['nama_pasien'] . "</td>";
							echo "<td>" . $row['kd_dok'] . "</td>";
							echo "<td>"; 
							echo $diagnosa;
							echo "</td>";
							echo "</tr>";
						}
					?>	
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>

<?php
	} else {
		header("Location: ../login.php");
	}
	
	mysqli_close($koneksi);
?>