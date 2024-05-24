<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function register(Request $request){
        return response()->json([
            'status' => true,
            'message' => 'Register API working fine.'
        ], 200);
    }

    public function login(Request $request){
        return response()->json([
            'status' => true,
            'message' => 'Login API working fine.'
        ], 200);
    }
}
