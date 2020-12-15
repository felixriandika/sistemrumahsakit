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
	
	$query2 = "SELECT * FROM obat_farmasi";
	$sql2 = mysqli_query($koneksi, $query2);
	$option2 = "";
	
	while($row2 = mysqli_fetch_array($sql2)){
		$option2 = $option2 . "<option value='" . $row2['kd_obat'] . "'>". $row2['kd_obat'] . " - " . $row2['nama_obat'] . "</option>";
	}	
	
	if(isset($_POST['simpan'])){
		$kd_obat = $_POST['kd_obat'];
		$tambahan = $_POST['tambahan'];
		
		$kd_obat = mysqli_real_escape_string($koneksi,$kd_obat);
		$stok = mysqli_real_escape_string($koneksi,$tambahan);		
		
		$sql = "UPDATE obat_farmasi 
				SET kd_obat = '{$kd_obat}', stok = stok + {$tambahan}
				WHERE kd_obat = '{$kd_obat}'";
		mysqli_query($koneksi, $sql);
		
		echo "<script>";
		echo "window.alert('Stok Obat Bertambah!')";
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
		<h1>Insert Data Obat Lama</h1>
		<form action="" method="POST">
			<div class="form-group">
				<label for="sel1">Kode Obat:</label>
				<select class="form-control" id="sel1" name="kd_obat">
					<?php echo $option2; ?>
				</select>
			</div>
			<div class="form-group">
				<label>Stok tambahan (jumlah):</label>
				<input type="text" class="form-control" name="tambahan">
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