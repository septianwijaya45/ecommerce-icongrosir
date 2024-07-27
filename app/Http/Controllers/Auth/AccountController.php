<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AccountController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.backend_endpoint');
    }

    public function index(Request $request){
        $token = getToken($request);

        if(!$token){
            $request->session()->forget('token');
            return redirect()->route('home')->with('error', 'Session Anda Telah berakhir!');
        }

        $getAccountMe = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($this->apiUrl.'/account-me/my-account');

        $account = $getAccountMe->json();
        
        return view('account.index', [
            'user'  => $account['user'],
            'detail'  => $account['detail'],
            'token' => $token
        ]);
    }

    public function update(Request $request){
        try {
            $token = getToken($request);

            if(!$token){
                $request->session()->forget('token');
                return redirect()->route('home')->with('error', 'Session Anda Telah berakhir!');
            }

            $data = [
                'name'          => $request->name,
                'email'         => $request->email,
                'no_telepon'    => $request->no_telepon,
                'jenis_kelamin' => $request->jenis_kelamin,
                'kota'          => $request->kota,
                'kode_pos'      => $request->kode_pos,
                'alamat'        => $request->alamat
            ];

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post($this->apiUrl.'/account-me/my-account/update/'.$request->account_id, $data);

            $resultResponse = $response->json();


            if ($response->successful()) {
                $getData = $response->json();
                \Log::info($data);
                return redirect()->back()->with([
                    'success' => 'Success to update your data!',
                    'user'  => $getData['user'],
                    'detail'  => $getData['detail'],
                    'token' => $token
                ]);
            } else {
                $error = $response->json();
                return redirect()->back()->with('error', 'Failed to update your data.');
            }
        }  catch (\Exception $e) {
            return redirect()->back()->with([
                'success' => false,
                'error' => 'Terjadi kesalahan saat menghubungi server.'
            ]);
        }
    }
}
