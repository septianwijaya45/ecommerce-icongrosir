<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.backend_endpoint');
    }

    public function getFiveCategories(Request $request){
        try {
            $getFiveCategory = Http::get($this->apiUrl.'/home/category/get-five-categories');
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

    public function getThreeCategories(Request $request){
        try {
            $getThreeCategory = Http::get($this->apiUrl.'/home/category/get-five-categories');
            $jsonGetThreeCategory = $getThreeCategory->json();
            $getThreeCategories = $jsonGetThreeCategory["data"];

            return response()->json($getThreeCategories);
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()->with([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghubungi server.'
            ]);
        }
    }
}
