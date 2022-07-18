<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(){
        $users=User::all();  //allメソッドで全てのユーザーを$userに格納
        return view('profile.index', compact('users'));
    }


    public function edit(User $user){
        $this->authorize('update', $user);
        $roles = Role::all();       //モデルからroleデータを全て取得する
        return view('profile.edit', compact('user', 'roles'));  //コンパクト関数でユーザー情報とロール情報をまとめて送る。
    }


    //プロフィール更新のupdateメソッドにポリシーによるアクセス制限を設定
    public function update(User $user, Request $request){
        $this->authorize('update', $user);
        //プロフィール変更入力のバリデーション設定
        $inputs=request()->validate([
            'name' => 'required|max:255',
            //emailのユニーク規制を現在のログインユーザーだけユニーク規制を除外し、emailの据え置きを可能にする。
            'email' => 'required', 'email', 'max:255', Rule::unique('users')->ignore($user->id),  
            'avatar' => 'image|max:1024',
            'password' => 'nullable|max:255|min:8',     //nullableなので入力なしでも可
            'password_confirmation' => 'nullable|same:password', //2回目のパスワード入力。1回目のパスワードと同じでなければエラー
        ]);

        if(!isset($inputs['password'])){    //パスワードが新たに設定されなければ
            unset($inputs['password']);     //パスワードは空の状態(unset)とする
        }else{
            $inputs['password']=Hash::make($inputs['password']);    //パスワードが入力されていればハッシュ化する
        }

        //アバターが存在するなら更新する
        if(isset($inputs['avatar'])) {
            //それがデフォルト画像でないなら、ストレージから古い画像を削除する
            if($user->avatar!=='default_user.png'){
                $oldAvatar = 'public/avatar/'.$user->avatar;
                Storage::delete($oldAvatar);
            }
            //新たにリクエストされた画像を日付 + オリジナルネームで登録する
            $name = request()->file( 'avatar')->getClientOriginalName();
            $avatar = date('Ymd_His').'_'.$name;
            request()->file( 'avatar')->storeAs('public/avatar', $avatar);  //パスは 'storage/app/public/avatar' の省略
            $inputs['avatar'] = $avatar;
        }

        $user->update($inputs);
        return back()->with('message', '情報を更新しました');
    }

    //ユーザーを削除するメソッド
    public function destroy(User $user){
        
        //ユーザー情報のアバターがデフォルト画像でなければ、その画像をストレージから先に削除しておく。
        if($user->avatar!=='default_user.png'){
            $oldAvatar = 'public/avatar/'.$user->avatar;
            Storage::delete($oldAvatar);
        }
        //ユーザーを削除する
        $user->delete();
        //メッセージ情報をwithで添付し、ページをバックする。
        return back()->with('message', 'ユーザーを削除しました。');
    }
}
