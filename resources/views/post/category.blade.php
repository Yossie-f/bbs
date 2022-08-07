<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">カテゴリー:{{$category->category_name}}</h2>
    <x-message :message="session('message')"/>
  </x-slot>

  {{-- 投稿一覧表示用のコード --}}
  <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
    @if(count($posts) == 0)
    <p class="mt-4">このカテゴリーの投稿はまだありません</p>
    @else
    <p>このカテゴリーの投稿は{{count($posts)}}件です</p>

    {{-- 投稿表示開始 --}}
    @foreach ($posts as $post)
    <div class="mx-3  md:mx-6 sm:p-8">
      <div class="p-1">
        <div class="bg-white w-full rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-600">
          <div class="">
            <div class="flex w-full place-content-between">
              <div class="flex">
                <div class="rounded-full w-12 h-10 ">
                <img src="{{asset('storage/avatar/'. ($post->user->avatar??'default_user.png'))}}">
                </div>
              {{-- タイトル表示部分をアンカータグとし、遷移先はpost.showルート、リクエストパラメータとして$postを渡す --}}
                <h1 class=" ml-4 text-lg text-gray-700 font-semibold hover:underline cursor-pointer float-left pt-2">
                  <a href="{{route('post.show', $post)}}">{{$post->title}}</a> 
              {{-- パラメータの$postにはpostのid番号が入っている --}}
                </h1>
              </div>
            </div>
            <hr class="w-full">
            {{-- 本文(body)表示部 : 150字以上は...で非表示にする --}}
            <p class="mt-4 text-gray-600 py-4">{{Str::limit($post->body, 150, '...')}}</p>
            @if (!empty($post->url))
            <hr class="w-full">
            <h1 class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer float-left pt-4">URL:<a href="{{$post->url}}" style="color:rgb(86, 160, 160);">{{$post->url}}</a></h1>  
            @endif
            {{-- diffForHumans()メソッド：今の時間から逆算した時間を表示する。対象にアロー演算子をつけ表示形式を変更している--}}
            <div class="text-sm font-semibold flex flex-row-reverse">
              <p>投稿：{{$post->created_at->diffForHumans()}}</p>
            </div>

            <hr class="w-full mb-2 pt-2">
            <span class="tag">{{ $post->category->category_name}}</span>
            <span class="mx-1"></span>
            @if($post->comments->count())
            <span class="badge">返信 {{ $post->comments->count() }}件</span>
            @else
            <span>コメントはまだありません。</span>
            @endif
            <a href="{{route('post.show', $post)}}" style="color:white;">
              <x-button class="float-right bg-teal-600 my-2" >コメントする</x-button>
            </a>
          </div>
        </div>
      </div>
    </div>    
    @endforeach
    @endif
  </div>
</x-app-layout>