<?php
session_start();
require 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: home.php");
  exit();
}

$user_id = $_SESSION['user_id'];

// Ambil data user
$stmt = $conn->prepare("SELECT nama, email, no_hp, foto FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($nama, $email, $no_hp, $foto);
$stmt->fetch();
$stmt->close();

$foto_url = $foto ? "uploads/$foto" : "https://i.pravatar.cc/150?u=$user_id";

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama_baru = $_POST['nama'];
  $email_baru = $_POST['email'];
  $no_hp_baru = $_POST['nohp'];
  $foto_nama = $foto; // default jika tidak upload baru

  // Cek jika ada upload gambar baru
  if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $ekstensi = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $foto_nama = 'user_' . $user_id . '.' . $ekstensi;
    move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/" . $foto_nama);
  }

  // Update database
  $update = $conn->prepare("UPDATE users SET nama=?, email=?, no_hp=?, foto=? WHERE id=?");
  $update->bind_param("ssssi", $nama_baru, $email_baru, $no_hp_baru, $foto_nama, $user_id);

  if ($update->execute()) {
    $_SESSION['nama'] = $nama_baru;
    $_SESSION['email'] = $email_baru;
    $_SESSION['no_hp'] = $no_hp_baru;
    header("Location: profile.php");
    exit();
  } else {
    $error = "Gagal memperbarui profil.";
  }

  $update->close();
}
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
  
<?php include 'header_user.php'; ?>

  <main class="profile-container">
    <h2>Edit Profil</h2>
    <?php if (isset($error)): ?>
      <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form class="edit-form" method="post" enctype="multipart/form-data">
      <div class="form-photo">
        <img id="previewPhoto" src="<?= htmlspecialchars($foto_url) ?>" alt="Foto Profil" />
        <input type="file" accept="image/*" id="photoInput" name="foto" style="display: none;" />
        <label for="photoInput" class="btn small">Ganti Foto</label>
      </div>

      <div class="form-group">
        <label for="nama">Nama Lengkap</label>
        <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($nama) ?>" required />
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required />
      </div>

      <div class="form-group">
        <label for="nohp">Nomor HP</label>
        <input type="text" id="nohp" name="nohp" value="<?= htmlspecialchars($no_hp) ?>" required />
      </div>

      <div class="form-actions">
        <button type="submit" class="btn small">Simpan Perubahan</button>
        <a href="profile.php" class="btn secondary">Batal</a>
      </div>
    </form>
  </main>

<!-- Footer -->
<footer class="site-footer">
  <div class="footer-container container">
    <div class="footer-col">
      <h4>NEWSLETTER</h4>
      <p>Subscribe to receive updates, access to exclusive deals, and more.</p>
      <form>
        <input type="email" placeholder="Enter your email address">
        <button type="submit">SUBSCRIBE</button>
      </form>
    </div>
    <div class="footer-col">
      <h4>Trice Hijab</h4>
      <p>Didirikan pada tahun 2025, Trice Hijab hadir sebagai representasi gaya muslimah modern yang anggun dan percaya diri.</p>
      <div class="social-icons">
        <a href="https://www.facebook.com/people/Trice-Hijab/61577776005727/"><ion-icon name="logo-facebook" style="font-size: 24px; color: #1877F2;"></ion-icon></a>
        <a href="https://www.instagram.com/tricehijab"><ion-icon name="logo-instagram" style="font-size: 24px; color: #E1306C;"></ion-icon></a>
        <a href="https://wa.me/087775825718"><ion-icon name="logo-whatsapp" style="font-size: 24px; color: #25D366;"></ion-icon></a>
        <a href="https://www.tiktok.com/@triceh1jab_?is_from_webapp=1&sender_device=pc"><ion-icon name="logo-tiktok" style="font-size: 24px; color: #010101;"></ion-icon></a>
      </div>
    </div>
    <div class="footer-col">
      <h4>CUSTOMER SERVICES</h4>
      <p>Chat with Us: 087-775-825-718</p>
      <p>Monday - Sunday: 8.30 AM - 9.00 PM</p>
    </div>
  </div>
</footer>

  <script>
    const photoInput = document.getElementById('photoInput');
    const previewPhoto = document.getElementById('previewPhoto');

    photoInput.addEventListener('change', function () {
      const file = photoInput.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          previewPhoto.src = e.target.result;
        }
        reader.readAsDataURL(file);
      }
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
