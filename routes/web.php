<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ObjekController;
use App\Http\Controllers\ObjekImagesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::get('/linkstorage', function(){
    Artisan::call('storage:link');
});

Route::group(['middleware' => ['auth','verified']], function(){
    Route::name('dashboard.')->prefix('dashboard')->group(function(){
        Route::get('/', [DashboardController::class, 'index']) -> name('index');

        Route::middleware(['admin'])->group(function(){
            Route::resource('objek', ObjekController::class);
            Route::resource('kategori', KategoriController::class);
            Route::resource('objek.images', ObjekImagesController::class)->shallow()->only([
                'index', 'create', 'store', 'destroy'
            ]);
            Route::resource('user', UserController::class)->only([
                'index', 'edit', 'update', 'destroy'
            ]);
        });
    });
});
