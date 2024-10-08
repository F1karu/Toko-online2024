<?php
include "koneksi.php";

if ($_POST) {
    $id_petugas = $_POST['id_petugas'];
    $nama_petugas = $_POST['nama_petugas'];
    $id_level = $_POST['id_level'];
    
    // Mengatur gambar baru jika diupload
    if (isset($_POST['cropped_data']) && !empty($_POST['cropped_data'])) {
        $cropped_data = $_POST['cropped_data'];
        $folder = "assets/foto/";  // Sesuaikan dengan direktori penyimpanan foto

        // Mengubah data base64 menjadi file gambar
        $image_parts = explode(";base64,", $cropped_data);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        // Penamaan file gambar
        $file_name = 'petugas_' . time() . '.' . $image_type;
        $file_path = $folder . $file_name;

        // Menyimpan file gambar
        file_put_contents($file_path, $image_base64);
        
        // Mengambil gambar lama untuk dihapus jika ada
        $query_get_old_image = mysqli_query($conn, "SELECT foto_petugas FROM petugas WHERE id_petugas = $id_petugas");
        $old_image = mysqli_fetch_assoc($query_get_old_image)['foto_petugas'];
        
        if ($old_image && file_exists("assets/foto/" . $old_image)) {
            unlink("assets/foto/" . $old_image);
        }

        // Update dengan gambar baru
        $query_update = mysqli_query($conn, "UPDATE petugas SET nama_petugas = '$nama_petugas', level = '$id_level', foto_petugas = '$file_name' WHERE id_petugas = '$id_petugas'");
    } else {
        // Jika gambar tidak diubah
        $query_update = mysqli_query($conn, "UPDATE petugas SET nama_petugas = '$nama_petugas', level = '$id_level' WHERE id_petugas = '$id_petugas'");
    }

    if ($query_update) {
        echo "<script>alert('Data petugas berhasil diubah!');location.href='tampilpetugas.php';</script>";
    } else {
        echo "<script>alert('Gagal mengubah data petugas.');location.href='tampilpetugas.php';</script>";
    }
}
?>
