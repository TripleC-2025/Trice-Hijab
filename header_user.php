<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trice Hijab</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>


  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <!-- Ionicons -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    .nav-link:hover {
      color: #d99c9c !important;
    }

    .navbar .nav-link,
    .navbar .navbar-brand,
    .navbar .nav-link i {
      color: #b77a7a !important;
    }

    .navbar .nav-link:hover,
    .navbar .navbar-brand:hover,
    .navbar .nav-link:hover i {
      color: #d99c9c !important;
    }

    .nav-item span {
      margin-left: 6px;
      font-size: 1rem;
    }

    .navbar-brand span {
      font-size: 1.5rem;
    }

    .navbar .nav-link i {
      font-size: 1.3rem;
    }

    .navbar-brand img {
      height: 60px;
    }

    @media (min-width: 992px) {
      .nav-item span {
        display: none;
      }
    }
  </style>
</head>

<body>
  <header class="site-header">
    <nav class="navbar navbar-expand-lg bg-white">
      <div class="container-fluid">
        <!-- Brand -->
        <a href="index.php" class="navbar-brand d-flex align-items-center">
          <img src="Proyek.png" alt="Logo" class="me-2">
          <span class="fw-bold">Trice Hijab</span>
        </a>

        <!-- Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavIcons" aria-controls="navbarNavIcons" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Menu -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavIcons">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="index.php" class="nav-link text-dark" title="Beranda">
                <i class="fa-solid fa-house"></i><span> Beranda</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="cart.php" class="nav-link" onclick="handleCartClick(event)">
                <i class="fas fa-shopping-cart"></i><span> Keranjang</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="profile.php" class="nav-link" onclick="handleProfileClick(event)">
                <i class="fas fa-user"></i><span> Profile</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

<script>
  const isLoggedIn = <?= isset($_SESSION['user_id']) && $_SESSION['role'] === 'user' ? 'true' : 'false' ?>;

  // Fungsi untuk efek fade out sebelum redirect
  function smoothRedirect(url) {
    document.body.style.transition = "opacity 0.5s ease";
    document.body.style.opacity = 0;
    setTimeout(() => {
      window.location.href = url;
    }, 500); // tunggu efek selesai
  }

  function handleCartClick(event) {
    event.preventDefault();
    if (!isLoggedIn) {
      Swal.fire({
        icon: 'warning',
        title: 'Anda belum login!',
        text: 'Silakan login terlebih dahulu untuk mengakses keranjang.',
        confirmButtonText: 'Login Sekarang',
        confirmButtonColor: '#d99c9c',
        showClass: {
          popup: 'swal2-show animate__animated animate__fadeInDown'
        },
        hideClass: {
          popup: 'swal2-hide animate__animated animate__fadeOutUp'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          smoothRedirect('signin.php');
        }
      });
    } else {
      smoothRedirect('cart.php');
    }
  }

  function handleProfileClick(event) {
    event.preventDefault();
    if (!isLoggedIn) {
      Swal.fire({
        icon: 'warning',
        title: 'Anda belum login!',
        text: 'Silakan login terlebih dahulu untuk melihat profil.',
        confirmButtonText: 'Login Sekarang',
        confirmButtonColor: '#d99c9c',
        showClass: {
          popup: 'swal2-show animate__animated animate__fadeInDown'
        },
        hideClass: {
          popup: 'swal2-hide animate__animated animate__fadeOutUp'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          smoothRedirect('signin.php');
        }
      });
    } else {
      smoothRedirect('profile.php');
    }
  }
</script>

</body>

</html>
