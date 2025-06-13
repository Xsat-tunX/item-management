<?php

namespace App\Http\Controllers;

use App\Models\ArrivalLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
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
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        $items = Item::all();

        return view('item.index', compact('items'));
    }

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|string|max:100',
                'category' => 'nullable|string|max:50',
                'detail' => 'nullable|string|max:100',
                'cost' => 'required|integer|min:0',
                'quantity' => 'required|integer|min:0',
            ]);

            // 商品登録
            $item = Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'category' => $request->category,
                'detail' => $request->detail,
                'cost' => $request->cost,
                'quantity' => $request->quantity,
            ]);

            //商品登録のログを登録
            ArrivalLog::create([
                'item_id' => $item->id,
                'quantity' => $item->quantity,
                'type' => '登録'
            ]);

            return redirect('/items');
        }

        return view('item.add');
    }

    /**
     * 商品情報変更
     */
    public function edit($id)
    {
        // 商品一覧取得
        $item = Item::find($id);

        return view('item.edit', compact('item'));
    }

     /**
     * 商品情報変更
     */
    public function update(Request $request,$id)
    {
        // バリデーション
        $this->validate($request, [
            'name' => 'required|max:100',
            'category' => 'nullable|string|max:50',
            'detail' => 'nullable|string|max:100',
            'cost' => 'required|integer|min:0',
        ]);

        //既存の商品を取得
        $item = Item::findOrFail($id);

        // 商品情報変更
        $item->update([
            'name' => $request->name,
            'category' => $request->category,
            'detail' => $request->detail,
            'cost' => $request->cost,
        ]);

        return redirect('/items');
     }

     /**
     * 商品削除
     */
    public function delete($id)
    {
        // 商品一覧取得
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect('/items')->with('success', '商品を削除しました。');
    }

     /**
     * 検索商品一覧
     */
    public function search(Request $request)
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

        return view('item.index', compact('items'));
    }

 }

