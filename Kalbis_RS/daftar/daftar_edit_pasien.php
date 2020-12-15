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
	
	if(@$_SESSION['pendaftaran'] || @$_SESSION['dokter'] || @$_SESSION['dok001'] || @$_SESSION['dok002'] || @$_SESSION['dok003'] || 
	@$_SESSION['admin'] || @$_SESSION['farmasi'] || @$_SESSION['keuangan']){
?>


<!DOCTYPE html>
<html>
<head>
	<title>Kalbis Hospital - Input Data Pasien for Pendaftaran</title>
	<link rel="icon" href="../gambar/logo.jpg" type="image/x-icon">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
<style>
	#form {
		margin-top: 120px;
		width: 500px;
	}
	
	#form button {
		margin-bottom: 20px;
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
	<center>
	<div id="form">
		<a href="edit/edit_nama.php"><button class="btn btn-warning">Ubah Nama</button></a><br/>
		<a href="edit/edit_ktp.php"><button class="btn btn-warning">Ubah Nomor Identitas</button></a><br/>
		<a href="edit/edit_tgl_lhr.php"><button class="btn btn-warning">Ubah Tanggal Lahir</button></a><br/>
		<a href="edit/edit_alamat.php"><button class="btn btn-warning">Ubah Alamat</button></a><br/>
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