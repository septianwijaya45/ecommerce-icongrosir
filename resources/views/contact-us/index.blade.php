@extends('layouts.app')

@section('content')
<section id="aa-catg-head-banner">

    @foreach($banners as $banner)
        @if (strpos($banner['name_menu_banner'], 'contact_us') !== false)
            <img data-seq src="{{ ($banner['image'] != null || $banner['image'] != '' ? $urlBanner.$banner['image'] : asset('img/fashion/fashion-header-bg-8.jpg')) }}" alt="Men slide img" />
        @endif
    @endforeach
    <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Contact Us</h2>
        <ol class="breadcrumb">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li class="active">Contact Us</li>
        </ol>
      </div>
     </div>
   </div>
</section>

<section id="aa-contact">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-contact-area">
            <div class="aa-contact-top">
              <h2>We are wating to assist you..</h2>
              <p>Apapun pertanyaan Anda seputar kaos, kami siap membantu....</p>
            </div>
            <!-- contact map -->
            <div class="aa-contact-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.905781246584!2d112.6884027!3d-7.3148192!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb5a942226b1%3A0xb2c0eeae6378c0ed!2sJl.%20Wiyung%20Brantas%20Permai%20I%20Gg%208%20No.7%2C%20Wiyung%2C%20Kec.%20Wiyung%2C%20Kota%20SBY%2C%20Jawa%20Timur%2060227!5e0!3m2!1sen!2sid!4v1691661566481!5m2!1sen!2sid" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <!-- Contact address -->
            <div class="aa-contact-address">
              <div class="row">
                <div class="col-md-8">
                  <div class="aa-contact-address-left">
                    <form class="comments-form contact-form" action="">
                     <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <input type="text" placeholder="Your Name" name="Nama" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <input type="email" placeholder="Email" name="email" class="form-control">
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <input type="text" placeholder="Subject" name="subject" class="form-control">
                            </div>
                        </div>
                        </div>

                        <div class="form-group">
                        <textarea class="form-control" rows="3" placeholder="Message"></textarea>
                        </div>
                        @if(!$token)
                            <a href="" data-toggle="modal" data-target="#login-modal" class="aa-secondary-btn">Send</a>
                        @else
                            <button class="aa-secondary-btn">Send</button>
                        @endif
                   </form>
                  </div>
                </div>
                <div class="col-md-4">
                    <div class="aa-contact-address-right">
                        <address>
                            <h4>IconGrosir</h4>
                            <p>IconGrosir adalah pusat belanja online terpercaya yang menyediakan berbagai macam pakaian berkualitas dengan harga grosir. Kami menghadirkan koleksi terbaru dan tren fashion terkini untuk memenuhi kebutuhan gaya Anda.</p>
                            <p><span class="fa fa-home"></span>Jl. Wiyung Brantas Permai I Gg 8 No.7, Wiyung, Kec. Wiyung, Surabaya, Jawa Timur 60227</p>
                            <p><span class="fa fa-phone"></span>+ 0857-0000-1111</p>
                            <p><span class="fa fa-envelope"></span>Email: icongrosir@gmail.com</p>
                        </address>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

@stop

@section('script')
<script>
</script>
@stop
