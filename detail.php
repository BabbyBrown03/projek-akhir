<?php
include 'config.php';
include 'navbar.php';

// Validasi ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='container mt-5'><h4>Resep tidak ditemukan.</h4></div>";
    exit;
}

$id = intval($_GET['id']);

// Ambil data resep dari database
$result = mysqli_query($conn, "SELECT * FROM resep WHERE id_resep = $id");
if (mysqli_num_rows($result) == 0) {
    echo "<div class='container mt-5'><h4>Resep tidak ditemukan.</h4></div>";
    exit;
}
$resep = mysqli_fetch_assoc($result);

// Proses komentar jika dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['isi_komentar']) && isset($_SESSION['username'])) {
    $isi_komentar = mysqli_real_escape_string($conn, $_POST['isi_komentar']);
    $id_user = $_SESSION['id_user'];
    mysqli_query($conn, "INSERT INTO comments (id_resep, id_user, isi_komentar) VALUES ($id, $id_user, '$isi_komentar')");

    header("Location: detail.php?id=$id");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($resep['nama_resep']) ?> | ResepMbokQ</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="home.php">Beranda</a></li>
      <li class="breadcrumb-item"><a href="resep.php">Resep</a></li>
      <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($resep['nama_resep']) ?></li>
    </ol>
  </nav>

  <h2 class="mb-3 text-center"><?= htmlspecialchars($resep['nama_resep']) ?></h2>
  <div class="text-center mb-4">
    <img class="img-fluid" src="uploads/<?= htmlspecialchars($resep['gambar']) ?>" alt="<?= htmlspecialchars($resep['nama_resep']) ?>" class="img-fluid" style="max-width: 500px;">
    <p class="text-muted mt-2">Estimasi biaya: <strong>Rp <?= number_format($resep['biaya'], 0, ',', '.') ?></strong></p>
  </div>

  <h5>Bahan-Bahan</h5>
  <div class="bg-light p-3 mb-4 rounded d-flex flex-column"><?= nl2br(htmlspecialchars($resep['bahan'])) ?></div>

  <h5>Cara Membuat</h5>
  <div class="bg-light p-3 mb-4 rounded"><?= nl2br(htmlspecialchars($resep['langkah'])) ?></div>

  <hr>

  <h5>Komentar</h5>

  <?php if (isset($_SESSION['username'])): ?>
    <form method="POST" class="mb-4">
      <div class="mb-3">
        <textarea name="isi_komentar" class="form-control" rows="3" placeholder="Tulis komentar..." required></textarea>
      </div>
      <button type="submit" class="btn btn-success">Kirim Komentar</button>
    </form>
  <?php else: ?>
    <p><a href="login.php">Login</a> untuk menulis komentar.</p>
  <?php endif; ?>

  <h4 class="mt-5">Komentar</h4>

<?php
$comments = mysqli_query($conn, "
  SELECT c.*, u.username 
  FROM comments c
  JOIN user u ON c.id_user = u.id_user
  WHERE c.id_resep = $id
  ORDER BY c.id_komentar DESC
");


if (mysqli_num_rows($comments) > 0) {
    while ($k = mysqli_fetch_assoc($comments)) {
        echo "<div class='mb-3 p-3 border rounded'>
                <strong>" . htmlspecialchars($k['username']) . "</strong><br>
                <small class='text-muted'>" . $k['created_at'] . "</small>
                <p class='mb-0'>" . nl2br(htmlspecialchars($k['isi_komentar'])) . "</p>
              </div>";
    }
} else {
    echo "<p class='text-muted'>Belum ada komentar.</p>";
}
?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>