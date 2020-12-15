<?php

$connect = mysqli_connect("localhost", "root", "", "kalbis_rs");

if(isset($_POST['search'])){
    $valueToSearch = $_POST['valueToSearch'];
    $query = "SELECT * FROM pasien
			  WHERE CONCAT (nama_pasien) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);   
} else {
    $query = "SELECT * FROM pasien";
    $search_result = filterTable($query);
}

if(isset($_GET['status'])) {
		if($_GET['status'] == 1){	
			$sql = "DELETE FROM pasien WHERE kd_pasien = $_GET[id]";
		}
		mysqli_query($connect, $sql);
	}

function filterTable($query){
    $connect = mysqli_connect("localhost", "root", "", "kalbis_rs");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Kalbis Hospital - Data Pasien for Pendaftaran</title>
	<link rel="icon" href="../gambar/logo.jpg" type="image/x-icon">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
<style>
	#konten {
		margin: 110px auto;
		max-width: 1200px;
	}
	
	#konten h1{
		margin: 50px auto;
	}
	
	.container {
		width: 100%;
	}
	
	input[type="text"] {
			width:500px;
			margin-left: 600px;
		}		
		
	.form-group {
		display: inline-block;
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
	
	<div id="konten">	 
		<center><h1>Data Pasien</h1></center>
		<form action="daftar_indeks.php" method="post">
			<div class="form-group">
				<input type="text" class="form-control" name="valueToSearch" placeholder="Masukkan nama untuk mencari">
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary" name="search" value="Cari"></button>
			</div>
			<br><br>
			
			<div class="container">
				<table class="table table-stripped">
					<tr>
						<th>Kode Pasien</th>
						<th>Nama Pasien</th>
						<th>Tanggal Lahir</th>
						<th>Alamat</th>
						<th>Status Pasien</th>
						<th>Action</th>
					</tr>

					<?php while($row = mysqli_fetch_array($search_result)):?>
					<tr>
						<td><?php echo "PS00000" . $row['kd_pasien'];?></td>
						<td><?php echo $row['nama_pasien'];?></td>
						<td><?php echo $row['tgl_lhr'];?></td>
						<td><?php echo $row['alamat_p'];?></td>
						<td><?php echo $row['status'];?></td>
						<td>
						<?php
							echo "<a href='daftar_indeks.php?status=1&id=" . $row['kd_pasien'] . "'>Hapus</a>";
						?>	
						</td>
					</tr>
					<?php endwhile;?>
				</table>
			</div>	
		</form>
	</div>	
</body>
</html>