<footer>
  <div class="container">
      <div class="row">
          <div class="col-md-4">
              <img src="{{ asset('assets/images/company-logo.jpg') }}" alt="Website Logo">
              <p>SCHOOL MANAGEMENT SYSTEM</p>
              <p>Q9P3+75H, My Town, My city, My Country</p>
          </div>
          <div class="col-md-4">
              <p>Time Zone: {{ date('D M d Y H:i:s T') }}</p>
          </div>
          <div class="col-md-4">
              <div class="footer-links">
                  <p>Follow us on</p>
              </div>
              <div class="social-icons">
                  <a href="#"><i class="fab fa-facebook-f facebook"></i></a>
                  <a href="#"><i class="fa-brands fa-x-twitter twitter"></i></a>
                  <a href="#"><i class="fab fa-instagram instagram"></i></a>
                  <a href="#"><i class="fab fa-linkedin-in linked-in"></i></a>
              </div>
          </div>
      </div>
      <div class="row mt-4">
          <div class="col-md-12">
              <p>&copy; {{ date('Y') }} By <a href="https://www.github.com/ProjectsAndPrograms" target="_blank">ProjectsAndPrograms</a>. All rights reserved.</p>
          </div>
      </div>
  </div>
</footer>

<script src="https://kit.fontawesome.com/a81368914c.js"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
</body>
</html>
