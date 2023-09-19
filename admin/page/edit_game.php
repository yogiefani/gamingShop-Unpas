	<div class="container">
		<?php
		$idgame = mysqli_real_escape_string($conn, @$_GET['id_game']);
		$proses = mysqli_real_escape_string($conn, @$_GET['proses']);
		if ($proses == "update") {
			$idkategori = mysqli_real_escape_string($conn, @$_POST['id_kategori']);
			$namagame = mysqli_real_escape_string($conn, @$_POST['namagame']);
			$harga = mysqli_real_escape_string($conn, @$_POST['harga']);
			$stok = mysqli_real_escape_string($conn, @$_POST['stok']);
			$deskripsi = mysqli_real_escape_string($conn, @$_POST['deskripsi']);
			$nama_gambar = mysqli_real_escape_string($conn, @$_FILES['images']['name']);
			$tmp_gambar = mysqli_real_escape_string($conn, @$_FILES['images']['tmp_name']);
			if (!empty($nama_gambar)) {
				$cekgambar = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM game WHERE id_game='$idgame'"));
				if (!empty($cekgambar['images'])) { //gambar akan dihapus jika didatabase sebelumnya sudah ada gambar
					unlink("../$cekgambar[images]");
				}else{
					echo "Maaf!! Gambar tidak ada";
				}
				//baris ini adalah baris untuk upload gambar baru
				copy($tmp_gambar, "../images/$nama_gambar");
				$update_gambar = mysqli_query($conn, "UPDATE game SET images='images/$nama_gambar' WHERE id_game='$idgame'");
			}
			$update = mysqli_query($conn, "UPDATE game SET id_kategori='$idkategori',namagame='$namagame',harga='$harga',stok='$stok',deskripsi='$deskripsi' WHERE id_game='$idgame'");
			if ($update) {
				echo "Sukses!! Update Data Berhasil";
				header("Location: ?page=tambah_game");
			} else {
				echo "Maaf!! Proses Update Data Gagal";
			}
		}

		$tampildata = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM game WHERE id_game='$idgame'"));
		?>
		<h2 class="">Edit Data Game <?php echo $tampildata['namagame'] ?></h2>
		<form method="post" action="?page=edit_game&&proses=update
	&&id_game=<?php echo $idgame ?>" enctype="multipart/form-data">
			<label class="col-4">Kategori game</label>
			<div class="col-8">
				<select class="form_input" name="id_kategori">
					<?php
					$kategorigame = mysqli_query(
						$conn,
						"SELECT * FROM kategori_game"
					);
					while ($kategorigame1 = mysqli_fetch_array($kategorigame)) {
					?>
						<option value="
					<?php echo $kategorigame1['id_kategori']; ?>" <?php if ($tampildata['id_kategori'] == $kategorigame1['id_kategori']) { ?>selected <?php } ?>>
							<?php echo $kategorigame1['kategori']; ?></option>
					<?php } ?>
				</select>
			</div>
			<label class="col-4">Nama Game</label>
			<div class="col-8">
				<input class="form_input" type="text" name="namagame" value="<?php echo $tampildata['namagame']; ?>">
			</div>
			<label class="col-4">Harga</label>
			<div class="col-8">
				<input class="form_input" type="text" name="harga" value="<?php echo $tampildata['harga']; ?>">
			</div>
			<label class="col-4">Stok</label>
			<div class="col-8">
				<input class="form_input" type="text" name="stok" value="<?php echo $tampildata['stok']; ?>">
			</div>
			<label class="col-4">Deskripsi</label>
			<div class="col-8">
				<textarea class="form_input" name="deskripsi" rows="10" style="width:100%;"><?php echo $tampildata['deskripsi']; ?></textarea>
			</div>
			<label class="col-4">Ganti Gambar</label>
			<div class="col-8">
				<input class="form_input" type="file" name="images">
			</div>

			<div class="col-12">
				<img src="../<?php echo $tampildata['images']; ?>" alt="" width="100px">
			</div>
			<div class="row">
				<div class="col-12">
					<button class="form_button2" type="submit">Update Data</button>
				</div>
			</div>
		</form>
		<br>
	</div>