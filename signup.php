<?php

// ====== Koneksi ke Database ======
$host = "localhost";
$user = "u458337714_trice_hijab";
$pass = "Sisfo396";
$dbname = "u458337714_localhost";

$conn = new mysqli($host, $user, $pass, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// ====== Proses Form Jika Dikirim ======
$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama     = $_POST['nama'];
    $email    = $_POST['email'];
    $no_hp    = $_POST['no_hp'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Cek apakah email sudah terdaftar
    $cek = $conn->query("SELECT * FROM users WHERE email = '$email'");
    if ($cek->num_rows > 0) {
        $error = "Email sudah digunakan!";
    } else {
        // Simpan ke database
        $sql = "INSERT INTO users (nama, email, no_hp, password) VALUES ('$nama', '$email', '$no_hp', '$password')";
        if ($conn->query($sql) === TRUE) {
            header("Location: signin.php");
            exit();
        } else {
            $error = "Gagal mendaftar: " . $conn->error;
        }
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
  <link rel="stylesheet" href="auth.css" />
</head>
<body>
  <main class="auth">
    <img src="Proyek.png" alt="Trice Hijab" class="logo" style="width: 80px; margin-bottom: 20px;" />
    <h2>Daftar ke Trice Hijab</h2>

    <?php if ($error): ?>
      <p style="color: red;"><?php echo $error; ?></p><br>
    <?php endif; ?>

    <form method="POST" action="">
      <input type="text" name="nama" placeholder="Nama Lengkap" required />
      <input type="email" name="email" placeholder="Email" required />
      <input type="no_hp" name="no_hp" placeholder="Nomor Handphone" required />
      <input type="password" name="password" placeholder="Kata Sandi" required />
      <button type="submit">Daftar</button>
      <p>Sudah punya akun? <a href="signin.php">Masuk</a></p>
    </form>
  </main>
</body>
</html>
