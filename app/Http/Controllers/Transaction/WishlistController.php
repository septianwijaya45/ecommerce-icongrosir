<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Http;

class WishlistController extends Controller
{

    protected $apiUrl;
    protected $photoUrl;
    protected $token;
    protected $banner;

    public function __construct(SessionManager $session)
    {
        $this->apiUrl = config('app.backend_endpoint');
        $this->photoUrl = config('app.photo_product');
        $this->banner = config('app.banner_app');
    }

    public function index(Request $request){
        $token = getToken($request);

        if(!$token){
            $request->session()->forget('token');
            return redirect()->route('home')->with('error', 'Session Anda Telah berakhir!');
        }

        $wishlist = $this->getWishlist($token);
        $wishlists = $wishlist['data'];
        $getBanners = Http::get($this->apiUrl.'/home/banner-app/get-data/');

        foreach ($wishlists as &$item) {
            $varian = getVariant($item['uuid']);
            $warna  = getWarna($item['uuid'], $varian[0]['variasi_detail'], $item['id']);
            $ukuran = getUkuran($item['uuid'], $varian[0]['variasi_detail'], $warna[0]['warna'], $item['id']);
            $harga  = getHarga($item['uuid'], $varian[0]['variasi_detail'], $warna[0]['warna'], $ukuran[0]['ukuran'], $item['id']);

            $item['variants']   = $varian;
            $item['warnas']      = $warna;
            $item['ukurans']     = $ukuran;
            $item['hargas']     = $harga;
        }

        return view('wishlist.index', [
            'token'         => $token,
            'data'          => $wishlists,
            'photoUrl'      => $this->photoUrl,
            'banners'        => $getBanners['data'],
            'urlBanner'     => $this->banner,
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
            \Log::info($jsoncreateWishlist);

            return redirect()->back()->with([
                'success' => 'Berhasil Menambahkan Produk Ke Wishlish!'
            ]);
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->with([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghubungi server.'
            ]);
        }
    }

    public function updateWishlist(Request $request, $product_id, $varian, $warna, $ukuran, $wishlist, $qty){
        try {
            $token = getToken($request);

            $createWishlist = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get($this->apiUrl.'/transaction/wishlist/update-wishlist/'.$product_id.'/'.$varian.'/'.$warna.'/'.$ukuran.'/'.$wishlist.'/'.$qty);
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
