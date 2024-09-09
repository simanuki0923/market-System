<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.index')->with('success', 'ユーザーが削除されました。');
    }

    public function showUsers()
    {
        $users = User::all(); // 全ユーザーを取得
        return view('admin.delete', compact('users'));
    }

    public function showComments()
    {
        $comments = Comment::with('product')->get();
        return view('admin.comment', compact('comments'));
    }

    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->route('admin.showComments')->with('success', 'コメントが削除されました。');
    }
}
