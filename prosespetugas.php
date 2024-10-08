<?php
if ($_POST) {
    $nama_petugas = $_POST['nama_petugas'];
    $usernameptgs = $_POST['usernameptgs'];
    $password = $_POST['password'];
    $croppedImage = $_POST['cropped_data'];
    $level = $_POST['level'];

    if (empty($nama_petugas) || empty($croppedImage) || empty($usernameptgs) || empty($password) || empty($level)) {
        echo "<script>alert('Semua field harus diisi');location.href='tambahpetugas.php';</script>";
    } else {
        include "koneksi.php";
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $image_parts = explode(";base64,", $croppedImage);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $file_name = uniqid() . '.' . $image_type;
        $file_path = 'assets/foto/' . $file_name;

        if (file_put_contents($file_path, $image_base64)) {
            $insert = mysqli_query($conn, "INSERT INTO petugas (nama_petugas, foto_petugas, username, password, level) 
                VALUES ('$nama_petugas', '$file_name', '$usernameptgs', '$hashed_password', '$level')");

            if ($insert) {
                echo "<script>alert('Sukses menambahkan petugas');location.href='login.php';</script>";
            } else {
                echo "<script>alert('Gagal menambahkan petugas ke database');location.href='tambahpetugas.php';</script>";
            }
        } else {
            echo "<script>alert('Gagal menyimpan foto petugas');location.href='tambahpetugas.php';</script>";
        }
    }
}
?>
