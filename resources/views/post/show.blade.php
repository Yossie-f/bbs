{{-- x-app-layoutの部分は、app.blade.phpのレイアウトを使っている。ナビゲーション、ヘッダー、コンテントという３部構成 --}}
<x-app-layout>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      投稿の詳細ページ
    </h2>
    <x-message :message="session('message')"></x-message>
  </x-slot>

  <div class="max-w-7xl mx-auto px-1 sm:px-6 lg:px-8">
    <div class="mx-2 sm:p-4 md:px-8">
      <div class="px-1 pt-1 md:px-8 md:pt-6">
        <div class="bg-white w-full rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500">
          <div class="mt-4">
            <h1 class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer">
              {{ $post->title }}
            </h1>
            <hr class="w-full">
          </div>
          <div class="flex justify-end mt-4">
            @can('update', $post)
             <a href="{{route('post.edit', $post)}}"><x-button class="bg-teal-600 float-right">編集</x-button></a>
            @endcan
            @can('delete', $post)
            <form method="post" action="{{route('post.destroy', $post)}}">
              @csrf
              @method('delete')
              <x-button class="bg-red-700 float-right ml-4" onClick="return confirm('本当に削除しますか？');">削除</x-button>
            </form>
            @endcan
          </div>

          <div>
            <p class="mt-1 md:mt-4 text-gray-600 py-2 md:py-4">{{$post->body}}</p>
            @if($post->image)
              <div class="w-full">
                (画像ファイル:{{$post->image}})
              </div>
              <img src="{{asset('storage/images/'.$post->image)}}" class="mx-auto" style="height:300px;">
            @endif
            <div class="text-sm font-semibold flex flex-row-reverse">
              <p>{{$post->post_name}}・{{$post->created_at->diffForHumans()}}</p>
            </div>
          </div>

          {{-- コメント表示 --}}
            @foreach($post->comments as $comment)
            <div class="bg-white w-full rounded-2xl px-6 py-6 shadow-lg hover:shadow-2xl transition duration-500 mt-6">
              {{$comment->body}}
              <div class="px-3 text-sm font-semibold flex flex-row-reverse">
                <p>{{$comment->comment_name}}・{{$comment->created_at->diffForHumans()}}</p>
              </div>
            </div>
            @endforeach

          {{-- コメント新規作成 --}}
          <div class="mt-8 mb-12">
            <form method="post" action="{{route('comment.store')}}">
              @csrf
              <input type="hidden" name="post_id" value="{{$post->id}}">
              <label for="comment_name"></label>
              <input type="text" name="comment_name" value="{{Auth::user()->name}}" class="w-full rounded-2xl border border-gray-300">
              <textarea name="body" class="bg-white w-full rounded-2xl px-4 mt-4 py-4 border border-gray-300 shadow-lg hover:shadow-2xl transition duration-500" id="body" cols="30" rows="3" placeholder="コメントを入力してください">{{old('body')}}</textarea>
              <x-button class="float-right mt-2 mr-4 mb-12 bg-teal-600 ">コメントする</x-button>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>

</x-app-layout>