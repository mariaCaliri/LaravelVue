<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class Postcontroller extends Controller
{
    public function getPosts()
    {
        $posts= Post::with('post_image')->orderBy('created_at', 'desc')->get();
        return response()->json(['error' => false, 'data' => $posts], 200);
    }


    public function create(Request $request)
    {
      $user = auth()->user();
      $title = $request->input('title');
        $body = $request->input('body');
        $images = $request->file('images');
       $user_id = $user->id;
   

    $post = Post::create([
        'title' => $title,
        'body' => $body,
        'user_id' => $user_id
    ]);

    foreach ($images as $image) {
        $imagePath = Storage::disk('uploads')->put($user->email.'/posts/'.$post->id, $image);
        PostImage::create([
            'path' => '/uploads/'.$imagePath,
            'caption' => '',
            'post_id' => $post->id
        ]);
    }
}
}