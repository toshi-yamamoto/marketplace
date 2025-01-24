<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Item;


class PurchaseController extends Controller
{
    // 購入画面の表示
    public function create($item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = auth()->user();
        return view('purchases.create', compact('item', 'user'));
    }

    // 購入処理
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'payment_method' => 'required|string',
        ]);

        Purchase::create([
            'user_id' => auth()->id(),
            'item_id' => $request->item_id,
            'payment_method' => $request->payment_method,
            'address' => auth()->user()->address,
        ]);

        return redirect()->route('items.index')->with('success', '購入が完了しました！');
    }

    // 住所変更画面の表示
    public function editAddress($item_id)
    {
        $user = auth()->user();
        $item = Item::findOrFail($item_id);
        return view('purchases.edit-address', compact('user', 'item'));
    }

    // 住所変更処理
    public function updateAddress(Request $request, $item_id)
    {
        $request->validate([
            'zip' => 'required|string|max:10',
            'address' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
        ]);

        $user = auth()->user();
        $user->update($request->only('zip', 'address', 'building'));

        return redirect()->route('purchases.create', ['item_id' => $item_id])->with('success', '住所を更新しました！');
    }
}
