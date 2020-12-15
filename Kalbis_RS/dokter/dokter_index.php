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
		$query = "SELECT * FROM jadwal_dok WHERE kd_dok = 'DOK001' ORDER BY hari DESC";
		$sql2 = mysqli_query($koneksi, $query);
	} else if(@$_SESSION['dok002']){
		$query = "SELECT * FROM jadwal_dok WHERE kd_dok = 'DOK002' ORDER BY hari DESC";
		$sql2 = mysqli_query($koneksi, $query);
	} else if(@$_SESSION['dok003']){
		$query = "SELECT * FROM jadwal_dok WHERE kd_dok = 'DOK003' ORDER BY hari DESC";
		$sql2 = mysqli_query($koneksi, $query);
	}
	
	
	if(@$_SESSION['pendaftaran'] || @$_SESSION['dokter'] || @$_SESSION['dok001'] || @$_SESSION['dok002'] || @$_SESSION['dok003'] || 
	@$_SESSION['admin'] || @$_SESSION['farmasi'] || @$_SESSION['keuangan']){
?>


<!DOCTYPE html>
<html>
<head>
	<title>Kalbis Hospital - Dokter Home</title>
	<link rel="icon" href="../gambar/logo.jpg" type="image/x-icon">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
<style>
	#tabel {
		margin: 120px auto;
		width: 500px;
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
						$kode = "DOK001";
					} else if(@$_SESSION['dok002']){
						$kode = "DOK002";
					} else if(@$_SESSION['dok003']){
						$kode = "DOK003";
					}
					
						$result = mysqli_query($koneksi, "SELECT COUNT(*) AS `count` FROM jadwal_dok WHERE kd_dok = '{$kode}'");
						$row = mysqli_fetch_assoc($result);
						$count = $row['count'];
						echo $count;
					?>
				</span>JADWAL PRAKTEK
			</li>
		</ul>
		<div class="container">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Kode Dokter</th>
						<th>Hari</th>
						<th>Waktu</th>
						<th>Ruangan</th>
					</tr>
				</thead>
				<tbody>
					<?php
						while($row = mysqli_fetch_assoc($sql2)){
							echo "<tr>";
							echo "<td>" . $row['kd_dok'] . "</td>";
							echo "<td>" . $row['hari'] . "</td>";
							echo "<td>" . $row['waktu'] . "</td>";
							echo "<td>" . $row['ruang'] . "</td>";
							echo "</tr>";
						}	
						mysqli_free_result($sql2);
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