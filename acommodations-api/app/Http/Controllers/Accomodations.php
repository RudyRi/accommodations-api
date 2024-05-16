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

    public function accomodations() {
        return response()->json([
            'message' => 'Get all accomodations.'
        ]);
    }

    public function accomodation($id) {
        return response()->json([
            'message' => 'Get accomodation with id ' . $id
        ]);
    }

    public function createAccomodation() {
        return response()->json([
            'message' => 'New accomodation created.'
        ]);
    }

    public function updateAccomodation($id) {
        return response()->json([
            'message' => 'Accomodation with id ' . $id . ' updated.'
        ]);
    }

    public function deleteAccomodation($id) {
        return response()->json([
            'message' => 'Accomodation with id ' . $id . ' deleted.'
        ]);
    }
    //
}
