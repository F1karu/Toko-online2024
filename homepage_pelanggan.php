<?php 
session_start();
if ($_SESSION['status_login'] != true) {
    header('location: login.php');
}
?>
<h2>Selamat datang <?=$_SESSION['nama_pelanggan']?> di website Perpus Online.</h2>
<?php
    