<?php

namespace App\Http\Controllers;

use App\Models\Accomodation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        if ($accomodations->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Accomodations not found.',
                'data' => "No data available."
            ], 404);}
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
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'address' => 'required',
            'capacity' => 'required',
            'rooms' => 'required',
            'img_url' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error.',
                'data' => $validator->errors()
            ], 400);
        }
        $accomodationDatabase = Accomodation::where('name', request('name'))->first();
        if ($accomodationDatabase) {
            return response()->json([
                'status' => false,
                'message' => 'Accomodation already exists.',
                'data' => $accomodationDatabase
            ], 409);}
        $accomodation = Accomodation::create(request()->all()); /*INSERT INTO DATABASE*/
        return response()->json([
            'status' => true,
            'message' => 'New accomodation created.',
            'data' => $accomodation
        ], 201);
    }

    public function updateAccomodation(Request $request, $id) {
        $accomodation = Accomodation::find($id);
        if (!$accomodation) {
            return response()->json([
                'status' => false,
                'message' => 'Accomodation with id ' . $id . ' not found.',
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

    public function deleteAccomodation($id) {
        $accomodation = Accomodation::find($id);
        if (!$accomodation) {
            
                return response()->json([
                    'status' => false,
                    'message' => 'Accomodation not found.',
                    'data' => 'Not data'
                ], 404);
    
            }

            $accomodation->update(['disabled' => true]);
            return response()->json([
                'status' => true,
                'message' => 'Accomodation deleted.',
                'data' => $accomodation
            ], 200);
        
        }
    
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