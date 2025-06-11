<?php

use App\Http\Controllers\ProfileController; // Asegúrate de que esta línea esté presente
use App\Http\Controllers\UserController; // Asegúrate de que esta línea esté presente
use Illuminate\Support\Facades\Route;

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

// Default welcome page route
Route::get('/', function () {
    return view('welcome');
});

// Laravel Breeze authentication routes - CRUCIAL for login/register
// Este archivo 'auth.php' define rutas como /login, /register, /forgot-password, etc.
require __DIR__.'/auth.php';

// --- RUTAS ACCESIBLES PARA CUALQUIER USUARIO AUTENTICADO ---
// Estas rutas requieren que el usuario esté logueado.
// NOTA: 'verified' se puede añadir si requieres que el email del usuario esté verificado.
Route::middleware('auth')->group(function () {
    // Ruta del Dashboard - accesible para CUALQUIER usuario logueado
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rutas del Perfil de Usuario (Editar, Actualizar, Eliminar Perfil)
    // Estas son las rutas que causaban el error 'profile.edit not defined'
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- GRUPO DE RUTAS PROTEGIDAS PARA ADMINISTRADORES ---
// Estas rutas solo son accesibles por:
// 1. Usuarios autenticados (middleware 'auth')
// 2. Usuarios con el rol 'administrador' (middleware 'admin')
Route::middleware(['auth', 'admin'])->group(function () {
    // Rutas de Recurso para la gestión de Usuarios (CRUD)
    Route::resource('usuarios', UserController::class); // Esta ruta corresponde al Ladrillo 10.

    // Puedes añadir más rutas que solo los administradores puedan acceder aquí
    // Ejemplo:
    // Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
});

// Puedes añadir otras rutas no protegidas aquí si es necesario