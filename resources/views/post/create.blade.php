<x-app-layout>  
{{-- ヘッダースロット --}}
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">投稿の新規作成</h2>
    {{-- バリデーションによるエラー結果を表示 --}}
    <x-validation-errors class="mb-4" :errors="$errors" />
    {{-- session('')でPostControllerのリダイレクト時にwithメソッドで送られてくる’message’を受け取る --}}
    <x-message :message="session('message')" />
    {{-- <x-amessage :message="session('message')" /> --}}
  </x-slot>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mx-4 pb-2 sm:p-8">
      
      {{-- フォーム部分 action属性にはルート名を指定する --}}
      <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="md:flex items-center">
          <div class="w-full flex flex-col">
            <label for="post_name" class="font-semibold leading-none mt-4">投稿者名</label>
            <input type="text" name="post_name" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="post_name" placeholder="投稿者名を入力" value="{{Auth::user()->name}}">
          </div>
        </div>


        {{-- カテゴリー選択セレクトボックス --}}
        <div class="md:flex items-center mt-8 grid grid-cols-8 gap-4 content-start ">
          <div class="flex flex-col col-span-6 ">
            <label for="category_id" class="font-semibold leading-none mt-4">カテゴリー</label>
            <select name="category_id" class="w-auto py-2  border border-gray-300 rounded-md" id="category_id"  required>
              <option value="" hidden>選択してください</option>
              @foreach($categories as $category)
              <option value="{{$category->id}}" label="{{$category->category_name}}・・・{{$category->summary}}"></option>
              @endforeach
            </select>
          </div>

            <x-nav-link :href="route('category.create')"  class="mt-6 text-teal-500 text-base font-semibold">
              追加
            </x-nav-link>

        </div>

        <div class="md:flex items-center ">
          <div class="w-full flex flex-col">
            <label for="title" class="font-semibold leading-none mt-4">件名</label>
            <input type="text" name="title" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="title" placeholder="タイトルを入力" value="{{old('title')}}">
          </div>
        </div>
        
        <div class="w-full flex flex-col">
          <label for="body" class="font-semibold leading-none mt-4">本文</label>
          <textarea name="body" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="body" cols="30" rows="10">{{old('body')}}</textarea>
        </div>
        
        <div class="w-full flex flex-col">
          <label for="image" class="font-semibold leading-none mt-4">画像 </label>
          <div>
            <input id="image" type="file" name="image">
          </div>
        </div>

        <div class="w-full flex flex-col">
          <label for="image" class="font-semibold leading-none mt-4">リンク</label>
          <div>
            <input id="url" type="url" name="url">
          </div>
        </div>
        
        <x-button class="mt-4 mb-12 bg-teal-600">
          送信する
        </x-button>
        
      </form>
    </div>
  </div>
</x-app-layout>