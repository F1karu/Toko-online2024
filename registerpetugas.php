<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Petugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
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
        #img-preview {
            display: none;
            max-width: 100%;
            margin-top: 20px;
            border-radius: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Petugas</h3>
            </div>
            <div class="card-body">
                <form action="prosespetugas.php" method="post" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="nama_petugas" class="form-label">Nama Petugas</label>
                        <input type="text" id="nama_petugas" name="nama_petugas" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="foto_petugas" class="form-label">Foto Petugas</label>
                        <input type="file" id="foto_petugas" name="foto_petugas" class="form-control" accept="image/*" required>
                        <img id="img-preview" class="img-preview">
                        <canvas id="cropped_image" style="display: none;"></canvas>
                    </div>
                    <button type="button" id="crop_button" class="btn btn-warning mt-3" style="display: none;">Konfirmasi Crop</button>
                    <div class="form-group mb-3">
                        <label for="usernameptgs" class="form-label">Username</label>
                        <input type="text" id="usernameptgs" name="usernameptgs" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="level" class="form-label">Level</label>
                        <select id="level" name="level" class="form-select" required>
                            <option value="" disabled selected>Pilih Level</option>
                            <?php 
                            include "koneksi.php";
                            $qry_level = mysqli_query($conn, "SELECT * FROM level");
                            while ($dt_level = mysqli_fetch_array($qry_level)) {
                                echo '<option value="'.$dt_level['id_level'].'">'.$dt_level['nama_level'].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" id="cropped_data" name="cropped_data">
                    <button type="submit" name="simpan" class="btn btn-success">Tambah Petugas</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    const fotoInput = document.getElementById('foto_petugas');
    const imgPreview = document.getElementById('img-preview');
    const canvas = document.getElementById('cropped_image');
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
            canvas.style.display = 'block';
            canvas.getContext('2d').drawImage(croppedCanvas, 0, 0);
            document.getElementById('cropped_data').value = croppedImage;
        }
    });
    </script>
</body>
</html>
