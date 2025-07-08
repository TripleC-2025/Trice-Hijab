<!DOCTYPE html> <html lang="id"> <head> <meta charset="UTF-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
<title>Trice Hijab</title> 
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet"> 
    <link rel="icon" type="image/png" href="Proyek.png" />
<style> * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Quicksand', sans-serif; }
html, body {
  height: 100%;
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

/* MAIN ONBOARDING */
.main-container {
  display: flex;
  height: 100%;
  align-items: center;
  justify-content: center;
  background: linear-gradient(to right, #fcefee, #ffffff);
  opacity: 0;
  visibility: hidden;
  transition: opacity 1s ease;
}

.main-container.show {
  opacity: 1;
  visibility: visible;
}

.content {
  text-align: center;
  padding: 40px;
  background-color: #fff;
  border-radius: 20px;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
  max-width: 400px;
  width: 90%;
  animation: fadeIn 1s ease-out;
}

.content img {
  width: 100px;
  margin-bottom: 20px;
}

h1 {
  font-size: 24px;
  margin-bottom: 10px;
}

p {
  font-size: 14px;
  margin-bottom: 30px;
  color: #666;
}

.btn {
  display: block;
  width: 100%;
  padding: 12px;
  margin-bottom: 15px;
  border-radius: 8px;
  font-weight: bold;
  text-align: center;
  text-decoration: none;
  font-size: 16px;
  transition: background 0.3s ease;
}

.btn:not(.secondary) {
  background-color: #b77a7a;
  color: #fff;
  border: none;
}

.btn:not(.secondary):hover {
  background-color: #a45f5f;
}

.btn.secondary {
  background-color: #f7e6e6;
  color: #b77a7a;
  border: 1px solid #d9a7a7;
}

.btn.secondary:hover {
  background-color: #f3d5d5;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(20px); }
  to   { opacity: 1; transform: translateY(0); }
}

@media (max-width: 480px) {
  .content {
    padding: 30px 20px;
  }

  h1 {
    font-size: 20px;
  }

  .btn {
    font-size: 14px;
    padding: 10px;
  }
}

</style> </head> <body> <!-- SPLASH SCREEN --> <div id="splash"> <img src="Proyek.png" alt="Logo Trice"> </div> <!-- ONBOARDING CONTENT --> <div class="main-container" id="mainContent"> <main class="content"> <img src="Proyek.png" alt="Logo Trice Hijab"> <h1>Selamat Datang di Trice Hijab</h1> <p>Eksplor gaya hijab syar'i dan stylish dari Trice.</p> <a href="signin.php" class="btn">Masuk</a> <a href="signup.php" class="btn secondary">Daftar</a> </main> </div> <script> setTimeout(() => { document.getElementById("splash").classList.add("fade-out"); document.getElementById("mainContent").classList.add("show"); document.body.style.overflow = "auto"; }, 2000); </script> </body> </html>