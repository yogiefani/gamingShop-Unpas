<!-- 
 Lokasi dan Nama File	: page/kategori_game1.php
-->
<br>
<div class="container">
    <div class="col-12">
        <h1>DETAIL KATEGORI GAME</h1>
    </div>
</div>
<div class="container">
    <?php
    $id_kategori = mysqli_real_escape_string($conn, @$_GET['id_kategori']);
    $game = mysqli_query($conn, "SELECT * FROM game WHERE id_kategori='$id_kategori' ORDER BY id_game DESC");
    $game2 = mysqli_num_rows($game);
    if ($game2 == 0) {
        echo "<font size='+2' color='#FF0004'>Maaf!! Data game pada Kategori ini masih Kosong</font>";
    }
    while ($game1 = mysqli_fetch_array($game)) {
    ?>
        <div class="col-3 game">
            <img src="<?php echo $game1['images']; ?>" width="100%" height="150px"><br>
            <div class="produk_nama">
                <a href="?page=detail_game&&id_game=<?php echo $game1['id_game']; ?>">
                    <?php echo $game1['namagame']; ?>
                </a>
            </div>
            <?php echo $game1['harga']; ?><br>
            <a href="?page=detail_game&&id_game=<?php echo $game1['id_game']; ?>" class="produk_tombol_kecil">Detail game</a>
            <a href="#" class="produk_tombol_kecil">Add to Cart</a>
        </div>
    <?php } ?>
</div>
<div class="row"></div>