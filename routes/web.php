<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//商品一覧
Route::prefix('items')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::get('/{id}/edit', [App\Http\Controllers\ItemController::class, 'edit'])->name('item.edit');
    Route::put('/{id}', [App\Http\Controllers\ItemController::class, 'update'])->name('item.update');
    Route::delete('/items/{id}', [App\Http\Controllers\ItemController::class, 'delete'])->name('item.delete');
});

//入荷処理画面へ遷移
Route::get('/arrive', [App\Http\Controllers\ItemController::class, 'arrive'])->name('item.arrive');

//数量更新
Route::put('/arrive/{id}', [App\Http\Controllers\ItemController::class, 'arriveUpdate'])->name('item.arriveUpdate');
