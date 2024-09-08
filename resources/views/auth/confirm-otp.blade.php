@extends('layouts.app')

@section('content')

 <!-- catg header banner section -->
 <section id="aa-catg-head-banner">
   <img src="{{ asset('img/fashion/fashion-header-bg-8.jpg')}}" alt="fashion img">
   <div class="aa-catg-head-banner-area">
    <div class="container">
     <div class="aa-catg-head-banner-content">
       <h2>Account Page</h2>
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
                <h4> @if($userId != '-') Konfirmasi OTP @else Konfirmasi OTP @endif</h4>
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
                    <form action="{{ route('checkConfirmOtp') }}" method="POST" class="aa-login-form">
                        @csrf
                        <label for="">Konfirm OTP<span>*</span></label>
                        <input type="text" placeholder="Konfirmasi OTP" name="user" value="{{ $userId }}" hidden>
                        <input type="text" placeholder="Konfirmasi OTP" name="otp">
                        <button type="submit" class="aa-browse-btn">Konfirmasi Otp</button>
                        @if($userId == '-')
                        <a href="{{ route('home') }}" >
                            <button type="button" class="aa-browse-btn">Kembali</button>
                        </a>
                        @else
                        <a href="{{ route('resendOtp', ['id' => $userId]) }}" >
                            <button type="button" class="aa-browse-btn">Kirim Ulang OTP</button>
                        </a>
                        @endif
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
