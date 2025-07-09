<?php
session_start();
require 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: home.php");
  exit();
}

$user_id = $_SESSION['user_id'];

// Ambil data dari database
$stmt = $conn->prepare("SELECT nama, email, no_hp, foto FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($nama, $email, $nohp, $foto);
$stmt->fetch();
$stmt->close();

// Cek foto
$foto_url = $foto ? "uploads/$foto" : "https://i.pravatar.cc/120?u=$user_id";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Trice Hijab</title>
  <link rel="icon" type="image/png" href="Proyek.png" />
  <link rel="stylesheet" href="style.css" />
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>
<!-- header -->
  <?php include 'header_user.php'; ?>

  <main class="profile-container">
    <h2>Profil Pengguna</h2>
    <div class="profile-card">
      <img src="<?= htmlspecialchars($foto_url) ?>" alt="Foto Pengguna" class="profile-pic" />
      <div class="profile-info">
        <p><strong>Nama:</strong> <?= htmlspecialchars($nama) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
        <p><strong>No. HP:</strong> <?= htmlspecialchars($nohp) ?></p>
        <div class="profile-actions">
          <a href="edit_profil.php" class="btn small">Edit Profil</a>
          <a href="logout.php" class="btn secondary small">Logout</a>
        </div>
      </div>
    </div>
  </main>

  <footer class="site-footer">
    <div class="footer-container">
      <div class="footer-col">
        <h4>NEWSLETTER</h4>
        <p>Subscribe to receive updates, access to exclusive deals, and more.</p>
        <form>
          <input type="email" placeholder="Enter your email address" />
          <button type="submit">SUBSCRIBE</button>
        </form>
      </div>

      <div class="footer-col">
        <h4>Trice Hijab</h4>
        <p>Trice Hijab hadir sebagai representasi gaya muslimah modern yang anggun dan percaya diri.</p>
        <div class="social-icons">
          <a href="https://www.facebook.com/people/Trice-Hijab/61577776005727/"><ion-icon name="logo-facebook" style="font-size: 24px; color: #1877F2;"></ion-icon></a>
          <a href="https://www.instagram.com/traicehijab"><ion-icon name="logo-instagram" style="font-size: 24px; color: #E1306C;"></ion-icon></a>
          <a href="https://wa.me/087775825718"><ion-icon name="logo-whatsapp" style="font-size: 24px; color: #25D366;"></ion-icon></a>
          <a href="https://www.tiktok.com/@triceh1jab_" target="_blank"><ion-icon name="logo-tiktok" style="font-size: 24px; color: #010101;"></ion-icon></a>
        </div>
      </div>

      <div class="footer-col">
        <h4>CUSTOMER SERVICES</h4>
        <p>Chat with Us: 087-775-825-718</p>
        <p>Monday - Sunday: 8.30 AM - 9.00 PM</p>
      </div>
    </div>
  </footer>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
