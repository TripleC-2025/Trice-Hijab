<?php
session_start();
require 'koneksi.php';

if (!isset($_GET['id'])) {
  header("Location: kelola_produk2.php");
  exit();
}

$id = $_GET['id'];
$success = '';
$error = '';

// Ambil data produk lama
$stmt = $conn->prepare("SELECT * FROM produk2 WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$produk = $result->fetch_assoc();
$stmt->close();

if (!$produk) {
  $error = "Produk tidak ditemukan.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama'];
  $harga = $_POST['harga'];
  $stok = $_POST['stok'];
  $status = $_POST['status'];
  $gambarBaru = $produk['gambar']; // Default: gambar lama

  // Cek apakah gambar baru diunggah
  if (!empty($_FILES['gambar']['name'])) {
    $target_dir = "uploads/";
    $file_name = basename($_FILES["gambar"]["name"]);
    $target_file = $target_dir . time() . '_' . $file_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($imageFileType, $allowed_types)) {
      if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        $gambarBaru = $target_file;
        // Hapus gambar lama jika bukan kosong dan berbeda
        if (file_exists($produk['gambar']) && $produk['gambar'] != $gambarBaru) {
          unlink($produk['gambar']);
        }
      } else {
        $error = "Gagal upload gambar baru.";
      }
    } else {
      $error = "Format gambar tidak valid.";
    }
  }

  if (!$error) {
    $stmt = $conn->prepare("UPDATE produk2 SET nama=?, harga=?, stok=?, status=?, gambar=? WHERE id=?");
    $stmt->bind_param("siissi", $nama, $harga, $stok, $status, $gambarBaru, $id);

    
    if ($stmt->execute()) {
      $success = "Produk berhasil diperbarui.";
      // Refresh data
      $produk = ['nama' => $nama, 'harga' => $harga, 'stok' => $stok, 'status' => $status, 'gambar' => $gambarBaru];
    } else {
      $error = "Gagal memperbarui produk.";
    }
    $stmt->close();
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Produk - Trice Hijab</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <style>
    /* body { display: flex; flex-direction: column; min-height: 100vh; background-color: #f8f9fa; } */
    main { flex: 1; }
    footer { background-color: #4a0072; color: white; padding: 30px 20px; }
    .social-icons ion-icon { margin-right: 10px; }
    .preview-img { max-width: 120px; border-radius: 8px; margin-bottom: 10px; }

        html, body {
      height: 100%;
      margin: 0;
    }

    body {
      display: flex;
      flex-direction: column;
      background-color: #f8f9fa;
    }

    main {
      flex: 1;
    }

    footer {
      background-color: #f7e6e6;
      color: white;
      padding: 40px 20px;
    }

    .site-footer {
  background-color: #f7e6e6;
  padding: 40px 20px;
  font-family: Arial, sans-serif;
  font-size: 14px;
  color: #555;
}

.site-footer {
  background-color: #f7e6e6;
  padding: 40px 20px;
  font-family: Arial, sans-serif;
  font-size: 14px;
  color: #555;
}

    .footer-container {
      display: flex;
      flex-wrap: wrap;
      gap: 2rem;
      justify-content: space-between;
    }

    .footer-col h4 {
  font-size: 12px;
  letter-spacing: 1px;
  color: #444;
  margin-bottom: 10px;
  text-transform: uppercase;
}

    .footer-col {
      flex: 1 1 250px;
        display: flex;
  flex-direction: column;
  justify-content: flex-start;
    }
.footer-col p {
  margin-bottom: 10px;
  line-height: 1.5;
}

    .footer-col form {
  display: flex;
  gap: 10px;
  margin-top: 10px;
}

    .footer-col input[type="email"] {
  flex: 1;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

    .footer-col button {
        background: #d9a7a7;
        border: none;
        padding: 8px 15px;
        color: #fff;
        letter-spacing: 1px;
        cursor: pointer;
        border-radius: 4px;
    }

    .dashboard-widgets .card:hover {
      transform: scale(1.03);
      transition: 0.3s;
    }
  </style>
</head>
<body>

<?php include 'header_admin.php'; ?>

<main class="container mt-4">
  <h3 class="mb-4">Edit Produk 2</h3>

<?php if ($success): ?>
  <div class="alert alert-success"><?= $success ?></div>
  <meta http-equiv="refresh" content="1;url=kelola_produk2.php">
<?php elseif ($error): ?>
  <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>


  <?php if ($produk): ?>
    <form method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Nama Produk</label>
        <input type="text" name="nama" class="form-control" required value="<?= htmlspecialchars($produk['nama']) ?>">
      </div>
      <div class="mb-3">
        <label class="form-label">Harga</label>
        <input type="number" name="harga" class="form-control" required value="<?= $produk['harga'] ?>">
      </div>

      <div class="mb-3">
        <label class="form-label">Stok</label>
        <input type="number" name="stok" class="form-control" required value="<?= $produk['stok'] ?>">
      </div>

      <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
          <option value="normal" <?= $produk['status'] == 'normal' ? 'selected' : '' ?>>Normal</option>
          <option value="sale" <?= $produk['status'] == 'sale' ? 'selected' : '' ?>>On Sale</option>
          <option value="sold" <?= $produk['status'] == 'sold' ? 'selected' : '' ?>>Sold Out</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Gambar Saat Ini</label><br>
        <img src="<?= $produk['gambar'] ?>" class="preview-img" alt="Gambar Produk">
      </div>
      <div class="mb-3">
        <label class="form-label">Ganti Gambar (opsional)</label>
        <input type="file" name="gambar" class="form-control" accept="image/*">
        <div class="form-text">Biarkan kosong jika tidak ingin mengganti.</div>
      </div>
      <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Perubahan</button><br><br>
    </form>
  <?php endif; ?>
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

<!-- Ionicons -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>
