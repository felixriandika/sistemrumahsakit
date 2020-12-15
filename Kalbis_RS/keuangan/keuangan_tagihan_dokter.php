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
	
	$query = "SELECT a.kd_pasien, a.biaya_dok, a.status_bayar, b.nama_pasien, a.kd_transaksi, c.verifiedBy, d.nama_dok
			  FROM biaya_dok a, pasien b, diagnosa c, dokter d
			  WHERE a.kd_pasien = b.kd_pasien AND a.kd_transaksi = c.kd_periksa AND c.verifiedBy = d.kd_dok
			  ORDER BY a.kd_transaksi";
	$sql2 = mysqli_query($koneksi, $query);
	
	if(@$_SESSION['pendaftaran'] || @$_SESSION['dokter'] || @$_SESSION['dok001'] || @$_SESSION['dok002'] || @$_SESSION['dok003'] || 
	@$_SESSION['admin'] || @$_SESSION['farmasi'] || @$_SESSION['keuangan']){
?>


<!DOCTYPE html>
<html>
<head>
	<title>Kalbis Hospital - Keuangan Tagihan Obat Pasien</title>
	<link rel="icon" href="../gambar/logo.jpg" type="image/x-icon">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
<style>
	#tabel {
		margin: 120px auto;
		width: 1200px;
	}
	
	table tr th {
		text-align: center;
	}
	
	table tr .td {
		text-align: center;
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
			<li><a href="keuangan_index.php">Home</a></li>
			<li><a href="keuangan_tagihan_obat.php">Biaya Obat</a></li>
			<li><a href="keuangan_tagihan_dokter.php">Biaya Dokter</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="keuangan_profile.php"><span class="glyphicon glyphicon-user"></span> Welcome, Keuangan</a></li>
			<li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
		</ul>
	  </div>
	</nav>
	
	<div id="tabel">
		<ul class="list-group ">
			<li class="list-group-item list-group-item-info">
				<span class="badge">
					<?php
						$result = mysqli_query($koneksi, "SELECT COUNT(*) AS `count` FROM biaya_dok");
						$row = mysqli_fetch_assoc($result);
						$count = $row['count'];
						echo $count;
					?>
				</span>DATA BIAYA PEMERIKSAAN PASIEN
			</li>
		</ul>
		<div class="container">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Kode Pemeriksaan</th>
						<th>Kode Pasien</th>
						<th>Nama Pasien</th>
						<th>Kode Dokter</th>
						<th>Nama Dokter</th>
						<th>Biaya Dokter</th>
					</tr>
				</thead>
				<tbody>
					<?php
						while($row = mysqli_fetch_assoc($sql2)){
							echo "<tr>";
							echo "<td class='td'>" . "PR" . $row['kd_transaksi'] . "</td>";
							echo "<td class='td'>PS00000" . $row['kd_pasien'] . "</td>";
							echo "<td class='td'>" . $row['nama_pasien'] . "</td>";
							echo "<td class='td'>" . $row['verifiedBy'] . "</td>";
							echo "<td class='td'>" . $row['nama_dok'] . "</td>";
							echo "<td class='td'>Rp. " . $row['biaya_dok'] . "</td>";
							echo "</tr>";
						}	
						mysqli_free_result($sql2);
						
						$query2 = "SELECT SUM(biaya_dok) AS Total FROM biaya_dok";
						$sql3 = mysqli_query($koneksi, $query2);
						while($row2 = mysqli_fetch_assoc($sql3)){
							echo "<tr>";
							echo "<td style='padding-top: 30px; font-weight: bold'>TOTAL PEMASUKAN</td>";
							echo "<td colspan='3' style='padding-top: 30px;'>Rp. " . $row2['Total'] . "</td>";
							echo "</tr>";
						}
						mysqli_free_result($sql3);
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