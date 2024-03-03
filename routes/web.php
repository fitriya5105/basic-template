<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ChefController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/home2', function () {
    return view('home2');
});     
Route::get('/about', function () {
    return view('about');
});     
Route::get('/coffees', function () {
    return view('coffees');
});     
Route::get('/contact', function () {
    return view('contact');
});     

Route::resource('siswa',siswaController::class);
// menu
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::delete('/menu/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');
Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create');
Route::post('/menu', [MenuController::class, 'store'])->name('menu.store');
Route::get('/menu/{id}/edit', [MenuController::class, 'edit'])->name('menu.edit');
Route::put('/menu/{id}', [MenuController::class, 'update']) ->name('menu.update');
Route::get('/menu/{id}', [MenuController::class, 'show'])->name('menu.show');
Route::get('/more/{id}', [MenuController::class, 'more'])->name('menu.more');

// chef
Route::get('/chef', [ChefController::class, 'index'])->name('chef.index');
Route::delete('/chef/{id}', [ChefController::class, 'destroy'])->name('chef.destroy');
Route::get('/chef/create', [ChefController::class, 'create'])->name('chef.create');
Route::post('/chef', [ChefController::class, 'store'])->name('chef.store');
Route::get('/chef/{id}/edit', [ChefController::class, 'edit'])->name('chef.edit');
Route::put('/chef/{id}', [ChefController::class, 'update']) ->name('chef.update');
Route::get('/chef/{id}', [ChefController::class, 'show'])->name('chef.show');
Route::get('/more/{id}', [ChefController::class, 'more'])->name('chef.more');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/contact', [ReservationController::class, 'index']);
Route::post('/contact', [ReservationController::class, 'store']);
