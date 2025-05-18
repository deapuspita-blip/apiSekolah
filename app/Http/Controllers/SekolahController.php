<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'message' => 'Daftar semua sekolah',
            'data' => Sekolah::all()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:sekolahs',
            'jenis_sekolah' => 'required|string',
            'status_sekolah' => 'required|string',
            'akreditasi' => 'required|string',
            'website' => 'nullable|url',
            'longitude' => 'nullable|numeric',
            'latitude' => 'nullable|numeric',
        ]);

        $sekolah = Sekolah::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Data sekolah berhasil ditambahkan',
            'data' => $sekolah
        ], 201);
    }

    public function show(Sekolah $sekolah)
    {
        return response()->json([
            'status' => true,
            'message' => 'Detail sekolah ditemukan',
            'data' => $sekolah
        ]);
    }

    public function update(Request $request, Sekolah $sekolah)
    {
        $data = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'alamat' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:sekolahs,email,' . $sekolah->id,
            'jenis_sekolah' => 'sometimes|required|string',
            'status_sekolah' => 'sometimes|required|string',
            'akreditasi' => 'sometimes|required|string',
            'website' => 'nullable|url',
            'longitude' => 'nullable|numeric',
            'latitude' => 'nullable|numeric',
        ]);

        $sekolah->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Data sekolah berhasil diperbarui',
            'data' => $sekolah
        ]);
    }

    public function destroy(Sekolah $sekolah)
    {
        $sekolah->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data sekolah berhasil dihapus',
            'data' => null
        ], 200);
    }
}
