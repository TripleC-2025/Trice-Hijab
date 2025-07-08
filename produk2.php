<?php
require 'koneksi.php';
$result = $conn->query("SELECT * FROM produk2");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trice Hijab</title>
  <link rel="icon" type="image/png" href="Proyek.png" />
  <link rel="stylesheet" href="style4.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <style>
    body { font-family: 'Segoe UI', sans-serif; margin: 0; background-color: #f8f9fa; }
    .judul { text-align: center; margin-top: 40px; color: #b77a7a; }
    .produk-list { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 24px; padding: 40px; max-width: 1200px; margin: auto; }
    .produk-item { background: #fff; border-radius: 10px; padding: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.05); text-align: center; }
    .produk-item img { width: 100%; height: 200px; object-fit: cover; border-radius: 8px; }
    .produk-item h3 { margin-top: 10px; font-size: 1.1em; color: #333; }
    .produk-item p { color: #777; margin: 8px 0; }
    .produk-item form button { background-color: #b77a7a; color: white; border: none; padding: 10px 15px; border-radius: 6px; cursor: pointer; transition: background 0.3s ease; }
    .produk-item form button:hover { background-color: #b77a7a; }
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
    .header-container { display: flex; justify-content: space-between; align-items: center; }
    .brand-link { display: flex; align-items: center; text-decoration: none; color: white; }
    .logo { height: 40px; margin-right: 10px; }
    .nav-icons .icon-link { color: #b77a7a; margin-left: 20px; font-size: 20px; text-decoration: none; }
    .social-icons a { margin-right: 10px; }
  </style>
</head>
<body>

<?php include 'header_user.php'; ?>

  <br><h2 class="judul">Produk Kami</h2>
  <div class="produk-list">
    <?php while($row = $result->fetch_assoc()): ?>
      <div class="produk-item">
        <img src="<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama']) ?>">
        <h3><?= htmlspecialchars($row['nama']) ?></h3>
        <p>Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
        <form action="tambah_keranjang.php" method="post">
          <input type="hidden" name="produk_id" value="<?= $row['id'] ?>">
          <input type="hidden" name="nama" value="<?= $row['nama'] ?>">
          <input type="hidden" name="harga" value="<?= $row['harga'] ?>">
          <input type="hidden" name="gambar" value="<?= $row['gambar'] ?>">
          <button type="submit"><i class="fa fa-cart-plus"></i> Tambah ke Keranjang</button>
        </form>
      </div>
    <?php endwhile; ?>
  </div>

  <footer class="site-footer">
    <div class="footer-container">
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
        <p>Didirikan pada tahun 2025, Trice Hijab hadir sebagai representasi gaya muslimah modern yang anggun dan percaya diri...</p>
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

</body>
</html>
