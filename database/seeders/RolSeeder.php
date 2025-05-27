<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rol::create([
            'nombre' => 'Administrador',
            'descripcion' => 'Acceso total al sistema.',
            'permisos' => json_encode([
                'crear_usuario' => true,
                'editar_usuario' => true,
                'eliminar_usuario' => true,
                'ver_reportes' => true
            ])
        ]);

        Rol::create([
            'nombre' => 'Gerente',
            'descripcion' => 'Acceso a administrar Personas, Usuarios y Roles.',
            'permisos' => json_encode([
                'crear_usuario' => true,
                'editar_usuario' => true,
                'eliminar_usuario' => true,
                'ver_reportes' => true
            ])
        ]);

        Rol::create([
            'nombre' => 'EncargadoCocina',
            'descripcion' => 'Acceso al sector de cocicna.',
            'permisos' => json_encode([
                'crear_usuario' => false,
                'editar_usuario' => false,
                'eliminar_usuario' => false,
                'ver_reportes' => true
            ])
        ]);

        Rol::create([
            'nombre' => 'Camarero',
            'descripcion' => 'Acceso al menú del dia, registrar ordenes de los clientes.',
            'permisos' => json_encode([
                'crear_usuario' => false,
                'editar_usuario' => false,
                'eliminar_usuario' => false,
                'ver_reportes' => false
            ])
        ]);
    }
}
