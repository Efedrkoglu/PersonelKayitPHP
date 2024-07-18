<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      var path = window.location.pathname;
      var page = path.split("/").pop();

      $('.nav-link').each(function() {
        var href = $(this).attr('href');
        if (page == href) {
          $(this).addClass('active');
        } else {
          $(this).removeClass('active');
        }
      });

      $('.dropdown-menu .dropdown-item').each(function() {
        var href = $(this).attr('href');
        if (page == href) {
          $(this).closest('.nav-item').find('.nav-link').addClass('active');
        }
      });
    });
  </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>