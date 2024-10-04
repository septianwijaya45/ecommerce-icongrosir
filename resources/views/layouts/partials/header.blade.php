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
                      <img src="{{ asset('img/flag/indonesia.png') }}" alt="english flag">INDONESIA
                      <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                      <li><a href="#"><img src="{{ asset('img/flag/indonesia.png') }}" alt="">INDONESIA</a></li>
                    </ul>
                  </div>
                </div>
                <!-- / language -->

                <!-- start currency -->
                <div class="aa-currency">
                  <div class="dropdown">
                    <a class="btn dropdown-toggle" href="#" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <i class="fa fa-money"></i>Rupiah
                      <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                      <li><a href="#"><i class="fa fa-money"></i>Rupiah</li>
                    </ul>
                  </div>
                </div>
                <!-- / currency -->
                <!-- start cellphone -->
                <div class="cellphone hidden-xs">
                  <p><span class="fa fa-phone"></span>{{ $setting['no_telp'] }}</p>
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
                    <li class="hidden-xs"><a href="{{ route('cart') }}">Cart Saya</a></li>
                    <li class="hidden-xs"><a href="{{ route('checkout') }}">Checkout</a></li>
                    <li><a href="{{ route('logout') }}" data-toggle="modal">Logout</a></li>
                  @else
                    <li class="hidden-xs"><a href="" data-toggle="modal" data-target="#login-modal">Wishlist</a></li>
                    <li class="hidden-xs"><a href="" data-toggle="modal" data-target="#login-modal">Cart Saya</a></li>
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
                    <div class="row">
                        <div class="col-md-2">
                            <span>
                                <img id="imageShow" src="{{ $logoUrl.$setting['logo'] }}" alt="Preview" style="max-width: 50px; cursor: pointer;" class="text-center ml-2">
                            </span>
                        </div>
                        <div class="col-md-9">
                            <p><strong>{{ $setting['name_app'] }}</strong> <span>Your Shopping Partner</span></p>
                        </div>
                    </div>
                </a>
                <!-- img based logo -->
                <!-- <a href="{{ route('home') }}"><img src="img/logo.jpg" alt="logo img"></a> -->
              </div>
              <!-- / logo  -->
               <!-- cart box -->
                @if($token)
                @php
                    $carts = getMyCart($token);
                    $photoUrl = config('app.photo_product');
                @endphp
                    @if(count($carts) > 0)
                        <div class="aa-cartbox">
                            <a class="aa-cart-link" href="#">
                                <span class="fa fa-shopping-basket"></span>
                                <span class="aa-cart-title">SHOPPING CART</span>
                                <span class="aa-cart-notify">{{ count($carts) }}</span>
                            </a>
                            <div class="aa-cartbox-summary">
                            <ul>
                                @foreach($carts as $index => $cart)
                                    @if ($index < 3)
                                        <li>
                                            <a class="aa-cartbox-img" href="#"><img src="{{ $cart['image'] != null ? $photoUrl.$cart['image'] : asset('/img/default/defaultProduct.png') }}" alt="img"></a>
                                            <div class="aa-cartbox-info">
                                                <h4><a href="#">{{ $cart['nama_barang'] }}</a></h4>
                                                <p>{{ $cart['qty'] }} {{ $cart['variasi'] }}</p>
                                            </div>
                                            <a class="aa-remove-product" onclick="deleteDataCartHeader(`{{ $cart['id'] }}`)"><span class="fa fa-times"></span></a>
                                        </li>
                                    @else
                                        @break
                                    @endif
                                @endforeach
                            </ul>
                            <a class="aa-cartbox-checkout aa-primary-btn" href="{{ route('cart') }}">Cart Saya</a>
                            </div>
                        </div>
                    @else
                    <div class="aa-cartbox">
                        <a class="aa-cart-link" href="#">
                            <span class="fa fa-shopping-basket"></span>
                            <span class="aa-cart-title">SHOPPING CART</span>
                            <span class="aa-cart-notify">{{ count($carts) }}</span>
                        </a>
                        <div class="aa-cartbox-summary">
                        <ul>
                            <p class="text-center text-danger">Tidak Ada Pesanan</p>
                        </ul>
                        <a class="aa-cartbox-checkout aa-primary-btn" href="{{ route('products') }}">Belanja Sekarang</a>
                        </div>
                    </div>
                    @endif
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
