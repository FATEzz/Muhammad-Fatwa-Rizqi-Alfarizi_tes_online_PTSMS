<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Nama Anda',
            'email' => 'fatwaal28@gmail.com', // Ubah ke email Anda
            'password' => Hash::make('20010124'), // Password TTTTBBHH di-hash
            'tanggal_lahir' => '2001-01-24', // Tanggal lahir YYYY-MM-DD
        ]);
    }
}
