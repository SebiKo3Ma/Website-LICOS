<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
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
    <title>Admin - Centrul Local „Licos” Timișoara</title>
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
        <div id="postForm" class="container">
            <h2 class="text-center my-5">New Activity</h2>
            <form action="./newPost.php" method="POST" enctype="multipart/form-data">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" placeholder="Activity Name" name="name" required>
                    <label for="name" class="form-label">Activity Name:</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="edition" placeholder="Edition:" name="edition">
                    <label for="edition" class="form-label">Edition:</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="location" placeholder="Location:" name="location" required>
                    <label for="location" class="form-label">Location:</label>
                </div>

                <div class="row">
                    <div class="form-floating mb-3 col-md-6">
                        <input type="date" class="form-control" id="dateStart" placeholder="Start date:" name="dateStart" required>
                        <label for="dateStart" class="form-label label1">Start Date:</label>
                    </div>

                    <div class="form-floating mb-3 col-md-6">
                        <input type="date" class="form-control" id="dateEnd" placeholder="End Date:" name="dateEnd" required>
                        <label for="dateEnd" class="form-label label1">End Date:</label>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control" rows="5" id="description" name="description" required></textarea>
                    <label for="description">Description:</label>
                </div>
                
                <div class="mb-3">
                    <input type="file" class="form-control" name="photos[]" multiple>
                </div>

                <button type="submit" class="btn btn-primary">Post</button>
            </form>
        </div>
        <div id="recordsList" class="container">
        <h2 class="text-center my-5">Activities</h2>
        <?php
            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "licoswebsite";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve records from the database
            $sql = "SELECT * FROM events order by dateStart desc";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                echo "<table class='table table-striped'><tr><th>ID</th><th>Name</th><th>Location</th><th>Date</th><th>Actions</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>#" . $row["id"]. "</td><td>" . $row["name"]. " " . $row["edition"]. "</td><td>" . $row["location"] . "</td><td>" . $row["dateStart"] . " / " . $row["dateStart"] . "</td><td> <a class='btn btn-warning' href='edit.php?id=".$row["id"]."'>Edit</a>  <a class='btn btn-danger' href='remove.php?id=".$row["id"]."'>Remove</a></td></tr><br>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </div>

        <a href="./logout.php" class="btn btn-danger my-5">Log out</a>
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