@extends('layouts.app')

@section('script')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@stop

@section('content')
 
 <!-- catg header banner section -->
 <section id="aa-catg-head-banner">
  @foreach($banners as $banner)
    @if (strpos($banner['name_menu_banner'], 'account') !== false)
      <img data-seq src="{{ ($banner['image'] != null || $banner['image'] != '' ? $urlBanner.$banner['image'] : asset('img/fashion/fashion-header-bg-8.jpg')) }}" alt="Men slide img" />
    @endif
  @endforeach
   <div class="aa-catg-head-banner-area">
    <div class="container">
     <div class="aa-catg-head-banner-content">
       <h2>Akun saya</h2>
       <ol class="breadcrumb">
         <li><a href="{{ route('home') }}">Home</a></li>                   
         <li class="active">Account</li>
       </ol>
     </div>
    </div>
  </div>
 </section>
 <!-- / catg header banner section -->

<!-- Cart view section -->
<section id="aa-myaccount">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
       <div class="aa-myaccount-area">         
           <div class="row">
             <div class="col-md-12">
               <div class="aa-myaccount-register">                 
                <h4>Akun Saya</h4>
                 <form action="{{ route('accountSave') }}" method="POST" class="aa-login-form">
                  @csrf
                  @if(session('error'))
                      <div class="alert alert-danger text-white">
                          {{ session('error') }}
                      </div>
                  @endif
                  @if(session('success'))
                      <div class="alert alert-success text-white">
                          {{ session('success') }}
                      </div>
                  @endif
                    <label for="">Nama<span>*</span></label>
                    <input type="text" name="account_id" value="{{ $user['id'] }}" hidden>
                    <input type="text" placeholder="Nama Anda" name="name" value="{{ $user['name'] }}">
                    <label for="">Email<span>*</span></label>
                    <input type="text" placeholder="Email Anda" name="email" value="{{ $user['email'] }}">
                    <label for="">Nomor Telepon<span>*</span></label>
                    <input type="text" placeholder="Nomor Telepon Anda" name="no_telepon" value="{{ $user['no_telepon'] }}">
                    <label for="">Kota<span>*</span></label>
                    <input type="text" placeholder="Kota Anda" name="kota" value="{{ isset($detail['kota']) ? $detail['kota'] : '' }}">
                    <label for="">Kode Pos<span>*</span></label>
                    <input type="text" placeholder="Kode Pos Anda" name="kode_pos" value="{{ isset($detail['kode_pos']) ? $detail['kode_pos'] : '' }}">
                    <label for="">Alamat<span>*</span></label>
                    <input type="text" placeholder="Alamat Anda" name="alamat" value="{{ isset($detail['alamat']) ? $detail['alamat'] : '' }}">
                    <button type="submit" class="aa-browse-btn">Simpan Data Saya</button> 
                  </form>
               </div>
             </div>
           </div>          
        </div>
      </div>
    </div>
  </div>
</section>

@stop
