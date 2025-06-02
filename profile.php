<?php
include 'config.php';
include 'navbar.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

// Upload Foto jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto'])) {
    $fotoName = $_FILES['foto']['name'];
    $fotoTmp = $_FILES['foto']['tmp_name'];
    $fotoExt = pathinfo($fotoName, PATHINFO_EXTENSION);
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array(strtolower($fotoExt), $allowed)) {
        $newName = uniqid('user_') . '.' . $fotoExt;
        $uploadPath = 'uploads/users' . $newName;

        if (move_uploaded_file($fotoTmp, $uploadPath)) {
            // Hapus foto lama jika ada
            $getOldFoto = mysqli_fetch_assoc(mysqli_query($conn, "SELECT foto FROM user WHERE id_user = $id_user"));
            if (!empty($getOldFoto['foto']) && file_exists('uploads/users' . $getOldFoto['foto'])) {
                unlink('uploads/users' . $getOldFoto['foto']);
            }

            mysqli_query($conn, "UPDATE user SET foto = '$newName' WHERE id_user = $id_user");
            header("Location: profile.php");
            exit;
        }
    } else {
        $error = "Format file tidak didukung. Gunakan jpg, jpeg, png, atau gif.";
    }
}

// Ambil data user
$queryUser = mysqli_query($conn, "SELECT * FROM user WHERE id_user = $id_user");
$user = mysqli_fetch_assoc($queryUser);

// Ambil komentar user
$queryKomentar = mysqli_query($conn, "
    SELECT c.*, r.nama_resep 
    FROM comments c
    JOIN resep r ON c.id_resep = r.id_resep
    WHERE c.id_user = $id_user
    ORDER BY c.created_at DESC
");

// Path foto profil
$fotoPath = !empty($user['foto']) && file_exists("uploads/users" . $user['foto']) 
    ? "uploads/users" . $user['foto'] 
    : "assets/default-avatar.png";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Profil | ResepMbokQ</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .profile-container {
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 30px;
    }
    .profile-img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 50%;
      background-color: #eee;
    }
    .btn-komentar {
      background-color: #009879;
      color: white;
      border: none;
      padding: 6px 12px;
      font-size: 14px;
    }
    .komentar-box {
      background-color: #fffbe6;
      padding: 16px;
      border-radius: 6px;
      margin-bottom: 16px;
    }
  </style>
</head>
<body>
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
    </nav>
  <div class="profile-container">
    <img src="<?= $fotoPath ?>" alt="Foto Profil" class="profile-img">
    <div>
      <h5 class="mb-0"><strong><?= htmlspecialchars($user['username']) ?></strong></h5>
      <small><?= htmlspecialchars($user['email']) ?></small><br>
      <a href="logout.php" class="text-dark small"><i class="bi bi-box-arrow-right"></i> Log out</a>
    </div>
  </div>

  <!-- Form Upload Foto -->
  <form action="" method="post" enctype="multipart/form-data" class="mb-3">
    <div class="row g-2 align-items-center">
      <div class="col-auto">
        <input type="file" name="foto" accept="image/*" class="form-control form-control-sm">
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-success btn-sm">Update Foto</button>
      </div>
    </div>
    <?php if (isset($error)): ?>
      <div class="text-danger small mt-2"><?= $error ?></div>
    <?php endif; ?>
  </form>

  <button class="btn-komentar mb-3">Komentarku</button>

  <?php if (mysqli_num_rows($queryKomentar) > 0): ?>
    <?php while ($komen = mysqli_fetch_assoc($queryKomentar)): ?>
      <div class="komentar-box">
        <strong>Di resep: <?= htmlspecialchars($komen['nama_resep']) ?></strong><br>
        <small class="text-muted"><?= $komen['created_at'] ?></small>
        <p class="mb-0"><?= nl2br(htmlspecialchars($komen['isi_komentar'])) ?></p>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p class="text-muted">Kamu belum menulis komentar apa pun.</p>
  <?php endif; ?>
</div>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>