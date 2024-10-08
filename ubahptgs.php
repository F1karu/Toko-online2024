<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Petugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 700px;
            margin-top: 50px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background: #ffffff;
        }
        .card-header {
            background-color: #007bff;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .form-control, .form-select {
            border-radius: 10px;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            border-radius: 10px;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .form-group label {
            font-weight: 600;
        }
    </style>
</head>
<?php
include "koneksi.php"; 

if(isset($_GET['id_petugas']) && is_numeric($_GET['id_petugas'])) {
    
    $id_petugas = $_GET['id_petugas'];

    $query_get_petugas = mysqli_query($conn, "SELECT * FROM petugas WHERE id_petugas = $id_petugas");
    $qry_level = mysqli_query($conn, "SELECT * FROM level");
    
    if(mysqli_num_rows($query_get_petugas) > 0) {
        $data_petugas = mysqli_fetch_assoc($query_get_petugas);
?>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ubah Data Petugas</h3>
            </div>
            <div class="card-body">
                <form method="post" action="proses_ubahptgs.php" class="row g-3" enctype="multipart/form-data">
                    <input type="hidden" name="id_petugas" value="<?=$id_petugas?>">
                    
                    <div class="form-group mb-3">
                        <label for="nama_petugas" class="form-label">Nama Petugas:</label>
                        <input type="text" name="nama_petugas" class="form-control" id="nama_petugas" value="<?=$data_petugas['nama_petugas']?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="foto_petugas" class="form-label">Foto Petugas</label>
                        <input type="file" id="foto_petugas" name="foto_petugas" class="form-control" accept="image/*">
                        <img id="img-preview" class="img-preview" style="max-width:100%; display:none; margin-top:20px; border-radius:15px;">
                        <button type="button" id="crop_button" class="btn btn-warning mt-3" style="display:none;">Konfirmasi Crop</button>
                    </div>

                    <div class="form-group mb-3">
                        <label for="username" class="form-label">Nama Petugas:</label>
                        <input type="text" name="username" class="form-control" id="username" value="<?=$data_petugas['username']?>" required>
                    </div>


                    <div class="form-group mb-3">
                        <label for="id_level" class="form-label">level:</label>
                        <select name="id_level" class="form-select" id="id_level" required>
                            <?php
                            while($data_level = mysqli_fetch_array($qry_level)) {
                                echo '<option value="'.$data_level['id_level'].'" '.($data_level['id_level'] == $data_petugas['id_level'] ? 'selected' : '').'>'.$data_level['nama_level'].'</option>'; 
                            }
                            ?>
                        </select>
                    </div>

                    <input type="hidden" id="cropped_data" name="cropped_data">
                    
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="tampilpetugas.php" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    const fotoInput = document.getElementById('foto_petugas');
    const imgPreview = document.getElementById('img-preview');
    const cropButton = document.getElementById('crop_button');
    let cropper;

    fotoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                imgPreview.src = event.target.result;
                imgPreview.style.display = 'block';

                if (cropper) {
                    cropper.destroy();
                }
                cropper = new Cropper(imgPreview, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 1
                });

                cropButton.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });

    cropButton.addEventListener('click', function() {
        if (cropper) {
            const croppedCanvas = cropper.getCroppedCanvas({
                width: 300,
                height: 300
            });
            const croppedImage = croppedCanvas.toDataURL('image/png');
            document.getElementById('cropped_data').value = croppedImage;
        }
    });
    </script>
</body>
</html>

<?php
    } else {
        echo "<div class='alert alert-danger'>Data petugas tidak ditemukan.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>ID petugas tidak valid.</div>";
}
?>
