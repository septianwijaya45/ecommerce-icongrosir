<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    protected $apiUrl, $token, $banner;

    public function __construct()
    {
        $this->apiUrl = config('app.backend_endpoint');
        $this->banner = config('app.banner_app');
    }

    public function index(Request $request){
        $token = getToken($request);
        $getBanners = Http::get($this->apiUrl.'/home/banner-app/get-data/');

        return view('contact-us.index', [
            'banners'        => $getBanners['data'],
            'urlBanner'     => $this->banner,
            'token'         => $token
        ]);
    }
}
