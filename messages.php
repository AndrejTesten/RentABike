<?php require_once 'includes/database.php'; 
?>
<?php require_once 'includes/modals.php';?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Messages</title>
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

        .modal-content {
            padding: 20px;
        }

        #messageSent {
            display: none;
        }
    </style>
</head>

<body>
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
            <a class="nav-link" href="crm.php">Zahtevi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="messages.php">Sporočila</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container">
        <h1>Sporočila: </h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM contact_messages";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $message = $row['message'];
                        $createdAt = $row['created_at'];
                        ?>
                        <tr>
                            <td>
                                <?php echo $id; ?>
                            </td>
                            <td>
                                <?php echo $name; ?>
                            </td>
                            <td>
                                <?php echo $email; ?>
                            </td>
                            <td>
                                <?php echo $message; ?>
                            </td>
                            <td>
                                <?php echo $createdAt; ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary replyBtn" data-toggle="modal"
                                    data-target="#replyModal" data-email="<?php echo $email; ?>"  data-message="<?php echo htmlspecialchars($message); ?>">Odgovori</button>
                                <a href="delete_message.php?id=<?php echo $id; ?>" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this message?')">Izbriši</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='6'>No messages found!</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.replyBtn').click(function () {
                var email = $(this).data('email');
                $('#recipientEmail').val(email); // Set recipient email in the modal
                var message = $(this).data('message');
                $('#userMessage').html('<strong>User Message:</strong><br>' + message); // Display user's message
                $('#replyMessage').val(''); // Clear reply message textarea
            });
        });
    </script>
</body>

</html>

<?php
$conn->close();
?>