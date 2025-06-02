<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container">
    <a class="navbar-brand" href="home.php">ResepMbokQ</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'home.php' ? 'active' : '' ?>" href="home.php">Home</a></li>
        <li class="nav-item"><a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'resep.php' ? 'active' : '' ?>" href="resep.php">Resep</a></li>
        <li class="nav-item"><a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : '' ?>" href="profile.php">Profil</a></li>
        <li class="nav-item"><a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'category.php' ? 'active' : '' ?>" href="category.php">Kategori</a></li>
      </ul>
      <?php if (isset($_SESSION['username'])): ?>
        <span class="text-white me-2">Hai, <?= htmlspecialchars($_SESSION['username']) ?>!</span>
        <a href="logout.php" class="btn btn-outline-light">Logout</a>
      <?php else: ?>
        <a href="login.php" class="btn btn-outline-light">Login</a>
      <?php endif; ?>
    </div>
  </div>
</nav>