@extends('layouts.app')

@section('content')

 <!-- catg header banner section -->
 <section id="aa-catg-head-banner">
   <img src="{{asset('img/fashion/fashion-header-bg-8.jpg')}}" alt="fashion img">
   <div class="aa-catg-head-banner-area">
    <div class="container">
     <div class="aa-catg-head-banner-content">
       <h2>Account Reset Password</h2>
       <ol class="breadcrumb">
         <li><a href="{{ route('home') }}">Home</a></li>
         <li class="active">Account Reset</li>
       </ol>
     </div>
    </div>
  </div>
 </section>
 <!-- / catg header banner section -->

<!-- Cart view section -->
<section id="aa-myaccount">
    @if(session('error'))
        <div class="alert alert-danger text-white text-center">
            {{ session('error') }}
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success text-white text-center">
            {{ session('success') }}
        </div>
    @endif
  <div class="container">
    <div class="row">
      <div class="col-md-12">
       <div class="aa-myaccount-area">
           <div class="row">
             <div class="col-md-12">
               <div class="aa-myaccount-register">
                <h4>Account Reset Password</h4>
                <form action="{{ route('reset.store') }}" method="POST" class="aa-login-form">
                    @csrf
                    <label for="">Email<span>*</span></label>
                    <input type="text" placeholder="Email" name="email">
                   <button type="submit" class="aa-browse-btn" id="submit-btn">Reset Password Sekarang!</button>
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
