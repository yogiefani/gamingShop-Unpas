<!-- 
 Lokasi dan Nama File	: page/kategori_game.php
-->

<br>
<div class="container">
	<form class="produk_search" method="post" class="form">
		<input class="form_search" type="text" name="cari" placeholder="cari..">
		<button class="form_button2" for="cari">cari</button>
	</form>
	<div class="col-12">
		<h1>KATEGORI GAME</h1>
	</div>
</div>
<div class="container">
	<div class="row">
		<?php
		$idgame = @$_GET['id_game'];
		$tampil = mysqli_query($conn, "SELECT * FROM kategori_game");
		if (isset($_POST['cari'])) {
			$tampil = mysqli_query($conn, "SELECT * FROM kategori_game WHERE kategori LIKE '%" . $_POST['cari'] . "%'");
		}
		while ($tampil1 = mysqli_fetch_array($tampil)) {
		?>
			<div class="col-3 produk">
				<img src="images/fullset.png" width="100%"><br>
				<div class="produk_nama">
					<a href="?page=kategori_game1&&id_kategori=<?php echo @$tampil1['id_kategori']; ?>">
						<?php echo $tampil1['kategori']; ?>
					</a>
				</div><br>
				<a href="?page=kategori_game1&&id_kategori=<?php echo @$tampil1['id_kategori']; ?>" class="produk_tombol_kecil">LIHAT DAFTAR GAME</a>
			</div>
		<?php } ?>
	</div>
</div>