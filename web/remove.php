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
        <div class="queryResults">
            <?php
                $conn = new mysqli("localhost", "root", "", "licoswebsite");

                if ($conn->connect_errno) {
                    echo "Connection error: " . $conn->connect_error; 
                    exit();
                }

                // Check if ID is provided in the URL
                if(isset($_GET['id'])) {
                    $id = $_GET['id'];

                    // Fetch record from the database
                    $sql = "SELECT * FROM events WHERE id = $id";
                    $result = $conn->query($sql);

                    if ($result->num_rows == 1) {
                        $row = $result->fetch_assoc();
            ?>
                        <div class="container">
                            <h2 class="mb-4">Remove Activity</h2>
                            <form action="delete.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" class="form-control" id="name" placeholder="Activity Name" name="name" value="<?php echo $row['name'];?>" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="edition" class="form-label">Edition:</label>
                                    <input type="text" class="form-control" id="edition" placeholder="Edition:" name="edition" value="<?php echo $row['edition']; ?>" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="location" class="form-label">Location:</label>
                                    <input type="text" class="form-control" id="location" placeholder="Location:" name="location" value="<?php echo $row['location']; ?>" disabled>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="dateStart" class="form-label label1">Start Date:</label>
                                        <input type="date" class="form-control" id="dateStart" placeholder="Start date:" name="dateStart" value="<?php echo $row['dateStart']; ?>" disabled>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="dateEnd" class="form-label label1">End Date:</label>
                                        <input type="date" class="form-control" id="dateEnd" placeholder="End Date:" name="dateEnd" value="<?php echo $row['dateEnd']; ?>" disabled>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description">Description:</label>
                                    <textarea class="form-control" rows="5" id="description" name="description" disabled><?php echo $row['description']; ?></textarea>
                                </div>

                                <button type="submit" name="delete" class="btn btn-danger">Continue and Delete</button>
                                <a href="admin.php" class="btn btn-warning">Cancel</a>
                            </form>
                        </div>
            <?php
                    } else {
                        echo "Record not found.";
                    }
                } else {
                    echo "ID not provided.";
                }
            ?>
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
                    <a href="./login.php">Admin Connect</a>
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