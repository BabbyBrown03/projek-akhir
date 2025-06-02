<?php
include 'config.php';

if (isLoggedIn()) {
    header("Location: index.php");
    exit();
}

$errors = [];
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Validasi input
    if (empty($username)) {
        $errors[] = "Username tidak boleh kosong";
    }

    if (empty($email)) {
        $errors[] = "Email tidak boleh kosong";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid";
    }

    if (empty($password)) {
        $errors[] = "Password tidak boleh kosong";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password minimal 6 karakter";
    }

    // Cek apakah username/email sudah digunakan
    $check_query = "SELECT * FROM user WHERE username = '$username' OR email = '$email'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $errors[] = "Username atau email sudah terdaftar";
    }

    // Simpan ke database jika tidak ada error
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $insert_query = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

        if (mysqli_query($conn, $insert_query)) {
            $success = "Registrasi berhasil! Silakan login.";
        } else {
            $errors[] = "Terjadi kesalahan: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register - Resepin.aja</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body, html {
      height: 100%;
    }
    .register-box {
      background-color: #00a896;
      border-radius: 15px;
      padding: 40px;
      color: white;
      box-shadow: 0 0 20px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 450px;
    }
    .register-box .form-control {
      border-radius: 10px;
    }
  </style>
</head>
<body>

<div class="d-flex justify-content-center align-items-center vh-100">
  <div class="register-box">
    <h3 class="text-center mb-4">Daftar Resepin.aja</h3>

    <?php if (!empty($errors)): ?>
      <div class="alert alert-danger">
        <ul class="mb-0">
          <?php foreach ($errors as $error): ?>
            <li><?= $error ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
      <div class="alert alert-success">
        <?= $success ?>
      </div>
    <?php endif; ?>

    <form method="post">
      <div class="mb-3">
        <input type="text" name="username" class="form-control" placeholder="Username" required value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">
      </div>
      <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" required value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
      </div>
      <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary w-100">Daftar</button>
      </div>
      <p class="mt-3 text-end"><small>Sudah punya akun? <a href="login.php" class="text-white">Login disini</a></small></p>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
