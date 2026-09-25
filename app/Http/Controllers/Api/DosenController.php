<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreDosenRequest;
use App\Http\Requests\Api\UpdateDosenRequest;
use App\Http\Resources\Api\DosenResource;
use App\Models\Dosen;

class DosenController extends Controller
{
    // 1. Ambil Semua Data Dosen
    public function index()
    {
        $dosens = Dosen::latest()->paginate(10);

        return response()->json([
            'status'  => 'success',
            'message' => 'Daftar data dosen',
            'data'    => DosenResource::collection($dosens),
            'meta'    => [
                'current_page' => $dosens->currentPage(),
                'last_page'    => $dosens->lastPage(),
                'total'        => $dosens->total(),
            ]
        ], 200);
    }

    // 2. Simpan Data Dosen Baru
    public function store(StoreDosenRequest $request)
    {
        $dosen = Dosen::create($request->validated());

        return response()->json([
            'status'  => 'success',
            'message' => 'Data dosen berhasil ditambahkan',
            'data'    => new DosenResource($dosen)
        ], 201);
    }

    // 3. Ambil Detail Dosen Berdasarkan ID
    public function show($id)
    {
        $dosen = Dosen::find($id);

        if (!$dosen) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data dosen tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Detail data dosen',
            'data'    => new DosenResource($dosen)
        ], 200);
    }

    // 4. Update Data Dosen
    public function update(UpdateDosenRequest $request, $id)
    {
        $dosen = Dosen::find($id);

        if (!$dosen) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data dosen tidak ditemukan'
            ], 404);
        }

        $dosen->update($request->validated());

        return response()->json([
            'status'  => 'success',
            'message' => 'Data dosen berhasil diperbarui',
            'data'    => new DosenResource($dosen)
        ], 200);
    }

    // 5. Hapus Data Dosen
    public function destroy($id)
    {
        $dosen = Dosen::find($id);

        if (!$dosen) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data dosen tidak ditemukan'
            ], 404);
        }

        $dosen->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data dosen berhasil dihapus'
        ], 200);
    }
}