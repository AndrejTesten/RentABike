<?php require_once 'includes/database.php'; 
?>
<?php require_once 'includes/modals.php';?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>UpravljanjeRezervacijama</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            padding: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #dee2e6;
        }

        th {
            background-color: #f8f9fa;
            text-align: center;
            vertical-align: middle;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .status-accepted {
            color: green;
        }

        .status-rejected {
            color: red;
        }
    </style>
</head>

<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">TestenCycling</a>
      <a href="loginoperations\logout" class="btn btn-primary">Logout</a>;
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Zahtevi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="messages.php">Sporočila</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
<div class="container">
        <h1>Rezervacije: </h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ime</th>
                    <th>Email</th>
                    <th>Model</th>
                    <th>Od datuma</th>
                    <th>Do datuma</th>
                    <th>Status</th>
                    <th>Izberi: </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM reservations";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $reservationId = $row['id'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $model = $row['model'];
                        $dateFrom = $row['date_from'];
                        $dateTo = $row['date_to'];
                        $status = $row['status'];
                        $statusClass = '';
                        if ($status == 'Potrjen') {
                            $statusClass = 'status-accepted';
                        } elseif ($status == 'Zavrnjen') {
                            $statusClass = 'status-rejected';
                        }
                ?>
                        <tr>
                            <td><?php echo $reservationId; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $model; ?></td>
                            <td><?php echo $dateFrom; ?></td>
                            <td><?php echo $dateTo; ?></td>
                            <td class="<?php echo $statusClass; ?>"><?php echo $status; ?></td>
                            <td>
                                <a href="requestoperations\approverequest.php?id=<?php echo $reservationId; ?>" class="btn btn-success">Potrdi</a>
                                <a href="requestoperations\rejectrequest.php?id=<?php echo $reservationId; ?>" class="btn btn-danger">Zavrni</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='8'>Nimate nobenih rezervacija!</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
$conn->close();
?>
