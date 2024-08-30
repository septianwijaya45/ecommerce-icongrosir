<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ConfirmOtpLogin extends Controller
{
    protected $apiUrl;
    protected $token;

    public function __construct()
    {
        $this->apiUrl = config('app.backend_endpoint');
    }

    public function index(Request $request){
        try {
            $userId = $request->secretCode;
            if(!$userId || $userId == '-'){
                return redirect()->route('home')->with([
                    'success' => false,
                    'error' => 'Anda Harus Login Terlebih Dahulu!.'
                ]);
            }

            $response = Http::post($this->apiUrl.'/auth-ecommerce/get-confirm-otp', [
                'user_id' =>  $userId
            ]);

            $data = $response->json();
            if ($data['status'] == true) {
                return view('auth.get-otp', $data);
            } else {
                $error = $response->json();
                return redirect()->route('home')->with('error', $data['message']);
            }
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->route('home')->with([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghubungi server.'
            ]);
        }
    }
}
