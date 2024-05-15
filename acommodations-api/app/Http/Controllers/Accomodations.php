<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Accomodations extends Controller
{
    function test() {
        return response()->json([
            'status' => true,
            'message' => 'Api working fine.'
        ]);
    }
    //
}
