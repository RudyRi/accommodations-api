<?php

namespace App\Http\Controllers;

use App\Models\Accomodation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AccommodationRwquest;

class Accomodations extends Controller
{
    function test() {
        return response()->json([
            'status' => true,
            'message' => 'Api working fine.'
        ], 200);
    }

    public function accomodations() {
        try{
        $accomodations = Accomodation::where('disabled', false)->get();
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error getting accomodations.',
                'data' => $e->getMessage()
            ], 500);
        }
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
        try{
        $accomodation = Accomodation::find($id);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error getting accomodation.',
                'data' => $e->getMessage()
            ], 500);
        }

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
        
        //Tercer metodo
        /*$data = new AccommodationRwquest();
        $data->name = request('name');
        $data->address = request('address');
        $data->capacity = request('capacity');
        $data->rooms = request('rooms');
        $data->img_url = request('img_url');
        $data->price = request('price');
        $data->description = request('description');*/
        //SEGUNDO METODO
        /*$validator = Validator::make(request()->all(), [
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
        }*/
        try{
        $accomodationDatabase = Accomodation::where('name', request('name'))->first();
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error creating accomodation.',
                'data' => $e->getMessage()
            ], 500);
        }
        if ($accomodationDatabase) {
            return response()->json([
                'status' => false,
                'message' => 'Accomodation already exists.',
                'data' => $accomodationDatabase
            ], 409);}
        
        try{
        $accomodation = Accomodation::create(request()->all()); /*INSERT INTO DATABASE*/
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error creating accomodation.',
                'data' => $e->getMessage()
            ], 500);
        }
        return response()->json([
            'status' => true,
            'message' => 'New accomodation created.',
            'data' => $accomodation
        ], 201);
    }

    public function updateAccomodation(Request $request, $id) {
        try{
        $accomodation = Accomodation::find($id);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error updating accomodation.',
                'data' => $e->getMessage()
            ], 500);
        }
        if (!$accomodation) {
            return response()->json([
                'status' => false,
                'message' => 'Accomodation with id ' . $id . ' not found.',
                'data' => 'Not data'
            ], 404);
        }
        try{
        $accomodation->update($request->all());
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error updating accomodation.',
                'data' => $e->getMessage()
            ], 500);
        }
        return response()->json([
            'status' => true,
            'message' => 'Accomodation updated.',
            'data' => $accomodation
        ], 200);
    }

    public function deleteAccomodation($id) {
        try{
        $accomodation = Accomodation::find($id);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error deleting accomodation.',
                'data' => $e->getMessage()
            ], 500);
        }
        if (!$accomodation) {
            
                return response()->json([
                    'status' => false,
                    'message' => 'Accomodation not found.',
                    'data' => 'Not data'
                ], 404);
    
            }
            try{
            $accomodation->update(['disabled' => true]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Error deleting accomodation.',
                    'data' => $e->getMessage()
                ], 500);
            }
            return response()->json([
                'status' => true,
                'message' => 'Accomodation deleted.',
                'data' => $accomodation
            ], 200);
        
        }
    
    function patchAccomodation(Request $request, $id) {
        try{
        $accomodation = Accomodation::find($id);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error updating accomodation.',
                'data' => $e->getMessage()
            ], 500);
        }
        if (!$accomodation) {
            return response()->json([
                'status' => false,
                'message' => 'Accomodation not found.',
                'data' => 'Not data'
            ], 404);
        }
        try{
        $accomodation->update($request->all());
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error updating accomodation.',
                'data' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'Accomodation updated.',
            'data' => $accomodation
        ], 200);
    }
}