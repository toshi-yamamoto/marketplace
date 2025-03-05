<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        // デフォルトでは全商品を取得
        $query = Item::query();

        // ログインしている場合、自分が出品した商品は表示しない
        if (auth()->check()) {
            $query->where('user_id', '!=', auth()->id());
        }

        // タブによるフィルタリング
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
        $item = Item::with(['comments.user']) // コメントとその投稿者を取得
            ->withCount(['likes', 'comments']) // いいねとコメント数をカウント
            ->findOrFail($item_id);

        return view('items.show', compact('item'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        // 1. バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'brand_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'condition' => 'required|string|max:255',
            'item_image' => 'nullable|image|max:2048',
            'categories' => 'required|array|min:1',   // ここで categories 配列が必須
            'categories.*' => 'string',
        ], [
            'categories.required' => 'カテゴリーは必ず指定してください。'
        ]);

        // 2. リクエストから必要なデータを取得
        $itemData = $request->only([
            'name',
            'price',
            'brand_name',
            'description',
            'category',
            'condition'
        ]);

        // 3. 現在ログインしているユーザーのIDを追加
        $itemData['user_id'] = Auth::id();

        // 複数選択されたカテゴリーを JSON 文字列として保存
        $itemData['category'] = json_encode($request->input('categories'));

        // 4. 画像がアップロードされた場合は保存
        if ($request->hasFile('item_image')) {
            $itemData['item_image'] = $request->file('item_image')->store('item_images', 'public');
        }

        // 5. 新しい商品をデータベースに登録
        $item = Item::create($itemData);

        // 6. 一覧ページにリダイレクト
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
