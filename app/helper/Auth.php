<?php
use Illuminate\Http\Request;

function getToken(Request $request = null)
{
    $token = $request->session()->get('token');
    return $token;
}