<?php 
if ($_POST) {
    // Memeriksa apakah form login untuk pelanggan atau petugas
    if (isset($_POST['username'])) {
        // Login untuk pelanggan (Morotuku)
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username)) {
            echo "<script>alert('Username tidak boleh kosong');location.href='login.php';</script>";
        } elseif (empty($password)) {
            echo "<script>alert('Password tidak boleh kosong');location.href='login.php';</script>";
        } else {
            include "koneksi.php";
            $qry_login = mysqli_query($conn, "SELECT * FROM pelanggan WHERE username = '".$username."'");

            if (mysqli_num_rows($qry_login) > 0) {
                $dt_login = mysqli_fetch_array($qry_login);
                // Verifikasi password
                if (password_verify($password, $dt_login['password'])) {
                    session_start();
                    $_SESSION['id_pelanggan'] = $dt_login['id_pelanggan'];
                    $_SESSION['nama_pelanggan'] = $dt_login['nama_pelanggan'];
                    $_SESSION['status_login'] = true;
                    header("location: homepage_pelanggan.php");
                } else {
                    echo "<script>alert('Username dan Password untuk pelanggan tidak benar');location.href='login.php';</script>";
                }
            } else {
                echo "<script>alert('Username tidak ditemukan');location.href='login.php';</script>";
            }
        }
    } elseif (isset($_POST['usernameptgs'])) {
        // Login untuk petugas (Worker)
        $worker_id = $_POST['usernameptgs'];
        $password = $_POST['password'];

        if (empty($worker_id)) {
            echo "<script>alert('Worker ID tidak boleh kosong');location.href='login.php';</script>";
        } elseif (empty($password)) {
            echo "<script>alert('Password tidak boleh kosong');location.href='login.php';</script>";
        } else {
            include "koneksi.php";
            // Ambil data petugas beserta nama level
            $qry_login = mysqli_query($conn, "
                SELECT p.*, l.nama_level 
                FROM petugas p 
                JOIN level l ON p.level = l.id_level 
                WHERE p.username = '".$worker_id."'
            ");

            if (mysqli_num_rows($qry_login) > 0) {
                $dt_login = mysqli_fetch_array($qry_login);
                // Verifikasi password
                if (password_verify($password, $dt_login['password'])) {
                    session_start();
                    $_SESSION['id_petugas'] = $dt_login['id_petugas'];
                    $_SESSION['nama_petugas'] = $dt_login['nama_petugas'];
                    $_SESSION['level'] = $dt_login['nama_level']; // Simpan nama level di session
                    $_SESSION['status_login'] = true;

                    // Redirect ke homepage petugas
                    header("location: homepage_petugas.php");
                } else {
                    echo "<script>alert('Worker ID dan Password untuk petugas tidak benar');location.href='login.php';</script>";
                }
            } else {
                // Notifikasi jika Worker ID tidak ditemukan
                echo "<script>alert('Worker ID tidak ditemukan');location.href='login.php';</script>";
            }
        }
    }
}
?>
