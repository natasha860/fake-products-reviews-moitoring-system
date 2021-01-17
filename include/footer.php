</div>
<footer class="bg-success footer">
  <p class="text-white text-center mb-0 py-3 my-font-size">Copyright 2020-2022, Fake Review System</p>
</footer>
<!-- Image Modal -->
<div class="modal animate__bounceIn" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title text-center" id="myModalLabel">User Image</h5>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body text-center">
        <img src="" id="imagepreview" style="width: 400px; height: 264px;">
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-outline-success my-btn1" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- image Modal end -->
<script src="admin/assets/js/jquery-3.5.1.min.js"></script>
<script src="admin/assets/js/popper.min.js"></script>
<script src="admin/assets/js/bootstrap.min.js"></script>
<script src="admin/assets/js/bootstrap-notify.js"></script>
<script src="admin/assets/js/notify.js"></script>

<?php
// it will check wheather to show info or error message or not
if ($is_notify) {
?>
  <script type="text/javascript">
    code.showNotification('top', 'right', '<?php echo $notify['message'] . "','" . $notify['icon'] . "','" . $notify['color']; ?>');
  </script>
  <?php
}
if (isset($_SESSION['user']) && $_SESSION['user'] == true) {
  if (isset($_GET['success'])  || isset($_GET['del']) || isset($_GET['added']) || isset($_GET['update']) || isset($_GET['send'])) {
  ?>
    <script type="text/javascript">
      var url = "http://localhost/fake_review_system/<?php echo basename($_SERVER['PHP_SELF']); ?>";
      window.history.replaceState(null, null, url);
    </script>
<?php
  }
}
?>

<script type="text/javascript">
  $('[data-toggle="tooltip"]').tooltip();

  $(document).ready(function() {
    $("input[type=number]").on("focus", function() {
      $(this).on("keydown", function(event) {
        if (event.keyCode === 38 || event.keyCode === 40) {
          event.preventDefault();
        }
      });
    });


    function getBadgeCount() {
      $.ajax({
        url: 'notifications.php',
        data: {
          'pid': '<?php echo $pid; ?>'
        },
        method: 'get',
        dataType: 'json',
        success: function(response) {
          if (response.count > 0) {
            $('.badge-count').html(response.count);
            $('.badge-count').removeClass('d-none');
          } else {
            $('.badge-count').html(response.count);
            $('.badge-count').addClass('d-none');
          }
          setTimeout(function() {
            getBadgeCount();
          }, 2000);
        }
      });
    }

    getBadgeCount();

  })

  //Image Enlarge

  $("#pop").on("click", function() {
    $('#imagepreview').attr('src', $('#imageresource').attr('src')); // here asign the image to the modal when the user click the enlarge link
    $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
  });
</script>
</body>

</html>