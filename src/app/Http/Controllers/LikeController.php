<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike(Request $request, $itemId)
    {
        if (!Auth::check()) {
            // 未認証ユーザーへのレスポンス
            return response()->json([
                'message' => 'ログインが必要です。',
                'redirect' => route('login'),
            ], 401); // HTTP 401 Unauthorized
        }

        $userId = auth()->id(); // 現在ログインしているユーザーID

        // すでに「いいね」が存在しているか確認
        $like = Like::where('user_id', $userId)->where('item_id', $itemId)->first();

        if ($like) {
            // 「いいね」が存在する場合は削除（解除）
            $like->delete();
            return response()->json([
                'message' => 'いいねを解除しました。',
                'status' => 'removed',
            ]);
        } else {
            // 存在しない場合は新しく作成（いいねを保存）
            Like::create([
                'user_id' => $userId,
                'item_id' => $itemId,
            ]);
            return response()->json([
                'message' => 'いいねをしました！',
                'status' => 'added',
            ]);
        }
    }
}
