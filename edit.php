<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resep</title>
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
        <h1>Edit Resep</h1>
        
        <?php
        // Include file koneksi database
        include_once("config.php");
        
        // Cek apakah ada ID yang dikirimkan
        if(!isset($_GET['id'])) {
            header("Location: index.php");
            exit();
        }
        
        $id = $_GET['id'];
        
        // Cek apakah form telah di-submit
        if(isset($_POST['update'])) {
            $nama = $_POST['nama_resep'];
            $bahan = $_POST['bahan'];
            $langkah = $_POST['langkah'];
            $biaya = $_POST['biaya'];
            
            // Validasi form
            $errors = array();
            
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
            }
            
            // Jika tidak ada error, update data
            if(empty($errors)) {
                $gambarBaru = $_FILES['gambar']['name'];
                $tmpGambar = $_FILES['gambar']['tmp_name'];
                $gambarLama = $row['gambar'];

                if ($gambarBaru) {
                    if (!is_dir('uploads')) {
                        mkdir('uploads');
                }

        // Upload gambar baru dan hapus lama jika berhasil
                if (move_uploaded_file($tmpGambar, "uploads/$gambarBaru")) {
                    if (file_exists("uploads/$gambarLama") && $gambarLama != $gambarBaru) {
                        unlink("uploads/$gambarLama");
                }
                } else {
                    $gambarBaru = $gambarLama; // Gagal upload, tetap pakai gambar lama
                }
            } else {
                $gambarBaru = $gambarLama; // Tidak pilih gambar baru
            }

            $result = mysqli_query($conn, "UPDATE resep SET 
                nama_resep='$nama',
                bahan='$bahan',
                langkah='$langkah',
                biaya='$biaya',
                gambar='$gambarBaru'
                WHERE id_resep='$id'
            ");

                
                if($result) {
                    echo "<div style='padding: 10px; background-color: #d4edda; color: #155724; border-radius: 5px; margin-bottom: 15px;'>";
                    echo "Data berhasil diperbarui. <a href='index.php'>Lihat Data</a>";
                    echo "</div>";
                } else {
                    echo "<div style='padding: 10px; background-color: #f8d7da; color: #721c24; border-radius: 5px; margin-bottom: 15px;'>";
                    echo "Error: " . mysqli_error($conn);
                    echo "</div>";
                }
            } else {
                echo "<div style='padding: 10px; background-color: #f8d7da; color: #721c24; border-radius: 5px; margin-bottom: 15px;'>";
                echo "<ul>";
                foreach($errors as $error) {
                    echo "<li>$error</li>";
                }
                echo "</ul>";
                echo "</div>";
            }
        }
        
        // Ambil data mahasiswa berdasarkan ID
        $result = mysqli_query($conn, "SELECT * FROM resep WHERE id_resep='$id'");
        
        // Jika data tidak ditemukan, kembali ke halaman utama
        if(mysqli_num_rows($result) == 0) {
            header("Location: index.php");
            exit();
        }
        
        // Ambil data untuk ditampilkan di form
        $row = mysqli_fetch_assoc($result);
        $id = $row['id_resep'];
        $nama = $row['nama_resep'];
        $bahan = $row['bahan'];
        $langkah = $row['langkah'];
        $biaya = $row['biaya'];
        $gambar = $row['gambar'];
        ?>
        
        <form action="edit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_resep">Nama Resep</label>
                <input type="text" name="nama_resep" id="nama_resep" value="<?php echo htmlspecialchars($nama); ?>" required>
            </div>

            <div class="form-group">
                <label for="bahan">Bahan-bahan</label>
                <textarea name="bahan" id="bahan" required><?php echo htmlspecialchars($bahan); ?></textarea>
            </div>

            <div class="form-group">
                <label for="langkah">Langkah Kerja</label>
                <textarea name="langkah" id="langkah" required><?php echo htmlspecialchars($langkah); ?></textarea>
            </div>

            <div class="form-group">
                <label for="biaya">Biaya</label>
                <input type="text" name="biaya" id="biaya" value="<?php echo htmlspecialchars($biaya); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="gambar">Upload Gambar Baru (opsional)</label>
                <input type="file" name="gambar" id="gambar" accept="image/*">
                <p>Gambar saat ini:</p>
                <img src="uploads/<?php echo htmlspecialchars($row['gambar']); ?>" alt="Gambar Resep" style="max-width: 100%; height: auto;">
            </div>

            <div style="margin-top: 20px;">
                <input type="submit" name="update" value="Update" class="btn">
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>