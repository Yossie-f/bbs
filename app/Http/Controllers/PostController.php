<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;            //Postモデルクラスをインポート
use App\Models\Comment;         
use Illuminate\Http\Request;    //Requestクラスをインポート
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage; //投稿画像削除のためにインポート

class PostController extends Controller
{

    public function index()
    {
        //Postモデルに紐づいたテーブルのデータを全て取得し$postsに代入
        // $posts = Post::all();
        //Postモデルから、テーブルのデータを作成日の降順で並び替えてget()で取得する
        $posts = Post::orderBy('created_at', 'desc')->get();
        //auth()でログイン中のユーザー情報を取得し$userに代入
        $user = auth()->user();

        $categories = Category::orderBy('id')->get();
        
        //ルート名 post.index に、取得した情報をcompactメソッドで、連想配列として渡す
        return view('post.index', compact('posts', 'user','categories'));
    }



    public function create()
    {
        //adminユーザーしかcreateメソッドを使用しないように制限するコード
        // Gate::authorize('admin'); 
        $categories = Category::orderBy('id')->get();
        return view("post.create", compact('categories'));
    }



    // データの保存メソッド store
    public function store(Request $request)
    {
        //リクエストパラメータごとにバリデーションの設定
        $inputs = $request->validate([
            'post_name' => 'required|string|max:30',
            'category_id' => 'required',
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
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->url = $request->url;
        //画像ファイルの保存処理(if文で、画像ファイルがある場合だけ処理する)
        if(request('image')){
            //リクエストパラメータimageから、getClientOriginalName()メソッド でファイルの名前を取得し$originalNameに代入。
            $originalName = request()->file('image')->getClientOriginalName();
            //originalNameの先頭に'日付_時分秒_'をくっつけて$nameに代入
            $name = date('Ymd_His'). '_'. $originalName;
            //リクエストで送られてきたimageファイルを、move()メソッド で指定の場所へ、$nameの名前で保存する。
            request()->file('image')->move('storage/images', $name);
            //$nameのファイル名を、データベースのpostテーブルのimageカラムへ保存する。
            $post->image = $name;
        }
        //データを保存
        $post->save();  
        //ビューの投稿作成画面(create)に戻り、withでセッションへmessageという名前で文字列を格納する。
        return redirect()->route('post.show', $post)->with('message', '投稿を作成しました。');
    }



    public function show(Post $post)  //引数にPostクラスの$postを受け取る
    {
        return view('post.show', compact('post')); //showのビューにpostの情報を渡す
    }



    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $categories=Category::all();
        return view('post.edit', compact('post', 'categories'));
    }



    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
         //リクエストパラメータごとにバリデーションの設定
         $inputs = $request->validate([
            'post_name' => 'required|string|max:30',
            'title'=>'required|max:50',
            'body'=>'required|string|max:1000',
            'image'=>'image|max:10240',
            'url' => 'url|nullable',
        ]);
        //Postクラスのフィールドにリクエストパラメータを代入
        // $post->user_id = auth()->user()->id;
        $post->post_name = $request->post_name;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->url = $request->url;
        //画像ファイルの保存処理(if文で、画像ファイルがある場合だけ処理する)
        if(request('image')){
            //リクエストパラメータimageから、getClientOriginalName()メソッド でファイルの名前を取得し$originalNameに代入。
            $originalName = request()->file('image')->getClientOriginalName();
            //originalNameの先頭に'日付_時分秒_'をくっつけて$nameに代入
            $name = date('Ymd_His'). '_'. $originalName;
            //リクエストで送られてきたimageファイルを、move()メソッド で指定の場所へ、$nameの名前で保存する。
            request()->file('image')->move('storage/images', $name);
            //$nameのファイル名を、データベースのpostテーブルのimageカラムへ保存する。
            $post->image = $name;
        }
        //データを保存
        $post->save();  
        //ビューの投稿詳細画面(show.blade)に戻り、$post(postsテーブルのid)と、withでセッションmessageへ文字列を格納しリダイレクト先に渡す
        return redirect()->route('post.show', $post)->with('message', '投稿を変更しました。');
    }



    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->comments()->delete(); //投稿(Post)削除時にコメント(Comment)も削除する
        //投稿された画像をストレージから削除する
        if(isset($post->image)){
            $imageName = $post->image;
            $image = 'public/images/'.$imageName;
            Storage::delete($image);
        }
        //投稿(Post)を削除する
        $post->delete();   
        //削除後はindexページにリダイレクト。セッションメッセージを合わせて送る。
        return redirect()->route('post.index')->with('message', '投稿を削除しました');
    }


    // 自分の投稿だけ表示させるメソッド
    public function mypost(){
        $user=auth()->user()->id;
        $posts=Post::where('user_id', $user)->orderBy('created_at', 'desc')->get();
        return view('post.mypost', compact('posts'));
    }


    //自分がコメントした投稿だけ表示させるメソッド
    public function mycomment(){
        $user=auth()->user()->id;
        $comments=Comment::where('user_id', $user)->orderBy('created_at', 'desc')->get();
        $comments=$comments->unique('post_id');
        return view('post.mycomment', compact('comments'));
    }

    //選択したカテゴリーの投稿だけ表示させるメソッド
    public function category(Request $request){
        $posts=Post::where('category_id', $request->id)->orderBy('created_at', 'desc')->get();
        $category=Category::where('id', $request->id)->first();
        return view('post.category', compact('posts', 'category'));
    }
}
