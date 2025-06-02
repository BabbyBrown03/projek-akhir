<?php
include_once("config.php");

$search = '';
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}

// Pagination
$limit = 9;
$page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$offset = ($page - 1) * $limit;

if (!empty($search)) {
    $query = "SELECT * FROM resep WHERE nama_resep LIKE '%$search%' ORDER BY id_resep DESC LIMIT $offset, $limit";
    $countQuery = "SELECT COUNT(*) FROM resep WHERE nama_resep LIKE '%$search%'";
} else {
    $query = "SELECT * FROM resep ORDER BY id_resep DESC LIMIT $offset, $limit";
    $countQuery = "SELECT COUNT(*) FROM resep";
}

$result = mysqli_query($conn, $query);
$total_result = mysqli_query($conn, $countQuery);
$row_total = mysqli_fetch_row($total_result);
$total_data = $row_total[0];
$total_pages = ceil($total_data / $limit);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Resep - ResepMbokQ</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card-title {
      font-size: 1rem;
      font-weight: bold;
      text-align: center;
    }
    .search-bar {
      max-width: 400px;
      margin: 0 auto 30px;
    }
    .card img {
      height: 180px;
      object-fit: cover;
    }
  </style>
</head>
<body class="bg-light">

<?php include 'navbar.php'; ?>
<div class="container py-5">
  <h2 class="text-center mb-4">Resep Terbaru</h2>

  <form method="get" action="" class="search-bar input-group mb-4">
    <input type="text" name="search" class="form-control" placeholder="Cari resep..." value="<?= htmlspecialchars($search) ?>">
    <button type="submit" class="btn btn-success">Cari</button>
  </form>

  <div class="row g-4">
    <?php if (mysqli_num_rows($result) > 0): ?>
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="col-md-4 col-sm-6">
          <div class="card h-100 shadow-sm">
            <img src="uploads/<?= htmlspecialchars($row['gambar']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['nama_resep']) ?>">
            <div class="card-body d-flex flex-column justify-content-between">
              <h5 class="card-title"><?= htmlspecialchars($row['nama_resep']) ?></h5>
              <div class="text-center mt-2">
                <a href="detail.php?id=<?= $row['id_resep'] ?>" class="btn btn-sm btn-success">Lihat Resep</a>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="col-12 text-center">
        <p class="text-muted">Resep tidak ditemukan.</p>
      </div>
    <?php endif; ?>
  </div>

  <?php if ($total_pages > 1): ?>
    <nav class="mt-5">
      <ul class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
          <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
            <a class="page-link" href="?halaman=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
          </li>
        <?php endfor; ?>
      </ul>
    </nav>
  <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>