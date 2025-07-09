<?php
session_start();
require 'koneksi.php';

// Ambil data produk
$produk = $conn->query("SELECT * FROM produk ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kelola Produk - Trice Hijab</title>

  <!-- Bootstrap & Font Awesome -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

  <style>
    html, body {
      height: 100%;
      margin: 0;
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

<!-- Main -->
<main class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Kelola Produk</h3>
    <a href="tambah_produk.php" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Produk</a>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
      <thead class="table-dark">
        <tr style=" text-align: center">
          <th style="width: 50px; text-align: center;">No</th>
          <th>Nama</th>
          <th>Harga</th>
          <th>Stok</th>
          <th>Status</th>
          <th>Gambar</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($produk->num_rows > 0): ?>
          <?php $no = 1; while($row = $produk->fetch_assoc()): ?>
            <tr style=" text-align: center">
              <td><center><?= $no++ ?></center></td>
              <td><?= htmlspecialchars($row['nama']) ?></td>
              <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
              <td><?= number_format($row['stok'], 0, ',', '.') ?></td>
              <td><?= htmlspecialchars($row['status']) ?></td>
              <td><img src="<?= htmlspecialchars($row['gambar']) ?>" width="60" alt="Produk"></td>
              <td>
                <a href="edit_produk.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="hapus_produk.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="6" class="text-center">Belum ada produk.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
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

<!-- Ionicons -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>
