<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Admin Login - Centrul Local „Licos” Timișoara</title>
</head>
<body>
        <div id="overlay2" class="overlay row">
            <div class="col-md-3"></div>
            <div id="logoContainer" class="col-md-1">
                <div class="logoWrapper">
                    <img class="logoImage img-fluid" src="./../img/logo.png" alt="">
                </div>
            </div>

            <div class="overlay-text col-md-5 pt-4">
                <h2 class="text-lg">Cercetașii României - Licos Timișoara</h2>
                <p class="text-lg">Gata Oricând!</p>
            </div>
        </div>

    <nav id="navbar" class="navbar navbar-expand-sm navbar-dark sticky-top justify-content-center pb-3">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
          <!-- Links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="./../index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./about.html">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./activities.php">Activities</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./register.html">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./gallery.html">Gallery</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./contact.html">Contact</a>
            </li>

          </ul>
        </div>
      
      </nav>

      <div class="container-fluid content">

            <div id="adminForm" class="container">
                <h2 class="text-center my-5">Admin Login</h2>
                <form action="./adminConnect.php" method="POST">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="user" placeholder="Username" name="user" required>
                        <label for="user" class="form-label">Username:</label>
                    </div>

                    <div class="form-floating mb-3 mt-3">
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                    <label for="password" class="form-label">Password:</label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Log In</button>
                </form>
            </div>
            
      </div>

      <footer class="footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mt-2">
                    <ul class="social-icons">
                        <li><a href="https://www.facebook.com/timisoarascout"><i class="fab fa-facebook"></i></a></li>
                        <li><a href="https://www.instagram.com/timisoarascout/"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="https://www.tiktok.com/@timisoara.scout"><i class="fab fa-tiktok"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-6 mt-2 admin">
                    <a href="#">Admin Connect</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center mt-2">
                    <p>&copy; 2024 Cercetașii României - Licos Timișoara. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>