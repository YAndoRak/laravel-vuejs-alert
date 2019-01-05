<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function form(){
        return view('pages.form.formulaire');
    }
    public function poster(Request $request,Guard $auth){
        $post=[
            'titre' => $request->input('titre'),
            'lieu' => $request->input('lieu'),
            'commune' => $request->input('commune'),
            'date' => $request->input('date'),
            'description' => $request->input('description'),
            'online' => $request->input('online'),
            'poster' => $request->input('poster'),
            'image' => $request->input('image'),
            'user_id' => $auth->user()->id
        ];
        Post::create($post);
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
    public function delete_post($id){
        if(Post::auteur()->findOrFail($id)) {
            Post::findOrFail($id)->delete();
        }else{
           return "Vous n'etes pas authoriser a effectuer cette operation";
        }
    }
}