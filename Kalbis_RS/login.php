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
?>



<html>
<head>
	<title>Login</title>
<head>
	<title>Kalbis Hospital - Dokter Home</title>
	<link rel="icon" href="gambar/logo.jpg" type="image/x-icon">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
<style>
	body{
		background-image: url("background.jpg");
		background-position: center center;
		background-repeat: no-repeat;
		background-size:cover;
		position: fixed;
		min-width:100%;
		min-height:100%;
	}
	
	#form {
		margin: 170px auto;
		width: 400px;
		box-shadow: 0 5px 5px 0;
		background-color: white;
	}
	
	input[type="text"]{
		margin-left: 100px;
		margin-top: 30px;
		margin-bottom: 20px;
		padding: 10px;
		width: 200px;
		height: 40px;
		box-shadow: 0 5px 5px 0;
	}
	
	input[type="password"]{
		margin-left: 100px;
		margin-top: 10px;
		margin-bottom: 20px;
		padding: 10px;
		width: 200px;
		height: 40px;
		box-shadow: 0 5px 5px 0;
	}
	
	input[type="submit"]{
		margin-left: 160px;
		margin-top: 10px;
		margin-bottom: 20px;
		padding: 10px auto;
		width: 75px;
		height: 30px;
		background-color: blue;
		color: white;
	}
</style>
</head>
<body>
	<div id="form">
	<center><h2>Login</h2></center>
		<form action="" method="POST">
			<input type="text" name="user" placeholder="Username"/><br/>
			<input type="password" name="pass" placeholder="Password"/><br/>
			<input type="submit" name="login" value="Log In"/>
		</form>
	</div>
<?php
	@$user = $_POST['user'];
	@$pass = $_POST['pass'];
	@$login = $_POST['login'];
	
	if($login){
		if($user == "" || $pass == ""){
?>	
<script type="text/javascript">alert("Username atau password masih kosong");window.location.href="login.php"</script>
<?php
		} else { 
			$query = "select * from login where username = '{$user}' and password = '{$pass}'" ;
			$sql = mysqli_query($koneksi, $query);
			$data = mysqli_fetch_array($sql);
			$cek = mysqli_num_rows($sql);
			if($cek >= 1) {
				if($data['level'] == "admin") {
					@$_SESSION['admin'] = $data['level'];
					header("location: adm/adm_index.php");
				} else if($data['level'] == "DOK001") {
					@$_SESSION['dok001'] = $data['level'];
					header("location: dokter/dokter_index.php");
				} else if($data['level'] == "DOK002") {
					@$_SESSION['dok002'] = $data['level'];
					header("location: dokter/dokter_index.php");
				} else if($data['level'] == "DOK003") {
					@$_SESSION['dok003'] = $data['level'];
					header("location: dokter/dokter_index.php");
				} else if($data['level'] == "pendaftaran") {
					@$_SESSION['pendaftaran'] = $data['level'];
					header("location: daftar/daftar_indeks.php");
				} else if($data['level'] == "farmasi") {
					@$_SESSION['farmasi'] = $data['level'];
					header("location: farmasi/farmasi_index.php");
				} else if($data['level'] == "keuangan") {
					@$_SESSION['keuangan'] = $data['level'];
					header("location: keuangan/keuangan_index.php");
				} 
			} else {
?> 
          <script type="text/javascript">alert("Login Gagal ."); window.location.href="login.php"</script>
<?php
			}
		}
	}
 ?>
</body>
</html>