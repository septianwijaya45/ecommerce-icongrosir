<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Http;

class MyCartController extends Controller
{
    protected $apiUrl;
    protected $token;
    protected $banner;
    protected $photoUrl;

    public function __construct(SessionManager $session)
    {
        $this->apiUrl = config('app.backend_endpoint');
        $this->banner = config('app.banner_app');
        $this->photoUrl = config('app.photo_product');
    }

    public function index(Request $request){
        $token = getToken($request);

        if(!$token){
            $request->session()->forget('token');
            return redirect()->route('home')->with('error', 'Session Anda Telah berakhir!');
        }

        $cart = $this->getCart($token);
        $carts = $cart['data'];

        $getBanners = Http::get($this->apiUrl.'/home/banner-app/get-data/');

        foreach ($carts as &$item) {
            $varian = getVariantCart($token, $item['uuid']);
            $warna  = getWarnaCart($token, $item['uuid'], $varian[0]['variasi_detail'], $item['id']);
            $ukuran = getUkuranCart($token, $item['uuid'], $varian[0]['variasi_detail'], $warna[0]['warna'], $item['id']);
            $harga  = getHargaCart($token, $item['uuid'], $varian[0]['variasi_detail'], $warna[0]['warna'], $ukuran[0]['ukuran'], $item['id']);

            $item['variants']   = $varian;
            $item['warnas']      = $warna;
            $item['ukurans']     = $ukuran;
            $item['hargas']     = $harga['harga'];
        }

        return view('cart.index', [
            'token'     => getToken($request),
            'carts'     => $carts,
            'banners'        => $getBanners['data'],
            'urlBanner'     => $this->banner,
            'urlPhoto'      => $this->photoUrl,
        ]);
    }

    public function getCart($token){
        try {
            $createWishlist = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get($this->apiUrl.'/transaction/cart/get-cart');
            $jsoncreateWishlist = $createWishlist->json();
            // dd($jsoncreateWishlist);

            return $jsoncreateWishlist;
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->with([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghubungi server.'
            ]);
        }
    }

    public function store(Request $request, $id, $uuid, $variant_id, $warna, $ukuran){
        try {
            $token = getToken($request);

            if(!$token){
                $request->session()->forget('token');
                return redirect()->route('home')->with('error', 'Session Anda Telah berakhir!');
            }

            $createWishlist = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get($this->apiUrl.'/transaction/cart/create-cart-by-wishlist/'.$id.'/'.$uuid.'/'.$variant_id.'/'.$warna.'/'.$ukuran);
            $jsoncreateWishlist = $createWishlist->json();

            if($jsoncreateWishlist['status'] == true){
                return redirect()->back()->with('success', 'Berhasil Menambahkan ke Keranjang Anda, Silahkan Checkout!.');
            }else{
                return redirect()->back()->with('error',$jsoncreateWishlist['message']);
            }

        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->with([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghubungi server.'
            ]);
        }
    }

    public function storeCartById(Request $request, $id){
        try {
            $token = getToken($request);

            if(!$token){
                $request->session()->forget('token');
                return redirect()->route('home')->with('error', 'Session Anda Telah berakhir!');
            }

            $createWishlist = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get($this->apiUrl.'/transaction/cart/create-cart/'.$id);
            $jsoncreateWishlist = $createWishlist->json();

            if($jsoncreateWishlist['status'] == true){
                return redirect()->back()->with('success','Berhasil Menambahkan ke Keranjang Anda, Silahkan Checkout!.');
            }else{
                return redirect()->back()->with('error', $jsoncreateWishlist['message']);
            }

        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->with('error','Terjadi kesalahan saat menghubungi server.');
        }
    }

    public function updateQty(Request $request, $id, $uuid, $variant_id){
        try {
            $token = getToken($request);

            if(!$token){
                $request->session()->forget('token');
                return redirect()->route('home')->with('error', 'Session Anda Telah berakhir!');
            }

            $reqData = [
                'qty'   => $request->qty
            ];

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post($this->apiUrl.'/transaction/cart/update-qty-cart/'.$id.'/'.$uuid.'/'.$variant_id, $reqData);

            $data = $response->json();


            if ($data['status'] == true) {
                return response()->json([
                    'status'  => $data['status'],
                    'message' => $data['message'],
                    'totalHarga' => formatRupiah($data['totalHarga'] ),
                    'newQty'    => $data['newQty']
                ]);
            } else {
                $error = $response->json();
                return response()->json([
                    'status'  => $data['status'],
                    'message' => $data['message']
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

    public function delete(Request $request,$id){
        try {
            $token = getToken($request);

            if(!$token){
                $request->session()->forget('token');
                return redirect()->route('home')->with('error', 'Session Anda Telah berakhir!');
            }

            $createCart = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->delete($this->apiUrl.'/transaction/cart/delete-cart/'.$id);

            $data = $createCart->json();

            if ($data['status'] == true) {
                return redirect()->route('cart')->with([
                    'success' => 'Berhasil Hapus Data Cart!'
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

    public function getWarnaProduct(Request $request, $product_id, $varian, $wishlist){
        try {
            $token = getToken($request);
            $request = getWarnaCart($token, $product_id, $varian, $wishlist);

            return response()->json($request);
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->with([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghubungi server.'
            ]);
        }
    }

    public function getUkuranProduct(Request $request, $product_id, $varian, $warna, $wishlist){
        try {
            $token = getToken($request);
            $request = getUkuranCart($token, $product_id, $varian, $warna, $wishlist);

            return response()->json($request);
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->with([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghubungi server.'
            ]);
        }
    }

    public function getHargaProduct(Request $request, $product_id, $varian, $warna, $ukuran, $wishlist){
        try {
            $token = getToken($request);
            $request = getHargaCart($token, $product_id, $varian, $warna, $ukuran, $wishlist);
            \Log::info($request);

            return response()->json($request);
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->with([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghubungi server.'
            ]);
        }
    }

    public function duplicateProduct(Request $request, $product_id){
        try {
            $token = getToken($request);

            if(!$token){
                $request->session()->forget('token');
                return redirect()->route('home')->with('error', 'Session Anda Telah berakhir!');
            }

            $duplicateData = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get($this->apiUrl.'/transaction/cart/duplicate-data/'.$product_id);
            $jsonDuplicate = $duplicateData->json();

            if($jsonDuplicate['status'] == true){
                return response()->json([
                    'status'    => true,
                ]);
            }else{
                return response()->json([
                    'status'    => false
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

    public function createCartByDetailProduct(Request $request, $id, $varian, $warna, $ukuran, $qty){
        try {
            $token = getToken($request);

            if(!$token){
                $request->session()->forget('token');
                return redirect()->route('home')->with('error', 'Session Anda Telah berakhir!');
            }

            $createWishlist = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get($this->apiUrl.'/transaction/cart/create-cart-by-detail/'.$id.'/'.$varian.'/'.$warna.'/'.$ukuran.'/'.$qty);
            $jsoncreateWishlist = $createWishlist->json();

            if($jsoncreateWishlist['status'] == true){
                return redirect()->back()->with([
                    'success' => $jsoncreateWishlist['message']
                ]);
            }else{
                return redirect()->back()->with('error', $jsoncreateWishlist['message']);
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
