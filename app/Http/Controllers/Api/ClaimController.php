<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use App\Models\Cloth;
use App\Http\Resources\ClaimResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClaimController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'cloth_id' => 'required|exists:clothes,id',
            'user_id' => 'required|exists:users,id'
        ]);

        return DB::transaction(function () use ($request) {
            
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();

            $totalClaimsThisMonth = Claim::where('user_id', $request->user_id)
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->whereIn('status', ['pending', 'disetujui'])
                ->lockForUpdate() 
                ->count();

            if ($totalClaimsThisMonth >= 2) {
                return response()->json([
                    'message' => 'Batas kuota habis! Kamu hanya boleh mengklaim maksimal 2 pakaian per bulan untuk mencegah penimbunan.'
                ], 403);
            }

            $cloth = Cloth::where('id', $request->cloth_id)->lockForUpdate()->first();
            
            if ($cloth->status !== 'tersedia') {
                return response()->json([
                    'message' => 'Maaf, pakaian ini sudah dipesan atau didonasikan kepada orang lain.'
                ], 400);
            }

            $claim = Claim::create([
                'user_id' => $request->user_id,
                'cloth_id' => $request->cloth_id,
                'status' => 'pending'
            ]);

            $cloth->update(['status' => 'minta_klaim']);

            return (new ClaimResource($claim, 'Permintaan klaim berhasil diajukan! Menunggu persetujuan donatur.'))
                ->response()
                ->setStatusCode(201);
        });
    }
}