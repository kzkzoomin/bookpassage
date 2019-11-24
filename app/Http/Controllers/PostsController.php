<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;    // 追加

class PostsController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(10);
            
            $data = [
                'user' => $user,
                'posts' => $posts,
            ];
        }
        
        return view('welcome', $data);
    }
    
    // 新規登録画面表示処理
    public function create()
    {
        $post = new Post;

        return view('posts.create', [
            'post' => $post,
        ]);
    }
    
    // 新規登録処理
    public function store(Request $request)
    {
        $this->validate($request, [
            'sentence' => 'required|max:191',
            'book_title' => 'required|max:191',
            'book_author' => 'required|max:191',
            'comment' => 'required|max:191',
        ]);

        $request->user()->posts()->create([
            'sentence' => $request->sentence,
            'book_title' => $request->book_title,
            'book_author' => $request->book_author,
            'comment' => $request->comment,
        ]);

        return redirect('/');
    }
    
    // 削除
    public function destroy($id)
    {
        $post = \App\Post::find($id);

        if (\Auth::id() === $post->user_id) {
            $post->delete();
        }

        return back();
    }
    
}
