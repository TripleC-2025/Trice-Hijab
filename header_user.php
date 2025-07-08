<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Trice Hijab</title>
  <link rel="stylesheet" href="style.css">
  <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<style>
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

<header class="site-header">
  <nav class="navbar navbar-expand-lg bg-white ">
    <div class="container-fluid">
      <!-- Brand -->
      <a href="dashboard_user.php" class="navbar-brand d-flex align-items-center">
        <img src="Proyek.png" alt="Logo" class="me-2" style="height: 50px; ">
        <span class="fw-bold">Trice Hijab</span>
      </a>

      <!-- Hamburger Button -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavIcons" aria-controls="navbarNavIcons" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Icons -->
      <div class="collapse navbar-collapse justify-content-end" id="navbarNavIcons">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="dashboard_user.php" class="nav-link text-dark" title="Home">
              <i class="fa-solid fa-house"></i>
            </a>
          </li>
          <li class="nav-item">
            <a href="cart.php" class="nav-link text-dark" title="Pesanan">
              <i class="fa-solid fa-cart-shopping"></i>
            </a>
          </li>
          <li class="nav-item">
            <a href="profile.php" class="nav-link text-dark" title="Profil">
              <i class="fa-solid fa-user"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

  <!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>