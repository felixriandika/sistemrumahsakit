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
		$option = "";
		while($row = mysqli_fetch_array($sql2)){
			$option = $option . "<option value='" . $row['kd_pasien'] . "'>PS00000" . $row['kd_pasien'] . " - " . $row['nama_pasien'] . "</option>";
		}
	} else if(@$_SESSION['dok002']){
		$query = "SELECT a.*, b.nama_pasien 
				  FROM pemeriksaan a, pasien b, dokter c
				  WHERE a.kd_pasien = b.kd_pasien AND a.kd_dok = c.kd_dok AND a.kd_dok = 'DOK002'";
		$sql2 = mysqli_query($koneksi, $query);	
		$option = "";
		while($row = mysqli_fetch_array($sql2)){
			$option = $option . "<option value='" . $row['kd_pasien'] . "'>PS00000" . $row['kd_pasien'] . " - " . $row['nama_pasien'] . "</option>";
		}	
	} else if(@$_SESSION['dok003']){
		$query = "SELECT a.*, b.nama_pasien 
				  FROM pemeriksaan a, pasien b, dokter c
				  WHERE a.kd_pasien = b.kd_pasien AND a.kd_dok = c.kd_dok AND a.kd_dok = 'DOK003'";
		$sql2 = mysqli_query($koneksi, $query);	
		$option = "";
		while($row = mysqli_fetch_array($sql2)){
			$option = $option . "<option value='" . $row['kd_pasien'] . "'>PS00000" . $row['kd_pasien'] . " - " . $row['nama_pasien'] . "</option>";
		}	
	}
	
	$query2 = "SELECT * FROM obat_farmasi";
	$sql2 = mysqli_query($koneksi, $query2);
	$option2 = "";
	
	while($row2 = mysqli_fetch_array($sql2)){
		$option2 = $option2 . "<option value='" . $row2['kd_obat'] . "'>". $row2['kd_obat'] . " - " . $row2['nama_obat'] . "</option>";
	}
	
	if(isset($_POST['simpan'])){
		$kd_p = $_POST['kd_pasien'];
		$riwayat = "";
		$diagnosa = $_POST['diagnosa'];
		$kd_obat = $_POST['kd_obat'];
		$jml = $_POST['jumlah'];
		$status = "Belum Lunas";
		
		$riwayat = mysqli_real_escape_string($koneksi, $riwayat);
		$diagnosa = mysqli_real_escape_string($koneksi, $diagnosa);
		
				
		$verif = "";
		if(@$_SESSION['dok001']){
			$verif = "DOK001";
		} else if(@$_SESSION['dok002']){
			$verif = "DOK002";
		} else if(@$_SESSION['dok003']){
			$verif = "DOK003";
		}
		
		$sql = "INSERT INTO diagnosa (kd_pasien, diagnosa, kd_obat, jumlah, verifiedBy) VALUES({$kd_p},'{$diagnosa}','{$kd_obat}',{$jml},'{$verif}')";
		$sql3 = "UPDATE obat_farmasi SET stok = stok - {$jml} WHERE kd_obat = '{$kd_obat}'";
		$sql4 = "INSERT INTO biaya_dok (kd_pasien, biaya_dok, status_bayar) VALUES({$kd_p},100000,'{$status}')";
		$sql5 = "INSERT INTO biaya_obat (kd_pasien, kd_obat, jumlah, status_bayar) VALUES({$kd_p},'{$kd_obat}',{$jml},'{$status}')";
		$sql6 = "UPDATE pasien SET riwayat_p = '{$diagnosa}', status = 'Lama' WHERE kd_pasien = {$kd_p}";
		
		mysqli_query($koneksi, $sql);
		mysqli_query($koneksi, $sql3);
		mysqli_query($koneksi, $sql4);
		mysqli_query($koneksi, $sql5);
		mysqli_query($koneksi, $sql6);
				
		$query = "SELECT stok FROM obat_farmasi";
		$sql6 = mysqli_query($koneksi, $query);
		
		while($row3 = mysqli_fetch_array($sql6)){
			if($row3['stok'] < $jml){
				?>
				<script type="text/javascript">
				alert("Stok obat tidak cukup. Ganti dengan obat lain.")
				</script>
				<?php
			}
		}
		
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
	<title>Kalbis Hospital - Dokter - Input Diagnosa</title>
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
	<div id="form">
		<h1>Input Diagnosa</h1>
		<form action="" method="POST">
			 <div class="form-group">
				  <label for="sel1">Kode Pasien:</label>
				  <select class="form-control" id="sel1" name="kd_pasien">
					<?php echo $option; ?>
				  </select>
			</div>
			<div class="form-group">
				<label>Diagnosa:</label>
				<textarea type="text" class="form-control" name="diagnosa"></textarea>
			</div>
			 <div class="form-group">
				  <label for="sel1">Kode Obat:</label>
				  <select class="form-control" id="sel1" name="kd_obat">
					<?php echo $option2; ?>
				  </select>
			</div>
			<div class="form-group">
				<label>Jumlah:</label>
				<input type="text" class="form-control" name="jumlah">
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