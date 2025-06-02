<?php
include 'config.php';
include 'navbar.php';

if (!isset($_GET['id_kategori'])) {
  echo "<div class='container mt-5 alert alert-danger'>Kategori tidak ditemukan.</div>";
  exit;
}

$id_kategori = intval($_GET['id_kategori']);

// Ambil nama kategori
$queryKategori = "SELECT nama_kategori FROM kategori WHERE id_kategori = $id_kategori";
$resultKategori = mysqli_query($conn, $queryKategori);
$kategori = mysqli_fetch_assoc($resultKategori);

// Ambil resep berdasarkan kategori
$queryResep = "SELECT * FROM resep WHERE id_kategori = $id_kategori";
$resultResep = mysqli_query($conn, $queryResep);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Resep Berdasarkan Kategori</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card:hover {
      transform: scale(1.03);
      transition: 0.3s ease;
    }
    .breadcrumb a {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="container mt-4">
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="home.php" class="text-primary">Home</a></li>
      <li class="breadcrumb-item"><a href="category.php" class="text-primary">Kategori</a></li>
      <li class="breadcrumb-item active text-secondary" aria-current="page"><?= htmlspecialchars($kategori['nama_kategori']) ?></li>
    </ol>
  </nav>

  <!-- Judul -->
  <h4 class="text-success fw-bold text-center mb-4">Resep: <?= htmlspecialchars($kategori['nama_kategori']) ?></h4>

  <!-- Grid Resep -->
  <div class="row">
    <?php if (mysqli_num_rows($resultResep) > 0): ?>
      <?php while ($row = mysqli_fetch_assoc($resultResep)): ?>
        <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <?php if (!empty($row['gambar']) && file_exists('uploads/' . $row['gambar'])): ?>
            <img src="uploads/<?= $row['gambar'] ?>" class="card-img-top mb-2 rounded" style="height: 180px; object-fit: cover;" alt="<?= htmlspecialchars($row['nama_resep']) ?>">
            <?php endif; ?>
            <div class="card-body d-flex flex-column">
                <h5 class="card-title text-success"><?= htmlspecialchars($row['nama_resep']) ?></h5>
                <p class="card-text mb-1"><strong>Biaya:</strong> Rp<?= number_format($row['biaya'], 0, ',', '.') ?></p>
                <a href="detail.php?id=<?= $row['id_resep'] ?>" class="btn btn-success mt-auto">Lihat Resep</a>
            </div>
        </div>
    </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="col-12">
        <div class="alert alert-warning text-center">Belum ada resep dalam kategori ini.</div>
      </div>
    <?php endif; ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
