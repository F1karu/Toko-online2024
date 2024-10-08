<?php
if ($_POST) {
    // Ambil data dari form
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $telpon = $_POST['telpon'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $croppedImage = $_POST['cropped_data'];  // Data gambar yang sudah di-crop dalam format base64

    // Validasi input
    if (empty($nama_pelanggan)) {
        echo "<script>alert('Nama pelanggan tidak boleh kosong');location.href='tambahpelanggan.php';</script>";
    } elseif (empty($croppedImage)) {
        echo "<script>alert('Foto pelanggan tidak boleh kosong');location.href='tambahpelanggan.php';</script>";
    } else {
        include "koneksi.php";
        
        // Hash password menggunakan bcrypt
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Proses decoding base64 image
        $image_parts = explode(";base64,", $croppedImage);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];  // Mengambil ekstensi file (misal png)
        $image_base64 = base64_decode($image_parts[1]);

        // Buat nama file unik untuk gambar dan tentukan path penyimpanan
        $file_name = uniqid() . '.' . $image_type;
        $file_path = 'assets/foto/' . $file_name;

        // Simpan gambar hasil decoding ke direktori 'uploads'
        if (file_put_contents($file_path, $image_base64)) {
            // Jika gambar berhasil disimpan, simpan data pelanggan ke database
            $insert = mysqli_query($conn, "INSERT INTO pelanggan (nama_pelanggan, alamat, telp, email, username, password, foto_pelanggan) 
                VALUES ('$nama_pelanggan', '$alamat', '$telpon', '$email', '$username', '$hashed_password', '$file_name')");

            // Cek apakah query berhasil dijalankan
            if ($insert) {
                echo "<script>alert('Sukses menambahkan pelanggan');location.href='login.php';</script>";
            } else {
                // Jika gagal menyimpan ke database
                echo "<script>alert('Gagal menambahkan pelanggan ke database');location.href='tambahpelanggan.php';</script>";
            }
        } else {
            // Jika gagal menyimpan gambar ke direktori
            echo "<script>alert('Gagal menyimpan foto pelanggan');location.href='tambahpelanggan.php';</script>";
        }
    }
}
?>
