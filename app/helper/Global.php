<?php
use Illuminate\Support\Facades\Http;

function formatRupiah($angka){
    return 'Rp ' . number_format($angka, 0, ',', '.') . ',-';
}

function getMyCart($token){
    try {
        $apiUrl = config('app.backend_endpoint');
        $createWishlist = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($apiUrl.'/transaction/cart/get-cart');
        $jsoncreateWishlist = $createWishlist->json();

        return $jsoncreateWishlist['data'];
    } catch (\Exception $e) {
        \Log::error($e);
        return redirect()->back()->with([
            'success' => false,
            'message' => 'Terjadi kesalahan saat menghubungi server.'
        ]);
    }
}

function getSetting(){
    try {
        $apiUrl = config('app.backend_endpoint');
        $setting = Http::get($apiUrl.'/setting/get-setting');
        $jsonsetting = $setting->json();

        return $jsonsetting['data'];
    } catch (\Exception $e) {
        \Log::error($e);
        return redirect()->back()->with([
            'success' => false,
            'message' => 'Terjadi kesalahan saat menghubungi server.'
        ]);
    }
}

function convertPhoneToInternational($phone) {
    if (substr($phone, 0, 1) === '0') {
        return '62' . substr($phone, 1);
    }
    return $phone;
}
