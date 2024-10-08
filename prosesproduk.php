<?php
if ($_POST) {
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $jenis = $_POST['jenis'];
    $croppedImage = $_POST['cropped_data']; // Data gambar yang telah di-crop

    if (empty($nama_produk) || empty($deskripsi) || empty($harga) || empty($jenis) || empty($croppedImage)) {
        echo "<script>alert('Semua field harus diisi');location.href='tambahproduk.php';</script>";
    } else {
        include "koneksi.php";

        // Mengubah harga menjadi integer (jika diperlukan)
        $harga = intval($harga);

        // Mengelola gambar yang di-crop
        $image_parts = explode(";base64,", $croppedImage);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        // Memberi nama file unik
        $file_name = uniqid() . '.' . $image_type;
        $file_path = 'assets/foto/' . $file_name;

        // Menyimpan gambar ke folder
        if (file_put_contents($file_path, $image_base64)) {
            // Menyimpan data produk ke database
            $insert = mysqli_query($conn, "INSERT INTO produk (nama_produk, deskripsi, harga, foto_produk, id_jenis) 
                VALUES ('$nama_produk', '$deskripsi', '$harga', '$file_name', '$jenis')");

            if ($insert) {
                echo "<script>alert('Sukses menambahkan produk');location.href='produk.php';</script>";
            } else {
                echo "<script>alert('Gagal menambahkan produk ke database');location.href='tambahproduk.php';</script>";
            }
        } else {
            echo "<script>alert('Gagal menyimpan foto produk');location.href='tambahproduk.php';</script>";
        }
    }
}
?>
