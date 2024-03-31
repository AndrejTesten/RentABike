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
