<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Master\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Session\SessionManager;

class HomeController extends Controller
{
    protected $apiUrl, $photoUrl, $banner;

    public function __construct(Request $request)
    {
        $this->apiUrl = config('app.backend_endpoint');
        $this->photoUrl = config('app.photo_product');
        $this->banner = config('app.banner_app');
    }

    public function index(Request $request){
        $categoryController = new CategoryController();
        $fiveCategory = $categoryController->getFiveCategories($request);
        $threeCategory = $categoryController->getTHreeCategories($request);
        $getBanners = Http::get($this->apiUrl.'/home/banner-app/get-data/');

        return view('home.index', [
            'promoBanner'   => $fiveCategory->getData(),
            'threeCategory' => $threeCategory->getData(),
            'urlPhoto'      => $this->photoUrl,
            'urlBanner'     => $this->banner,
            'banners'        => $getBanners['data'],
            'token'         => getToken($request)
        ]);
    }
}
