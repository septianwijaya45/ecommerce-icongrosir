<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Http;

class AuthUserController extends Controller
{
    protected $apiUrl;
    protected $token;

    public function __construct(SessionManager $session)
    {
        $this->apiUrl = config('app.backend_endpoint');
        $this->token = $session->get('token');
    }

    public function register(){
        return view('auth.register', [
            'token' => $this->token
        ]);
    }

    public function store(Request $request){
        try {
            $response = Http::post($this->apiUrl . '/auth-ecommerce/register', [
                'name'          => $request->name,
                'email'         => $request->email,
                'no_telepon'    => $request->no_telepon,
                'password'      => $request->password
            ]);

            if ($response->successful()) {
                $data = $response->json();
                \Log::info($data);
                return redirect()->route('confirm-otp')->with([
                    'success' => 'Silahkan Cek Nomor Whatsapp Anda untuk Mendapatkan Kode OTP.',
                    'user'    => $data['user']['uuid']
                ]);
            } else {
                $error = $response->json();
                return redirect()->back()->with('error', 'Failed to register.');
            }
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->with([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghubungi server.'
            ]);
        }
    }

    public function confirmOtp(){
        return view('auth.confirm-otp', [
            'token' => $this->token
        ]);
    }

    public function checkConfirmOtp(Request $request){
        try {
            $response = Http::post($this->apiUrl . '/auth-ecommerce/confirm-otp', [
                'user_id'          => $request->user,
                'kode_otp'         => $request->otp
            ]);

            $statusResponse = $response->json();
            \Log::info($statusResponse);

            if ($statusResponse['status'] == true) {
                
                $token = $statusResponse['accessToken'];
                $request->session()->put('token', $token);

                return redirect()->route('home')->with('success', 'Berhasil Login!');
            } else {
                $error = $response->json();
                return redirect()->back()->with([
                    'error' => "Cannot Confirm OTP Because OTP Expired! Click 'Kirim Ulang OTP' ",
                    'user'    => $request->user
                ]);
            }
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->with([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghubungi server.'
            ]);
        }
    }

    public function resendOtp(Request $request, $id){
        try {
            $response = Http::post($this->apiUrl . '/auth-ecommerce/resend-otp', [
                'user_id'          => $id
            ]);

            if ($response->successful()) {
                $data = $response->json();

                return redirect()->back()->with([
                    'success' => "Silahkan Cek Nomor Whatsapp Anda untuk Mendapatkan Kode OTP.",
                    'user'    => $id
                ]);
            } else {
                $error = $response->json();
                return redirect()->back()->with([
                    'error' => "Error Ketika Kirim OTP, Silahkan Klik Ulang 'Kirim Ulang OTP' ",
                    'user'    => $id
                ]);
            }
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->with([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghubungi server.'
            ]);
        }
    }

    public function loginUser(Request $request){
        try {
            $username = $request->username;
            $password = $request->password;

            if(is_null($username) || is_null($password)){
                return response()->json([
                    'status'    => false,
                    'code'      => 400,
                    'message'   => 'Nomor Telepon/Email atau Password Tidak Boleh Kosong!'
                ]);
            }

            $response = Http::post($this->apiUrl.'/auth-ecommerce/login', [
                'username'      => $request->username,
                'password'      => $request->password
            ]);

            $data = $response->json();
            if ($data['status'] == true) {
                return redirect()->route('confirm-otp')->with([
                    'success' => 'Silahkan Cek Nomor Whatsapp Anda untuk Mendapatkan Kode OTP.',
                    'user'    => $data['user']['uuid']
                ]);
            } else {
                $error = $response->json();
                return redirect()->back()->with('error', $data['message']);
            }
        } catch (\Exception $e) {
            \Log::info($e);
            return response()->json([
                'status'    => false,
                'code'      => 500,
                'message'   => 'Nomor Telepon/Email atau Password Salah!'
            ]);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('token');

        return redirect()->route('home');
    }
}