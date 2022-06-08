<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">投稿の一覧</h2>
    <x-message :message="session('message')"/>
  </x-slot>

  {{-- 投稿一覧表示用のコード --}}
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    @foreach ($posts as $post)
      <div class="mx-4 sm:p-8">
        <div class="mt-4">
          <div class="bg-white w-full rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500">
            <div class="mt-4">
              <div class="text-sm font-semibold flex flex-row-reverse">
                {{-- diffForHumans()メソッド：今の時間から逆算した時間を表示する。対象にアロー演算子をつけ表示形式を変更している--}}
                <p>投稿者：{{$post->user->name}} ・ 投稿名：{{$post->post_name}} ・ 日時：{{$post->created_at->diffForHumans()}}</p>
              </div>
              <h1 class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer">{{$post->title}}</h1>
              <hr class="w-full">
              <p class="mt-4 text-gray-600 py-4">{{$post->body}}</p>
              @if (!empty($post->url))
                <hr class="w-full">
                <h1>URL:{{$post->url}}</h1>  
              @endif
            </div>
          </div>
        </div>
      </div>    
    @endforeach
  </div>
</x-app-layout>