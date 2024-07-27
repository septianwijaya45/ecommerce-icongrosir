<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Http;

class WishlistController extends Controller
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

        $wishlist = $this->getWishlist($token);
        
        return view('wishlist.index', [
            'token'         => $token,
            'data'          => $wishlist['data']
        ]);
    }

    public function createWishlist(Request $request,$id){
        try {
            $token = getToken($request);
            
            if(!$token){
                $request->session()->forget('token');
                return redirect()->route('home')->with('error', 'Session Anda Telah berakhir!');
            }

            $createWishlist = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get($this->apiUrl.'/transaction/wishlist/create-wishlist/'.$id);
            $jsoncreateWishlist = $createWishlist->json();

            return redirect()->back();
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->with([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghubungi server.'
            ]);
        }
    }

    public function getWishlist($token){
        try {

            $createWishlist = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get($this->apiUrl.'/transaction/wishlist/get-wishlist/');
            $jsoncreateWishlist = $createWishlist->json();

            return $jsoncreateWishlist;
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->with([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghubungi server.'
            ]);
        }
    }

    public function deleteWishlist(Request $request,$id){
        try {
            $token = getToken($request);

            if(!$token){
                $request->session()->forget('token');
                return redirect()->route('home')->with('error', 'Session Anda Telah berakhir!');
            }

            $createWishlist = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->delete($this->apiUrl.'/transaction/wishlist/delete-wishlist/'.$id);

            $data = $createWishlist->json();

            if ($data['status'] == true) {
                return redirect()->route('wishlist')->with([
                    'success' => 'Berhasil Hapus Data Wishlist!'
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
}
