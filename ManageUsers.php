<!DOCTYPE html>
<html>

<head>
	<title>Absensi | Biometric</title>
	<link rel="shortcut icon" href="assets/logo-wb.png" type="image/x-icon">
		<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha1256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous">
	</script>
	<link rel="stylesheet" type="text/css" href="css/manageusers.css">
	<script src="js/jquery-2.2.3.min.js"></script>
	<script src="js/manage_users.js"></script>

	<script>
		$(window).on("load resize ", function() {
			var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
			$('.tbl-header').css({
				'padding-right': scrollWidth
			});
		}).resize();
	</script>
	<script>
		$(document).ready(function() {
			$.ajax({
				url: "manage_users_up.php"
			}).done(function(data) {
				$('#manage_users').html(data);
			});
			setInterval(function() {
				$.ajax({
					url: "manage_users_up.php"
				}).done(function(data) {
					$('#manage_users').html(data);
				});
			}, 5000);
		});
	</script>
</head>

<body>
	<?php include 'header.php'; ?>
	<main>
		<h1 class="slideInDown animated">Manajemen Pengguna</h1>
		<div class="form-style-5 slideInDown animated">
			<div class="alert">
				<label id="alert"></label>
			</div>
			<form>
				<fieldset>
					<legend><span class="number">1</span> User Fingerprint ID:</legend>
					<label>Enter Fingerprint ID between 1 & 1000:</label>
					<input type="number" name="fingerid" id="fingerid" placeholder="User Fingerprint ID...">
					<button type="button" name="fingerid_add" class="fingerid_add">Add Fingerprint ID</button>
				</fieldset>
				<fieldset>
					<legend><span class="number">2</span> User Info</legend>
					<input type="text" name="name" id="name" placeholder="User Name...">
					<input type="text" name="number" id="number" placeholder="Serial Number...">
					<input type="email" name="email" id="email" placeholder="User Email...">
					<input type="number" name="parent_number" id="parent_number" placeholder="Nomor orang tua...">
					<input type="text" name="parent_name" id="parent_name" placeholder="Nama Orang tua">
					<input type="number" name="student_number" id="student_number" placeholder="Nomor Siswa...">
					<select name="student_class" id="student_class">
						<option selected>Kelas</option>
						<option value="7A">7A</option>
						<option value="7B">7B</option>
						<option value="7C">7C</option>
						<option value="8A">8A</option>
						<option value="8B">8B</option>
						<option value="8C">8C</option>
						<option value="9A">9A</option>
						<option value="9B">9B</option>
						<option value="9C">9C</option>
					</select>
					<select name="student_year" id="student_year">
						<option selected>Tahun Ajar</option>
						<?php
						$year = date("Y") - 1;
						?>
						<?php for ($i = 0; $i < 5; $i++) : ?>
							<option value="<?= $year + $i ?>/<?= date("Y") + $i ?>"><?= $year + $i ?>/<?= date("Y") + $i ?></option>
						<?php endfor; ?>
					</select>
				</fieldset>
				<fieldset>
					<legend><span class="number">3</span> Additional Info</legend>
					<label>
						Time In:
						<input type="time" name="timein" id="timein">
						<input type="radio" name="gender" class="gender" value="Female">Female
						<input type="radio" name="gender" class="gender" value="Male" checked="checked">Male
					</label>
				</fieldset>
				<button type="button" name="user_add" class="user_add">Add User</button>
				<button type="button" name="user_upd" class="user_upd">Update User</button>
				<button type="button" name="user_rmo" class="user_rmo">Remove User</button>
			</form>
		</div>

		<div class="section">
			<!--User table-->
			<div class="tbl-header slideInRight animated">
				<table cellpadding="0" cellspacing="0" border="0">
					<thead>
						<tr>
							<th>Finger .ID</th>
							<th>Nama</th>
							<th>Gender</th>
							<th>NIK/NISN</th>
							<th>Telpon</th>
							<th>Tanggal</th>
							<th>Waktu masuk</th>
						</tr>
					</thead>
				</table>
			</div>
			<div class="tbl-content slideInRight animated">
				<table cellpadding="0" cellspacing="0" border="0">
					<div id="manage_users"></div>
			</div>
		</div>

	</main>
</body>

</html>