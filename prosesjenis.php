<?php
if ($_POST) {
    // Ambil data dari form
    $nama_jenis = $_POST['nama_jenis'];

    // Validasi input
    if (empty($nama_jenis)) {
        echo "<script>alert('Nama jenis tidak boleh kosong');location.href='tambahjenis.php';</script>";
    } else {
        include "koneksi.php";

        // Query untuk menyimpan data jenis ke database
        $insert = mysqli_query($conn, "INSERT INTO jenis (nama_jenis) VALUES ('$nama_jenis')");

        // Cek apakah query berhasil dijalankan
        if ($insert) {
            echo "<script>alert('Sukses menambahkan jenis');location.href='tambahjenis.php';</script>";
        } else {
            // Jika gagal menyimpan ke database
            echo "<script>alert('Gagal menambahkan jenis ke database');location.href='tambahjenis.php';</script>";
        }
    }
}
?>
