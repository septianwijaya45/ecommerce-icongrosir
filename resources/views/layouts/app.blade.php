@php
    $setting = getSetting();
    $logoUrl = config('app.logo_app');
@endphp

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Icon Grosir</title>

    <!-- Font awesome -->
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <!-- SmartMenus jQuery Bootstrap Addon CSS -->
    <link href="{{ asset('css/jquery.smartmenus.bootstrap.css') }}" rel="stylesheet">
    <!-- Product view slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.simpleLens.css') }}">
    <!-- slick slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}">
    <!-- price picker slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/nouislider.css') }}">
    <!-- Theme color -->
    <link id="switcher" href="{{ asset('css/theme-color/default-theme.css') }}" rel="stylesheet">
    <!-- <link id="switcher" href="css/theme-color/bridge-theme.css" rel="stylesheet"> -->
    <!-- Top Slider CSS -->
    <link href="{{ asset('css/sequence-theme.modern-slide-in.css') }}" rel="stylesheet" media="all">
    <!-- Icon -->
    <link rel="shortcut icon" href="{{ asset('img/logo/icongrosir.png') }}" type="image/x-icon">

    <!-- Main style sheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

    <!-- Sweet alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"/>
    @yield('header')

  </head>
  <body>
    <!-- SCROLL TOP BUTTON -->
        <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
    <!-- END SCROLL TOP BUTTON -->
    @include('layouts.partials.header')
    @include('layouts.partials.menu')

    @yield('content')


    <!-- Login Modal -->
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4>Login atau Daftar</h4>
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
            <form class="aa-login-form" method="POST" action="{{ route('login') }}" enctype="multipart/form-data">
              @csrf
                <label for="">Nomor Telepon atau Email<span>*</span></label>
                <input type="text" placeholder="Nomor Telepon atau Email" name="username" id="username" oninput="validatePhoneNumber(this)">
                <label for="">Password<span>*</span></label>
                <div class="row">
                    <div class="col-md-10">
                        <input type="password" name="password" placeholder="Password" id="password">
                    </div>
                    <div class="col-md-1" style="margin-left: -7%; margin-top:-3%;">
                        <button type="button" onclick="togglePasswordLogin('password')" class="btn btn-sm btn-success toggle-password">
                            <i class="fa fa-eye" id="eye-password"></i>
                        </button>
                    </div>
                </div>
                <button class="aa-browse-btn" type="submit">Login</button>
                <p class="aa-lost-password"><a href="#">lupa password?</a></p>
                <div class="aa-register-now">
                Tidak Punya Akun IconGrosir?<a href="{{ route('register') }}">Register sekaraing!</a>
                </div>
            </form>
            </div>
        </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    @include('layouts.partials.footer')

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <!-- SmartMenus jQuery plugin -->
    <script type="text/javascript" src="{{ asset('js/jquery.smartmenus.js') }}"></script>
    <!-- SmartMenus jQuery Bootstrap Addon -->
    <script type="text/javascript" src="{{ asset('js/jquery.smartmenus.bootstrap.js') }}"></script>
    <!-- To Slider JS -->
    <script src="{{ asset('js/sequence.js') }}"></script>
    <script src="{{ asset('js/sequence-theme.modern-slide-in.js') }}"></script>
    <!-- Product view slider -->
    <script type="text/javascript" src="{{ asset('js/jquery.simpleGallery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.simpleLens.js') }}"></script>
    <!-- slick slider -->
    <script type="text/javascript" src="{{ asset('js/slick.js') }}"></script>
    <!-- Price picker slider -->
    <script type="text/javascript" src="{{ asset('js/nouislider.js') }}"></script>
    <!-- Custom js -->
    <script src="{{ asset('js/custom.js') }}"></script>
    <script>
        function deleteDataCartHeader(id){
            swal({
                title: "Apakah Anda Yakin",
                text: "Hapus Cart Anda?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, Hapus!",
                closeOnConfirm: false,
            }, function() {
                swal({
                    title: "Loading...",
                    text: "Proses Hapus List Keranjang Anda!",
                    type: "warning",
                    buttons: false,
                    closeOnClickOutside: false,
                    closeOnEsc: false,
                    allowOutsideClick: false
                });
                $.ajax({
                    url: "{{ route('cart.delete', ':id') }}".replace(':id', id),
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                    swal("Success!", "Berhasil Hapus Cart Anda!.", "success");
                    setInterval(() => {
                        window.location.reload();
                    }, 1000);
                    },
                    error: function(xhr) {
                        swal("Error!", "An error occurred while deleting the wishlist item.", "error");
                    }
                });
            });
        }
    </script>
    <script>
        function togglePasswordLogin(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const eyeIcon = document.getElementById('eye-password');

            if (eyeIcon.classList.contains('fa-eye-slash')) {
                passwordField.type = "password";
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                passwordField.type = "text";
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        }

        function validatePhoneNumber(input) {
            input.value = input.value.replace(/[^0-9]/g, '');
        }
    </script>

    @yield('script')
  </body>
</html>
