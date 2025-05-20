<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\SaborController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\IngredienteController;
use App\Http\Controllers\ProductoController;  

Route::get('/', function () {
    return view('principal');
})->name('principal'); // pagina de inicio.

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'rol:Administrador'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn() => view('admin.dashboard'))->name('dashboard');

    // Ruta personalizada para el panel principal de empleados
    Route::get('empleados/panel', [EmpleadoController::class, 'panel'])->name('empleados.panel');

    Route::resource('clientes', ClienteController::class);
    Route::resource('empleados', EmpleadoController::class);
    Route::resource('usuarios', UserController::class);
    Route::resource('roles', RolController::class);

    Route::resource('tipos', TipoController::class);
    Route::resource('sabores', SaborController::class);
    Route::resource('unidades', UnidadController::class);
    Route::resource('ingredientes', IngredienteController::class);
    Route::resource('productos', ProductoController::class);
});




/* Route::middleware(['auth', 'rol:Administrador'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::get('/', fn() => view('admin.dashboard'));

    Route::resource('clientes', ClienteController::class);
    Route::resource('empleados', EmpleadoController::class);
    Route::resource('usuarios', UserController::class);
    Route::resource('roles', RolController::class);
}); */



/* Route::get('/camarero', function () {
    return view('camarero.dashboard');
})->middleware(['auth', 'rol:Camarero'])->name('camarero'); */




