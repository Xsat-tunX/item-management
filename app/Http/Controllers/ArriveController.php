<?php

namespace App\Http\Controllers;

use App\Models\ArrivalLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ArriveController extends Controller
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
     * 入荷処理画面一覧
     */
    public function arrive()
    {
        // 商品一覧取得
        $items = Item::all();

        return view('arrive.arrive', compact('items'));
    }

    /**
     * 数量加算
     */
    public function arriveUpdate(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        $item = Item::findOrFail($id);

        //入力された数量を現在の数量に加算
        $item->quantity += $request->quantity;
        $item->save();

        //入荷処理のログを登録
        ArrivalLog::create([
            'item_id' => $item->id,
            'quantity' => $request->quantity,
            'type' => '入荷',
        ]);

        return redirect()->route('item.arrive')->with('success','数量を変更しました。');
    }

    
    /**
     * 入荷商品履歴一覧
     */
    public function arriveHistory()
    {
        // 商品一覧取得
        $logs = ArrivalLog::with('item')->orderBy('created_at','desc')->get();


        $totalCost = $logs->sum(fn ($log) => $log->item->cost * $log->quantity);
        $totalQuantity = $logs->sum('quantity');

        return view('arrive.history', compact('logs', 'totalCost', 'totalQuantity'));
    }


    /**
     * 検索入荷処理一覧
     */
    public function arriveSearch(Request $request)
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

        return view('arrive.arrive', compact('items'));
    }

    public function arriveHistorySearch(Request $request)
    {
        // 検索商品一覧取得
        $keyword = $request->input('search');

        $query = ArrivalLog::with('item');

        if (!empty($keyword)) {
            $query->whereHas('item', function($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('type', 'LIKE', "%{$keyword}%")
                    ->orWhere('detail', 'LIKE', "%{$keyword}%");
            });
        }

        $logs = $query->orderBy('created_at', 'desc')->get();

        $totalCost = $logs->sum(fn ($log) => $log->item->cost * $log->quantity);

        $totalQuantity = $logs->sum('quantity');


        return view('arrive.history', compact('logs', 'totalCost', 'totalQuantity'));
    }
    
     /**
     * 検索商品合計
     */
    public function searchTotal(Request $request)
    {
        $query = ArrivalLog::with('item');

        if ($request->filled('keyword')) {
            $query->whereHas('item', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('updated_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('updated_at', '<=', $request->date_to);
        }

        $logs = $query->orderBy('updated_at', 'desc')->get();

        $totalCost = $logs->sum(fn ($log) => $log->item->cost * $log->quantity);

        $totalQuantity = $logs->sum('quantity');


        return view('arrive.history', compact('logs', 'totalCost', 'totalQuantity'));
    }

    public function index()
    {
        $logs = ArrivalLog::with('item')->get();

        $totalCost = $logs->sum(fn ($log) => optional($log->item)->cost ?? 0);
        $totalQuantity = $logs->sum('quantity');

        return view('arrive_history.index', compact('logs', 'totalCost', 'totalQuantity'));
    }
 }

