<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    //Mostar postagens
   public function index(Request $request)
   {
    return Post::all();
   }

   //Criar postagem
   public function store(Request $request)
   {
       $posting = new Post;

       $posting->user = $request->user;
       $posting->tittle = $request->tittle;
       $posting->desc = $request->desc;

       $posting->save();

       return response()->json([
        "message" => "Post enviado com sucesso."
       ], 200);
   }

   //Mostar UM postagem
   public function show(Request $request, $id)
   {
        if(Post::where('id',$id)->exists()){

            return Post::find($id);

        }else{

            return response()->json([
                "message" => "Post nao encontrado."
            ], 404);

        }
   }

   //Editar postagem
   public function edit(Request $request, $id)
   {
        if(Post::where('id',$id)->exists()){

            $posting = Post::find($id);

            $posting->user = $request->user;
            $posting->tittle = $request->tittle;
            $posting->desc = $request->desc;

            $posting->save();

            return response()->json([
                "message" => "O Post foi editado."
            ], 200);

       }else{

            return response()->json([
               "message" => "Post nao foi encontrado."
            ], 404);

       }
   }

   //Apagar postagem
   public function destroy(Request $request, $id)
   {

        if(Post::where('id',$id)->exists()){

            $posting = Post::find($id);

            $posting->comment()->delete();
            $posting->delete();

            return response()->json([
                "message" => "Post deletado com sucesso!"
            ], 200);

        }else{

            return response()->json([
                "message" => "Post não encontrado."
             ], 404);

        }
   }
}
