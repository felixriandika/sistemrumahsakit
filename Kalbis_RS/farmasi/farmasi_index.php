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
	
	$query = "SELECT * FROM obat_farmasi ORDER BY kd_obat ASC";
	$sql2 = mysqli_query($koneksi, $query);
	
	if(isset($_GET['status'])) {
		if($_GET['status'] == 1){	
			$sql = "DELETE FROM obat_farmasi WHERE kd_obat = '$_GET[id]'";
		}
		mysqli_query($koneksi, $sql);
	}
	
	if(@$_SESSION['pendaftaran'] || @$_SESSION['dokter'] || @$_SESSION['dok001'] || @$_SESSION['dok002'] || @$_SESSION['dok003'] || 
	@$_SESSION['admin'] || @$_SESSION['farmasi'] || @$_SESSION['keuangan']){
?>


<!DOCTYPE html>
<html>
<head>
	<title>Kalbis Hospital - Farmasi Home</title>
	<link rel="icon" href="../gambar/logo.jpg" type="image/x-icon">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
<style>
	#tabel {
		margin: 120px auto;
		width: 1000px;
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
	
	<div id="tabel">
		<ul class="list-group ">
			<li class="list-group-item list-group-item-info">
				<span class="badge">
					<?php
						$result = mysqli_query($koneksi, "SELECT COUNT(*) AS `count` FROM obat_farmasi");
						$row = mysqli_fetch_assoc($result);
						$count = $row['count'];
						echo $count;
					?>
				</span>DATA OBAT
			</li>
		</ul>
		<div class="container">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Kode Obat</th>
						<th>Nama Obat</th>
						<th>Indikasi</th>
						<th>Dosis</th>
						<th>Bentuk Obat</th>
						<th>Stok</th>
						<th>Satuan</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						while($row = mysqli_fetch_assoc($sql2)){
							echo "<tr>";
							echo "<td>" . $row['kd_obat'] . "</td>";
							echo "<td>" . $row['nama_obat'] . "</td>";
							echo "<td>" . $row['indikasi'] . "</td>";
							echo "<td>" . $row['dosis'] . "</td>";
							echo "<td>" . $row['bentuk'] . "</td>";
							echo "<td>" . $row['stok'] . "</td>";
							echo "<td>" . $row['satuan'] . "</td>";
							echo "<td>";
							echo "<a href='farmasi_index.php?status=1&id=" . $row['kd_obat'] . "'>Hapus</a>";
							echo "</td>";
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