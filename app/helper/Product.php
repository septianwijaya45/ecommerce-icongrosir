<?php 
use Illuminate\Support\Facades\Http;


function getVariant($product_id){
    $apiUrl = config('app.backend_endpoint');
    $response = Http::get($apiUrl.'/home/product/get-varian/'.$product_id);

    return $response->json();
}

function getWarna($product_id, $variant_id, $wishlist){
    $apiUrl = config('app.backend_endpoint');
    $response = Http::get($apiUrl.'/home/product/get-warna/'.$product_id.'/'.$variant_id.'/'.$wishlist);

    return $response->json(); 
}

function getUkuran($product_id, $variant_id, $warna, $wishlist){
    $apiUrl = config('app.backend_endpoint');
    $response = Http::get($apiUrl.'/home/product/get-ukuran/'.$product_id.'/'.$variant_id.'/'.$warna.'/'.$wishlist);

    return $response->json();  
}

function getHarga($product_id, $variant_id, $warna, $ukuran, $wishlist){
    $apiUrl = config('app.backend_endpoint');
    $response = Http::get($apiUrl.'/home/product/get-harga/'.$product_id.'/'.$variant_id.'/'.$warna.'/'.$ukuran.'/'.$wishlist);

    return $response->json();  
}


function getVariantCart($token, $product_id){
    $apiUrl = config('app.backend_endpoint');
    $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                ])->get($apiUrl.'/transaction/cart/get-varian/'.$product_id);

    return $response->json();
}

function getWarnaCart($token, $product_id, $variant_id, $wishlist){
    $apiUrl = config('app.backend_endpoint');
    $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                ])->get($apiUrl.'/transaction/cart/get-warna/'.$product_id.'/'.$variant_id.'/'.$wishlist);

    return $response->json(); 
}

function getUkuranCart($token, $product_id, $variant_id, $warna, $wishlist){
    $apiUrl = config('app.backend_endpoint');
    $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                ])->get($apiUrl.'/transaction/cart/get-ukuran/'.$product_id.'/'.$variant_id.'/'.$warna.'/'.$wishlist);

    return $response->json();  
}

function getHargaCart($token, $product_id, $variant_id, $warna, $ukuran, $wishlist){
    $apiUrl = config('app.backend_endpoint');
    $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                ])->get($apiUrl.'/transaction/cart/get-harga/'.$product_id.'/'.$variant_id.'/'.$warna.'/'.$ukuran.'/'.$wishlist);

    return $response->json();  
}

?>