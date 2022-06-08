<?php

namespace App\Http\Controllers;

use App\Models\Post;            //Postモデルクラスをインポート
use Illuminate\Http\Request;    //Requestクラスをインポート

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("post.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // データの保存メソッド store
    public function store(Request $request)
    {
        //リクエストパラメータごとにバリデーションの設定
        $inputs = $request->validate([
            'post_name' => 'required|string|max:30',
            'title'=>'required|max:50',
            'body'=>'required|string|max:200',
            'image'=>'image|max:10240',
            'url' => 'url|nullable',
        ]);
        // 投稿のレコードとなるPostクラスを作成
        $post = new Post;
        //Postクラスのフィールドにリクエストパラメータを代入
        $post->user_id = auth()->user()->id;
        $post->post_name = $request->post_name;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->url = $request->url;
        //画像ファイルの保存処理(if文で、画像ファイルがある場合だけ処理する)
        if(request('image')){
            //リクエストパラメータimageから、getClientOriginalName()メソッド でファイルの名前を取得し$originalNameに代入。
            $originalName = request()->file('image')->getClientOriginalName();
            //originalNameの先頭に'日付_'をくっつけて$nameに代入
            $name = date('Ymd_His'). '_'. $originalName;
            //リクエストで送られてきたimageファイルを、move()メソッド で指定の場所へ、$nameの名前で保存する。
            request()->file('image')->move('storage/images', $name);
            //$nameのファイル名を、データベースのpostテーブルのimageカラムへ保存する。
            $post->image = $name;
        }
        //データを保存
        $post->save();  
        //ビューの投稿作成画面(create)に戻り、withでセッションへmessageという名前で文字列を格納する。
        return redirect()->route('post.create')->with('message', '投稿を作成しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
