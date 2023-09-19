<?php
include "../connect.php";
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="../style.css">
	<style>
		body {
			background: #101828;
		}
	</style>
</head>

<body>
	<?php
	$proses = mysqli_real_escape_string($conn, @$_GET['proses']);
	if ($proses == "registrasi") {
		$username = @$_POST['username'];
		$password = @$_POST['password'];
		$password2 = @$_POST['password2'];
		$name = @$_POST['name'];
		if ($password == $password2) { // kondisi jika password = password2
			//tamplikan password benar
			$simpan = mysqli_query($conn, "INSERT INTO admin(username,password,name)VALUES('$username','$password','$name')");
			if ($simpan) {
				echo "<script>alert('Registrasi Berhasil')</script>";
				header("Location:login.php");
			} else {
				echo "<script>alert('Gagal Registrasi')</script>";
			}
		} else { // sebaliknya, jika password tidak sama dengan password 2
			echo "<script>alert('Maaf password anda tidak sama, silahkan coba lagi')</script>"; //tamplikan error
		}
	}
	?>
	<div class="container2">
		<div class="body_sign">
			<div class="signup" align="center">
				<h1>Sign up</h1>
				<form method="post" action="?proses=registrasi">
					<div class="col-12">
						<input type="text" name="name" placeholder="Nama" class="form_input2" maxlength="20">
					</div>
					<div class="col-12">
						<input type="text" name="username" placeholder="Username" class="form_input2" maxlength="15">
					</div>
					<div class="col-12">
						<input type="password" name="password" placeholder="Password" class="form_input2" minlength="8" maxlength="15">
					</div>
					<div class="col-12">
						<input type="password" name="password2" placeholder="Konfirmasi Password" class="form_input2" minlength="8" maxlength="15">
					</div>
					<input type="submit" name="registrasi" class="form_button2" value="Create">
					<a href="../index.php" class="form_button2">Halaman Utama</a><br>
					sudah punya akun?<a href="login.php" class="text_kecil"> login</a>
				</form>
			</div>
		</div>
		<div class="col-6 thumbnail_log">

		</div>
	</div>

</body>

</html>