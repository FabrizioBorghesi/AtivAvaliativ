<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{

    public function index($id)
    {
        if(Post::where('id', $id)->exists()){

            $comments = Post::find($id)->comment;
            return $comments;

        }else{
            return response->json([
                "message" => "Postagem não encontrada."
            ], 404);
        }
    }


    public function store(Request $request, $id)
    {
        $comment = new Comment;

        $comment->user = $request->user;
        $comment->desc = $request->desc;

        $comment->fk_postagem_id = $id;

        $comment->save();

        return response()->json([
            "message" => "Comentario postado com sucesso."
        ],200);
    }


    public function show($id)
    {
        if(Comment::where('id', $id)->exists()){

            return Comment::find($id);

        }else{

            return response()->json([
                "message" => "Esse Comentário não foi encontrado"
            ], 404);

        }
    }


    public function edit(Request $request, $id)
    {
        if(Comment::where('id', $id)->exists()){
            $comment = Comment::find($id);

            $comment->user = $request->user;
            $comment->desc = $request->desc;

            $comment->save();

            return response()->json([
                "message" => "Comentario editado com sucesso!"
            ], 200);

        }else{

            return response()->json([
                "message" => "Comentário nao foi encontrado."
            ], 404);

        }
    }


    public function destroy($id)
    {
        if(Comment::where('id', $id)->exists()){

            $comment = Comment::find($id);
            $comment->delete($id);

            return response()->json([
                "message" => "Comentario deletado com sucesso."
            ],200);

        }else{

            return response()->json([
                "message" => "Comentario nao foi encontrado."
            ], 404);

        }
    }
}