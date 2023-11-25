<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FoodsController;

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


Route::get('/myname', function() {
    return 'Rizky Perdana Nst';
});

Route::get('/about', ['App\Http\Controllers\ContohController', 'index']);

Route::get('/example', ['App\Http\Controllers\ExampleController', 'rizky']);
Route::get('/example', ['App\Http\Controllers\ExampleController', 'joko']);

// Route Login
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

Route::middleware(['auth'])->group(function() {
    Route::prefix('/admin')->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

        Route::get('/foods', [FoodsController::class, 'index'])->name('foods.index');
        Route::get('/foods/create', [FoodsController::class, 'create'])->name('foods.create');
        Route::post('/foods/store', [FoodsController::class, 'store'])->name('foods.store');
        Route::get('/foods/edit/{id}', [FoodsController::class, 'edit'])->name('foods.edit');
        Route::post('/foods/update/{id}', [FoodsController::class, 'update'])->name('foods.update');
        Route::post('/foods/delete/{id}', [FoodsController::class, 'destroy'])->name('foods.destroy');
    });
});
