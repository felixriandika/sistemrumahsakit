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
	
	if($sesi = @$_SESSION['dok001']){
		$query = "SELECT * FROM dokter WHERE kd_dok = 'DOK001'";
		$sql2 = mysqli_query($koneksi, $query);
	} else if($sesi = @$_SESSION['dok002']){
		$query = "SELECT * FROM dokter WHERE kd_dok = 'DOK002'";
		$sql2 = mysqli_query($koneksi, $query);
	} else if($sesi = @$_SESSION['dok003']){
		$query = "SELECT * FROM dokter WHERE kd_dok = 'DOK003'";
		$sql2 = mysqli_query($koneksi, $query);
	}
	
	if(@$_SESSION['pendaftaran'] || @$_SESSION['dokter'] || @$_SESSION['dok001'] || @$_SESSION['dok002'] || @$_SESSION['dok003'] || 
	@$_SESSION['admin'] || @$_SESSION['farmasi'] || @$_SESSION['keuangan']){
?>


<!DOCTYPE html>
<html>
<head>
	<title>Kalbis Hospital - Profile Pendaftaran</title>
	<link rel="icon" href="../gambar/logo.jpg" type="image/x-icon">
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
	
	<center>
	<div id="tabel">
		<?php
		if(@$_SESSION['dok001']){
			echo "<img src='../gambar/DOK001.png' class='img-circle' alt='Cinque Terre' width='304' height='236'/>";
		} else if(@$_SESSION['dok002']){
			echo "<img src='../gambar/DOK002.png' class='img-circle' alt='Cinque Terre' width='304' height='236'/>";
		} else if(@$_SESSION['dok003']){
			echo "<img src='../gambar/DOK003.png' class='img-circle' alt='Cinque Terre' width='304' height='236'/>";
		}
		
		while($row = mysqli_fetch_assoc($sql2)){
			$kd = $row['kd_dok'];
			$nama_d = $row['nama_dok'];
			$alamat_d = $row['alamat_dok'];
			$spec = $row['spesialisasi'];
		}	
		mysqli_free_result($sql2);
		?>
		<table>
			<tr>
				<td>Kode Dokter</td>
				<td>:</td>
				<td><?=$kd?></td>
			</tr>
			<tr>
				<td>Nama Dokter</td>
				<td>:</td>
				<td><?=$nama_d?></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td><?=$alamat_d?></td>
			</tr>
			<tr>
				<td>Spesialisasi</td>
				<td>:</td>
				<td><?=$spec?></td>
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