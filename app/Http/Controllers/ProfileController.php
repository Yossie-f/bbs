<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(){
        $users=User::all();  //allメソッドで全てのユーザーを$userに格納
        return view('profile.index', compact('users'));
    }

    public function edit(User $user){
        return view('profile.edit', compact('user'));
    }
}
