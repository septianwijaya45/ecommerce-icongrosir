<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    
    protected $apiUrl;
    protected $token;

    public function __construct(SessionManager $session)
    {
        $this->apiUrl = config('app.backend_endpoint');
    }

    public function index(Request $request){
        $token = getToken($request);
        
        if(!$token){
            $request->session()->forget('token');
            return redirect()->route('home')->with('error', 'Session Anda Telah berakhir!');
        }

        $getAccountMe = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($this->apiUrl.'/account-me/my-account');

        $getCheckoutData = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($this->apiUrl.'/transaction/checkout/get-checkout');

        $account = $getAccountMe->json();

        return view('checkout.index', [
            'token'         => getToken($request),
            'user'          => $account['user'],
            'detail'        => $account['detail'],
            'checkout'      => $getCheckoutData['data']
        ]);
    }

    public function store(Request $request){
        try {
            $token = getToken($request);
        
            if(!$token){
                $request->session()->forget('token');
                return redirect()->route('home')->with('error', 'Session Anda Telah berakhir!');
            }

            $createWishlist = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post($this->apiUrl.'/transaction/checkout/create-checkout');

            $data = $createWishlist->json();

            if ($data['status'] == true) {
                return redirect()->route('checkout')->with([
                    'success' => 'Berhasil Checkout Produk Anda!'
                ]);
            } else {
                $error = $response->json();
                return redirect()->back()->with('error', $data['message']);
            }

        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->with([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghubungi server.'
            ]);
        }
        
    }

    public function storeConfirm(Request $request){
        try {
            $token = getToken($request);
        
            if(!$token){
                $request->session()->forget('token');
                return redirect()->route('home')->with('error', 'Session Anda Telah berakhir!');
            }

            $apiSend = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post($this->apiUrl.'/transaction/checkout/confirm-pesanan');

            $data = $apiSend->json();

            if ($data['status'] == true) {
                return response()->json([
                    'status' => true,
                    'code'   => 200
                ]);
            } else {
                $error = $response->json();
                return response()->json([
                    'status'    => false,
                    'code'      => 200,
                    'error'     => $error
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
}
