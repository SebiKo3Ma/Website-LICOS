<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Despre noi - Centrul Local „Licos” Timișoara</title>
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
              <a class="nav-link" href="./activities.html">Activities</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./register.html">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./gallery.html">Gallery</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">Contact</a>
            </li>

          </ul>
        </div>
      
      </nav>

      <div class="container-fluid content">
        <?php
            /* Verificar se o formulário foi submetido */
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = filter_input(INPUT_POST, 'name');
                $email = filter_input(INPUT_POST, 'email');
                $message = filter_input(INPUT_POST, 'message');
                /* validar os dados recebidos do formulário */
                if (empty($name) || empty($email) || empty($message)){
                    echo "Todos os campos do formulário devem conter valores ";
                    exit();
                }    
            }
            else{
            echo " Erro, formulário não submetido ";
            exit();
            }

            $conn = new mysqli("localhost", "root", "", "licoswebsite");

            if ($conn->connect_errno) {
                echo "Falha na ligação: " . $conn->connect_error; 
                exit();
            }

            /* texto sql da consulta*/
            $query = "INSERT INTO contact (name, email, message, timestamp) VALUES ('$name', '$email', '$message', CURRENT_TIMESTAMP )";
            /* executar a consulta e testar se ocorreu erro */
            if (!$conn->query($query)) {
                echo " Falha ao executar a consulta: \"$query\" <br>" . $conn->error;
                $conn->close();  /* fechar a ligação */
            }
            else{
                /* percorrer os registos (linhas) da tabela e mostrar na página */
                echo " Novo registo inserido com sucesso" ;
                }
            $conn->close();       /* fechar a ligação */

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
                    <a href="./admin.html">Admin Connect</a>
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