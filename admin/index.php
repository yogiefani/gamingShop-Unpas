
	<?php
	session_start();
	include "../connect.php";
	$cekuserlogin = $_SESSION['username'];
	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Halaman Administrator</title>
		<link rel="stylesheet" type="text/css" href="../style.css">
	</head>
		<?php
		if (empty($cekuserlogin)) {
			header("Location: login.php");
		} else { ?>

			<section class="header">
				<div class="container">
					<div class="row">
						<div class="col-2 heading">
							<h2>Admin</h2>
						</div>
						<div class="col-10">
							<div class="header_menu">
								<a href="?page" class="menu_atas">Beranda</a>
								<a href="?page=tambah_kategori" class="menu_atas">Kategori Game</a>
								<a href="?page=tambah_game" class="menu_atas">Game</a>
								<a href="logout.php" class="menu_button">Log out</a>
							</div>
						</div>
					</div>
				</div>
			</section>
			<div class="konten">
				<?php
				$page = mysqli_real_escape_string($conn, @$_GET['page']);
				if ($page == "tambah_game") {
					include "page/tambah_game.php";
				} else if ($page == "edit_game") {
					include "page/edit_game.php";
				} else if ($page == "tambah_kategori") {
					include "page/tambah_kategori.php";
				} else if ($page == "edit_kategori") {
					include "page/edit_kategori.php";
				} else {
					include("page/home.php");
				}
				?>
			</div>

		<?php } ?>
		<section class="footer">
			&nsub;
		</section>
		<section class="footer1">
			Copyright &copy; 2019. All Right Reserved
		</section>
	</body>

	</html>
</body>

</html>