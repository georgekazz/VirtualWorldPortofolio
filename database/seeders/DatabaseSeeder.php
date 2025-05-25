<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Giorgos Kazlaris',
            'email' => 'grkazz98@gmail.com',
            'password' => Hash::make('giorgos123'),
        ]);

        Admin::create([
            'name' => 'Euclid Keramopoulos',
            'email' => 'euclid@ihu.gr',
            'password' => Hash::make('euclid123'),
        ]);
    }
}
