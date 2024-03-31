<?php require_once 'includes/session.php'; ?>
<?php require_once 'includes/database.php'; ?>

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
<?php require_once 'includes/header.php'; ?>
</body>
<div class="container">
  <h2>Vaše rezervacije:</h2>
  <div class="row">
    <?php
     $sql = "SELECT * FROM reservations";
    $result = $conn->query($sql);
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
                <a href="deletereservation.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Izbrisi</a>
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
<?php require_once 'includes/footer.php'; ?>