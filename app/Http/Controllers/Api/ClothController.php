<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cloth;
use App\Http\Resources\ClothResource;
use Illuminate\Http\Request;

class ClothController extends Controller
{
    public function index()
    {
        $clothes = Cloth::latest()->get();
        return ClothResource::collection($clothes)
            ->additional(['message' => 'Daftar pakaian berhasil diambil']);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'size' => 'required|in:S,M,L,XL,XXL',
            'gender' => 'required|in:pria,wanita,unisex',
            'status' => 'nullable|in:tersedia,minta_klaim,terdonasi',
        ]);

        $cloth = Cloth::create($validatedData);

        return (new ClothResource($cloth, 'Data pakaian berhasil ditambahkan'))
            ->response()
            ->setStatusCode(201);
    }

    public function show($id)
    {
        $cloth = Cloth::find($id);

        if (!$cloth) {
            return response()->json(['message' => 'Data pakaian tidak ditemukan'], 404);
        }

        return new ClothResource($cloth, 'Detail pakaian berhasil diambil');
    }

    public function update(Request $request, $id)
    {
        $cloth = Cloth::find($id);

        if (!$cloth) {
            return response()->json(['message' => 'Data pakaian tidak ditemukan'], 404);
        }

        $validatedData = $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'size' => 'sometimes|required|in:S,M,L,XL,XXL',
            'gender' => 'sometimes|required|in:pria,wanita,unisex',
            'status' => 'sometimes|required|in:tersedia,minta_klaim,terdonasi',
        ]);

        $cloth->update($validatedData);

        return new ClothResource($cloth, 'Data pakaian berhasil diperbarui');
    }

    public function destroy($id)
    {
        $cloth = Cloth::find($id);

        if (!$cloth) {
            return response()->json(['message' => 'Data pakaian tidak ditemukan'], 404);
        }

        $cloth->delete();

        return response()->json([
            'message' => 'Data pakaian berhasil dihapus',
            'data' => null
        ], 200);
    }
}