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
	
	if(isset($_POST['simpan'])){
		$kd_obat = $_POST['kd_obat'];
		$nama_obat = $_POST['nama_obat'];
		$indikasi = $_POST['indikasi'];
		$dosis = $_POST['dosis'];
		$bentuk = $_POST['bentuk'];
		$stok = $_POST['stok'];
		$satuan = $_POST['satuan'];
		
		$kd_obat = mysqli_real_escape_string($koneksi,$kd_obat);
		$nama_obat = mysqli_real_escape_string($koneksi,$nama_obat);
		$indikasi = mysqli_real_escape_string($koneksi,$indikasi);
		$dosis = mysqli_real_escape_string($koneksi,$dosis);
		$bentuk = mysqli_real_escape_string($koneksi, $bentuk);
		$stok = mysqli_real_escape_string($koneksi,$stok);
		$satuan = mysqli_real_escape_string($koneksi, $satuan);
		
		$sql = "INSERT INTO obat_farmasi VALUES('{$kd_obat}','{$nama_obat}','{$indikasi}','{$dosis}', '{$bentuk}' , {$stok}, '{$satuan}')";
		mysqli_query($koneksi, $sql);
		
		echo "<script>";
		echo "window.alert('Data bertambah!')";
		echo "</script>";
	}
	
	if(@$_SESSION['pendaftaran'] || @$_SESSION['dokter'] || @$_SESSION['dok001'] || @$_SESSION['dok002'] || @$_SESSION['dok003'] || 
	@$_SESSION['admin'] || @$_SESSION['farmasi'] || @$_SESSION['keuangan']){
?>

<!DOCTYPE html>
<html>
<head>
	<title>Kalbis Hospital - Farmasi Input Obat Baru</title>
	<link rel="icon" href="../gambar/logo.jpg" type="image/x-icon">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
<style>
	#form {
		margin: 120px auto;
		width: 500px;
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
			<li><a href="farmasi_index.php">Home</a></li>
			<li><a href="farmasi_input_baru.php">Insert Obat Baru</a></li>
			<li><a href="farmasi_input_lama.php">Insert Stok Obat Lama</a></li>
			<li><a href="farmasi_pembayaran_pasien.php">Status Pembayaran Obat Pasien</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="farmasi_profile.php"><span class="glyphicon glyphicon-user"></span> Welcome, Farmasi</a></li>
			<li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
		</ul>
	  </div>
	</nav>
	
	<div id="form">
		<h1>Insert Data Obat Baru</h1>
		<form action="" method="POST">
			<div class="form-group">
				<label for="sel1">Kode Obat:</label>
				<input type="text" class="form-control" name="kd_obat">
			</div>
			<div class="form-group">
				<label for="sel1">Nama Obat:</label>
				<input type="text" class="form-control" name="nama_obat">
			</div>
			<div class="form-group">
				<label for="sel1">Indikasi:</label>
				<input type="text" class="form-control" name="indikasi">
			</div>
			<div class="form-group">
				<label for="sel1">Dosis:</label>
				<input type="text" class="form-control" name="dosis">
			</div>
			<div class="form-group">
				<label for="sel1">Bentuk Obat:</label>
				<select class="form-control" id="sel1" name="bentuk">
					<option>Tablet</option>
					<option>Kapsul</option>
					<option>Sirup</option>
				</select>
			</div>
			<div class="form-group">
				<label>Stok:</label>
				<input type="text" class="form-control" name="stok">
			</div>
			<div class="form-group">
				<label for="sel1">Satuan:</label>
				<select class="form-control" id="sel1" name="satuan">
					<option>Butir</option>
					<option>Botol</option>
				</select>
			</div>
			<button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
		</form>
	</div>	
</body>
</html>

<?php
	} else {
		header("Location: ../login.php");
	}
	
	mysqli_close($koneksi);
?>