<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('auth.account');
    }
    public function updateProfil(Request $request)
    {
        if($request->name!=""){
            $this->validate($request, [
                'name' => 'required'
            ]);
            $request->user()->forceFill([
                'name' => $request->name
            ])->save();
        }
        if($request->email!=""){
            $this->validate($request, [
                'email' => 'email|unique:users'
            ]);
            $request->user()->forceFill([
                'email' => $request->email
            ])->save();
        }

        return "Update successfull";
    }
}
