<?php
session_start();
require 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: signin.php");
  exit();
}

$user_id = $_SESSION['user_id'];

// Hapus item dari cart
if (isset($_GET['hapus'])) {
  $cart_id = $_GET['hapus'];
  $hapus = $conn->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
  $hapus->bind_param("ii", $cart_id, $user_id);
  $hapus->execute();
  header("Location: cart.php");
  exit();
}

// Tambah atau kurang jumlah
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aksi']) && isset($_POST['cart_id'])) {
  $cart_id = $_POST['cart_id'];
  $aksi = $_POST['aksi'];

  $get = $conn->prepare("SELECT jumlah FROM cart WHERE id = ? AND user_id = ?");
  $get->bind_param("ii", $cart_id, $user_id);
  $get->execute();
  $result = $get->get_result();

  if ($row = $result->fetch_assoc()) {
    $jumlah = $row['jumlah'];
    if ($aksi === 'tambah') {
      $jumlah++;
    } elseif ($aksi === 'kurang' && $jumlah > 1) {
      $jumlah--;
    }

    $update = $conn->prepare("UPDATE cart SET jumlah = ? WHERE id = ? AND user_id = ?");
    $update->bind_param("iii", $jumlah, $cart_id, $user_id);
    $update->execute();
  }
  header("Location: cart.php");
  exit();
}

// Ambil semua data cart
$keranjang = [];
$total = 0;
$get = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
$get->bind_param("i", $user_id);
$get->execute();
$result = $get->get_result();

while ($row = $result->fetch_assoc()) {
  $keranjang[] = $row;
  $total += $row['harga'] * $row['jumlah'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Trice Hijab</title>
  <link rel="stylesheet" href="style.css">
  <link rel="icon" type="image/png" href="Proyek.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <style>
    body { background-color: #f8f9fa; }
    main { padding: 20px; }
    .social-icons ion-icon { margin-right: 10px; font-size: 24px; }
    .cart-img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      margin-right: 15px;
      border-radius: 8px;
    }

    .jumlah-box {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .jumlah-box form {
      display: inline;
    }

    .total {
      font-size: 20px;
      font-weight: bold;
      margin-top: 20px;
    }

          footer {
      background-color: #f7e6e6;
      color: white;
      padding: 30px 20px;
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

    .social-icons ion-icon {
      margin-right: 10px;
    }

    .site-header {
      background-color: #fff;
      border-bottom: 1px solid #ddd;
      padding: 10px 20px;
    }

    .header-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .brand-link {
      display: flex;
      align-items: center;
      text-decoration: none;
      color: #333;
    }

    .logo {
      width: 40px;
      height: 40px;
      margin-right: 10px;
    }

    .brand-name {
      font-size: 20px;
      font-weight: bold;
    }

    .nav-icons .icon-link {
      margin-left: 15px;
      font-size: 20px;
      color: #333;
      text-decoration: none;
    }
        .nav-icons .icon-link { color: #b77a7a; margin-left: 20px; font-size: 20px; text-decoration: none; }

    .nav-icons .icon-link:hover {
      color: #d9a7a7;
    }
  </style>
</head>
<body>

  <!-- header -->
  <?php include 'header_user.php'; ?>

  <!-- Konten Utama -->
  <main>
    <div class="container my-5">
      <h2 class="mb-4">Keranjang Belanja</h2>

      <?php if (count($keranjang) === 0): ?>
        <div class="alert alert-info">Keranjang kosong.</div>
        <a href="dashboard_user.php" class="btn btn-secondary">Belanja Sekarang</a>
      <?php else: ?>
        <?php foreach ($keranjang as $item): ?>
          <div class="d-flex justify-content-between align-items-center border-bottom py-3">
            <img src="<?= htmlspecialchars($item['gambar']) ?>" class="cart-img" alt="<?= htmlspecialchars($item['nama']) ?>">
            <div style="flex: 1;">
              <strong><?= htmlspecialchars($item['nama']) ?></strong><br>
              Harga: Rp <?= number_format($item['harga'], 0, ',', '.') ?><br>
              <div class="jumlah-box mt-2">
                <form method="post">
                  <input type="hidden" name="cart_id" value="<?= $item['id'] ?>">
                  <input type="hidden" name="aksi" value="kurang">
                  <button type="submit" class="btn btn-sm btn-outline-secondary">-</button>
                </form>
                <span><?= $item['jumlah'] ?></span>
                <form method="post">
                  <input type="hidden" name="cart_id" value="<?= $item['id'] ?>">
                  <input type="hidden" name="aksi" value="tambah">
                  <button type="submit" class="btn btn-sm btn-outline-secondary">+</button>
                </form>
              </div>
              <div class="mt-2">Subtotal: Rp <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?></div>
            </div>
            <div class="d-flex flex-column align-items-end gap-2">
              <a href="cart.php?hapus=<?= $item['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus produk ini?')">Hapus</a>
              <a href="https://wa.me/6287775825718?text=Halo%20Saya%20ingin%20memesan%20<?= urlencode($item['nama']) ?>%20sebanyak%20<?= $item['jumlah'] ?>%20dengan%20total%20Rp%20<?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?>" target="_blank" class="btn btn-sm btn-success">Pesan Sekarang</a>
            </div>
          </div>
        <?php endforeach; ?>
        <p class="total">Total: Rp <?= number_format($total, 0, ',', '.') ?></p>
        <a href="dashboard_user.php" class="btn btn-primary">Lanjut Belanja</a>
      <?php endif; ?>
    </div>
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
        <a href="https://wa.me/6287775825718"><ion-icon name="logo-whatsapp" style="font-size: 24px; color: #25D366;"></ion-icon></a>
        <a href="https://www.tiktok.com/@tricehijab_?_t=ZS-8xo1GSTgBYV&_r=1"><ion-icon name="logo-tiktok" style="font-size: 24px; color: #010101;"></ion-icon></a>
      </div>
    </div>
    <div class="footer-col">
      <h4>CUSTOMER SERVICES</h4>
      <p>Chat with Us: 087-775-825-718</p>
      <p>Monday - Sunday: 8.30 AM - 9.00 PM</p>
    </div>
  </div>
</footer>

</body>
</html>
