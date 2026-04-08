<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    // Delete the given post only when the current user owns it.
    public function deletePost(Post $post)
    {
        if (Auth::id() === $post['user_id']) {
            $post->delete();
        }

        return redirect('/');
    }

    // Update the given post after validating input and checking ownership.
    public function updatePost(Post $post, Request $request)
    {
        if (Auth::id() !== $post['user_id']) {
            return redirect('/');
        }

        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $post->update($incomingFields);
        return redirect('/');
    }

    // Show the edit form for a single post.
    public function showEditScreen(Post $post)
    {
        if (Auth::id() !== $post['user_id']) {
            return redirect('/');
        }

        return view('edit-post', ['post' => $post]);
    }

    // Create a new post for the authenticated user.
    public function createPost(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = Auth::id();

        Post::create($incomingFields);
        return redirect('/');
    }
}
