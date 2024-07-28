<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductAllController extends Controller
{
    protected $apiUrl, $photoUrl;

    public function __construct(Request $request)
    {
        $this->apiUrl = config('app.backend_endpoint');
        $this->photoUrl = config('app.photo_product');
    }
    
    public function index(Request $request){
        $apiCategory = Http::get($this->apiUrl.'/home/category/get-data');
        $getCategory = $apiCategory->json();

        return view('product.index', [
            'categories'    => $getCategory['data'],
            'apiUrl'        => $this->apiUrl,
            'photoUrl'      => $this->photoUrl,
            'token'         => getToken($request)
        ]);
    }
}
