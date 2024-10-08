  <!-- menu -->
  <section id="menu">
    <div class="container">
        <div class="menu-area">
            <!-- Navbar -->
            <div class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <!-- Left nav -->
                <ul class="nav navbar-nav">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('products') }}">Katalog Kami</a></li>
                <li><a href="{{ route('contactus') }}">Tentang Kami</a></li>
                <li><a href="{{ route('contactus') }}">Kontak Kami</a></li>
                @if($token)
                <li><a href="{{ route('pesananSaya') }}">Pesanan Saya</a></li>
                @endif
                </ul>
            </div><!--/.nav-collapse -->
            </div>
        </div>
    </div>
</section>
  <!-- / menu -->
