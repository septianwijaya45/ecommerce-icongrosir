<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirm OTP</title>
    <style>
        body {
            background-color: red;
        }
        .height-100 {
            height: 100vh;
        }
        .card {
            width: 400px;
            border: none;
            height: 300px;
            box-shadow: 0px 5px 20px 0px #d2dae3;
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card h6 {
            color: red;
            font-size: 20px;
        }
        .inputs input {
            width: 40px;
            height: 40px;
        }
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0;
        }
        .card-2 {
            background-color: #fff;
            padding: 10px;
            width: 350px;
            height: 100px;
            bottom: -50px;
            left: 20px;
            position: absolute;
            border-radius: 5px;
        }
        .card-2 .content {
            margin-top: 50px;
        }
        .card-2 .content a {
            color: red;
        }
        .form-control:focus {
            box-shadow: none;
            border: 2px solid red;
        }
        .validate {
            border-radius: 20px;
            height: 40px;
            background-color: red;
            border: 1px solid red;
            width: 140px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container height-100 d-flex justify-content-center align-items-center">
        <div class="position-relative">
            <div class="card p-2 text-center">
            <h6>Berikut adalah Kode tp Anda <br> untuk verifikasi akun Anda </h6>
            <div>
                <small>Berlaku Sampai {{ date('d F Y H:i:s', strtotime($otp['expired_date'])) }}</small>
                <br>
                <span>Kode OTP Anda:</span>
            </div>
            <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2">
                @php
                    $kode_otp_digits = str_split(strval($otp['kode_otp']));
                @endphp
                <input class="m-2 text-center form-control rounded" type="text" id="first" maxlength="1" value="{{ $kode_otp_digits[0] }}" />
                <input class="m-2 text-center form-control rounded" type="text" id="second" maxlength="1" value="{{ $kode_otp_digits[1] }}" />
                <input class="m-2 text-center form-control rounded" type="text" id="third" maxlength="1" value="{{ $kode_otp_digits[2] }}" />
                <input class="m-2 text-center form-control rounded" type="text" id="fourth" maxlength="1" value="{{ $kode_otp_digits[3] }}" />
                <input class="m-2 text-center form-control rounded" type="text" id="fifth" maxlength="1" value="{{ $kode_otp_digits[4] }}" />
                <input class="m-2 text-center form-control rounded" type="text" id="sixth" maxlength="1" value="{{ $kode_otp_digits[5] }}" />
            </div>
            <div class="mt-4">
                <button class="btn btn-danger px-4 validate" onclick="copyOtp()">Copy OTP</button>
            </div>
            </div>
            <div class="card-2">
            <div class="content d-flex justify-content-center align-items-center">
                {{-- <span>Didn't get the code</span>
                <a href="#" class="text-decoration-none ms-3">Resend(1/3)</a> --}}
            </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function copyOtp() {
            const otp = [
                document.getElementById('first').value,
                document.getElementById('second').value,
                document.getElementById('third').value,
                document.getElementById('fourth').value,
                document.getElementById('fifth').value,
                document.getElementById('sixth').value
            ].join('');

            navigator.clipboard.writeText(otp).then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Copied!',
                    text: 'OTP copied to clipboard: ' + otp
                });
            }).catch(err => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Failed to copy OTP: ' + err
                });
            });
        }
    </script>
</body>
</html>
