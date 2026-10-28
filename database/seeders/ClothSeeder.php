<?php

namespace Database\Seeders;

use App\Models\Cloth;
use App\Models\User;
use Illuminate\Database\Seeder;

class ClothSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'donatur@fitshare.com'],
            ['name' => 'Donatur Fitshare', 'password' => bcrypt('password')]
        );

        Cloth::create([
            'user_id' => $user->id,
            'title' => 'Jaket Parka Outdoor',
            'description' => 'Jaket hangat masih sangat bagus.',
            'size' => 'L',
            'gender' => 'unisex',
            'status' => 'tersedia'
        ]);

        Cloth::create([
            'user_id' => $user->id,
            'title' => 'Kemeja Flanel Merah',
            'description' => 'Kemeja santai bahan katun lembut.',
            'size' => 'M',
            'gender' => 'pria',
            'status' => 'tersedia'
        ]);

        Cloth::create([
            'user_id' => $user->id,
            'title' => 'Gaun Casual Floral',
            'description' => 'Gaun wanita motif bunga warna biru muda.',
            'size' => 'S',
            'gender' => 'wanita',
            'status' => 'tersedia'
        ]);

        Cloth::create([
            'user_id' => $user->id,
            'title' => 'Hoodie Polos Hitam',
            'description' => 'Hoodie oversized hangat.',
            'size' => 'XL',
            'gender' => 'unisex',
            'status' => 'tersedia'
        ]);

        Cloth::create([
            'user_id' => $user->id,
            'title' => 'Celana Chino Cokelat',
            'description' => 'Celana panjang bahan chino nyaman.',
            'size' => 'M',
            'gender' => 'pria',
            'status' => 'tersedia'
        ]);
    }
}