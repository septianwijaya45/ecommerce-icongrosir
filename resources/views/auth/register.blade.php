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
                    <div class="row">
                        <div class="col-md-10">
                            <input type="password" placeholder="Password" name="password" id="password" oninput="checkPasswordMatch()">
                        </div>
                        <div class="col-md-1" style="margin-top: -0.9%">
                            <button type="button" onclick="togglePassword('password')" class="btn btn-success toggle-password">
                                <i class="fa fa-eye" id="eye-password"></i>
                            </button>
                        </div>
                    </div>

                    <label for="">Confirm Password<span>*</span></label>
                    <div class="row">
                        <div class="col-md-10">
                            <input type="password" placeholder="Confirm Password" name="password_confirmation" id="confirm_password" oninput="checkPasswordMatch()">
                        </div>
                        <div class="col-md-1" style="margin-top: -0.9%">
                            <button type="button" onclick="togglePassword('confirm_password')" class="btn btn-sm toggle-password">
                                <i class="fa fa-eye" id="eye-confirm-password"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="color: red; display: none;" id="password-error">
                            Passwords do not match!
                        </div>
                    </div>
                   <button type="submit" class="aa-browse-btn" id="submit-btn">Register</button>
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

@section('script')
<script>
    // Function to toggle password visibility
    function togglePassword(fieldId) {
        const passwordField = document.getElementById(fieldId);
        const eyeIcon = document.getElementById('eye-password');
        const eyeIconTwo = document.getElementById('eye-confirm-password');

        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = "password";
            eyeIconTwo.classList.remove('fa-eye-slash');
            eyeIconTwo.classList.add('fa-eye');
        }
    }

    function checkPasswordMatch() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        const submitButton = document.getElementById('submit-btn');
        const passwordError = document.getElementById('password-error');

        if (password === confirmPassword && password !== "") {
            submitButton.disabled = false;
            passwordError.style.display = 'none';
        } else {
            submitButton.disabled = true;
            passwordError.style.display = 'block';
        }
    }
</script>
@stop
