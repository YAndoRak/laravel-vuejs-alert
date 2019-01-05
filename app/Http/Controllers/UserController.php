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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $request->user()->forceFill([
            'name' => $request->name,
            'email' => $request->email
        ])->save();
        return "Update successfull";
    }
}
