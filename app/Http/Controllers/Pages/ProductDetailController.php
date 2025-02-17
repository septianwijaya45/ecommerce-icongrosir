<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Session\SessionManager;

class ProductDetailController extends Controller
{
    protected $apiUrl, $photoUrl, $token;

    public function __construct(SessionManager $session)
    {
        $this->apiUrl = config('app.backend_endpoint');
        $this->photoUrl = config('app.photo_product');
        $this->videoUrl = config('app.video_product');
        $this->banner = config('app.banner_app');
    }

    public function getRelatedProduct($id){
        $getRelatedProduct = Http::get($this->apiUrl.'/home/product/get-eight-product-by-categories/'.$id);
        $jsonGetRelatedProduct = $getRelatedProduct->json();
        $getProduct = $jsonGetRelatedProduct["data"];

        return $getProduct;
    }

    public function getProductById(Request $request, $id){
        $getProductById = Http::get($this->apiUrl.'/home/product/get-product-by-id/'.$id);
        $productById    = $getProductById->json();
        $product        = $productById['product'];
        $productDetail  = $productById['productDetail'];
        $category       = $productById['category'];
        $productReviews = $productById['productReviews'];
        $variants       = $productById['variants'];
        $photo          = $product['photos'];

        $relatedProduct = $this->getRelatedProduct($category['category']);
        $getBanners = Http::get($this->apiUrl.'/home/banner-app/get-data/');

        return view('product.detail-product', [
            'photoUrl'          => $this->photoUrl,
            'videoUrl'          => $this->videoUrl,
            'product'           => $product,
            'productDetail'     => $productDetail,
            'category'          => $category,
            'productReviews'    => $productReviews,
            'photo'             => $photo,
            'relatedProduct'    => $relatedProduct,
            'variants'          => $variants,
            'product_id'        => $id,
            'token'             => getToken($request),
            'banners'           => $getBanners['data'],
            'urlBanner'         => $this->banner,
        ]);
    }

    public function getProductDetailVariant(Request $request, $productId){
        $getProductById = Http::get($this->apiUrl.'/home/product/get-product-by-id/'.$productId);
        $productById    = $getProductById->json();
        $variants       = $productById['variants'];

        return response()->json([
            'variants'          => $variants
        ]);
    }
}
