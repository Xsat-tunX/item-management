<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Sale;
use App\Models\Item;
use App\Models\ArrivalLog;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // 今月の売上合計（価格 × 数量）
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $monthlySales = Sale::whereBetween('sales_date', [$startOfMonth, $endOfMonth])
            ->get()
            ->sum(fn($sale) => $sale->price * $sale->sales_quantity);

        // 商品総数（在庫数の合計）
        $totalStock = Item::sum('quantity');

        // 商品の種類（行数）
        $itemTypes = Item::count();
        
        //今月の商品入荷数
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $monthlyArrive = ArrivalLog::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('quantity');

        return view('home', compact('monthlySales', 'totalStock', 'itemTypes', 'monthlyArrive'));
    }
}
