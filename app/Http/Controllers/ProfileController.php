<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(){
        $users=User::all();  //allメソッドで全てのユーザーを$userに格納
        return view('profile.index', compact('users'));
    }

    public function edit(User $user){
        $this->authorize('update', $user);
        return view('profile.edit', compact('user'));
    }

    public function update(User $user, Request $request){
        $this->authorize('update', $user);

        $inputs=request()->validate([
            'name' => 'required|max:255',
            //emailのユニーク規制を現在のログインユーザーだけ除外し、emailの据え置きを可能にする。
            'email' => 'required', 'email', 'max:255', Rule::unique('users')->ignore($user->id),  
            'avatar' => 'image|max:1024',
            'password' => 'nullable|max:255|min:8',     
            'password_confirmation' => 'nullable|same:password', //2回目のパスワード入力。上のパスワードと同じでなければエラー
        ]);

        if(!isset($inputs['password'])){    //パスワードが新たに設定されなければ
            unset($inputs['password']);     //パスワードは空の状態(unset)とする
        }else{
            $inputs['password'] = Hash::make($inputs['password'])->save();    //パスワードが入力されていればハッシュ化する
        }

        if(isset($inputs['avatar'])) {
            $name=request()->file( 'avatar')->getClientOriginalName();
            $avatar=date('Ymd_His').'_'.$name;
            request()->file( 'avatar')->storeAs('public/avatar', $avatar);
            $inputs['avatar'] = $avatar;
        }
        $user->update($inputs);
        return back()->with('message', '情報を更新しました');
    }
    }
}
