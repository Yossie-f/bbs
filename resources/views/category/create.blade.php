<x-app-layout>  
  {{-- ヘッダースロット --}}
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">カテゴリー</h2>
      {{-- バリデーションによるエラー結果を表示 --}}
      <x-validation-errors class="mb-4" :errors="$errors" />
      {{-- session('')でPostControllerのリダイレクト時にwithメソッドで送られてくる’message’を受け取る --}}
      <x-message :message="session('message')" />
    </x-slot>

    
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      {{-- 現在のカテゴリーリスト --}}
      <div class="mx-4 sm:p-8">
        <div class="flex">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">カテゴリーを編集</h2>
          <h3 class="font-semibold text-sm text-gray-500 leading-tight ml-4 pt-1">※クリックして編集</h3>
        </div>
        <div class="w-full grid grid-cols-6 gap-4 content-center mt-2">
          @foreach($categories as $category)
          <a href="{{route('category.edit', $category)}}" class=" block p-2 bg-indigo-500 hover:bg-indigo-300 rounded-lg text-center text-white hover:text-indigo-500 text-base font-semibold hover:drop-shadow-2xl transition duration-400 ease-in-out">{{$category->category_name}}</a>
          @endforeach
        </div>
      </div>

      <div class="mx-4 sm:p-8">
        <form method="post" action="{{route('category.store')}}" enctype="multipart/form-data">
          @csrf
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">カテゴリーの追加</h2>
          <div class="md:flex items-center ">
            <div class="w-full flex flex-col">
              <label for="category_name" class="font-semibold leading-none mt-4">名前</label>
              <input type="text" name="category_name" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="category_name" placeholder="タイトルを入力" value="{{old('category_name')}}">
            </div>
          </div>
          
          <div class="w-full flex flex-col">
            <label for="summary" class="font-semibold leading-none mt-4">説明</label>
            <textarea name="summary" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="summary" cols="30" rows="10">{{old('summary')}}</textarea>
          </div>
          
          <x-button class="mt-4 bg-teal-600">
            追加する
          </x-button>
          
        </form>
      </div>
    </div>
  </x-app-layout>