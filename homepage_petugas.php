<?php 
session_start();
if ($_SESSION['status_login'] != true) {
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Homepage Petugas</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="box-shadow: 4px 4px 5px -4px;">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">WEBSITE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="homepage_petugas.php">Home</a>
            </li>
            <?php
            // Menampilkan link tampil pelanggan hanya jika level bukan seller
            if ($_SESSION['level'] != 'seller') {
            ?>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="tampilpetugas.php">Worker</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="tampilpelanggan.php">List</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="produk.php">Product</a>
            </li>
            <?php
            }
            ?>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container bg-light rounded" style="margin-top:10px">
        <h1>Selamat datang, <?= $_SESSION['nama_petugas'] ?>!</h1>
        <h3>Level: <?= $_SESSION['level'] ?></h3> <!-- Menampilkan nama level -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-FTvPjhG6M4h93wWTVoURR7xzGJ7Skbb8N4t+6IpoTxi1pCuDbbV4Mr5p54uJF05G" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0ey1sM2DAu2e0+JpLkzu2RzABJ5JpXMiGpBb/TFgFg70JpUcNF8d8hZg" crossorigin="anonymous"></script>
</body>
</html>
