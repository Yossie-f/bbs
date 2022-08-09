<x-app-layout>  
  {{-- ヘッダースロット --}}
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">投稿の編集</h2>
      {{-- バリデーションによるエラー結果を表示 --}}
      <x-validation-errors class="mb-4" :errors="$errors" />
      {{-- session('')でPostControllerのリダイレクト時にwithメソッドで送られてくる’message’を受け取る --}}
      <x-message :message="session('message')" />
      {{-- <x-amessage :message="session('message')" /> --}}
    </x-slot>
  
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mx-4 sm:p-8">
        {{-- フォーム部分 action属性にはルート名を指定する --}}
        <form method="post" action="{{route('post.update', $post)}}" enctype="multipart/form-data">
          @csrf
          @method('patch')
          <div class="md:flex items-center">
            <div class="w-full flex flex-col">
              <label for="post_name" class="font-semibold leading-none mt-4">投稿者名</label>
              <input type="text" name="post_name" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="post_name" placeholder="投稿者名を入力" value="{{old('post_name', $post->post_name)}}">
            </div>
          </div>

          <div class="md:flex items-center sm:mt-4 grid grid-cols-8 gap-4 content-start ">
            <div class="flex flex-col col-span-6 ">
              <label for="category_id" class="font-semibold leading-none mt-4">カテゴリー</label>
              <select name="category_id" class="w-auto py-2  border border-gray-300 rounded-md" id="category_id"  required>
                @foreach($categories as $category)
                @if($post->category_id == $category->id)
                <option value="{{$category->id}}" label="{{$category->category_name}}・・・{{$category->summary}}" selected></option>
                @else
                <option value="{{$category->id}}" label="{{$category->category_name}}・・・{{$category->summary}}"></option>
                @endif
                @endforeach
              </select>
            </div>
            <x-nav-link :href="route('category.create')"  class="mt-6 text-teal-500 text-base font-semibold">
              追加
            </x-nav-link>
          </div>
  
          <div class="md:flex items-center mt-8">
            <div class="w-full flex flex-col">
              <label for="title" class="font-semibold leading-none sm:mt-4">件名</label>
              <input type="text" name="title" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="title" placeholder="タイトルを入力" value="{{old('title', $post->title)}}">
            </div>
          </div>
          
          <div class="w-full flex flex-col">
            <label for="body" class="font-semibold leading-none mt-4">本文</label>
            <textarea name="body" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="body" cols="30" rows="10">{{old('body', $post->body)}}</textarea>
          </div>
          
          <div class="w-full flex flex-col">
            @if($post->image)
              <div>
                (画像ファイル:{{$post->image}})
              </div>
              <img src="{{asset('storage/images/'.$post->image)}}" class="mx-auto" style="height:200px;">
            @endif
            <label for="image" class="font-semibold leading-none mt-4">画像 </label>
            <div>
              <input id="image" type="file" name="image">
            </div>
          </div>
  
          <div class="w-full flex flex-col">
            <label for="image" class="font-semibold leading-none mt-4 ">リンク</label>
            <div >
              <input class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="url" type="url" name="url" value="{{old('url', $post->url)}}" placeholder="URLを入力">
            </div>
          </div>
          
          <x-button class="mt-4 mb-12 bg-teal-600">
            変更を保存
          </x-button>
          
        </form>
      </div>
    </div>
  </x-app-layout>