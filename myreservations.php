<?php require 'loginoperations\checklogin.php'?>
<!DOCTYPE html>
<html>
<head>
    <title>Vaše rezervacije</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .reservation {
            margin-bottom: 20px;
        }
        .bicycle-image {
            max-width: 200px;
            max-height: 200px;
        }
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">TestenCycling</a>
      <?php
      if (isset($_SESSION['email'])) {
          $loggedInEmail = $_SESSION['email'];
              echo ' <a href="loginoperations\logout" class="btn btn-primary">Logout</a>';} else { echo '<div class="login-button">
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#loginModal">
          Login
        </button>
      </div>';}
      ?>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index">O nama</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index#ponudba">Ponudba</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index#user_reviews">Rekli so o nama</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <div class="container">
  <h2>Vaše rezervacije:</h2>
  <div class="row">
    <?php
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $model = $row['model'];
        $RezervacijaOd = $row['date_from'];
        $RezervacijaDo = $row['date_to'];
        $status = $row['status'];

        $bicycleQuery = "SELECT * FROM bicycles WHERE model = '$model'";
        $bicycleResult = $conn->query($bicycleQuery);

        if ($bicycleResult->num_rows > 0) {
          $bicycleRow = $bicycleResult->fetch_assoc();
          $bicycleImage = $bicycleRow['image'];
          $bicycleName = $bicycleRow['model'];

          ?>
          <div class="col-md-4">
            <div class="card">
              <img src="<?php echo $bicycleImage; ?>" alt="<?php echo $bicycleName; ?>" class="card-img-top">
              <div class="card-body">
                <h5 class="card-title"><?php echo $bicycleName; ?></h5>
                <p class="card-text"><strong>Od datuma:</strong> <?php echo $RezervacijaOd; ?></p>
                <p class="card-text"><strong>Do datuma:</strong> <?php echo $RezervacijaDo; ?></p>
                <p class="card-text"><strong>Status:</strong> <?php echo $status; ?></p>
                <a href="delete_reservation?id=<?php echo $row['id']; ?>" class="btn btn-danger">Izbrisi</a>
              </div>
            </div>
          </div>
          <?php
        }
      }
    } else {
      echo "<p>Nimate nobenih rezervacij.</p>";
    }
    $conn->close();
    ?>
  </div>
</div>

    <footer class="bg-dark text-white text-left py-3">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h5>Follow Us</h5>
          <a href="#" class="social-icon"><i class="fa fa-facebook"></i></a>
          <a href="#" class="social-icon"><i class="fa fa-twitter"></i></a>
          <a href="#" class="social-icon"><i class="fa fa-instagram"></i></a>
        </div>
        <div class="col-sm-6 text-right">
          <p>&copy; 2023 TestenCycling. All rights reserved.</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://kit.fontawesome.com/xxxxxxxxxx.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
