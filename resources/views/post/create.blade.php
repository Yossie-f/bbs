<x-app-layout>  

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        投稿の新規作成
    </h2>

    <x-validation-errors class="mb-4" :errors="$errors" />
        
    {{-- session('')でPostControllerのリダイレクト時にwithメソッドで送られてくる’message’を受け取る --}}
    <x-message :message="session('message')" />
    {{-- <x-amessage :message="session('message')" /> --}}
  </x-slot>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mx-4 sm:p-8">
      {{-- フォーム部分 action属性にはルート名を指定する --}}
      <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="md:flex items-center mt-8">
          <div class="w-full flex flex-col">
            <label for="title" class="font-semibold leading-none mt-4">投稿者名</label>
            <input type="text" name="post_name" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="post_name" placeholder="投稿者名を入力" value="{{old('your_name')}}">
          </div>
        </div>

        <div class="md:flex items-center mt-8">
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
        
        <x-button class="mt-4">
          送信する
        </x-button>
        
      </form>
    </div>
  </div>
</x-app-layout>