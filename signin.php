<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();


$host = "localhost";
$user = "u458337714_trice_hijab";
$pass = "Sisfo396";
$dbname = "u458337714_localhost";


$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses login saat form disubmit
$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cari user berdasarkan email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['no_hp'] = $user['no_hp'];
            $_SESSION['role'] = $user['role'];

            // Redirect berdasarkan role
            if ($user['role'] === 'admin') {
                header("Location: dashboard_admin.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $error = "Username atau password anda salah!";
        }
    } else {
        // $error = "Akun tidak ditemukan!";
        $error = "Username atau password anda salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Trice Hijab</title>
  <link rel="icon" type="image/png" href="Proyek.png" />
  <link rel="stylesheet" href="auth.css"/>
</head>
<body>
  <main class="auth">
    <img src="Proyek.png" alt="Trice Hijab" class="logo" style="width: 80px; margin-bottom: 20px;" />
    <h2>Masuk ke Trice Hijab</h2>

    <?php if ($error): ?>
      <p style="color: red;"><?php echo $error; ?></p><br>
    <?php endif; ?>

    <form method="POST" action="">
      <input type="email" name="email" placeholder="Email" required />
      <input type="password" name="password" placeholder="Kata Sandi" required />
      <button type="submit">Masuk</button>
      <p>Belum punya akun? <a href="signup.php">Daftar</a></p>
    </form>
  </main>
</body>
</html>
