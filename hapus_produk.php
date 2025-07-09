<?php
session_start();
require 'koneksi.php';

if (!isset($_GET['id'])) {
  header("Location: kelola_produk.php");
  exit();
}

$id = intval($_GET['id']);

// Ambil data produk terlebih dahulu (untuk hapus file gambar)
$stmt = $conn->prepare("SELECT gambar FROM produk WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$produk = $result->fetch_assoc();
$stmt->close();

// Jika produk ada
if ($produk) {
  // Hapus gambar jika file-nya ada dan bukan URL dari luar
  if (!empty($produk['gambar']) && file_exists($produk['gambar'])) {
    unlink($produk['gambar']);
  }

  // Hapus dari database
  $stmt = $conn->prepare("DELETE FROM produk WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->close();
}

header("Location: kelola_produk.php");
exit();
?>
