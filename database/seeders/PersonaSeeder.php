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
            'carnet' => '8880196',
            'nombre' => 'Victor Hugo Mamani Copa',
            'telefono' => '69118575',
        ]);

        Persona::create([
            'carnet' => '8880068',
            'nombre' => 'Yolanda Mamani Copa',
            'telefono' => '69162056',
        ]);
    }
}
