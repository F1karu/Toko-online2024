<?php
if ($_POST) {
    // Ambil data dari form
    $nama_level = $_POST['nama_level'];

    // Validasi input
    if (empty($nama_level)) {
        echo "<script>alert('Nama level tidak boleh kosong');location.href='tambahlevel.php';</script>";
    } else {
        include "koneksi.php";

        // Query untuk menyimpan data level ke database
        $insert = mysqli_query($conn, "INSERT INTO level (nama_level) VALUES ('$nama_level')");

        // Cek apakah query berhasil dijalankan
        if ($insert) {
            echo "<script>alert('Sukses menambahkan level');location.href='tambahlevel.php';</script>";
        } else {
            // Jika gagal menyimpan ke database
            echo "<script>alert('Gagal menambahkan level ke database');location.href='tambahlevel.php';</script>";
        }
    }
}
?>
