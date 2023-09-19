<!-- 
 Lokasi dan Nama File	: page/detail_produk.php
-->
<br>
<div class="container">
    <div class="col-12">
        <h1>DETAIL GAME</h1>
    </div>
</div>
<div class="container">
    <?php
    $idgame = mysqli_real_escape_string($conn, @$_GET['id_game']);
    $tampil = mysqli_query($conn, "SELECT * FROM game WHERE id_game='$idgame'");
    $tampil1 = mysqli_fetch_array($tampil);
    ?>
    <div class="row">
        <div class="col-5">
            <img src="<?php echo $tampil1['images']; ?>" width="80%">
        </div>
        <div class="col-7 produk_detail">
            <h3><?php echo $tampil1['namagame']; ?></h3><br>
            <table width="100%" cellpadding="5" cellspacing="0">
                <tr>
                    <td width="20%">Harga</td>
                    <td>
                        : Rp. <?php echo number_format($tampil1['harga']); ?><br>
                    </td>
                </tr>
                <tr>
                    <td>Stok</td>
                    <td>
                        : <?php echo $tampil1['stok']; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php echo $tampil1['deskripsi']; ?>
                    </td>
                </tr>
            </table><br>
            <a href="" class="form_button2">Add to Cart</a>

        </div>
    </div>

    <div class="produk_deskripsi">
        <?php echo $tampil1['deskripsi']; ?>
    </div>
</div>