<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk membuat akun admin default
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'stokadmin@example.com'], // cek apakah sudah ada
            [
                'name' => 'stok',
                'email' => 'stokadmin@example.com',
                'password' => Hash::make('password123'), // password default
                'role' => 'admin', // pastikan kolom role ada di tabel users
            ]
        );
    }
}
