<?php
session_start();
require 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: signin.php");
  exit();
}

$user_id = $_SESSION['user_id'];
$nama    = $_SESSION['nama'];
$no_hp   = $_SESSION['no_hp'] ?? '';
$wa_admin = '6287775825718'; // Nomor admin WA

// Ambil data keranjang dari DB
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $alamat = trim($_POST['alamat']);

  // Format pesan WA
  $pesan = "Halo Admin, saya ingin memesan produk dari Trice Hijab.%0A%0A";
  $pesan .= "*Nama:* $nama%0A";
  $pesan .= "*No. HP:* $no_hp%0A";
  // $pesan .= "*Alamat:* $alamat%0A%0A";
  $pesan .= "*Daftar Pesanan:*%0A";

  foreach ($keranjang as $item) {
    $subtotal = $item['harga'] * $item['jumlah'];
    $pesan .= "- {$item['nama']} ({$item['jumlah']} x Rp " . number_format($item['harga'], 0, ',', '.') . ") = Rp " . number_format($subtotal, 0, ',', '.') . "%0A";
  }

  $pesan .= "%0A*Total:* Rp " . number_format($total, 0, ',', '.');

  // Redirect ke WhatsApp
  $url = "https://wa.me/$wa_admin?text=" . urlencode($pesan);
  header("Location: $url");
  exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Checkout - Trice Hijab</title>
      <link rel="icon" type="image/png" href="Proyek.png" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
  <h2>Checkout</h2>
  <form method="post">
    <!-- <div class="mb-3">
      <label for="alamat" class="form-label">Alamat Lengkap</label>
      <textarea name="alamat" id="alamat" class="form-control" required></textarea>
    </div> -->
    <button type="submit" class="btn btn-success">Kirim ke WhatsApp</button>
    <a href="cart.php" class="btn btn-secondary">Kembali ke Keranjang</a>
  </form>
</div>
</body>
</html>
