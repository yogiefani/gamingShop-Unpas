<?php
$cekuserlogin = $_SESSION['username'];
?>
<?php
if (empty($cekuserlogin)) {
	header("Location: login.php");
} else { ?>
	<!DOCTYPE html>
	<html>

	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href=".../style.css">
	</head>

	<body>
		<div class="container">
			<h2 class="">GAME</h2>
			<hr>
			<b>Tambah/Edit Data</b>
			<?php
			//proses simpan data
			$proses = mysqli_real_escape_string($conn, @$_GET['proses']);
			if ($proses == "simpan") {
				$idkategori = @$_POST['id_kategori'];
				$namagame = @$_POST['namagame'];
				$harga = @$_POST['harga'];
				$stok = @$_POST['stok'];
				$deskripsi = @$_POST['deskripsi'];
				$nama_gambar = @$_FILES['images']['name'];
				$tmp_gambar = @$_FILES['images']['tmp_name'];
				if (!empty($nama_gambar)) {
					copy($tmp_gambar, "../images/$nama_gambar");
				}
				$simpan = mysqli_query($conn, "
    		INSERT INTO game(id_kategori,namagame,
    		harga,stok,deskripsi,images) 
    		VALUES('$idkategori','$namagame',
    		'$harga','$stok','$deskripsi','images/$nama_gambar')");
				if ($simpan) {
					echo "<h3>Input Data Berhasil</h3>";
				} else {
					echo "<h3>Input Data Gagal</h3>";
				}
			}
			if ($proses == "hapus") {
				$idgame = mysqli_real_escape_string($conn, @$_GET['id_game']);
				$cekdata = mysqli_fetch_array(mysqli_query(
					$conn,
					"SELECT * FROM game WHERE 
    		id_game='$idgame'"
				));
				unlink("../$cekdata[images]");
				$hapus = mysqli_query($conn, "DELETE FROM game WHERE 
    		id_game='$idgame'");
				if ($hapus) {
					echo "<h3>Hapus Data Berhasil</h3>";
				} else {
					echo "<h3>Hapus Data Gagal</h3>";
				}
			}
			?>
			<form method="post" action="?page=tambah_game&&proses=simpan" enctype="multipart/form-data">
				<label class="col-4">Kategori Game</label>
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
					<?php echo $kategorigame1['id_kategori']; ?>"><?php echo $kategorigame1['kategori']; ?></option>
						<?php } ?>
					</select>
				</div>
				<label class="col-4">Nama game</label>
				<div class="col-8">
					<input class="form_input" type="text" name="namagame" maxlength="100" placeholder="Masukan nama game" minlength="1">
				</div>
				<label class="col-4">Harga game</label>
				<div class="col-8">
					<input class="form_input" type="number" name="harga" maxlength="20" placeholder="Masukan harga game(tidak boleh ada tanda ./," minlength="1">
				</div>
				<label class="col-4">Stok game</label>
				<div class="col-8">
					<input class="form_input" type="number" name="stok" maxlength="20" placeholder="Masukan stok game(tidak boleh ada tanda ./," minlength="1">
				</div>
				<label class="col-4">Deskripsi</label>
				<div class="col-8">
					<textarea class="form_input" name="deskripsi" rows="20" style="width:100%;" minlength="1"></textarea>
				</div>
				<label class="col-4">Upload Gambar Buku</label>
				<input class="col-8" type="file" accept="image/*" name="images">

				<label class="col-4">&nbsp;</label>
				<div class="col-8">
					<button class="form_button2" type="submit">Simpan Data</button>
				</div>
			</form>
			<h3>Tampil Data</h3>
			<form method="post" class="form">
				<input type="text" name="cari" placeholder="cari..">
				<button for="cari">cari</button>
			</form>
			<table class="table_admin" border="1" cellpadding="5" cellspacing="0">
				<tr>
					<td>NO</td>
					<td>Nama Game</td>
					<td>Harga Rupiah</td>
					<td>Stok Game</td>
					<td>Gambar</td>
					<td>aksi</td>
				</tr>
				<?php
				$tampildata = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM kategori_game"));
				$i = 1;
				$query = mysqli_query($conn, "SELECT * FROM game");
				if (isset($_POST['cari'])) {
					$query = mysqli_query($conn, "SELECT * FROM game WHERE namagame LIKE '%" . $_POST['cari'] . "%'");
				}
				while ($cetak = mysqli_fetch_array($query)) {
				?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $cetak['namagame']; ?></td>
						<td><?php echo $cetak['harga']; ?></td>
						<td><?php echo $cetak['stok']; ?></td>
						<td><img src="../<?php echo $cetak['images']; ?>" alt="" width="50px"></td>
						<td>
							<a class="text_kecil" href="?page=edit_game&&id_game=
				<?php echo $cetak['id_game']; ?>">
								Edit</a>
							<a class="text_kecil2" href="?page=tambah_game&&id_game=
				<?php echo $cetak['id_game']; ?>&&proses=hapus">
								Hapus</a>
						</td>
					</tr>
				<?php $i = $i + 1;
				} ?>
			</table>
			<br>
		</div>
	</body>

	</html>
<?php } ?>