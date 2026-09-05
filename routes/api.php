<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// disini http method get, menampikan hello world
// dengan parameter name, by default adalah Ahmad
Route::get('/hello-world', function() {
    $name = request()->get('name') ?? 'Ahmad'; 

    return response()->json([
        'message' => "Hello World, {$name}"
    ]);
});

// blogs : untuk menampikan semua data blogs (GET)
// blogs : untuk menambahkan data blog baru (POST)
// blog/{id} : untuk menampilkan data blog berdasarkan id (GET)
// blog/{id} : untuk mengupdate data blog berdasarkan id (PUT)
// blog/{id} : untuk menghapus data blog berdasarkan id (DELETE)
