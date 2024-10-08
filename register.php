<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
    <script src="https://unpkg.com/cropperjs/dist/cropper.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 900px;
            margin-top: 50px;
        }
        .card {
            border-radius: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            background: #ffffff;
            padding: 30px;
        }
        .card-header {
            text-align: center;
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #007bff;
        }
        .form-control, .form-select {
            border-radius: 10px;
            padding: 15px;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 10px;
            padding: 10px 25px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        #img-preview {
            display: none;
            max-width: 100%;
            margin-top: 20px;
            border-radius: 15px;
            max-height: 300px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Tambah Pelanggan
            </div>
            <div class="card-body">
                <form action="prosesregister.php" method="post" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                        <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="foto_pelanggan" class="form-label">Foto Pelanggan</label>
                        <input type="file" id="foto_pelanggan" name="foto_pelanggan" class="form-control" accept="image/*" required>
                        <img id="img-preview" class="img-preview">
                        <canvas id="cropped_image" style="display: none;"></canvas>
                    </div>
                    <button type="button" id="crop_button" class="btn btn-warning mt-3" style="display: none;">Konfirmasi Crop</button>
                    <div class="form-group mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea id="alamat" name="alamat" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="telpon" class="form-label">Telepon</label>
                        <input type="text" id="telpon" name="telpon" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary">Tambah Pelanggan</button>
                    <input type="hidden" id="cropped_data" name="cropped_data">
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script>
    const fotoInput = document.getElementById('foto_pelanggan');
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

    function cropImage() {
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
    }

    document.querySelector('form').addEventListener('submit', function(e) {
        cropImage();
    });
    </script>
</body>
</html>
