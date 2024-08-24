<!-- footer -->
  <footer id="aa-footer">
    <!-- footer bottom -->
    <div class="aa-footer-top">
     <div class="container">
        <div class="row">
        <div class="col-md-12">
          <div class="aa-footer-top-area">
            <div class="row">
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <h3>Main Menu</h3>
                  <ul class="aa-footer-nav">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="#">Blogger</a></li>
                    <li><a href="#">Career</a></li>
                    <li><a href="#">Katalog Kami</a></li>
                    <li><a href="#">Tentang Kami</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-md-2 col-sm-6">
                <div class="aa-footer-widget">

                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Et Cetera Menu</h3>
                    <ul class="aa-footer-nav">
                        @if($token)
                            <li class="hidden-xs"><a href="{{ route('wishlist') }}">Wishlist</a></li>
                            <li class="hidden-xs"><a href="{{ route('cart') }}">My Cart</a></li>
                            <li class="hidden-xs"><a href="{{ route('checkout') }}">Checkout</a></li>
                            <li><a href="{{ route('account') }}" data-toggle="modal">My Account</a></li>
                        @else
                            <li class="hidden-xs"><a href="" data-toggle="modal" data-target="#login-modal">Wishlist</a></li>
                            <li class="hidden-xs"><a href="" data-toggle="modal" data-target="#login-modal">My Cart</a></li>
                            <li class="hidden-xs"><a href="" data-toggle="modal" data-target="#login-modal">Checkout</a></li>
                            <li><a href="" data-toggle="modal" data-target="#login-modal">Login</a></li>
                        @endif
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-1 col-sm-6">
                <div class="aa-footer-widget">

                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Contact Us</h3>
                    <address>
                      <p>Surabaya, Jawa Timur</p>
                      <p><span class="fa fa-phone"></span>0857-0000-1111</p>
                      <p><span class="fa fa-envelope"></span>icongrosir@gmail.com</p>
                    </address>
                    <div class="aa-footer-social">
                      <a href="#"><span class="fa fa-facebook"></span></a>
                      <a href="#"><span class="fa fa-twitter"></span></a>
                      <a href="#"><span class="fa fa-google-plus"></span></a>
                      <a href="#"><span class="fa fa-youtube"></span></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>
    </div>
    <!-- footer-bottom -->
    <div class="aa-footer-bottom">
      <div class="container">
        <div class="row">
        <div class="col-md-12">
          <div class="aa-footer-bottom-area">
            <p>Designed by <a href="http://www.markups.io/">MarkUps.io</a></p>
            <div class="aa-footer-payment">
              <span class="fa fa-cc-mastercard"></span>
              <span class="fa fa-cc-visa"></span>
              <span class="fa fa-paypal"></span>
              <span class="fa fa-cc-discover"></span>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </footer>
  <!-- / footer -->
