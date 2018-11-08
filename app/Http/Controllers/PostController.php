<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{

    public function form(){
        return view('pages.form.formulaire');
    }
    public function poster(Request $request){
        #$post = Post::create($request->all());
        $post= Post::create($request->all());
    }
    public function edit(){
        return view('pages.article');
    }
    public function update($id, Request $request){
        $post= Post::findOrFail($id);
        $post->update($request->all());
    }
}