<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ProductController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [WebsiteController::class, 'index'])->name('website');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {


    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/add-product', [ProductController::class, 'index'])->name('add.product');
    Route::post('/create-product', [ProductController::class, 'create'])->name('create.product');
    Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('edit.product');
    Route::post('/update-product/{id}', [ProductController::class, 'update'])->name('update.product');
    Route::get('/update-product/{id}', [ProductController::class, 'delete'])->name('delete.product');
    Route::get('/manage-product', [ProductController::class, 'manage'])->name('manage.product');

});
