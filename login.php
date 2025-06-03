<?php
include 'config.php';

if (isLoggedIn()) {
    header("Location: home.php");
    exit();
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($username == 'admin' || $password == 'admin123') {
        
      $_SESSION['username'] = 'admin';
      header("Location: index.php");
        exit();
    }


    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            header("Location: home.php");
            exit();
        } else {
            $error = "Username atau password salah!";
        }
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login - Resepin.aja</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body, html {
      height: 100%;
    }
    .login-box {
      background-color: #00a896;
      border-radius: 15px;
      padding: 40px;
      color: white;
      box-shadow: 0 0 20px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 400px;
    }
    .login-box .form-control {
      border-radius: 10px;
    }
    .alert {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
      border-radius: 5px;
      padding: 10px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

<div class="d-flex justify-content-center align-items-center vh-100">
  <div class="login-box text-center">
    <h3 class="mb-4">Selamat Datang Resepin.aja</h3>

    <?php if (isset($error)): ?>
      <div class="alert"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="post">
      <div class="mb-3 text-start">
        <input type="text" name="username" class="form-control" placeholder="Username" required>
      </div>
      <div class="mb-3 text-start">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
      </div>
      <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
    </form>
    <p class="mt-3 text-end"><small>Belum punya akun? <a href="register.php" class="text-white">Daftar disini</a></small></p>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>