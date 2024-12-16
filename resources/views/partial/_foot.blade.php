<footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <ul class="social-icons">
            <li><a href="#">Facebook</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Behance</a></li>
            <li><a href="#">Linkedin</a></li>
            <li><a href="#">Dribbble</a></li>
          </ul>
        </div>
        <div class="col-lg-12">
          <div class="copyright-text">
            <p>Copyright 2020 Stand Blog Co.

               | Design: <a rel="nofollow" href="https://templatemo.com" target="_parent">TemplateMo</a></p>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script language = "text/Javascript">
    cleared[0] = cleared[1] = cleared[2] = 0;
    function clearField(t){
    if(! cleared[t.id]){
        cleared[t.id] = 1;
        t.value='';
        t.style.color='#fff';
        }
    }
  </script>
  <script src="{{ asset('js/custom.js') }}"></script>
  <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('template/assets/js/custom.js') }}"></script>
  <script src="{{ asset('template/assets/js/owl.js') }}"></script>
  <script src="{{ asset('template/assets/js/slick.js') }}"></script>
  <script src="{{ asset('template/assets/js/isotope.js') }}"></script>
  <script src="{{ asset('template/assets/js/accordions.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  {{-- <script language="JavaScript">
    let cleared = [0, 0, 0]; // Set a cleared flag for each field
    function clearField(t) {
        if (!cleared[t.id]) {
            cleared[t.id] = 1; // Mark field as cleared
            t.value = ''; // Clear the field value
            t.style.color = '#fff';
        }
    } --}}
