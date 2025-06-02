<?php
include 'config.php';
include 'navbar.php';
?>

<!-- Bootstrap & Icons CDN -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kategori Masakan</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card:hover {
      transform: scale(1.03);
      transition: 0.3s ease;
    }
  </style>
</head>
<body>

<!-- Konten Utama -->
<div class="container mt-4">
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="home.php" class="text-primary text-decoration-underline">Home</a>
      </li>
      <li class="breadcrumb-item active text-secondary" aria-current="page">Kategori</li>
    </ol>
  </nav>

  <!-- Judul -->
  <h4 class="text-center text-success fw-bold mb-5">Kategori Masakan</h4>

  <!-- Kategori Grid -->
  <div class="row justify-content-center">
    <?php
    $query = "SELECT * FROM kategori";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)):
    ?>
      <div class="col-6 col-md-3 col-lg-2 mb-4 d-flex justify-content-center">
        <a href="resep_kategori.php?id_kategori=<?= $row['id_kategori'] ?>" class="text-decoration-none w-100">
          <div class="card bg-success text-white text-center border-0 shadow-sm" style="height: 100px;">
            <div class="card-body d-flex align-items-center justify-content-center">
              <strong><?= htmlspecialchars($row['nama_kategori']) ?></strong>
            </div>
          </div>
        </a>
      </div>
    <?php endwhile; ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>