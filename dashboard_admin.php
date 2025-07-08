<?php

session_start();
require 'koneksi.php';

// if (!isset($_SESSION['admin_id']))  {
//   header("Location: signin.php");
//   exit();
// }

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: signin.php");
  exit();
}


$total_produk1 = $conn->query("SELECT COUNT(*) FROM produk")->fetch_row()[0];
$total_produk2 = $conn->query("SELECT COUNT(*) FROM produk2")->fetch_row()[0];
$total_produk3 = $conn->query("SELECT COUNT(*) FROM produk3")->fetch_row()[0];
$total_user = $conn->query("SELECT COUNT(*) FROM users")->fetch_row()[0];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Admin - Trice Hijab</title>

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

  <!-- Ionicons -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <style>
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

<!-- Dashboard Content -->
<main class="container mt-4">
  <div class="row text-center dashboard-widgets">
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Hijab Paris</h5>
          <p class="card-text display-6"><?= $total_produk1 ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Hijab Bella Square</h5>
          <p class="card-text display-6"><?= $total_produk2 ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Hijab Pashmina</h5>
          <p class="card-text display-6"><?= $total_produk3 ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Total Pengguna</h5>
          <p class="card-text display-6"><?= $total_user ?></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Menu Link -->
  <div class="row mt-4 text-center">
    <div class="col-md-3 mb-3">
      <a href="kelola_produk.php?tipe=1" class="btn btn-primary w-100 py-3">Kelola Produk 1</a>
    </div>
    <div class="col-md-3 mb-3">
      <a href="kelola_produk2.php?tipe=2" class="btn btn-success w-100 py-3">Kelola Produk 2</a>
    </div>
    <div class="col-md-3 mb-3">
      <a href="kelola_produk3.php?tipe=3" class="btn btn-info w-100 py-3 text-white">Kelola Produk 3</a>
    </div>
    <div class="col-md-3 mb-3">
      <a href="kelola_user.php" class="btn btn-dark w-100 py-3">Kelola Pengguna</a>
    </div>
  </div>
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

</body>
</html>
