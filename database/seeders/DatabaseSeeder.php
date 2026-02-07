<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Table;
use App\Models\Food;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

User::create([
            'name' => 'hanif waiter',
            'email' => 'hanifwaiter@mail.com',
            'password' => Hash::make('password'),
            'role' => 'pelayan',
        ]);

        User::create([
            'name' => 'hanif kasir',
            'email' => 'hanifkasir@mail.com',
            'password' => Hash::make('password'),
            'role' => 'kasir',
        ]);

        for ($i = 1; $i <= 15; $i++) {
            Table::create([
                'number' => 'Table ' . $i,
                'status' => 'available',
            ]);
        }

        $foodItems = [
            ['name' => 'bakso', 'price' => 15000, 'stock' => 100],
            ['name' => 'nasi goreng', 'price' => 14000, 'stock' => 100],
            ['name' => 'sate', 'price' => 25000, 'stock' => 100],
            ['name' => 'soto', 'price' => 20000, 'stock' => 100],
        ];

        foreach ($foodItems as $item) {
            Food::create($item);
        }
    }
}
