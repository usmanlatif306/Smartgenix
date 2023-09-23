<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Package::create([
            'name' => 'Bronze',
            'price' => '145',
            'setup_fee' => '3.5',
            'specification' => ['Voluptates dolore la', ' Et tenetur ut recusa', 'Nobis est qui modi'],
        ]);

        Package::create([
            'name' => 'Silver',
            'price' => '200',
            'setup_fee' => '8.69',
            'specification' => ['Voluptates dolore la', ' Et tenetur ut recusa', 'Nobis est qui modi'],
        ]);

        Package::create([
            'name' => 'Gold',
            'price' => '346',
            'setup_fee' => '14.32',
            'specification' => ['Voluptates dolore la', ' Et tenetur ut recusa', 'Nobis est qui modi'],
        ]);
    }
}
