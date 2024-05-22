<?php

namespace App\Http\Controllers;

use App\Models\Accomodation;
use Illuminate\Http\Request;

class Accomodations extends Controller
{
    function test() {
        return response()->json([
            'status' => true,
            'message' => 'Api working fine.'
        ], 200);
    }

    public function accomodations() {
        $accomodations = Accomodation::where('disabled', false)->get();
            return response()->json([
                'status' => true,
                'message' => 'Get all accomodations succesfully.',
                'data' => $accomodations
            ], 200);
    }

    public function accomodation($id) {
        $accomodation = Accomodation::find($id);

        if($accomodation->disabled) {
            return response()->json([
                'status' => false,
                'message' => 'Accomodation with id' . $id .' not found.',
                'data' => $accomodation
            ], 404);}
        
        if (!$accomodation) {
            return response()->json([
                'status' => false,
                'message' => 'Accomodation with id' . $id .' not found.',
                'data' => $accomodation
            ], 404);
        }
        return response()->json([
            'status' => true,
            'message' => 'Get accomodation with id ' . $id ,
            'data' => $accomodation
        ], 200);
    }

    public function createAccomodation() {
        $accomodationDatabase = Accomodation::where('name', request('name'))->first();
        if ($accomodationDatabase) {
            return response()->json([
                'status' => false,
                'message' => 'Accomodation already exists.',
                'data' => $accomodationDatabase
            ], 404);}
        return response()->json([
            'message' => 'New accomodation created.'
        ], 200);
    }

    public function updateAccomodation($id) {
        $accomodation = Accomodation::find($id);
        if (!$accomodation) {
            return response()->json([
                'status' => false,
                'message' => 'Accomodation with id ' . $id . ' not found.',
                'data' => 'Not data'
            ], 404);
        }
        $accomodation->update(request()->all());
        return response()->json([
            'status' => true,
            'message' => 'Accomodation updated.',
            'data' => $accomodation
        ], 200);
    }

    public function deleteAccomodation($id) {
        $accomodation = Accomodation::find($id);
        if (!$accomodation) {
            
                return response()->json([
                    'status' => false,
                    'message' => 'Accomodation not found.',
                    'data' => 'Not data'
                ], 404);
    }}
    
    function patchAccomodation(Request $request, $id) {
        $accomodation = Accomodation::find($id);
        if (!$accomodation) {
            return response()->json([
                'status' => false,
                'message' => 'Accomodation not found.',
                'data' => 'Not data'
            ], 404);
        }
        $accomodation->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Accomodation updated.',
            'data' => $accomodation
        ], 200);
    }
}