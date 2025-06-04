<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sale;
use App\Models\Item;

class SaleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    /**
     * 売上処理
     */
    public function sales()
    {
        // 商品一覧取得
        $items = Item::all();

        return view('sales.sales', compact('items'));
    }


    /**
     * 売上登録
     */
    public function sale(Request $request)
    {
        // バリデーション
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'price' => 'required|integer',
            'sales_quantity' => 'required|integer|min:1',
        ]);

        //対象商品の取得
        $item = Item::findOrFail($request->item_id);

        // 売上登録
        Sale::create([
            'user_id' => Auth::id(),
            'item_id' => $item->id,
            'sales_quantity' => $request->sales_quantity,
            'price' => $request->price,
            'sales_date' => now(),
        ]);

        //入力された数量を現在の数量から減算
        $item->quantity -= $request->sales_quantity;
        $item->save();

        return redirect()->route('item.sales')->with('success','売上を登録しました。');
    }

    
    /**
     * 検索売上処理一覧
     */
    public function salesSearch(Request $request)
    {
        // 検索商品一覧取得
        $keyword = $request->input('search');
        $query = Item::query();
        if(!empty($keyword)) {
            $query->where('name', 'LIKE', "%{$keyword}%")
            ->orWhere('type', 'LIKE', "%{$keyword}%")
            ->orWhere('detail', 'LIKE', "%{$keyword}%");
        }

        $items = $query->get();

        return view('sales.sales', compact('items'));
    }

    /**
     * 売上履歴一覧
     */
    public function salesHistory()
    {
        // 商品一覧取得
        $logs = Sale::with('item')->orderBy('sales_date','desc')->get();


        $totalPrice = $logs->sum(fn ($log) => $log->price * $log->sales_quantity);
        $totalQuantity = $logs->sum('sales_quantity');

        return view('sales.history', compact('logs', 'totalPrice', 'totalQuantity'));
    }


    /**
     * 検索商品合計
     */
    public function searchTotal(Request $request)
    {
        $query = Sale::with('item');

        if ($request->filled('keyword')) {
            $query->whereHas('item', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('sales_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('sales_date', '<=', $request->date_to);
        }

        $logs = $query->orderBy('sales_date', 'desc')->get();

        $totalPrice = $logs->sum(fn ($log) => $log->price * $log->sales_quantity);
        $totalQuantity = $logs->sum('sales_quantity');


        return view('sales.history', compact('logs', 'totalPrice', 'totalQuantity'));
    }

    public function index()
    {
        $logs = Sale::with('item')->get();

        $totalPrice = $logs->sum(fn ($log) => optional($log->item)->price ?? 0);
        $totalQuantity = $logs->sum('sales_quantity');

        return view('sales_history.index', compact('logs', 'totalPrice', 'totalQuantity'));
    }

}
