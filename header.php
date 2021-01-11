<?php
// session_start();
?>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<title>Absensi | Biometric</title>
	<link rel="shortcut icon" href="assets/logo-wb.png" type="image/x-icon">
</head>
<header>
	<div class="topnav" id="myTopnav">
		<b>
			<a href="index.php" style="color: white;">Biometric Absensi</a>
		</b>
		<a href="index.php">Pengguna</a>
		<a href="UsersLog.php">Absensi Pengguna</a>
		<a href="ManageUsers.php">Manajemen Pengguna</a>
		<a href="javascript:void(0);" class="icon" onclick="navFunction()">
			<i class="fa fa-bars"></i></a>
		<a class="laporan-link">Laporan </a>
		<div class="dropdown">
			<a href="laporan-kelas.php">Perkelas</a>
		</div>
	</div>
</header>
<div class="bg-blue-custom"></div>
<script>
	function navFunction() {
		var x = document.getElementById("myTopnav");
		if (x.className === "topnav") {
			x.className += " responsive";
		} else {
			x.className = "topnav";
		}
	}
</script>