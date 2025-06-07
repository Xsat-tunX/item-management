<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index'])->name('item.index');

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

//入荷関連
Route::prefix('arrive')->group(function () {
    Route::get('/', [App\Http\Controllers\ArriveController::class, 'arrive'])->name('item.arrive');

    //入荷処理
    Route::put('/{id}/update', [App\Http\Controllers\ArriveController::class, 'arriveUpdate'])->name('item.arriveUpdate');

    //入荷処理画面検索
    Route::get('/search', [App\Http\Controllers\ArriveController::class, 'arriveSearch'])->name('arrive.search');

    //入荷履歴一覧
    Route::get('/history', [App\Http\Controllers\ArriveController::class, 'arriveHistory'])->name('arrive.history');

     //入荷履歴画面検索
     Route::get('/history/search', [App\Http\Controllers\ArriveController::class, 'searchTotal'])->name('arriveHistory.search');

});


//売上関連
Route::prefix('sales')->group(function () {
    Route::get('/', [App\Http\Controllers\SaleController::class, 'sales'])->name('item.sales');

     //検索
     Route::get('/search', [App\Http\Controllers\SaleController::class, 'salesSearch'])->name('sales.search');

     //売上登録
    Route::post('/add', [App\Http\Controllers\SaleController::class, 'sale'])->name('sales.add');

    //売上履歴一覧
    Route::get('/history', [App\Http\Controllers\SaleController::class, 'salesHistory'])->name('sales.history');

    //売上履歴画面検索
    Route::get('/history/search', [App\Http\Controllers\SaleController::class, 'searchTotal'])->name('salesHistory.search');

});

