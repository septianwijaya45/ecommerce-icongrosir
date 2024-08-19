<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductAllController extends Controller
{
    protected $apiUrl, $photoUrl, $banner;

    public function __construct(Request $request)
    {
        $this->apiUrl = config('app.backend_endpoint');
        $this->photoUrl = config('app.photo_product');
        $this->banner = config('app.banner_app');
    }

    public function index(Request $request){
        $apiCategory = Http::get($this->apiUrl.'/home/category/get-data');
        $getCategory = $apiCategory->json();

        $getBanners = Http::get($this->apiUrl.'/home/banner-app/get-data/');

        return view('product.index', [
            'categories'    => $getCategory['data'],
            'apiUrl'        => $this->apiUrl,
            'photoUrl'      => $this->photoUrl,
            'banners'       => $getBanners['data'],
            'urlBanner'     => $this->banner,
            'token'         => getToken($request)
        ]);
    }
}
