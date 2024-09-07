<?php

use Illuminate\Support\Facades\Route;
use App\Models\Area;
use App\Models\Role; 

use App\Http\Controllers\EmpleadoController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::post('/empleado/crear', [EmpleadoController::class, 'store'])->name('empleado.store');

Route::get('/empleados', [EmpleadoController::class, 'index'])->name('empleados.index');

Route::get('/empleados/{id}/edit', [EmpleadoController::class, 'edit'])->name('empleado.edit');
Route::put('/empleados/{id}', [EmpleadoController::class, 'update'])->name('empleado.update');
Route::delete('/empleado/{id}', [EmpleadoController::class, 'destroy'])->name('empleado.destroy');



// Route::post('/', [EmpleadoController::class, 'create'])->name('empleado.create');



Route::get('/', function () {
    $areas = Area::all();
    $roles = Role::all();
    return view('welcome', compact('areas','roles'));
})->name('empleado.create');
