<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetDetailProductController extends Controller
{
    public function getWarnaProduct(Request $request, $product_id, $varian, $wishlist){
        try {
            $request = getWarna($product_id, $varian, $wishlist);
            
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
            $request = getUkuran($product_id, $varian, $warna, $wishlist);
            
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
            $request = getHarga($product_id, $varian, $warna, $ukuran, $wishlist);
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
}
