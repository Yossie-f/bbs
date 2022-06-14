<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">投稿の一覧</h2>
    <x-message :message="session('message')"/>
  </x-slot>

  {{-- 投稿一覧表示用のコード --}}
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    @if(count($posts) == 0)
      <p class="mt-4">投稿はまだありません。</p>
    @else
    <p>あなたの投稿は{{count($posts)}}件です</p>
    @foreach ($posts as $post)
      <div class="mx-4 sm:p-8">
        <div class="mt-4">
          <div class="bg-white w-full rounded-2xl px-10 py-12 shadow-lg hover:shadow-2xl transition duration-500">
            <div class="mt-4">
              <div class="text-sm font-semibold flex flex-row-reverse">
                {{-- diffForHumans()メソッド：今の時間から逆算した時間を表示する。対象にアロー演算子をつけ表示形式を変更している--}}
                <p>投稿者：{{$post->user->name}} ・ 投稿名：{{$post->post_name}} ・ 日時：{{$post->created_at->diffForHumans()}}</p>
              </div>
              
              <h1 class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer float-left pt-4">
                {{-- タイトル表示部分をアンカータグとし、遷移先はpost.showルート、リクエストパラメータとして$postを渡す --}}
                <a href="{{route('post.show', $post)}}">{{$post->title}}</a> 
                {{-- パラメータの$postにはpostのid番号が入っている --}}
              </h1>
              <hr class="w-full">
              {{-- 本文(body)表示部 : 100字以上は...で非表示にする --}}
              <p class="mt-4 text-gray-600 py-4">{{Str::limit($post->body, 100, '...')}}</p>
              @if (!empty($post->url))
                <hr class="w-full">
                <h1 class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer float-left pt-4">URL:<a href="{{$post->url}}" style="color:rgb(86, 160, 160);">{{$post->url}}</a></h1>  
              @endif
              
              <hr class="w-full mb-2 pt-8">
              @if($post->comments->count())
                <span class="badge"> 
                  返信 {{ $post->comments->count() }}件
                </span>
              @else
                <span>コメントはまだありません。</span>
              @endif
              <a href="{{route('post.show', $post)}}" style="color:white;">
                <x-button class="float-right" >コメントする</x-button>
              </a>

            </div>
          </div>
        </div>
      </div>    
    @endforeach
    @endif
  </div>
</x-app-layout>