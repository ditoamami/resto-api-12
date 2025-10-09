<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Andi Pelayan',
                'email' => 'andi@resto.com',
                'role' => 'pelayan',
            ],
            [
                'name' => 'Budi Pelayan',
                'email' => 'budi@resto.com',
                'role' => 'pelayan',
            ],
            [
                'name' => 'Citra Kasir',
                'email' => 'citra@resto.com',
                'role' => 'kasir',
            ],
            [
                'name' => 'Dewi Kasir',
                'email' => 'dewi@resto.com',
                'role' => 'kasir',
            ],
        ];

        foreach ($users as $data) {
            $password = explode('@', $data['email'])[0]; // ambil nama depan dari email
            User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'role' => $data['role'],
                    'password' => Hash::make($password),
                ]
            );
        }
    }
}
