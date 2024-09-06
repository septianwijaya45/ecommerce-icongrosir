@extends('layouts.app')

@section('content')
 
 <!-- catg header banner section -->
 <section id="aa-catg-head-banner">
   <img src="{{asset('img/fashion/fashion-header-bg-8.jpg')}}" alt="fashion img">
   <div class="aa-catg-head-banner-area">
    <div class="container">
     <div class="aa-catg-head-banner-content">
       <h2>Account Register</h2>
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
                <h4>Register</h4>
                <form action="{{ route('register.store') }}" method="POST" class="aa-login-form">
                    @csrf
                   <label for="">Nama<span>*</span></label>
                   <input type="text" placeholder="Nama" name="name">
                   <label for="">Email<span>*</span></label>
                   <input type="text" placeholder="Email" name="email">
                   <label for="">Nomor Telepon<span>*</span></label>
                   <input type="text" placeholder="Nomor Telepon" name="no_telepon">
                   <label for="">Password<span>*</span></label>
                   <input type="password" placeholder="Password" name="password">
                   <button type="submit" class="aa-browse-btn">Register</button>                    
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