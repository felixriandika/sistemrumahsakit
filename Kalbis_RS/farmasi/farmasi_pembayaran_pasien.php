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
	
	$query = "SELECT a.kd_transaksi, c.kd_pasien, c.nama_pasien, a.kd_obat, d.nama_obat, a.jumlah, e.verifiedBy, b.harga_satuan, a.jumlah*b.harga_satuan, a.status_bayar
			  FROM biaya_obat a, obat_keu b, pasien c, obat_farmasi d, diagnosa e
			  WHERE b.kd_obat = a.kd_obat AND a.kd_pasien = c.kd_pasien AND 
			  a.kd_obat = d.kd_obat AND e.kd_pasien = c.kd_pasien AND a.kd_transaksi = e.kd_periksa
			  ORDER BY a.kd_transaksi";
	$sql2 = mysqli_query($koneksi, $query);	
	
	if(@$_SESSION['pendaftaran'] || @$_SESSION['dokter'] || @$_SESSION['dok001'] || @$_SESSION['dok002'] || @$_SESSION['dok003'] || 
	@$_SESSION['admin'] || @$_SESSION['farmasi'] || @$_SESSION['keuangan']){
?>


<!DOCTYPE html>
<html>
<head>
	<title>Kalbis Hospital - Farmasi Status Pembayaran</title>
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
						$result = mysqli_query($koneksi, "SELECT COUNT(*) AS `count` FROM biaya_obat");
						$row = mysqli_fetch_assoc($result);
						$count = $row['count'];
						echo $count;
					?>
				</span>DATA TAGIHAN OBAT PASIEN
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
						<th>Jumlah butir</th>
						<th>Verified By</th>
						<th>Harga/butir</th>
						<th>Total</th>
						<th>Status Pembayaran</th>
					</tr>
				</thead>
				<tbody>
					<?php
						while($row = mysqli_fetch_assoc($sql2)){
							$total = $row['jumlah'] * $row['harga_satuan'];
							echo "<tr>";
							echo "<td>" . "TR" . $row['kd_transaksi'] . "</td>";
							echo "<td>PS00000" . $row['kd_pasien'] . "</td>";
							echo "<td>" . $row['nama_pasien'] . "</td>";
							echo "<td>" . $row['kd_obat'] . "</td>";
							echo "<td>" . $row['nama_obat'] . "</td>";
							echo "<td>" . $row['jumlah'] . "</td>";
							echo "<td>" . $row['verifiedBy'] . "</td>";
							echo "<td>Rp. " . $row['harga_satuan'] . "</td>";
							echo "<td>Rp. " . $total . "</td>";
							echo "<td>" . $row['status_bayar'] . "</td>";
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