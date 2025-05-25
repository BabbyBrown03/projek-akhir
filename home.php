<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ResepMbokQ - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container">
    <a class="navbar-brand" href="#">ResepMbokQ</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Resep</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Profil</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Kategori</a></li>
      </ul>
      <a href="login.php" class="btn btn-outline-light">Login</a>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<header class="hero">
  <div class="hero-content">
    <h1>RESEP MASAKAN</h1>
    <p>
      Inilah tempatnya segala resep masakan enak!<br>
      MbokQ telah siapkan beragam hidangan seru bergaya rumahan, tepat sebagai masakan sehari-hari.
    </p>
    <a href="#resep-terbaru" class="btn btn-success px-4 py-2 mt-3">Lihat Selengkapnya</a>
  </div>
</header>

<!-- Resep Terbaru -->
<section class="py-5 bg-light" id="resep-terbaru">
  <div class="container">
    <h2 class="text-center mb-4">Resep Terbaru</h2>
    <div class="row g-4" id="resep-list">
      <?php
      $result = mysqli_query($conn, "SELECT * FROM resep ORDER BY id_resep DESC");
      $index = 0;
      while($row = mysqli_fetch_assoc($result)):
        $hiddenClass = $index >= 6 ? 'd-none' : ''; // Sembunyikan jika lebih dari 6
      ?>
        <div class="col-md-4 resep-item <?php echo $hiddenClass; ?>">
          <div class="card h-100">
            <img src="uploads/<?php echo $row['gambar']; ?>" class="card-img-top" alt="<?php echo $row['nama_resep']; ?>">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['nama_resep']; ?></h5>
              <a href="detail.php?id=<?php echo $row['id_resep']; ?>" class="btn btn-success btn-sm">Lihat Resep</a>
            </div>
          </div>
        </div>
      <?php
        $index++;
      endwhile;
      ?>
    </div>
    
    <?php if ($index > 5): ?>
      <div class="text-center mt-4">
        <button id="loadMoreBtn" class="btn btn-success">Lihat Lebih Banyak</button>
      </div>
    <?php endif; ?>
  </div>
</section>

<script>
  // JavaScript untuk tombol "Lihat Lebih Banyak"
  document.addEventListener('DOMContentLoaded', function () {
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    const items = document.querySelectorAll('.resep-item.d-none');
    let isExpanded = false;
    
    if (loadMoreBtn) {
      loadMoreBtn.addEventListener('click', function () {
        items.forEach(item => item.classList.remove('d-none'));
        loadMoreBtn.style.display = 'none';
      });
    }
  });
</script>

<!-- Footer -->
<footer class="bg-success text-white pt-5 pb-3 mt-5">
  <div class="container">
    <div class="row text-center text-md-start">
      <div class="col-md-4 mb-4">
        <div class="footer-logo fw-bold fs-5">RESEP MBOKQ</div>
        <p>Temukan resep praktis untuk keluarga Anda setiap hari.</p>
      </div>
      <div class="col-md-2 mb-3">
        <h6>Kategori</h6>
        <ul class="list-unstyled">
          <li><a href="#" class="text-white text-decoration-none">Ayam</a></li>
          <li><a href="#" class="text-white text-decoration-none">Ikan</a></li>
          <li><a href="#" class="text-white text-decoration-none">Sayuran</a></li>
        </ul>
      </div>
      <div class="col-md-2 mb-3">
        <h6>Resepku</h6>
        <ul class="list-unstyled">
          <li><a href="#" class="text-white text-decoration-none">Tersimpan</a></li>
          <li><a href="#" class="text-white text-decoration-none">Favorit</a></li>
        </ul>
      </div>
      <div class="col-md-4 mb-3">
        <h6>Kontak Kami</h6>
        <p>Email: info@mbokq.com<br>Telepon: 0812-3456-7890</p>
      </div>
    </div>
    <hr class="border-white">
    <p class="text-center mb-0">&copy; 2025 ResepMbokQ. All rights reserved.</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>