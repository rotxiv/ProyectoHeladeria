<?php

use App\Models\Empleado;
use App\Models\Ingrediente;
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

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ---------------- Autenticación general ----------------
Route::middleware(['auth'])->group(function () {

    Route::middleware('rol:Administrador')->group(function () {
        Route::get('/administrador', fn() => view('administrador.dashboard'))
            ->name('administrador');
    });
    Route::middleware('rol:Recepcionista')->group(function () {
        Route::get('/recepcionista', fn() => view('recepcionista.dashboard'))
            ->name('recepcionista');
    });
    Route::middleware('rol:EncargadoCocina')->group(function () {
        Route::get('/EncargadoCocina', fn() => view('encargadococina.dashboard'))
            ->name('encargado');
    });
    Route::middleware('rol:Camarero')->group(function () {
        Route::get('/Camarero', fn() => view('camarero.dashboard'))
            ->name('camarero');
    });

    /* Rutas a los controladores */
    Route::resource('roles', RolController::class)
        ->middleware(['rol:Administrador']);
    Route::get('roles/panel', [RolController::class, 'panel'])
        ->middleware(['rol:Administrador'])
        ->name('roles.panel');

    Route::resource('usuarios', UserController::class)
        ->middleware(['rol:Administrador']);
    Route::get('usuarios/panel', [UserController::class, 'panel'])
        ->middleware(['rol:Administrador'])
        ->name('usuarios.panel');

    Route::resource('empleados', EmpleadoController::class)
        ->middleware(['rol:Administrador']);
    Route::get('empleados/panel', [EmpleadoController::class, 'panel'])
        ->middleware(['rol:Administrador'])
        ->name('empleados.panel');

    Route::resource('clientes', ClienteController::class)
        ->middleware(['rol:Administrador']);
    Route::get('clientes/panel', [ClienteController::class, 'panel'])
        ->middleware(['rol:Administrador'])
        ->name('clientes.panel');

    Route::resource('productos', ProductoController::class)
        ->middleware(['rol:Administrador,EncargadoCocina']);
    Route::get('productos/panel', [ProductoController::class, 'panel'])
        ->middleware(['rol:Administrador,EncargadoCocina'])
        ->name('productos.panel');

    Route::resource('ingredientes', IngredienteController::class)
        ->middleware(['rol:Administrador,EncargadoCocina']);
    Route::get('ingredientes/panel', [IngredienteController::class, 'panel'])
        ->middleware(['rol:Administrador,EncargadoCocina'])
        ->name('ingredientes.panel');

    Route::resource('tipos', TipoController::class)
        ->middleware(['rol:Administrador,EncargadoCocina']);
    Route::get('tipos/panel', [TipoController::class, 'panel'])
        ->middleware(['rol:Administrador,EncargadoCocina'])
        ->name('tipos.panel');

    Route::resource('sabores', SaborController::class)
        ->middleware(['rol:Administrador,EncargadoCocina']);
    Route::get('sabores/panel', [SaborController::class, 'panel'])
        ->middleware(['rol:Administrador,EncargadoCocina'])
        ->name('sabores.panel');

    Route::resource('unidades', UnidadController::class)
        ->middleware(['rol:Administrador,EncargadoCocina']);
    Route::get('unidades/panel', [UnidadController::class, 'panel'])
        ->middleware(['rol:Administrador,EncargadoCocina'])
        ->name('unidades.panel');


    // ---------------- ADMINISTRADOR ----------------
    //Route::middleware(['rol:Administrador'])->prefix('admin')->name('admin.')->group(function () {
        
       // Route::get('/', fn() => view('admin.dashboard'))
        //    ->name('dashboard');
        
        // Paneles
        //Route::get('empleados/panel', [EmpleadoController::class, 'panel'])
          //  ->name('empleados.panel');

        // Recursos completos del administrador
        //Route::resource('empleados', EmpleadoController::class);

        //Route::resources([
          //  'clientes' => ClienteController::class,
           // 'usuarios' => UserController::class,
          //  'roles' => RolController::class,
          //  'tipos' => TipoController::class,
          //  'sabores' => SaborController::class,
           // 'unidades' => UnidadController::class,
           // 'productos' => ProductoController::class,
           // 'ingredientes' => IngredienteController::class,
        //]);

    //});

    /* // ---------------- ENCARGADO DE COCINA ----------------
    Route::middleware(['rol:Encargado de cocina'])->prefix('cocina')->name('cocina.')->group(function () {

        Route::get('/', fn() => view('cocina.dashboard'))
            ->name('dashboard');

        // Recursos permitidos
        Route::resource('productos', ProductoController::class)
            ->only(['index', 'create', 'store', 'edit', 'update', 'show']
        );
        Route::resource('sabores', SaborController::class)
            ->only(['index', 'create', 'store', 'edit', 'update', 'show']
        );
        Route::resource('ingredientes', IngredienteController::class)
            ->only(['index', 'create', 'store', 'edit', 'update', 'show']
        );
        Route::resource('tipos', TipoController::class)
            ->only(['index', 'create', 'store', 'edit', 'update', 'show']
        );
        Route::resource('unidades', UnidadController::class)
            ->only(['index', 'create', 'store', 'edit', 'update', 'show']
        );
    }); */

});

/* Route::get('/camarero', function () {
    return view('camarero.dashboard');
})->middleware(['auth', 'rol:Camarero'])->name('camarero'); */




