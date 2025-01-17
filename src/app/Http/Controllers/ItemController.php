<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * 商品一覧ページを表示
     */
    public function index(Request $request)
    {
        // デフォルトでは全商品を取得
        $query = Item::query();

        // タブによるフィルタリング（例: "おすすめ" や "マイリスト"）
        if ($request->tab === 'mylist') {
            $query->where('user_id', auth()->id()); // ユーザーが追加した商品
        }

        $items = $query->get();

        return view('items.index', compact('items'));
    }
}
