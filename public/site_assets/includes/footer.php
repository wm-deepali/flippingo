  <!-- Modal -->
  <div class="modal fade" id="requestCallback" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="requestCallbackLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="requestCallbackLabel">Request Callback</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body contact">
          <form action="#" method="post" role="form" class="php-email-form">
            <div class="row">
              <div class="col-md-6 form-group">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Estimate Number" required>
              </div>
              <div class="col-md-6 form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Your Email" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 form-group mt-3">
                <label class="form-label">Phone</label>
                <input type="text" class="form-control" name="mobile" placeholder="Contact Number" required>
              </div>
              <div class="col-md-6 form-group mt-3">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" name="address" placeholder="Address" required>
              </div>
            </div>
            <div class="form-group mt-3">
                <label class="form-label">Message</label>
              <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
            </div>
            <div class="text-center"><button type="submit">Send Message</button></div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <img src="images/footer-logo.png" alt="">
            <p>Cras222222222 fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus. Scelerisque felis.</p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><a href="about.php">About Us</a></li>
              <li><a href="trade-binding.php">Trade Binding</a></li>
              <li><a href="tools.php">Tools</a></li>
              <li><a href="book-types.php">Book Types</a></li>
              <li><a href="services.php">Services</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>BOOK EMPIRE, Reception,<br>Unit 7, Lotherton Way,<br>Leeds, West Yorkshire, LS25 2JY.<br>
              <strong>Phone:</strong> 0113 2874 724<br>
              <strong>Email:</strong> info@bookempire.co.uk
            </p>

            <div class="social-links">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>

          </div>

          <div class="col-lg-3 col-md-6 footer-newsletter">
            <h4>Get an Instant Quote</h4>
            <p>Whether2 you want to take advantage of our book design service or not, it's really easy to find out how much it is going to cost to print your book.</p>
            <p>Get an instant online quote for your book or booklet printing.</p>
            <div class="foot-btn-blk">
              <a href="#" class="btn btn-primary">Get online quote</a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright 2021 <strong><span>Book Empire</span></strong> | All Rights Reserved. Designed by <a href="https://www.webmingo.in/" target="_blank">Web Mingo IT Solutions Pvt. Ltd.</a>
      </div>
    </div>
  </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="js/jquery-3.6.0.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/purecounter.js"></script>
  <script src="js/lightbox.min.js"></script>
  <script src="js/main.js"></script>
  <script>
    $(document).ready(function() {
      $('.home-slider').owlCarousel({
        loop: true,
        margin: 0,
        responsiveClass: true,
        autoplay: true,
        singleItem: true,
        responsive: {
          0: {
            items: 1,
            nav: true,
            dots: false
          },
          600: {
            items: 1,
            nav: true,
            dots: false
          },
          1000: {
            items: 1,
            nav: true,
            dots: false
          }
        }
      })
    });
    $(document).ready(function() {
      $('.testimonial-slider').owlCarousel({
        loop: true,
        margin: 0,
        responsiveClass: true,
        responsive: {
          0: {
            items: 1,
            nav: true,
            dots: false
          },
          600: {
            items: 1,
            nav: true,
            dots: false
          },
          1000: {
            items: 1,
            nav: true,
            dots: false
          }
        }
      })
    });
  </script>
  <script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
  </script>
</body>

</html>