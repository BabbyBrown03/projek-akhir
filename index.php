<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Resep</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1000px;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .btn {
            display: inline-block;
            padding: 8px 12px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .btn-edit {
            background-color: #2196F3;
        }
        .btn-edit:hover {
            background-color: #0b7dda;
        }
        .btn-delete {
            background-color: #f44336;
        }
        .btn-delete:hover {
            background-color: #da190b;
        }
        .header-action {
            margin-bottom: 20px;
        }
        .overflow {
            overflow: auto;
            text-overflow: ellipsis;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Data Resep Masakan</h1>
        
        <div class="header-action">
            <a href="tambah.php" class="btn">Tambah Resep</a>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id resep</th>
                    <th>Nama resep</th>
                    <th>Bahan-bahan</th>
                    <th>Langkah Kerja</th>
                    <th>Biaya</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include file koneksi database
                include_once("config.php");
                
                // Query untuk mengambil data resep
                $result = mysqli_query($conn, "SELECT * FROM resep ORDER BY nama_resep ASC");
                
                // Cek apakah ada data
                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    // Looping untuk menampilkan data
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$no++."</td>";
                        echo "<td>".$row['id_resep']."</td>";
                        echo "<td>".$row['nama_resep']."</td>";
                        echo "<td>".$row['bahan']."</td>";
                        echo "<td class='overflow'>".$row['langkah']."</td>";
                        echo "<td>".$row['biaya']."</td>";
                        echo "<td>";
                        echo "<a href='edit.php?id=".$row['id_resep']."' class='btn btn-edit'>Edit</a> ";
                        echo "<a href='hapus.php?id=".$row['id_resep']."' class='btn btn-delete' onclick='return confirm(\"Yakin ingin menghapus data?\")'>Hapus</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' style='text-align:center'>Tidak ada data</td></tr>";
                }
                
                // Tutup koneksi
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>