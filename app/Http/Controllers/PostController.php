<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;

class PostController extends Controller
{
    public function createPost(Request $request){
        $data = $request->validate([
            'user_id'=>'required','source_id'=>'required','title'=>'required','description'=>'required',
        ]);

        $post = Post::create($data);

        if(!empty($post)){
            return response()->json([
                'message' => 'success'
            ]);
        }
    }
}
