<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $fillable=['titre', 'lieu', 'commune', 'date', 'poster', 'image', 'description', 'online', 'user_id'];
    public function scopePublic($req){
        return $req->where('online', true);
    }
    public function scopeAuteur($req){
        return $req->where('user_id', Auth::user()->id);
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
