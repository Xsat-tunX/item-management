<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sale;
use App\Models\Item;

class saleController extends Controller
{
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

        return redirect()->route('sales.add')->with('success','売上を登録しました。');
    }
}
