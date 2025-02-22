<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;

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
            if (auth()->check()) {
                // 認証ユーザーの場合、いいねした商品のみ表示
                $query->whereHas('likes', function ($query) {
                    $query->where('user_id', auth()->id());
                });
            } else {
                // 未認証ユーザーの場合は空を返す
                $query->whereNull('id');
            }
        }

        $items = $query->get();

        return view('items.index', compact('items'));
    }

    public function show($item_id)
    {
        // // 商品情報を取得し、likes_count と comments_count を取得
        // $item = Item::withCount(['likes', 'comments'])->findOrFail($item_id);

        // 商品情報を取得し、likes_count と comments_count を取得
        $item = Item::with(['comments.user']) // コメントとその投稿者を取得
            ->withCount(['likes', 'comments']) // いいねとコメント数をカウント
            ->findOrFail($item_id);

        return view('items.show', compact('item'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'item_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // バリデーション
        ]);

        $itemData = $request->only(['name', 'description', 'price']);

        // 画像がアップロードされた場合
        if ($request->hasFile('item_image')) {
            $itemData['item_image'] = $request->file('item_image')->store('item_images', 'public');
        }

        $item = Item::create($itemData);

        return redirect()->route('items.index')->with('success', '商品を登録しました！');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $items = Item::where('name', 'LIKE', "%{$query}%")
            ->orWhere('brand_name', 'LIKE', "%{$query}%")
            ->get();

        return view('items.index', compact('items'));
    }
}
