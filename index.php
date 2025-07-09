<?php
session_start();
require 'koneksi.php';

// if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
//   header("Location: signin.php");
//   exit();
// }

$subscribeMessage = '';

if (isset($_POST['subscribe'])) {
    $email = $_POST['email'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $subscribeMessage = '<div class="alert alert-danger mt-3" role="alert">Email tidak valid!</div>';
    } else {
        $cek = $conn->prepare("SELECT id FROM subscribers WHERE email = ?");
        $cek->bind_param("s", $email);
        $cek->execute();
        $cek->store_result();

        if ($cek->num_rows > 0) {
            $subscribeMessage = '<div class="alert alert-warning mt-3" role="alert">Email sudah terdaftar.</div>';
        } else {
            $stmt = $conn->prepare("INSERT INTO subscribers (email) VALUES (?)");
            $stmt->bind_param("s", $email);
            if ($stmt->execute()) {
                // Kirim email konfirmasi
                $subject = "Terima Kasih Telah Berlangganan Trice Hijab!";
                $message = "
                <html>
                <head>
                    <title>Konfirmasi Berlangganan</title>
                </head>
                <body>
                    <p>Hai!</p>
                    <p>Terima kasih telah berlangganan newsletter dari <strong>Trice Hijab</strong>.</p>
                    <p>Kami akan mengirimkan informasi terbaru, promo eksklusif, dan produk pilihan langsung ke email kamu.</p>
                    <br>
                    <p>Salam hangat,<br>Tim Trice Hijab</p>
                </body>
                </html>
                ";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: Trice Hijab <indranurman396@gmail.com>" . "\r\n";

                // Kirim email
                if (mail($email, $subject, $message, $headers)) {
                    $subscribeMessage = '<div class="alert alert-success mt-3" role="alert">Berhasil berlangganan! Cek email kamu untuk konfirmasi.</div>';
                } else {
                    $subscribeMessage = '<div class="alert alert-warning mt-3" role="alert">Berhasil berlangganan, tapi email konfirmasi gagal dikirim.</div>';
                }
            } else {
                $subscribeMessage = '<div class="alert alert-danger mt-3" role="alert">Terjadi kesalahan. Silakan coba lagi.</div>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trice Hijab</title>
  <link rel="stylesheet" href="style.css">
  <link rel="icon" type="image/png" href="Proyek.png" />
  <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet"> 
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<style>
    body { background-color: #f8f9fa; }
    main { padding: 20px; }
    .social-icons ion-icon { margin-right: 10px; font-size: 24px; }
      footer {
      background-color: #f7e6e6;
      color: white;
      padding: 40px 20px;
    }

    /* SPLASH SCREEN */
#splash {
  position: fixed;
  top: 0; left: 0;
  width: 100%;
  height: 100%;
  background-color: #ffffff;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 9999;
  opacity: 1;
  visibility: visible;
  transition: opacity 0.8s ease, visibility 0.8s ease;
}

#splash.fade-out {
  opacity: 0;
  visibility: hidden;
}

#splash img {
  width: 120px;
  animation: zoomIn 0.8s ease;
}

@keyframes zoomIn {
  from { transform: scale(0.8); opacity: 0; }
  to   { transform: scale(1); opacity: 1; }
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

  .nav-link:hover {
    color: #d99c9c !important;
  }

  /* Ubah warna teks dan ikon navbar menjadi #b77a7a */
.navbar .nav-link,
.navbar .navbar-brand,
.navbar .nav-link i {
  color: #b77a7a !important;
}

/* Ubah warna saat hover */
.navbar .nav-link:hover,
.navbar .navbar-brand:hover,
.navbar .nav-link:hover i {
  color: #d99c9c !important;
}

  </style>

<body>

<!-- SPLASH SCREEN --> 
 <div id="splash"> 
  <img src="Proyek.png" alt="Logo Trice"> 
</div> 

<?php include 'header_user.php'; ?>

<!-- Slideshow Bootstrap -->
<section id="carouselBanner" class="carousel slide mb-4" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="banner1.png" class="d-block w-100 img-fluid" alt="Promo 1">
    </div>
    <div class="carousel-item">
      <img src="banner2.png" class="d-block w-100 img-fluid" alt="Promo 2">
    </div>
    <div class="carousel-item">
      <img src="Beige and Gold Elegant Photo Collage Jewelry Banner.png" class="d-block w-100 img-fluid" alt="Promo 3">
    </div>
  </div>

  <!-- Tombol Navigasi -->
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanner" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Sebelumnya</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselBanner" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Berikutnya</span>
  </button>
</section>

  <main class="dashboard">
    <h2>Koleksi Hijab Trice</h2>
    <div class="produk-container">
      <div class="produk-card">
        <img src="paris.jpeg" alt="Square Collection">
        <div class="overlay">
          <h3>PARIS COLLECTION</h3>
          <a href="produk.php" class="btn-view">VIEW PRODUCT</a>
        </div>
      </div>
      <div class="produk-card">
        <img src="bella.jpeg" alt="Shawl Collection">
        <div class="overlay">
          <h3>BELLA COLLECTION</h3>
          <a href="produk2.php" class="btn-view">VIEW PRODUCT</a>
        </div>
      </div>
      <div class="produk-card">
        <img src="voal.jpeg" alt="Pashmina Collection">
        <div class="overlay">
          <h3>PASHMINA COLLECTION</h3>
          <a href="produk3.php" class="btn-view">VIEW PRODUCT</a>
        </div>
    </div>
  </main>

<!-- Footer -->
<!--<footer class="site-footer">-->
  <footer class="site-footer" id="footer-subscribe">
  <div class="footer-container">
    <div class="footer-col">
      <h4>NEWSLETTER</h4>
      <p>Subscribe to receive updates, access to exclusive deals, and more.</p>
      <!--<form>-->
      <!--  <input type="email" placeholder="Enter your email address">-->
      <!--  <button type="submit">SUBSCRIBE</button>-->
      <!--</form>-->
      
      <form method="post" action="#footer-subscribe">
          <input type="email" name="email" placeholder="Enter your email address" required>
          <button type="submit" name="subscribe">SUBSCRIBE</button>
        </form>
        <!-- Tampilkan pesan setelah submit -->
        <div id="footer-subscribe">
          <?php if (!empty($subscribeMessage)) echo $subscribeMessage; ?>
        </div>

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
    setTimeout(() => { document.getElementById("splash").classList.add("fade-out"); 
    document.getElementById("mainContent").classList.add("show"); 
    document.body.style.overflow = "auto"; }, 2000); 
</script> 

  <script>
    let slides = document.querySelectorAll(".slide");
    let current = 0;

    function showSlide(index) {
      slides.forEach(slide => slide.classList.remove("active"));
      slides[index].classList.add("active");
    }

    setInterval(() => {
      current = (current + 1) % slides.length;
      showSlide(current);
    }, 500);
  </script>
  
   <!--Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php if (!empty($subscribeMessage)) : ?>
<script>
  window.location.hash = '#footer-subscribe';
</script>
<?php endif; ?>


</body>

</html>
