<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Resep</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
            resize: vertical;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .btn-secondary {
            background-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Resep</h1>
        
        <?php
        // Include file koneksi database
        include_once("config.php");
        
        // Cek apakah form telah di-submit
        if(isset($_POST['submit'])) {
            $id = $_POST['id_resep'];
            $nama = $_POST['nama_resep'];
            $bahan = $_POST['bahan'];
            $langkah = $_POST['langkah'];
            $biaya = $_POST['biaya'];
            
            // Validasi form
            $errors = array();
            if(empty($id)) {
                $errors[] = "Id resep tidak boleh kosong";
            }
            if(empty($nama)) {
                $errors[] = "Nama resep tidak boleh kosong";
            }
            if(empty($bahan)) {
                $errors[] = "Bahan-bahan tidak boleh kosong";
            }
            if(empty($langkah)) {
                $errors[] = "Langkah kerja tidak boleh kosong";
            }
            if(empty($biaya)) {
                $errors[] = "Biaya tidak boleh kosong";
            } elseif(!is_numeric($biaya)) {
                $errors[] = "Biaya harus berupa angka";
            }
            
            // Jika tidak ada error, simpan data
            if(empty($errors)) {
                $gambar = $_FILES['gambar']['name'];
                $tmp = $_FILES['gambar']['tmp_name'];

                if (!is_dir('uploads')) {
                    mkdir('uploads');
                }

                if (move_uploaded_file($tmp, "uploads/$gambar")) {
                    $result = mysqli_query($conn, "INSERT INTO resep (id_resep, nama_resep, bahan, langkah, biaya, gambar) 
                                       VALUES('$id', '$nama', '$bahan', '$langkah', '$biaya', '$gambar')");
                if($result) {
                    echo "<div style='padding: 10px; background-color: #d4edda; color: #155724; border-radius: 5px; margin-bottom: 15px;'>";
                    echo "✅ Resep berhasil ditambahkan. <a href='index.php'>Lihat Data</a>";
                    echo "</div>";
                } else {
                    echo "<div style='padding: 10px; background-color: #f8d7da; color: #721c24; border-radius: 5px; margin-bottom: 15px;'>";
                    echo "❌ Error: " . mysqli_error($conn);
                    echo "</div>";
                }
            } else {
                echo "<div style='padding: 10px; background-color: #f8d7da; color: #721c24; border-radius: 5px; margin-bottom: 15px;'>";
                echo "❌ Upload gambar gagal.";
                echo "</div>";
                }
            }
        }
        ?>
        
        <form action="tambah.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="id_resep">Id Resep</label>
                <input type="text" name="id_resep" id="id_resep" required>
                
            <div class="form-group">
                <label for="nama_resep">Nama Resep</label>
                <input type="text" name="nama_resep" id="nama_resep" required>
            </div>
            
            <div class="form-group">
                <label for="bahan">Bahan-bahan</label>
                <textarea name="bahan" id="bahan" required></textarea>
            </div>
        
            <div class="form-group">
                <label for="langkah">Langkah Kerja</label>
                <textarea name="langkah" id="langkah" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="biaya">Biaya</label>
                <input type="text" name="biaya" id="biaya" required>
            </div>
            
            <div class="form-group">
                <label for="gambar">Upload Gambar</label>
                <input type="file" name="gambar" id="gambar" accept="image/*" required>
            </div>

            <div style="margin-top: 20px;">
                <input type="submit" name="submit" value="Simpan" class="btn">
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>