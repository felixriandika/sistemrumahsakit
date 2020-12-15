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
	
	$query = "SELECT * FROM profil WHERE kd_bag = 'KEU'";
	$sql2 = mysqli_query($koneksi, $query);
	
	if(@$_SESSION['pendaftaran'] || @$_SESSION['dokter'] || @$_SESSION['dok001'] || @$_SESSION['dok002'] || @$_SESSION['dok003'] || 
	@$_SESSION['admin'] || @$_SESSION['farmasi'] || @$_SESSION['keuangan']){
?>


<!DOCTYPE html>
<html>
<head>
	<title>Kalbis Hospital - Profile Administrasi</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
<style>
	#tabel {
		margin: 100px auto;
		width: 500px;
		background-color: #F0F3FF;
	}
	
	#tabel table {
		margin-top: 30px;
	}
	
	#tabel table tr td {
		padding: 15px;
		font-family: Tahoma;
		font-size: 20px;
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
			<li><a href="keuangan_index.php">Home</a></li>
			<li><a href="keuangan_tagihan_obat.php">Tagihan Obat</a></li>
			<li><a href="keuangan_tagihan_dokter.php">Tagihan Dokter</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="keuangan_profile.php"><span class="glyphicon glyphicon-user"></span> Welcome, Keuangan</a></li>
			<li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
		</ul>
	  </div>
	</nav>
	
	<center>
	<div id="tabel">
		<img src="../gambar/keuangan.png" class="img-circle" alt="Cinque Terre" width="304" height="236"/>
		<?php
			while($row = mysqli_fetch_assoc($sql2)){
				$kd = $row['kd_bag'];
				$nama_b = $row['nama_bag'];
				$nama_s = $row['nama_staf'];
			}	
			mysqli_free_result($sql2);
		?>
		<table>
			<tr>
				<td>Kode Bagian</td>
				<td>:</td>
				<td><?=$kd?></td>
			</tr>
			<tr>
				<td>Nama Bagian</td>
				<td>:</td>
				<td><?=$nama_b?></td>
			</tr>
			<tr>
				<td>Nama Staf</td>
				<td>:</td>
				<td><?=$nama_s?></td>
			</tr>
		</table>
	</div>
	</center>
</body>
</html>

<?php
	} else {
		header("Location: ../login.php");
	}
	
	mysqli_close($koneksi);
?>