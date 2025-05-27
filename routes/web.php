<?php

use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Ingrediente;
use App\Models\Tipo;
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

/* Pagina de inicio */
Route::get('/', function () {
    return view('principal');
})->name('principal');

/* Pagina de inicio y cierre de sesión */
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ---------------- Autenticación general ----------------
Route::middleware(['auth'])->group(function () {

    Route::middleware(['rol:Administrador'])->prefix('administrador')->name('administrador.')->group(function () {
        
        /* Panel principal del administrador */
        Route::get('/', fn() => view('administrador.dashboard'))->name('dashboard');
        
        /* Paneles para cada controlador */
        Route::get('empleados/panel', [EmpleadoController::class, 'panel'])->name('empleados.panel');
        Route::get('clientes/panel', [ClienteController::class, 'panel'])->name('clientes.panel');
        Route::get('usuarios/panel', [UserController::class, 'panel'])->name('usuarios.panel');
        Route::get('roles/panel', [RolController::class, 'panel'])->name('roles.panel');
        Route::get('productos/panel', [ProductoController::class, 'panel'])->name('productos.panel');
        Route::get('ingredientes/panel', [IngredienteController::class, 'panel'])->name('ingredientes.panel');
        Route::get('tipos/panel', [TipoController::class, 'panel'])->name('tipos.panel');
        Route::get('sabores/panel', [SaborController::class, 'panel'])->name('sabores.panel');
        Route::get('unidades/panel', [UnidadController::class, 'panel'])->name('unidades.panel');

        Route::resource('empleados', EmpleadoController::class);
        Route::resource('clientes', ClienteController::class);
        Route::resource('usuarios', UserController::class);
        Route::resource('roles', RolController::class);
        Route::resource('productos', ProductoController::class);
        Route::resource('ingredientes', IngredienteController::class);
        Route::resource('tipos', TipoController::class);
        Route::resource('sabores', SaborController::class);
        Route::resource('unidades', UnidadController::class);
    });

    Route::middleware(['rol:Gerente'])->prefix('gerente')->name('gerente.')->group(function () {
        
        /* Panel principal del Gerente */
        Route::get('/', fn() => view('gerente.dashboard'))->name('dashboard');
        
        /* Paneles para cada controlador */
        Route::get('empleados/panel', [EmpleadoController::class, 'panel'])->name('empleados.panel');
        Route::get('clientes/panel', [ClienteController::class, 'panel'])->name('clientes.panel');
        Route::get('usuarios/panel', [UserController::class, 'panel'])->name('usuarios.panel');
        Route::get('roles/panel', [RolController::class, 'panel'])->name('roles.panel');

        Route::resource('empleados', EmpleadoController::class);
        Route::resource('clientes', ClienteController::class);
        Route::resource('usuarios', UserController::class);
        Route::resource('roles', RolController::class);
    });

    /* Panel principal del encargado de cocina */
    Route::middleware(['rol:EncargadoCocina'])->prefix('encargado-cocina')->name('encargado-cocina.')->group(function () {
        
        /* Panel principal del encargado de cocina */
        Route::get('/', fn() => view('encargadococina.dashboard'))->name('dashboard');
        
        /* Paneles para cada controlador */
        Route::get('productos/panel', [ProductoController::class, 'panel'])->name('productos.panel');
        Route::get('ingredientes/panel', [IngredienteController::class, 'panel'])->name('ingredientes.panel');
        Route::get('tipos/panel', [TipoController::class, 'panel'])->name('tipos.panel');
        Route::get('sabores/panel', [SaborController::class, 'panel'])->name('sabores.panel');
        Route::get('unidades/panel', [UnidadController::class, 'panel'])->name('unidades.panel');

        Route::resource('productos', ProductoController::class);
        Route::resource('ingredientes', IngredienteController::class);
        Route::resource('tipos', TipoController::class);
        Route::resource('sabores', SaborController::class);
        Route::resource('unidades', UnidadController::class);
    });
});
    /* Route::middleware('rol:Administrador')->group(function () {
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
/*     Route::resource('roles', RolController::class)
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
 */
 
    // ---------------- ADMINISTRADOR ----------------
    

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

//});

/* Route::get('/camarero', function () {
    return view('camarero.dashboard');
})->middleware(['auth', 'rol:Camarero'])->name('camarero'); */




