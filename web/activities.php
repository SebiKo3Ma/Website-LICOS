<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Activități - Centrul Local „Licos” Timișoara</title>
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
              <a class="nav-link active" href="#">Activities</a>
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
      <?php
            // Custom array with Romanian month names
            $romanian_months = array(
                'ianuarie', 'februarie', 'martie', 'aprilie', 'mai', 'iunie',
                'iulie', 'august', 'septembrie', 'octombrie', 'noiembrie', 'decembrie'
            );

            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "licoswebsite";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL query to retrieve event data
            $sql = "SELECT id, name, edition, location, dateStart, dateEnd, description FROM events order by dateStart desc";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    // Format dates for display
                    // Format dates for display
                    $dateStart = isset($row["dateStart"]) ? strftime("%e ", strtotime($row["dateStart"])) . $romanian_months[date('n', strtotime($row["dateStart"])) - 1] . strftime(" %Y", strtotime($row["dateStart"])) : "Not specified";
                    $dateEnd = isset($row["dateEnd"]) ? strftime("%e ", strtotime($row["dateEnd"])) . $romanian_months[date('n', strtotime($row["dateEnd"])) - 1] . strftime(" %Y", strtotime($row["dateEnd"])) : "Not specified";
            
                    $sql2 = "select url from pictures, events where events.id = pictures.id and events.id = ?";
                    $pics = $conn->prepare($sql2);
                    $pics->bind_param("s", $row['id']);
                    $pics->execute();
                    $result2 = $pics->get_result();
                    $active = 0;

                    // Create a <div> element with event data
                    echo "<div class='event row p-4 my-3'>";
                        echo "<div class='event-text col-lg-8 my-auto'>";
                            echo "<h2>" . $row["name"] . "</h2>";
                            if($row["edition"] != NULL){
                                echo "<p>Edition: " . $row["edition"] . "</p>";
                            }
                            echo "<p>Locația: " . $row["location"] . "</p>";
                            echo "<p>Perioada: " . $dateStart . " - " . $dateEnd . "</p>";
                            echo $row["description"] . "</p>";
                        echo "</div>";
                        if ($result2->num_rows > 0) {
                            echo "<div id='event" . $row["id"] . "'  class='event-images carousel col-lg-4' data-bs-ride='carousel'>";
                                echo "<div class='carousel-inner'>";
                                    while($row2 = $result2->fetch_assoc()) {
                                    echo "<div class='carousel-item "; if($active == 0){$active = 1; echo "active";} echo"'>";
                                        echo "<img src='./../img/" . $row2["url"] . ".jpg' alt='' class='d-block w-100 img-thumbnail'>";
                                    echo "</div>";
                                    }
                                echo "</div>";

                                echo "<button class='carousel-control-prev' type='button' data-bs-target='#event" . $row["id"] . "' data-bs-slide='prev'>
                                <span class='carousel-control-prev-icon'></span>
                                </button>
                                <button class='carousel-control-next' type='button' data-bs-target='#event" . $row["id"] . "' data-bs-slide='next'>
                                <span class='carousel-control-next-icon'></span>
                                </button>";
                            echo "</div>";
                        }
                    echo "</div>";
                }
            } else {
                echo "0 results";
            }

            $pics->close();
            $conn->close();
            ?>

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