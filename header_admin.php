<?php
// Mulai session jika belum
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Trice Hijab</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<style>
  .btn-custom {
    background-color: #d99c9c;
    color: white;
    border: none;
    transition: background-color 0.3s ease;
  }

  .btn-custom:hover {
    background-color: #b77a7a;
    color: white;
  }

  .btn-custom i {
    color: white;
  }

  .btn-custom:hover i {
    color: white;
  }
</style>

<body>
  <!-- Header -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="dashboard_admin.php">Admin - Trice Hijab</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
        aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
        <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="btn btn-custom ms-lg-3 mt-2 mt-lg-0" href="dashboard_admin.php" title="Home">
                <i class="fa-solid fa-house"></i> 
            </a>
            </li>
            <li class="nav-item">
            <a href="logout.php" class="btn btn-custom ms-lg-3 mt-2 mt-lg-0" title="Logout">
                <i class="fa-solid fa-right-from-bracket"></i>
            </a>
            </li>
        </ul>
      </div>
    </div>
  </nav>
