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
            // 未認証ユーザーへのレスポンスをJSONで返す
            return response()->json([
                'message' => 'ログインが必要です。',
                'redirect' => route('login'),
            ], 401);
        }

        $userId = auth()->id();

        $like = Like::where('user_id', $userId)->where('item_id', $itemId)->first();

        if ($like) {
            $like->delete();
            return response()->json([
                'message' => 'いいねを解除しました。',
                'status' => 'removed',
            ]);
        } else {
            Like::create(['user_id' => $userId, 'item_id' => $itemId]);
            return response()->json([
                'message' => 'いいねをしました！',
                'status' => 'added',
            ]);
        }
    }
}
