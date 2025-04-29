<?php

namespace App\Http\Controllers;

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
                'name' => 'required|max:100',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'detail' => $request->detail,
                'cost' => $request->cost,
                'quantity' => $request->quantity,
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
        ]);

        //既存の商品を取得
        $item = Item::findOrFail($id);

        // 商品情報変更
        $item->update([
            'name' => $request->name,
            'type' => $request->type,
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
     * 入荷処理
     */
    public function arrive()
    {
        // 商品一覧取得
        $items = Item::all();

        return view('item.arrive', compact('items'));
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

        return redirect()->route('item.arrive')->with('success','数量を変更しました。');
    }

    /**
     * 入荷処理
     */
    public function sales()
    {
        // 商品一覧取得
        $items = Item::all();

        return view('item.sales', compact('items'));
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

        return view('item.arrive', compact('items'));
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

        return view('item.sales', compact('items'));
    }


 }

