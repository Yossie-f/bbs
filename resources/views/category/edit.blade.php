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
      <div class="mx-4 sm:p-8">
        <form method="post" action="{{route('category.update', $category)}}" enctype="multipart/form-data">
          @csrf
          @method('patch')
          <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">項目の内容を編集する</h2>
            <h3 class="font-semibold text-base text-gray-600 leading-tight ml-4 pt-1">※編集中の項目：{{$category->category_name}}</h3>
          </div>
          <div class="md:flex items-center ">
            <div class="w-full flex flex-col">
              <label for="category_name" class="font-semibold leading-none mt-4">名前</label>
              <input type="text" name="category_name" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="category_name" placeholder="カテゴリー名を入力" value="{{old('category_name',$category->category_name)}}">
            </div>
          </div>
          
          <div class="w-full flex flex-col">
            <label for="summary" class="font-semibold leading-none mt-4">説明</label>
            <textarea name="summary" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="summary" cols="30" rows="10">{{$category->summary}}</textarea>
          </div>
          
          <x-button class="mt-4 bg-teal-600">
            変更を確定
          </x-button>
          
        </form>
      </div>
    </div>
  </x-app-layout>