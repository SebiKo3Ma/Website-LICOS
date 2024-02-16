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
            /* Verify if the form is submitted */
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = filter_input(INPUT_POST, 'name');
                $edition = filter_input(INPUT_POST, 'edition');
                $location = filter_input(INPUT_POST, 'location');
                $dateStart = filter_input(INPUT_POST, 'dateStart');
                $dateEnd = filter_input(INPUT_POST, 'dateEnd');
                $description = filter_input(INPUT_POST, 'description');
                /* validar os dados recebidos do formulário */
                if (empty($name) || empty($location) || empty($dateStart) || empty($dateEnd) || empty($description)){
                    echo "All form fields must be filled! ";
                    exit();
                }    
            }
            else{
                echo "Error, the form is not submitted! ";
                exit();
            }

            $conn = new mysqli("localhost", "root", "", "licoswebsite");

            if ($conn->connect_errno) {
                echo "Connection error: " . $conn->connect_error; 
                exit();
            }

            /*SQL query*/
            $query = "INSERT INTO events (name, edition, location, dateStart, dateEnd, description) VALUES ('$name', '$edition', '$location', '$dateStart', '$dateEnd', '$description' )";
            /* execute the query end check for errors */
            if (!$conn->query($query)) {
                echo "Error executing the query: \"$query\" <br>" . $conn->error;
                $conn->close();  /*Close the connection */
            }
            else{
                echo "New post registered! " ;
                $getId = "SELECT * from events order by id desc limit 1";
                $idRow = $conn->query($getId);
                $row = $idRow->fetch_assoc();
                $id = $row["id"];


                // Insert pictures into the pictures table
                if(isset($_FILES['photos'])){
                    $errors= array();
                    foreach($_FILES['photos']['tmp_name'] as $key => $tmp_name ){
                        $file_name = $_FILES['photos']['name'][$key];
                        $file_size =$_FILES['photos']['size'][$key];
                        $file_tmp =$_FILES['photos']['tmp_name'][$key];
                        $file_type=$_FILES['photos']['type'][$key];
                    
                        $sql = "INSERT INTO pictures (id, url) VALUES ('$id', '$file_name')";
                        if ($conn->query($sql) === TRUE) {
                            move_uploaded_file($file_tmp,"./../img/".$file_name);
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }

                    // Display any errors
                    if($errors){
                        print_r($errors);
                    }else{
                        echo "Photos uploaded successfully.";
                    }
                }
            }

            $conn->close();       /* close the connection */
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