<?php
include "koneksi.php";
$qry_produk = mysqli_query($conn, "SELECT * FROM produk");
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title></title>

    <style>
    .card {
        box-shadow: -4px 0 15px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        display: grid;
        place-content: center;
    }

    .title-worker {
        display: grid;
        place-content: center;
        margin-bottom: 5px;
    }

    .card-img-top {
        margin-left: 80px;
    }
    </style>
</head>
<?php
include "headerptgs.php";
?>
<body>
    <div class="container mt-5">
        <div class="title-worker">
            <h1>Product List</h1>
        </div>
        <div class="row">
            <?php
            $no = 0;
            while($data_produk = mysqli_fetch_array($qry_produk)){
                $no++;
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">
                                <!-- Mengubah jalur untuk folder assets/foto -->
                                <img src="assets/foto/<?=$data_produk['foto_produk']?>" class="card-img-top" style="width:150px;height:150px;object-fit:cover;">
                                <h3 class="card-title"><?=$data_produk['nama_produk']?></h3>
                                <strong>Deskripsi:</strong> <?=$data_produk['deskripsi']?><br>
                                <strong>Harga:</strong> <?=$data_produk['harga']?><br>
                            </p>
                            <a href="ubah.php?id_produk=<?=$data_produk['id_produk']?>" class="btn btn-success">Ubah</a>
                            <a href="hapus.php?id_produk=<?=$data_produk['id_produk']?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class="btn btn-danger">Hapus</a>
                            <a href="detail.php?id_produk=<?=$data_produk['id_produk']?>" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
            <?php 
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
