<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use Exception;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class PostController extends Controller
{
    public function test()
    {
        return response()->json('Hello MFA ');
    }

    public function create(PostRequest $request)
    {
        try {
            $post = Post::create([
                'titre' => $request->titre,
                'description' => $request->description,
                'user_id' => Auth::user()->id,
            ]);
            // dd($post);
            return response()->json([
                'message' => 'Post creer',
                'status' => 200,
                'post' => $post
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Post non cree',
                'erreur' => $e
            ]);
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $post = Post::find($id);
            // dd($post);
            if (!$post) {
                return response()->json([
                    'erreur' => 'Ce post n\'exixte pas'
                ]);
            }
            $post->titre = $request->titre;
            $post->description = $request->description;
            $post->save();
            return response()->json([
                'status' => 200,
                'message ' => 'Post modifier',
                'post' => $post,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erreur sur la modification ',
                'erreur' => $e
            ]);
        }
    }
}
