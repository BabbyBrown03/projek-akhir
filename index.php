<?php
include_once("config.php");

// Batasi akses hanya untuk username 'admin'
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    echo "<div class='container mt-5'><h4>Akses ditolak. Halaman ini hanya bisa diakses oleh admin.</h4></div>";
    exit;
}

$search = '';
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}

// Pagination
$limit = 5; // jumlah data per halaman
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$offset = ($halaman - 1) * $limit;

if (!empty($search)) {
    $query = "SELECT * FROM resep WHERE nama_resep LIKE '%$search%' ORDER BY nama_resep ASC LIMIT $offset, $limit";
    $countQuery = "SELECT COUNT(*) FROM resep WHERE nama_resep LIKE '%$search%'";
} else {
    $query = "SELECT * FROM resep ORDER BY nama_resep ASC LIMIT $offset, $limit";
    $countQuery = "SELECT COUNT(*) FROM resep";
}

$result = mysqli_query($conn, $query);
$total_result = mysqli_query($conn, $countQuery);
$row_total = mysqli_fetch_row($total_result);
$total_data = $row_total[0];
$total_halaman = ceil($total_data / $limit);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Resep</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-4">
<div class="container bg-white p-4 rounded shadow">
    <?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-success">
        <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
    </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
    <?php endif; ?>
    <h1 class="text-center mb-4">Data Resep Masakan</h1>

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
        <a href="tambah.php" class="btn btn-success">Tambah Resep</a>
        <form method="get" action="" class="d-flex gap-2">
            <input type="text" name="search" class="form-control" placeholder="Cari resep..." value="<?= htmlspecialchars($search) ?>">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
            <tr>
                <th>No</th>
                <th>ID Resep</th>
                <th>Nama Resep</th>
                <th>Bahan-bahan</th>
                <th>Langkah Kerja</th>
                <th>Biaya</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                $no = $offset + 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$no++."</td>";
                    echo "<td>".$row['id_resep']."</td>";
                    echo "<td>".$row['nama_resep']."</td>";
                    echo "<td>".$row['bahan']."</td>";
                    echo "<td>".$row['langkah']."</td>";
                    echo "<td>".$row['biaya']."</td>";
                    echo "<td>
                            <div class='d-flex flex-wrap gap-2'>
                                <a href='edit.php?id=".$row['id_resep']."' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='hapus.php?id=".$row['id_resep']."' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus data?\")'>Hapus</a>
                            </div>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>Tidak ada data ditemukan.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <?php if ($total_halaman > 1): ?>
    <nav class="mt-3">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $total_halaman; $i++): ?>
                <li class="page-item <?= ($halaman == $i) ? 'active' : '' ?>">
                    <a class="page-link" href="?halaman=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
    <?php endif; ?>
</div>
</body>
</html>