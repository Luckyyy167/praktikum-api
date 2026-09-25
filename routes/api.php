<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Item;
use App\Models\Dosen;
use App\Http\Controllers\Api\DosenController;

Route::apiResource('dosen', DosenController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// disini http method get, menampikan hello world
// dengan parameter name, by default adalah Ahmad
Route::get('/hello-world', function() {
    $name = request()->get('name') ?? 'Admin Gudang'; 

    return response()->json([
        'message' => "Hello World, {$name}"
    ]);
});

// Get untuk menampilkan data stok gudang
Route::get('/items', function() {
    $items = Item::latest()->get();

    return response()->json([
        'status' => 'success',
        'message' => 'Berhasil mengambil semua data barang gudang',
        'total' => $items->count(),
        'data' => $items
    ], 200);
});

//Post untuk menambahkan data stok gudang
Route::post('/items', function (Request $request) {
    $validated = $request->validate([
        'item_code'     => 'required|string|unique:items,item_code',
        'name'          => 'required|string|max:255',
        'category'      => 'required|string|max:100',
        'quantity'      => 'required|integer|min:0',
        'minimum_stock' => 'required|integer|min:0',
    ]);

    $item = Item::create($validated);

    return response()->json([
        'status'  => 'success',
        'message' => 'Barang baru berhasil ditambahkan ke gudang',
        'data'    => $item
    ], 201);
});

//Get: Menampilkan detail barang menggunakan id
Route::get('/item/{id}', function ($id) {
    $item = Item::find($id);

    if (!$item) {
        return response()->json([
            'status'  => 'error',
            'message' => 'Barang tidak ditemukan di gudang'
        ], 404);
    }

    return response()->json([
        'status'  => 'success',
        'message' => 'Berhasil mengambil detail data barang',
        'data'    => $item
    ], 200);
});

//PUT: Update data barang menggunakan id
Route::put('/item/{id}', function (Request $request, $id) {
    $item = Item::find($id);

    if (!$item) {
        return response()->json([
            'status'  => 'error',
            'message' => 'Barang tidak ditemukan di gudang'
        ], 404);
    }

    $validated = $request->validate([
        'item_code'     => 'sometimes|required|string|unique:items,item_code,' . $id,
        'name'          => 'sometimes|required|string|max:255',
        'category'      => 'sometimes|required|string|max:100',
        'quantity'      => 'sometimes|required|integer|min:0',
        'minimum_stock' => 'sometimes|required|integer|min:0',
    ]);

    $item->update($validated);

    return response()->json([
        'status'  => 'success',
        'message' => 'Data/stok barang berhasil diperbarui',
        'data'    => $item
    ], 200);
});

//DELETE: Menghapus data barang menggunakan id
Route::delete('/item/{id}', function ($id) {
    $item = Item::find($id);

    if (!$item) {
        return response()->json([
            'status'  => 'error',
            'message' => 'Barang tidak ditemukan di gudang'
        ], 404);
    }

    $item->delete();

    return response()->json([
        'status'  => 'success',
        'message' => 'Barang berhasil dihapus dari sistem gudang'
    ], 200);
});




