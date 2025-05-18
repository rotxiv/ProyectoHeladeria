<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'empleado_id' => 1,
            'name' => 'Victor',
            'email' => 'victor@example.com',
            'password'=> bcrypt('password123'),
            'visible' => true,
        ]);

        $user->roles()->attach(1, ['fecha_asignacion' => now()]);
    }
}
