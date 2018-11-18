<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=['titre', 'lieu', 'commune', 'date', 'poster', 'image', 'description', 'online'];
    public function scopePublic($req){
        return $req->where('online', true);
    }
}
