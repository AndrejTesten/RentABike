<?php require 'database.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>TestenCycling</title>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">TestenCycling</a>
      <?php
      if (isset($_SESSION['email'])) {
        $loggedInEmail = $_SESSION['email'];
        echo ' <a href="loginoperations\logout" class="btn btn-primary">Logout</a>';
      } else {
        echo '<div class="login-button">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#loginModal">
          Login
        </button>
      </div>
      <div class="login-button">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#signupModal">
          SignUp
        </button>
      </div>';
      }
      ?>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="#about">O nama</a>
          </li>
          <?php
          if (isset($_SESSION['email'])) {
            $loggedInEmail = $_SESSION['email'];
            echo '<li class="nav-item">
              <a class="nav-link" href="myreservations.php">Moje rezervacije</a>
            </li>';
          } ?>
          <li class="nav-item">
            <a class="nav-link" href="#bike-rent">Ponudba</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#user_reviews">Rekli so o nama</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">Prijavi se</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="loginoperations/login" method="POST">
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="form-group">
              <label for="password">Geslo:</label>
              <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Registracija</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="loginoperations/signup.php" method="POST">
          <div class="form-group">
            <label for="signup_email">Email:</label>
            <input type="email" class="form-control" name="email" id="signup_email" required>
          </div>
          <div class="form-group">
            <label for="signup_password">Geslo:</label>
            <input type="password" class="form-control" name="password" id="signup_password" required>
          </div>
          <div class="form-group">
            <label for="confirm_password">Potrdi geslo:</label>
            <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
          </div>
          <button type="submit" class="btn btn-primary">Registriraj se</button>
        </form>
      </div>
    </div>
  </div>
</div>

  <section id="about" class="about-section">
    <div class="about-bg"></div>
    <div class="container">
      <div class="about-content">
        <h2>TestenCycling</h2>
        <p>Smo mlado podjetje, ki se ukvarja z izposojo zmogljivih električnih koles.
          Pridite, izberite in doživite naval adrenalina.</p>
      </div>
    </div>
  </section>

  <section id="bike-rent" class="container">
    <h2 class="izberi">Izberite kolesa: </h2>
    <div id="bike-carousel" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <?php
        $bicycles = [];
        while ($row = $result->fetch_assoc()) {
          $bicycles[] = $row;
        }

        $groups = array_chunk($bicycles, 3);

        $active = true;
        foreach ($groups as $group) {
          if ($active) {
            echo '<div class="carousel-item active">';
            $active = false;
          } else {
            echo '<div class="carousel-item">';
          }
          echo '<div class="row">';
          foreach ($group as $bike) {
            $bikeName = $bike['model'];
            $bikeImage = $bike['image'];
            $bikeDescription = $bike['description'];
            ?>
            <div class="col-md-4">
              <div class="card">
                <img src="<?php echo $bikeImage; ?>" class="card-img-top" alt="<?php echo $bikeName; ?>">
                <div class="card-body">
                  <h5 class="card-title">
                    <?php echo $bikeName; ?>
                  </h5>
                  <p class="card-text">
                    <?php echo $bikeDescription; ?>
                  </p>
                  <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#rentModal"
                    data-model="<?php echo $bikeName; ?>">Izposoji</a>
                </div>
              </div>
            </div>
            <?php
          }
          echo '</div>';
          echo '</div>';
        }
        ?>
      </div>
      <a class="btn btn-primary mb-3 mr-1" href="#bike-carousel" role="button" data-slide="prev">
        <i class="fa fa-arrow-left"></i>
      </a>
      <a class="btn btn-primary mb-3 " href="#bike-carousel" role="button" data-slide="next">
        <i class="fa fa-arrow-right"></i>
      </a>
    </div>
  </section>

  <div class="modal fade" id="rentModal" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="requestModalLabel">Rezervacija</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="requestoperations\submit_request.php" method="POST">
            <?php
            //Preverjamo ce je uporabnik ulogovan in ce je izpisemo form, ce ni pa napisemo da se mora prijaviti ce zeli izposojiti koleso
            if (isset($_SESSION['email'])) {
              $loggedInEmail = $_SESSION['email'];
              echo '
                            <div class="form-group">
              <label for="model">Model:</label>
              <input type="text" class="form-control" name="model" id="model" readonly>
            </div>
            <div class="form-group">
              <label for="name">Ime:</label>
              <input type="text" class="form-control" name="name" id="name" required>
            </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" name="email" id="email2" readonly>
                                </div>
                                <div class="form-group">
              <label for="dateFrom">Datum od:</label>
              <input type="date" class="form-control" name="dateFrom" id="dateFrom" required>
            </div>

            <div class="form-group">
              <label for="dateTo">Datum do:</label>
              <input type="date" class="form-control" name="dateTo" id="dateTo" required>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Prekliči</button>
              <button type="submit" class="btn btn-primary">Potrdi</button>
            </div>
                            ';
            } else {
              echo '
                                <div class="alert alert-warning" role="alert">
                                    Morate se prijaviti da bi rezervirali koleso.
                                </div>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Prekliči</button>

                            ';
            }
            ?>


          </form>
        </div>
      </div>
    </div>
  </div>



  <section id="user_reviews" class="user-reviews-section">
    <div class="container">
      <h2>Rekli so o nama</h2>
      <div class="row">
        <div class="col-md-4">
          <div class="review-card">
            <div class="review-image">
              <img src="slike/avatar1.png" alt="User 1">
            </div>
            <div class="review-content">
              <h4>Jovan Jovanovic</h4>
              <p>Vrhunska ponudba, priporocam vsem.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="review-card">
            <div class="review-image">
              <img src="slike/avatar2.png" alt="User 2">
            </div>
            <div class="review-content">
              <h4>Pera Peric</h4>
              <p>Fantastična ponudba visokozmogljivih koles.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="review-card">
            <div class="review-image">
              <img src="slike/avatar3.jpg" alt="User 3">
            </div>
            <div class="review-content">
              <h4>Marko Simic</h4>
              <p>Prijetni ljudje, s kvalitetnimi kolesi in ugodnimi cenami.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="bg-dark text-white text-left py-3">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h5>Zapratite nas</h5>
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
  <script>
    // Funkcionalnost da lahko ko je uporabnik logiran automatski potegnemo informacije o modelu in njegov email v modal in formu v njemu
    $('#rentModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var model = button.data('model');
      var modal = $(this);
      modal.find('#selectedModel').text(model);
      modal.find('#model').val(model);
    });
    $('#rentModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var model = button.data('model');
      var modal = $(this);
      var userEmail = '<?php echo $_SESSION["email"]; ?>';

      modal.find('#selectedModel').text(model);
      modal.find('#model').val(model);
      modal.find('#email2').val(userEmail);
    });
  </script>
</body>

</html>