<?php require_once 'session.php'; ?>

<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">TestenCycling</a>
      <?php
      if (isset($_SESSION['email'])) {
        $loggedInEmail = $_SESSION['email'];
        echo ' <a href="loginoperations/logout.php" class="btn btn-primary">Odjava</a>';
      } else {
        echo '<div class="login-button">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#loginModal">
          Prijava
        </button>
      </div>
      <div class="login-button">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#signupModal">
          Registracija
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
            <a class="nav-link" href="index.php">O nama</a>
          </li>
          <?php
          if (isset($_SESSION['email'])) {
            $loggedInEmail = $_SESSION['email'];
            echo '<li class="nav-item">
              <a class="nav-link" href="myreservation.php">Moje rezervacije</a>
            </li>';
          } ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php#bike-rent">Ponudba</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php#user_reviews">Rekli so o nama</a>
          </li>
        </ul>
      </div>
    </nav>
</header>
