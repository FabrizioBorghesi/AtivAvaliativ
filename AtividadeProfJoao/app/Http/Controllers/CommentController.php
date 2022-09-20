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

            return response () -> json ([
                " message " => " Não há nada aqui. "
              ], 404);

        }
    }


    public function store(Request $request, $id)
    {

        $coment = new Comment;

        $coment -> usuario = $request->usuario;
        $coment ->descricao = $request->descricao;
        $coment ->fk_postagem_id = $id;
        $coment ->save();
        return response()->json([
            "message" => "Foi realizado um comentário"
        ],200);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function edit(Request $request, $id)
    {

        if(Comment::where('id', $id)->exists()){
            $coment = Comment::find($id);
            $coment->usuario = $request->usuario;
            $coment->descricao = $request->descricao;
            $coment->save();
            return response()->json([
                "message" => "Comentário alterado"
            ], 200);

        }else{

            return response () -> json ([
                " message " => " Não há nada aqui. "
              ], 404);
            }

    }

    /* Exiba o recurso especificado*/
    public function show($id)
    {

        if(Comment::where('id', $id)->exists()){
            return Comment::find($id);

        }else{

            return response () -> json ([
                " message " => " Não há nada aqui. "
              ], 404);

        }
    }




    /*Remova o recurso especificado do armazenamento*/
    public function destroy(Comment $comment, $id)
    {
        if(Comment::where('id', $id)->exists()){
            $coment = Comment::find($id);
            $coment->delete($id);
            return response()->json([
                "message" => "Comentario deletado"
            ],200);
        }else{
            return response () -> json ([
                "message" => " Não há nada aqui. "
              ], 404);
        }
    }
}
