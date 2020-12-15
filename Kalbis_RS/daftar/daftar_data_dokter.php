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
	
	$query = "SELECT a.kd_dok, a.nama_dok, a.spesialisasi, b.hari, b.waktu, b.ruang 
			  FROM dokter a, jadwal_dok b 
			  WHERE b.kd_dok = a.kd_dok ORDER BY a.kd_dok";
	$sql2 = mysqli_query($koneksi, $query);
	
	if(@$_SESSION['pendaftaran'] || @$_SESSION['dokter'] || @$_SESSION['dok001'] || @$_SESSION['dok002'] || @$_SESSION['dok003'] || 
	@$_SESSION['admin'] || @$_SESSION['farmasi'] || @$_SESSION['keuangan']){
?>


<!DOCTYPE html>
<html>
<head>
	<title>Kalbis Hospital - Data Dokter for Pendaftaran</title>
	<link rel="icon" href="../gambar/logo.jpg" type="image/x-icon">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
<style>
	#tabel {
		margin: 120px auto;
		width: 750px;
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
			<li><a href="daftar_indeks.php">Home</a></li>
			<li><a href="daftar_input_pasien.php">Insert Pasien Baru</a></li>
			<li><a href="daftar_pemeriksaan.php">Insert Pemeriksaan Baru</a></li>
			<li><a href="daftar_data_dokter.php">Data Dokter</a></li>
			<li><a href="daftar_edit_pasien.php">Edit Data Pasien</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="daftar_profile.php"><span class="glyphicon glyphicon-user"></span> Welcome, Pendaftaran</a></li>
			<li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
		</ul>
	  </div>
	</nav>
	
	<div id="tabel">
		<ul class="list-group ">
			<li class="list-group-item list-group-item-info">
				<span class="badge">
					<?php
						$result = mysqli_query($koneksi, "SELECT COUNT(*) AS `count` FROM jadwal_dok");
						$row = mysqli_fetch_assoc($result);
						$count = $row['count'];
						echo $count;
					?>
				</span>DATA DOKTER
			</li>
		</ul>
		<div class="container">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Kode Dokter</th>
						<th>Nama Dokter</th>
						<th>Spesialisasi</th>
						<th>Hari</th>
						<th>Waktu</td>
						<th>Ruangan</th>
					</tr>
				</thead>
				<tbody>
					<?php
						while($row = mysqli_fetch_assoc($sql2)){
							echo "<tr>";
							echo "<td>" . $row['kd_dok'] . "</td>";
							echo "<td>" . $row['nama_dok'] . "</td>";
							echo "<td>" . $row['spesialisasi'] . "</td>";
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