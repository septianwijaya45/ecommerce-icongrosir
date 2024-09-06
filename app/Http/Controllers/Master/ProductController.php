<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Session\SessionManager;

class ProductController extends Controller
{
    protected $apiUrl;
    protected $token;

    public function __construct(SessionManager $session)
    {
        $this->apiUrl = config('app.backend_endpoint');
        $this->token = $session->get('token');
    }

    public function getEightProductByCategories(Request $request, $categoryId){
        try {
            $token = getToken($request);
            $getFiveCategory = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get($this->apiUrl.'/home/product/get-eight-product-by-categories/'.$categoryId);

            $jsonGetFiveCategory = $getFiveCategory->json();
            
            $getFiveCategories = $jsonGetFiveCategory["data"];

            return response()->json($getFiveCategories);
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()->with([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghubungi server.'
            ]);
        }
    }

    public function getProductPopular(Request $request){
        try {
            $url = Http::get($this->apiUrl.'/home/product/get-product-popular/');
            $response = $url->json();
            $getData = $response["data"];

            return response()->json($getData);
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()->with([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghubungi server.'
            ]);
        }
    }

    public function getProductFeatured(Request $request){
        try {
            $url = Http::get($this->apiUrl.'/home/product/get-product-featured/');
            $response = $url->json();
            $getData = $response["data"];

            return response()->json($getData);
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()->with([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghubungi server.'
            ]);
        }
    }

    public function getProductLatest(Request $request){
        try {
            $url = Http::get($this->apiUrl.'/home/product/get-product-latest/');
            $response = $url->json();
            $getData = $response["data"];

            return response()->json($getData);
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()->with([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghubungi server.'
            ]);
        }
    }
}
