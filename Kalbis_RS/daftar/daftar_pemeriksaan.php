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
	
	$query = "SELECT * FROM pasien";
	$sql2 = mysqli_query($koneksi, $query);
	$option = "";
	
	while($row = mysqli_fetch_array($sql2)){
		$option = $option . "<option value='" . $row['kd_pasien'] . "'>PS00000". $row['kd_pasien'] . " - " . $row['nama_pasien'] ."</option>";
	}
	
	$query2 = "SELECT * FROM dokter";
	$sql3 = mysqli_query($koneksi, $query2);
	$option2 = "";
	
	while($row2 = mysqli_fetch_array($sql3)){
		$option2 = $option2 . "<option value='" . $row2['kd_dok'] . "'>". $row2['kd_dok'] . " - " . $row2['nama_dok'] . " - Dokter " . $row2['spesialisasi'] . "</option>";
	}
	
	if(isset($_POST['simpan'])){
		$kd_p = $_POST['kd_p'];
		$kd_dok = $_POST['kd_dok'];
		

		$kd_p = mysqli_real_escape_string($koneksi, $kd_p);
		$kd_dok = mysqli_real_escape_string($koneksi, $kd_dok);
		
		$sql = "INSERT INTO pemeriksaan (kd_pasien, kd_dok)
				VALUES({$kd_p},'{$kd_dok}')";
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
		<h1>Insert Pemeriksaan Baru</h1>
		<form action="" method="POST">
			<div class="form-group">
				<label for="sel1">Pilih pasien:</label>
				<select class="form-control" id="sel1" name="kd_p">
					<?php echo $option; ?>
				</select>
			</div>
			<div class="form-group">
				<label for="sel1">Pilih dokter:</label>
				<select class="form-control" id="sel1" name="kd_dok">
					<?php echo $option2; ?>
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