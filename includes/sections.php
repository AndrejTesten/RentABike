<?php require 'database.php'; ?>

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
        $sql = "SELECT * FROM bicycles";
        $result = $conn->query($sql);
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
    </div></section>

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

<?php if (isLoggedIn()): ?>
<section id="kontakt" class="container">
<h2>Kontaktirajte nas</h2>
  <div class="row">
    <div class="col-md-6 mx-auto">
      <form action="contactoperations\contact.php" method="POST">
        <div class="form-group">
          <label for="name">Ime:</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="message">Sporočilo:</label>
          <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Pošlji</button>
      </form>
    </div>
  </div>
</section>
<?php endif; ?>
