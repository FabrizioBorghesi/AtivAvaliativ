<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
   public function index(Request $request)
   {
    return Post::all();
   }

   public function store(Request $request)
   {

       $posta = new Post;

       $posta->usuario = $request->usuario;
       $posta->titulo = $request->titulo;
       $posta->descricao = $request->descricao;
       $posta->save();

       return response()->json([
        "message" => "Postagem foi realizada"
       ], 200);
   }

   public function show(Request $request, $id )
   {
        if(Post::where('id' ,$id)->exists()){
            return Post::find($id);

        }else{

            return response()->json ( [
                "message" => "Não há nada aqui"
            ], 404);
        }
   }

   public function edit(Request $request, $id)
   {
        if(Post::where('id',$id)->exists()){

            $posta = Post::find($id);

            $posta->usuario = $request->usuario;
            $posta->titulo = $request->titulo;
            $posta->descricao = $request->descricao;
            $posta->save();

            return response()->json ( [
                "message" => "Postagem alterada"
            ], 200);

       }else{

            return response()->json ( [
               "message" => "Não há  nada aqui"
            ], 404);

       }
   }

   public function destroy(Request $request , $id)
   {
        if(Post::where('id',$id)->exists()){
            $posta = Post::find($id);
            $posta->comment()->delete();
            $posta->delete();

            return response()->json( [
                "message" => "Postagem deletada."
            ], 200);

        }else{

            return response()->json( [
                "message" => "Não há nada aqui"
             ], 404);

        }
   }
}
