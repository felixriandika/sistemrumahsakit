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
		$nama = $_POST['nama'];
		$tgl = $_POST['tgl_lahir'];
		$alamat = $_POST['alamat'];
		$no_ktp = $_POST['no_ktp'];
		
		$nama = mysqli_real_escape_string($koneksi, $nama);
		$tgl = mysqli_real_escape_string($koneksi, $tgl);
		$alamat = mysqli_real_escape_string($koneksi, $alamat);
		$no_ktp = mysqli_real_escape_string($koneksi, $no_ktp);
		
		$sql = "INSERT INTO pasien (no_ktp, nama_pasien, tgl_lhr, alamat_p, status)
				VALUES('{$no_ktp}','{$nama}','{$tgl}','{$alamat}','Baru')";
		mysqli_query($koneksi, $sql);
		
		?>
		<script>
				window.alert("Data Bertambah!");	
		</script>
		<?php
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
	<div id="form">
		<h1>Insert Pasien Baru</h1>
		<form action="" method="POST">
			<div class="form-group">
				<label>Nama Lengkap:</label>
				<input type="text" class="form-control" name="nama">
			</div>
			<div class="form-group">
				<label>Nomor Identitas Diri (16-digit):</label>
				<input type="text" class="form-control" name="no_ktp">
			</div>
			<div class="form-group">
				<label>Tanggal Lahir (YYYY-MM-DD):</label>
				<input type="text" class="form-control" name="tgl_lahir">
			</div>
			<div class="form-group">
				<label>Alamat:</label>
				<textarea type="text" class="form-control" name="alamat"></textarea>
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