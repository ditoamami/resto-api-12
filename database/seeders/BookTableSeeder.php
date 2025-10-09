<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BookTable;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tables = [
            [
                'name' => 'A1',
                'status' => 'available',
                'capacity' => 4,
                'floor' => '1',
            ],
            [
                'name' => 'A2',
                'status' => 'occupied',
                'capacity' => 2,
                'floor' => '1',
            ],
            [
                'name' => 'B1',
                'status' => 'reserved',
                'capacity' => 6,
                'floor' => '2',
            ],
            [
                'name' => 'B2',
                'status' => 'inactive',
                'capacity' => 4,
                'floor' => '2',
            ],
            [
                'name' => 'VIP-1',
                'status' => 'available',
                'capacity' => 8,
                'floor' => 'VIP',
            ],
        ];

        foreach ($tables as $table) {
            BookTable::updateOrCreate(['name' => $table['name']], $table);
        }
    }
}
