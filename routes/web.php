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

//商品一覧画面
Route::prefix('items')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);

    //商品登録
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);

    //商品編集
    Route::get('/{id}/edit', [App\Http\Controllers\ItemController::class, 'edit'])->name('item.edit');
    //商品情報変更
    Route::put('/{id}/update', [App\Http\Controllers\ItemController::class, 'update'])->name('item.update');

    //削除
    Route::delete('/{id}/delete', [App\Http\Controllers\ItemController::class, 'delete'])->name('item.delete');

    //検索
    Route::get('/search', [App\Http\Controllers\ItemController::class, 'search'])->name('item.search');
});

//入荷処理画面
Route::prefix('arrive')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'arrive'])->name('item.arrive');

    //数量更新
    Route::put('/{id}/update', [App\Http\Controllers\ItemController::class, 'arriveUpdate'])->name('item.arriveUpdate');

    //検索
    Route::get('/search', [App\Http\Controllers\ItemController::class, 'arriveSearch'])->name('arrive.search');
});


//売上処理画面
Route::prefix('sales')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'sales'])->name('item.sales');

     //検索
     Route::get('/search', [App\Http\Controllers\ItemController::class, 'salesSearch'])->name('sales.search');
});

//売上登録
Route::post('/sales/add', [App\Http\Controllers\SaleController::class, 'sale'])->name('sales.add');