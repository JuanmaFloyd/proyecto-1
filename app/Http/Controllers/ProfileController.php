<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function edit(){
    	$user = User::where('id', auth()->id())->get()[0];

    	return view('usuarios.editProfile', compact('user'));
    }

    public function update(){

    	request()->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        $user = User::where('id', auth()->id())->get()[0];

        $user->name = request('name');
       
       	if(request('description') != null)
			$user->description = request('description');
        else
        	$user->description = "";
        
        $user->preference = request('preference');

        $user->save();
        return redirect("/home");
    }

    public function show(){
        $user = User::where('id', auth()->id())->get()[0];

        return view('usuarios.myProfile', compact('user'));
    }
}
