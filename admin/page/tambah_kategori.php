	<div class="container">
		<h2 class="">KATEGORI GAME</h2>

		<hr>

		<div class="kotak_form">
			<b>Tambah/Edit Data</b>
			<?php
			$idkategori = mysqli_real_escape_string($conn, @$_GET['id_kategori']);
			if (@$_GET['proses'] == "form_edit") {
				$action = "?page=tambah_kategori&&proses=edit&&id_kategori=$idkategori";
				$tampildata = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM kategori_game WHERE id_kategori='$idkategori'"));
			} else {
				$action = "?page=tambah_kategori&&proses=tambah";
			}
			?>
			<form method="post" action="<?php echo $action; ?>">
				<label class="col-4">Kategori</label>
				<div class="col-8">
					<input class="form_input" type="text" name="kategori" value="<?php echo @$tampildata['kategori']; ?>" placeholder="Kategori Game" class="form_input">
				</div>
				<input type="submit" name="Simpan" value="Simpan" class="form_button2">
			</form>
		</div><br>
		<div class="kotak_form">
			<?php
			$proses = mysqli_real_escape_string($conn, @$_GET['proses']);
			$kategori = mysqli_real_escape_string($conn, @$_POST['kategori']);
			$idkategori = mysqli_real_escape_string($conn, @$_GET['id_kategori']);
			if ($proses == "tambah") {
				$simpan = mysqli_query($conn, "INSERT INTO kategori_game(kategori) VALUES('$kategori')");
				if ($simpan) {
					echo "Sukses!!, Simpan Data Berhasil<br>";
				} else {
					echo "Maaf!!, Simpan Data Gagal<br>";
				}
			}
			if ($proses == "edit") {
				$update = mysqli_query($conn, "UPDATE kategori_game SET kategori='$kategori' WHERE id_kategori='$idkategori'");
				if ($update) {
					echo "Sukses!! Data Berhasil diupdate<br>";
				} else {
					echo "Maaf!! Data Gagal diupdate<br>";
				}
			}
			if ($proses == "hapus") {
				$hapus = mysqli_query($conn, "DELETE FROM kategori_game WHERE id_kategori='$idkategori'");
				if ($hapus) {
					echo "Sukses!!, Hapus Data Berhasil<br>";
				} else {
					echo "Maaf!!, Hapus Data Gagal<br>";
				}
			}
			?>
			<b>Tampil Data</b><br><br>
			<form method="post" class="form">
				<input type="text" name="cari" placeholder="cari..">
				<button for="cari">cari</button>
			</form>
			<table border="1" cellpadding="3" cellspacing="1" width="100%">
				<tr>
					<td><b>No</b></td>
					<td><b>Kategori</b></td>
					<td>Aksi</td>
				</tr>
				<?php
				$i = 1;
				$kategori = mysqli_query($conn, "SELECT * FROM kategori_game");
				if (isset($_POST['cari'])) {
					$kategori = mysqli_query($conn, "SELECT * FROM kategori_game WHERE kategori LIKE '%" . $_POST['cari'] . "%'");
				}
				while ($kategori1 = mysqli_fetch_array($kategori)) {
				?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $kategori1['kategori']; ?></td>
						<td>
							<a class="text_kecil" href="?page=edit_kategori&&id_kategori=<?php echo $kategori1['id_kategori'] ?>" class="">Edit</a>
							<a class="text_kecil2" href="?page=tambah_kategori&&id_kategori=<?php echo $kategori1['id_kategori'] ?>&&proses=hapus" class="">Hapus</a>
						</td>
					</tr>
				<?php $i = $i + 1;
				} ?>
			</table>
			<br>
		</div>
	</div>