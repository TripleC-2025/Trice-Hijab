<?php
session_start();
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama   = $_POST['nama'];
  $harga  = $_POST['harga'];
  $gambar = $_POST['gambar'];

  // Buat ID unik untuk produk di session (dari hash nama+harga+gambar)
  $unique_id = md5($nama . $harga . $gambar);

  // Inisialisasi cart session jika belum ada
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }

  // Simpan ke session
  if (isset($_SESSION['cart'][$unique_id])) {
    $_SESSION['cart'][$unique_id]['jumlah']++;
  } else {
    $_SESSION['cart'][$unique_id] = [
      'nama'   => $nama,
      'harga'  => $harga,
      'gambar' => $gambar,
      'jumlah' => 1
    ];
  }

  // Jika user login, simpan juga ke database
  if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Cek apakah item sudah ada berdasarkan user_id + nama + harga
    $cek = $conn->prepare("SELECT id, jumlah FROM cart WHERE user_id = ? AND nama = ? AND harga = ?");
    $cek->bind_param("isi", $user_id, $nama, $harga);
    $cek->execute();
    $result = $cek->get_result();

    if ($result->num_rows > 0) {
      // Sudah ada, update jumlah
      $row = $result->fetch_assoc();
      $jumlah_baru = $row['jumlah'] + 1;
      $update = $conn->prepare("UPDATE cart SET jumlah = ? WHERE id = ?");
      $update->bind_param("ii", $jumlah_baru, $row['id']);
      $update->execute();
    } else {
      // Belum ada, insert baru (tanpa kolom produk_id)
      $stmt = $conn->prepare("INSERT INTO cart (user_id, nama, harga, gambar, jumlah) VALUES (?, ?, ?, ?, 1)");
      $stmt->bind_param("isis", $user_id, $nama, $harga, $gambar);
      $stmt->execute();
    }
  }

  header("Location: cart.php");
  exit;
}
?>
