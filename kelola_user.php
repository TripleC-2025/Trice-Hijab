<?php
session_start();
require 'koneksi.php';

$users = $conn->query("SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kelola Pengguna - Trice Hijab</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <style>
    body { display: flex; flex-direction: column; min-height: 100vh; background-color: #f8f9fa; }
    main { flex: 1; }
    .social-icons ion-icon { margin-right: 10px; }
    .profil-img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
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

<!-- Navbar -->
<?php include 'header_admin.php'; ?>


<main class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Kelola Pengguna</h3>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
      <thead class="table-dark">
        <tr>
          <th>No</th>
          <th>Foto</th>
          <th>Nama</th>
          <th>Email</th>
          <th>No. HP</th>
          <th>Tanggal Daftar</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($users->num_rows > 0): ?>
          <?php $no = 1; while($user = $users->fetch_assoc()): ?>
            <tr>
              <td><center><?= $no++ ?></center></td>
              <td>
                <img src="uploads/<?= htmlspecialchars($user['foto'] ?? 'default.jpg') ?>" class="profil-img" alt="Foto Profil">
              </td>
              <td><?= htmlspecialchars($user['nama']) ?></td>
              <td><?= htmlspecialchars($user['email']) ?></td>
              <td><?= htmlspecialchars($user['no_hp']) ?></td> <!-- Dianggap username = No HP -->
              <td><?= htmlspecialchars($user['created_at']) ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="6" class="text-center">Belum ada pengguna.</td></tr>
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

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>
