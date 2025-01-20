<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Item;

class CommentController extends Controller
{
    public function store(Request $request, $item_id)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $item = Item::findOrFail($item_id);

        Comment::create([
            'content' => $request->content,
            'user_id' => auth()->id(),
            'item_id' => $item->id,
        ]);

        return redirect()->route('items.show', $item_id)->with('success', 'コメントを投稿しました！');
    }
}
