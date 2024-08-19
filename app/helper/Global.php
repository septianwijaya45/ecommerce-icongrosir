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
