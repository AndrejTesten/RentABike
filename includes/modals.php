<!-- Login Modal -->
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
          <form action="loginoperations/login.php" method="POST">
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

<!-- Signup Modal -->
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
<!-- Reservation Modal -->
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

      <!-- Reply CRM Modal -->
      <div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="replyModalLabel">Odgovori na Sporočilo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="recipientEmail">Naslovnik:</label>
                            <input type="text" class="form-control" id="recipientEmail" name="recipientEmail"
                                value="$email" readonly>
                        </div>
                        <div id="userMessage"></div>
                        <div class="form-group">
                            <label for="replyMessage">Sporočilo:</label>
                            <textarea class="form-control" id="replyMessage" name="replyMessage" rows="4"
                                required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Zapri</button>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#replyDone">Odgovori</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="replyDone" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="replyModalLabel">Odgovor je poslat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>