<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\User;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['user', 'recipe'])->get();
        return response()->json($comments);
    }

    public function create(Request $request)
    {
        $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string|max:255',
        ]);

        $comment = Comment::create($request->all());
        $comment->user = User::find($request->user_id);

        return response()->json($comment, 201);
    }

    public function patch(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,published',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update($request->all());

        return response()->json($comment);
    }

    public function pending()
    {
        $comments = Comment::where('status', 'pending')->with(['user', 'recipe'])->get();
        return response()->json($comments);
    }
}