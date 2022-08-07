<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight ">投稿の一覧</h2>
    <x-message :message="session('message')"/>
  </x-slot>

  {{-- カテゴリ一覧 --}}
  <div class="sm:flex sm:items-center sm:ml-6">
    <x-dropdown align="left" width="96" z="0">
        <x-slot name="trigger">
            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                <div class="ml-12 text-lg text-white hover:text-gray-700 hover:animation-pulse hover:font-semibold ">
                    {{-- Aueh::check()は、ログインしていれば true が返る。 Auth::user()->でログインユーザーのカラム情報を取得する。 --}}
                    <h1>Filter by Category</h1>
                </div>
                {{--マーク--}}
                <div class="ml-1">
                    <svg class="animate-bounce fill-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot> 
        {{-- カテゴリーのリスト --}}
        <x-slot name="content" >
          <div class="grid grid-cols-8 gap-1 z-0 ">
            @foreach($categories as $category)
            <div class="m-2 bg-indigo-500 col-start-2 col-span-6 rounded-lg">
              <x-dropdown-link :href="route('post.category', $category)" class="text-center text-white hover:text-indigo-500 text-base font-semibold">
                {{$category->category_name}}
              </x-dropdown-link>
            </div>
            @endforeach
          </div>
        </x-slot>
    </x-dropdown>
  </div> 
  
  
  {{-- 投稿一覧表示用のコード --}}
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    @foreach ($posts as $post)
      <div class="mx-6 sm:p-8">
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
                    <a href="{{route('post.show', $post)}}">{{ $post->title }}</a>
                  </h1>
                </div>
              </div> 
            </div>
            <hr class="w-full">
            {{-- 本文(body)表示部 : 150字以上は...で非表示にする --}}
            <p class="mt-4 text-gray-600 py-4">{{Str::limit($post->body, 150, '...')}}</p>      
                     
            @if (!empty($post->url))
              <h1 class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer float-left pt-4">URL:<a href="{{$post->url}}" style="color:rgb(86, 160, 160);">{{$post->url}}</a></h1>  
            @endif
            {{-- diffForHumans()メソッド：今の時間から逆算した時間を表示する。対象にアロー演算子をつけ表示形式を変更している--}}
            <div class="text-sm font-semibold flex flex-row-reverse">
              <p>投稿：{{$post->created_at->diffForHumans()}}</p>
            </div>
            
            <hr class="w-full mb-2 pt-2">
            <span class="tag"> 
              {{ $post->category->category_name}}
            </span>
            <span class="mx-1"></span>
            @if($post->comments->count())
              <span class="badge"> 
                返信 {{ $post->comments->count() }}件
              </span>
            @else
              <span>コメントはまだありません。</span>
            @endif
            <a href="{{route('post.show', $post)}}" style="color:white;">
              <x-button class="float-right bg-teal-600" >コメントする</x-button>
            </a>
          </div>
        </div>
      </div> 
    @endforeach
  </div>
</x-app-layout>