<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          会員一覧
      </h2>
      <x-message :message="session('message')" />
  </x-slot>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="my-6">
          <table class="text-left w-full border-collapse mt-8"> 
              <tr class="bg-green-600">
                  <th class="p-3 text-left text-white">ID</th>
                  <th class="p-3 text-left text-white">名前</th>
                  <th class="p-3 text-left text-white">Email</th>
                  <th class="p-3 text-left text-white">アバター</th>
                  <th class="p-3 text-left text-white">編集</th>
                  <th class="p-3 text-left text-white">削除</th>
              </tr>
              @foreach($users as $user) 
              <tr class="bg-white">
                  <td class="border-gray-light border hover:bg-gray-100 p-3">{{$user->id}}</td>
                  <td class="border-gray-light border hover:bg-gray-100 p-3">{{$user->name}}</td>
                  <td class="border-gray-light border hover:bg-gray-100 p-3">{{$user->email}}</td>
                  <td class="border-gray-light border hover:bg-gray-100 p-3">
                      <div class="rounded-full w-12 h-12 m-auto">
                          <img src="{{asset('storage/avatar/'.($user->avatar??'default_user.png'))}}">
                      </div>
                  </td>
                  <td class="border-gray-light border hover:bg-gray-100 p-3 place-items-center">
                      <a class="inline-block m-auto" href="{{route('profile.edit', $user)}}"><x-button class="bg-teal-700">編集</x-button></a>
                  </td>
                  <td class="border-gray-light border hover:bg-gray-100 p-3 place-items-center">
                      <form action="{{route('profile.delete', $user)}}" method="post" class="inline-block">
                        @csrf
                        @method('delete')
                        <x-button class="bg-red-700" onclick="return confirm('ユーザーを削除します。よろしいですか？')">削除</x-button>
                      </form>
                  </td>
              </tr>
              @endforeach
          </table>
       </div>
  </div>
</x-app-layout>