<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Http;

class PesananSayaController extends Controller
{
    protected $apiUrl;
    protected $token;
    protected $banner;

    public function __construct(SessionManager $session)
    {
        $this->apiUrl = config('app.backend_endpoint');
        $this->banner = config('app.banner_app');
    }

    public function index(Request $request){
        $token = getToken($request);

        if(!$token){
            $request->session()->forget('token');
            return redirect()->route('home')->with('error', 'Session Anda Telah berakhir!');
        }

        $getBanners = Http::get($this->apiUrl.'/home/banner-app/get-data/');

        $apiUrl = config('app.backend_endpoint');
        $createWishlist = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($apiUrl.'/transaction/history/get-history-cart');

        $jsoncreateWishlist = $createWishlist->json();

        $transactions = [];

        $data = $jsoncreateWishlist['data'];
        foreach ($data as $item) {
            $kode_invoice = $item['kode_invoice'];

            if (!isset($transactions[$kode_invoice])) {
                $transactions[$kode_invoice] = [
                    'name'  => $item['name'],
                    'alamat' => $item['alamat'],
                    'kode_invoice' => $kode_invoice,
                    'products' => [],
                    'total_harga' => 0,
                    'konfirmasi_admin' => $item['konfirmasi_admin'],
                    'tanggal_pesan' => date('d F Y H:i:s', strtotime($item['createdAt']))
                ];
            }

            $transactions[$kode_invoice]['products'][] = [
                'nama_barang' => $item['nama_barang'],
                'variasi'   => $item['variasi'],
                'warna'     => $item['warna'],
                'ukuran'    => $item['ukuran'],
                'qty' => $item['qty'],
                'harga' => $item['harga'],
            ];

            $transactions[$kode_invoice]['total_harga'] += $item['qty'] * $item['harga'];
        }

        $transactions = array_values($transactions);

        $data['token'] = $token;
        $data['banners']    = $getBanners['data'];
        $data['urlBanner']  = $this->banner;
        $data['historyTransaction'] = $transactions;
        return view('transaction.history', $data);
    }
}
