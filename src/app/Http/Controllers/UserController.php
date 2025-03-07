<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;
use App\Models\Purchase;

class UserController extends Controller
{
    /**
     * プロフィール設定画面を表示
     */
    public function edit()
    {
        return view('users.profile');
    }

    /**
     * プロフィール更新処理
     */
    public function update(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'address' => ['nullable', 'string', 'max:255'],
            'building_name' => ['nullable', 'string', 'max:255'],
            'profile_image' => ['nullable', 'image', 'max:2048'], // 画像は最大2MB
        ]);

        // 現在のユーザーを取得
        $user = Auth::user();

        // プロフィール画像を保存
        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                // 古い画像を削除
                Storage::disk('public')->delete($user->profile_image);
            }
            // 新しい画像を保存
            $user->profile_image = $request->file('profile_image')->store('profile_images', 'public');
        }

        // ユーザー情報を更新
        $user->update([
            'name' => $request->input('name'),
            'postal_code' => $request->input('postal_code'),
            'address' => $request->input('address'),
            'building_name' => $request->input('building_name'),
        ]);

        // リダイレクト
        return redirect()->route('users.profile')->with('success', 'プロフィールを更新しました！');
    }

    public function mypage()
    {
        $user = Auth::user();

        // 出品した商品
        $postedItems = $user->items;

        // 購入した商品
        // purchasesテーブルから item_id を取得 → Itemを紐付け
        $purchasedItems = Purchase::where('user_id', $user->id)
            ->with('item')
            ->get()
            ->map(function ($purchase) {
                return $purchase->item;
            })
            ->unique('id')
            ->values();

        return view('users.mypage', compact('user', 'postedItems', 'purchasedItems'));
    }
}
