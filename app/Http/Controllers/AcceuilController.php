<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;

class AcceuilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('pages.acceuil');
    }
    public function api(){
        $posts= Post::public()->get();
        foreach ($posts as $post) {

            $data[] =[
                "id" => $post->id,
                "titre" => $post->titre,
                "lieu" => $post->lieu,
                "commune" => $post->commune,
                "image" => $post->image,
                "date" => $post->date,
                "poster" => $post->poster,
                "description" => $post->description,
                "online" => $post->online,
                "user_id" => $post->user_id,
                "created_at" => $post->created_at->format("Y-m-d H:i:s"),
                "updated_at" => $post->updated_at->format('Y-m-d H:i:s'),
                "auteur" => User::findOrFail($post->user_id)->name
            ];
        }
        return (json_encode($data));
    }
    public function detail(){
        return view('pages.article');
    }
    public function show($id){
        $article = Post::public()->findOrFail($id);
        return (json_encode($article));
    }
}
