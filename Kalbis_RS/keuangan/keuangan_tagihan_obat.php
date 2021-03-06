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
	
	$query = "SELECT a.kd_transaksi, a.kd_pasien, d.nama_pasien, a.kd_obat, c.nama_obat, a.jumlah, e.verifiedBy, c.satuan, b.harga_satuan, a.jumlah*b.harga_satuan 
			  FROM biaya_obat a, obat_keu b, obat_farmasi c, pasien d, diagnosa e
			  WHERE b.kd_obat = a.kd_obat AND b.kd_obat = c.kd_obat AND a.kd_pasien = d.kd_pasien AND a.kd_transaksi = e.kd_periksa
			  ORDER BY a.kd_transaksi";
	$sql2 = mysqli_query($koneksi, $query);
	
	$query2 = "SELECT SUM(biaya_obat) FROM biaya_obat";
	$sql3 = mysqli_query($koneksi, $query2);
	
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
						$result = mysqli_query($koneksi, "SELECT COUNT(*) AS `count` FROM biaya_obat");
						$row = mysqli_fetch_assoc($result);
						$count = $row['count'];
						echo $count;
					?>
				</span>DATA BIAYA OBAT PASIEN
			</li>
		</ul>
		<div class="container">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Kode Transaksi</th>
						<th>Kode Pasien</th>
						<th>Nama Pasien</th>
						<th>Kode Obat</th>
						<th>Nama Obat</th>
						<th>Verified By</th>
						<th>Jumlah</th>
						<th>Satuan</th>
						<th>Harga Satuan</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<?php
						while($row = mysqli_fetch_assoc($sql2)){
							$total = $row['jumlah'] * $row['harga_satuan'];
							echo "<tr>";
							echo "<td class='td'>" . "TR" . $row['kd_transaksi'] . "</td>";
							echo "<td class='td'>PS00000" . $row['kd_pasien'] . "</td>";
							echo "<td class='td'>" . $row['nama_pasien'] . "</td>";
							echo "<td class='td'>" . $row['kd_obat'] . "</td>";
							echo "<td class='td'>" . $row['nama_obat'] . "</td>";
							echo "<td class='td'>" . $row['verifiedBy'] . "</td>";
							echo "<td class='td'>" . $row['jumlah'] . "</td>";
							echo "<td class='td'>" . $row['satuan'] . "</td>";
							echo "<td style='text-align: left;'>Rp. " . $row['harga_satuan'] . "</td>";
							echo "<td style='text-align: left;'>Rp. " . $total . "</td>";
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