<?php
// Load Config
require_once 'app/config/config.php';
require_once 'app/config/database.php';
//new class connection
$conn = Connection::new();



?>

<!doctype html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homepage</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
  <div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-evenly  py-3 mb-4">
      <div class="col-md-3 mb-2 mb-md-0">
        <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none regular">
            museum
        </a>
      </div>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="#" class="nav-link px-2 link-secondary regular">Home</a></li>
        <li><a href="#" class="nav-link px-2 regular">Features</a></li>
        <li><a href="#" class="nav-link px-2 regular">Pricing</a></li>
        <li><a href="#" class="nav-link px-2 regular">FAQs</a></li>
        <li><a href="#" class="nav-link px-2 regular">About</a></li>
      </ul>

      <div class="col-md-3 text-end">
        <a href="login.html" class="btn btn-outline-primary me-2 regular">Login</a>
        <a href="signup.html" class="btn btn-primary regular">Sign-up</a>
      </div>
    </header>
  </div>
    <h1 class="title">Hello, world!</h1>
    
    <h2 class="regular">Presentazione del Museo</h2>
    <p class="regular">Benvenuto nel museo</p>

    https://bulma.io/documentation/start/overview/



    <br>


</body>
</html>
