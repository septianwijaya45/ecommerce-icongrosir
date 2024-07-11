<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductDetailController extends Controller
{
    protected $apiUrl, $photoUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.backend_endpoint');
        $this->photoUrl = config('app.photo_product');
    }

    public function getRelatedProduct($id){
        $getRelatedProduct = Http::get($this->apiUrl.'/home/product/get-eight-product-by-categories/'.$id);
        $jsonGetRelatedProduct = $getRelatedProduct->json();
        $getProduct = $jsonGetRelatedProduct["data"];

        return $getProduct;
    }

    public function getProductById($id){
        $getProductById = Http::get($this->apiUrl.'/home/product/get-product-by-id/'.$id);
        $productById    = $getProductById->json();
        $product        = $productById['product'];
        $productDetail  = $productById['productDetail'];
        $productSize    = $productById['productSize'];
        $category       = $productById['category'];
        $productReviews = $productById['productReviews'];
        $photo = $product['photos'];
        
        $relatedProduct = $this->getRelatedProduct($category['category']);

        return view('product.detail-product', [
            'photoUrl'          => $this->photoUrl,
            'product'           => $product,
            'productDetail'     => $productDetail,
            'productSize'       => $productSize,
            'category'          => $category,
            'productReviews'    => $productReviews,
            'photo'             => $photo,
            'relatedProduct'    => $relatedProduct
        ]);
    }
}
