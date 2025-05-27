<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Persona;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Persona::create([
            'carnet' => '8880123',
            'nombre' => 'Victor Hugo Mamani Copa',
            'telefono' => '60033810'
        ]);

        /* Persona::create([
            'carnet' => '1881267',
            'nombre' => 'Yolanda Copa Hernandez',
            'telefono' => '62132050',
        ]); */
    }
}
