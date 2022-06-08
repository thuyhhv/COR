<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::group(['prefix'=>'user' , 'as' => 'user.'], function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/create', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::post('/edit/{id}', [UserController::class, 'update'])->name('update');
    Route::post('/delete/{id}', [UserController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'products' , 'as' => 'products.'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/create', [ProductController::class, 'create'])
        ->name('create');
        // ->middleware('can:products.create');
    Route::post('/create', [ProductController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
    Route::post('/edit/{id}', [ProductController::class, 'update'])->name('update');
    Route::post('/delete/{id}', [ProductController::class, 'destroy'])->name('delete');
    Route::get('/export', [ProductController::class, 'export'])->name('export');
});

Route::group(['prefix' => 'categories' , 'as' => 'categories.'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/create', [CategoryController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
    Route::post('/edit/{id}', [CategoryController::class, 'update'])->name('update');
    Route::post('/delete/{id}', [CategoryController::class, 'destroy'])->name('delete');
    Route::get('/export', [CategoryController::class, 'export'])->name('export');
});

Route::group(['prefix' => 'permission' , 'as' => 'permission.'], function () {
    Route::get('/', [PermissionsController::class, 'index'])->name('index');
    Route::get('/create', [PermissionsController::class, 'create'])->name('create');
    Route::post('/create', [PermissionsController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PermissionsController::class, 'edit'])->name('edit');
    Route::post('/edit/{id}', [PermissionsController::class, 'update'])->name('update');
    Route::post('/delete/{id}', [PermissionsController::class, 'destroy'])->name('delete');
    Route::get('/export', [PermissionsController::class, 'export'])->name('export');
});
