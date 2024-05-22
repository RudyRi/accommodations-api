<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Accomodations;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', [Accomodations::class, 'test']);

Route::get('/accomodation/all', [Accomodations::class, 'accomodations']);

Route::get('/accomodation/{id}', [Accomodations::class, 'accomodation']);

Route::post('/accomodation', [Accomodations::class, 'createAccomodation']);

Route::put('/accomodation/{id}', [Accomodations::class, 'updateAccomodation']);

Route::delete('/accomodation/{id}', [Accomodations::class, 'deleteAccomodation']);

Route::patch('/accomodation/{id}', [Accomodations::class, 'patchAccomodation']);