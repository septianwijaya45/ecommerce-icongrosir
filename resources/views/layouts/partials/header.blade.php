 <!-- Start header section -->
  <header id="aa-header">
    <!-- start header top  -->
    <div class="aa-header-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-top-area">
              <!-- start header top left -->
              <div class="aa-header-top-left">
                <!-- start language -->
                <div class="aa-language">
                  <div class="dropdown">
                    <a class="btn dropdown-toggle" href="#" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <img src="img/flag/indonesia.png" alt="english flag">INDONESIA
                      <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                      <li><a href="#"><img src="img/flag/indonesia.png" alt="">INDONESIA</a></li>
                    </ul>
                  </div>
                </div>
                <!-- / language -->

                <!-- start currency -->
                <div class="aa-currency">
                  <div class="dropdown">
                    <a class="btn dropdown-toggle" href="#" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <i class="fas fa-rupiah"></i>Rupiah
                      <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                      <li><a href="#"><i class="fa fa-usd"></i>USD</li>
                      <li><a href="#"><i class="fa fa-euro"></i>EURO</a></li>
                    </ul>
                  </div>
                </div>
                <!-- / currency -->
                <!-- start cellphone -->
                <div class="cellphone hidden-xs">
                  <p><span class="fa fa-phone"></span>0857-0000-1111</p>
                </div>
                <!-- / cellphone -->
              </div>
              <!-- / header top left -->
              <div class="aa-header-top-right">
                <ul class="aa-head-top-nav-right">
                  @if($token != null) 
                    <li><a href="{{ route('account') }}">Akun Saya</a></li>
                  @endif
                  @if($token)
                    <li class="hidden-xs"><a href="{{ route('wishlist') }}">Wishlist</a></li>
                    <li class="hidden-xs"><a href="{{ route('cart') }}">My Cart</a></li>
                    <li class="hidden-xs"><a href="{{ route('checkout') }}">Checkout</a></li>
                    <li><a href="{{ route('logout') }}" data-toggle="modal">Logout</a></li>
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
        </div>
      </div>
    </div>
    <!-- / header top  -->

    <!-- start header bottom  -->
    <div class="aa-header-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-bottom-area">
              <!-- logo  -->
              <div class="aa-logo">
                <!-- Text based logo -->
                <a href="{{ route('home') }}">
                  <span class="fa fa-shopping-cart"></span>
                  <p>Icon<strong>Grosir Shop</strong> <span>Your Shopping Partner</span></p>
                </a>
                <!-- img based logo -->
                <!-- <a href="{{ route('home') }}"><img src="img/logo.jpg" alt="logo img"></a> -->
              </div>
              <!-- / logo  -->
               <!-- cart box -->
               @if($token)
              <div class="aa-cartbox">
                <a class="aa-cart-link" href="#">
                  <span class="fa fa-shopping-basket"></span>
                  <span class="aa-cart-title">SHOPPING CART</span>
                  <span class="aa-cart-notify">2</span>
                </a>
                <div class="aa-cartbox-summary">
                  <ul>
                    <li>
                      <a class="aa-cartbox-img" href="#"><img src="img/products/kaos3.png" alt="img"></a>
                      <div class="aa-cartbox-info">
                        <h4><a href="#">T-Shirt Men New Arrival Casual Short</a></h4>
                        <p>200 Kaos</p>
                      </div>
                      <a class="aa-remove-product" href="#"><span class="fa fa-times"></span></a>
                    </li>
                    <li>
                      <a class="aa-cartbox-img" href="#"><img src="img/products/kaos2.png" alt="img"></a>
                      <div class="aa-cartbox-info">
                        <h4><a href="#">T-Shirt Men Dark</a></h4>
                        <p>300 Kaos</p>
                      </div>
                      <a class="aa-remove-product" href="#"><span class="fa fa-times"></span></a>
                    </li>                    
                    <li>
                      <span class="aa-cartbox-total-title">
                        Total
                      </span>
                      <span class="aa-cartbox-total-price">
                        Rp 25.000.000,-
                      </span>
                    </li>
                  </ul>
                  <a class="aa-cartbox-checkout aa-primary-btn" href="checkout.html">Checkout</a>
                </div>
              </div>
              @endif
              <!-- / cart box -->     
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header bottom  -->
  </header>
  <!-- / header section -->