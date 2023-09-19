<!-- 
 Lokasi dan Nama File	: page/home.php
-->
<div class="thumbnail">
    <div class="linear"></div>
</div>
<div class="body_konten">
    <div class="container">
        <form class="produk_search" method="post" class="form">
            <input class="form_search" type="text" name="cari" placeholder="cari..">
            <button class="form_button2" for="cari">cari</button>
        </form>
        <div class="row">
            <div class="col-12 heading_game">
                <h1>Rekomendasi</h1>
            </div>
        </div>
        <?php
        $game = mysqli_query($conn, "SELECT * FROM game ORDER BY id_game");
        if (isset($_POST['cari'])) {
            $game = mysqli_query($conn, "SELECT * FROM game WHERE namagame LIKE '%" . $_POST['cari'] . "%'");
        }
        while ($game1 = mysqli_fetch_array($game)) {
        ?>
            <div class="game col-3">
                <img src="<?php echo $game1['images']; ?>" width="100%" height="150px"><br>
                <div class="namagame">
                    <a href="?page=detail_game&&id_game=<?php echo $game1['id_game']; ?>">
                        <?php echo $game1['namagame']; ?>
                    </a><br>
                    <i class="namagamei">Rp.<?php echo number_format($game1['harga']); ?></i>
                </div>
                <center>
                    <a href="?page=detail_game&&id_game=<?php echo $game1['id_game']; ?>" class="detail_game">Detail Game</a>
                </center>
            </div>
        <?php } ?>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 heading_game">
                <h1>Game terbaru</h1>
            </div>
        </div>
        <?php
        $game = mysqli_query($conn, "SELECT * FROM game ORDER BY id_game DESC");
        if (isset($_POST['cari'])) {
            $game = mysqli_query($conn, "SELECT * FROM game WHERE namagame LIKE '%" . $_POST['cari'] . "%'");
        }
        while ($game1 = mysqli_fetch_array($game)) {
        ?>
            <div class="game col-3">
                <img src="<?php echo $game1['images']; ?>" width="100%" height="150px"><br>
                <div class="namagame">
                    <a href="?page=detail_game&&id_game=<?php echo $game1['id_game']; ?>">
                        <?php echo $game1['namagame']; ?>
                    </a><br>
                    <i class="namagamei">Rp.<?php echo number_format($game1['harga']); ?></i>
                </div>
                <center>
                    <a href="?page=detail_game&&id_game=<?php echo $game1['id_game']; ?>" class="detail_game">Detail Game</a>
                </center>
            </div>
        <?php } ?>
    </div>
    <div class="row">

    </div>
</div>