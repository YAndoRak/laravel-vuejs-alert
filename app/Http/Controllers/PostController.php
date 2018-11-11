<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function form(){
        return view('pages.form.formulaire');
    }
    public function poster(Request $request){
        Post::create($request->all());
    }
    public function edit(){
        return view('pages.article');
    }
    public function update($id, Request $request){
        $post= Post::findOrFail($id);
        $post->update($request->all());
    }
    public function delete(Request $req){
        $filePath=$req->type.class_basename($req->src);
        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$filePath)){
            Storage::disk('uploads')->delete($filePath);
            return "Fichier effacer";
        }else{
            return "le fichier n'existe plus";
        }
    }
}