<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\FundingController;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/menu', function (Request $request) {
    return response()->json(['Home', 'Profile', 'About', 'Contact Us']);
});

//buat route menuju url/donatur
//buat response berupa data json seperti berikut

Route::get('/donatur', function (Request $request) {
    return response()->json(
        [
            ['id' => 1, 'nama' => 'Donatur 1'],
            ['id' => 2, 'nama' => 'Donatur 2'],
            ['id' => 3, 'nama' => 'Donatur 3'],
        ]
    );
});


Route::group(['middleware' => 'auth:sanctum'], function () {
    //API CRUD Funding
    Route::get('/funding', [FundingController::class, 'index']); //get all data
    Route::post('/funding', [FundingController::class, 'store']); //create new data
    Route::get('/funding{id}', [FundingController::class, 'show']); //create new data
    Route::put('/funding{id}', [FundingController::class, 'update']); //create new data
    Route::delete('/funding{id}', [FundingController::class, 'destroy']); //create new data

    // API CRUD DONATION
    Route::get('/donation', [DonationController::class, 'index']);
    Route::apiResource('donation', DonationController::class);


    Route::get('/logout', [AuthController::class, 'logout']);
});


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);