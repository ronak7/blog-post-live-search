<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validation = validator($request->all(), [
                'title' => 'require',
                'category_id' => 'require',
                'des' => 'require'
            ]);

            $post = new Post();
            $post->title = $request->title;
            $post->body = $request->des;
            $post->save();

            $post->category()->sync($request->category_id);

            return redirect('/home');
        } catch (\Exception $e) {
            echo $e;
        }
    }

    public function search(Request $request)
    {
        if (isset($request->date)) {
            $reqDate = strtotime($request->date);
            $date = date("Y-m-d", $reqDate);
            $posts = Post::with('category:id,name')->whereDate('created_at','=', $date)->get();
        }else{
            $posts = Post::with('category:id,name')->get();
        }
        $categories = Category::all();
        return response()->json(compact('posts', 'categories'), 200);
    }
}
