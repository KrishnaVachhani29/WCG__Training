<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\WithdrawHistory;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::get();

        return view('posts', compact('posts'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }
        // dd($request->all());
        Post::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);
        return response()->json(['success' => 'Post created successfully.']);
    }

    //update
    public function update(Request $request)
    {
        $post = Post::find($request->id);
        // dd($post);
        if ($post) {
            $post->update([
                'title' => $request->title,
                'body' => $request->body,
            ]);

            return response()->json(['success' => 'Post updated successfully.']);
        }

        return response()->json(['error' => 'Post not found.']);
    }
    //remove
    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();

            return response()->json(['success' => 'Post deleted successfully.']);
        }

        return response()->json(['error' => 'Post not found.']);
    }
    public function edit($id)
    {
        $post = Post::find($id);
        return response()->json($post);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $withdrawHistories = Post::where('title', 'like', '%' . $search . '%')->paginate(10);

        $view = view('dashboard.withdraw-history.search-results', compact('withdrawHistories'))->render();
        $pagination = $withdrawHistories->links('pagination.custom')->render();

        return response()->json([
            'view' => $view,
            'pagination' => $pagination,
        ]);
    }
}
