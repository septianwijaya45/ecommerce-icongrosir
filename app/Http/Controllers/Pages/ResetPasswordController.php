<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Http;

class ResetPasswordController extends Controller
{
    protected $apiUrl, $token, $banner;

    public function __construct(SessionManager $session)
    {
        $this->apiUrl = config('app.backend_endpoint');
        $this->banner = config('app.banner_app');
    }

    public function index(Request $request){
        $token = getToken($request);

        return view('auth.reset', [
            'token' => $token
        ]);
    }

    public function store(Request $request){
        try {
            $email = $request->email;

            $apiSend = Http::post($this->apiUrl.'/auth-ecommerce/reset/get-user-by-email', [
                'email'  =>  $request->email
            ]);

            $data = $apiSend->json();

            if ($data['status']) {
                return redirect()->route('reset.password', $data['token'])->with('success', 'Silahkan Reset Password Anda!');;
            } else {
                return redirect()->back()->with('error', 'Email Anda Tidak Terdaftar!');
            }
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->with([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghubungi server.'
            ]);
        }
    }

    public function indexReset(Request $request, $token){
        $tokenWeb = getToken($request);

        return view('auth.reset-password', [
            'token' => $tokenWeb,
            'token_reset' => $token
        ]);
    }

    public function updatePassword(Request $request, $token){
        try {
            $password = $request->password;

            $apiSend = Http::post($this->apiUrl.'/auth-ecommerce/reset/reset-password/'.$token, [
                'password'  =>  $request->password
            ]);

            $data = $apiSend->json();

            if ($data['status']) {
                return redirect()->route('home')->with('success', 'Berhasil Mereset Password Anda!');;
            } else {
                return redirect()->back()->with('error', 'Session Anda Telah berakhir!');
            }
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->with([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghubungi server.'
            ]);
        }
    }
}
