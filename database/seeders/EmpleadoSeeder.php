<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empleado;
use App\Models\Persona;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verifica que existan personas antes de asignarlas a empleados
        $persona1 = Persona::firstOrCreate([
            'carnet' => '8081190',
            'nombre' => 'Raul Hugo Lopez Copa',
            'telefono' => '60000575',
        ]);
        
        Empleado::create([
            'persona_id' => $persona1->id,
            'direccion' => 'Barrio: 34 de Septiembre Este',
            'visible' => true,
        ]);
    }
}
