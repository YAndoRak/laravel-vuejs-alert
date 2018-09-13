<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class AcceuilController extends Controller
{
    public function index(){
        return view('pages.acceuil');
    }
    public function api(){
       $post= Post::where('online', 1)->get();
       return (json_encode($post));
    }
}
