<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          プロフィール変更
      </h2>

      <x-auth-validation-errors class="mb-4" :errors="$errors" />
      <x-message :message="session('message')" />

  </x-slot>

  <div class="font-sans text-gray-900 antialiased">
      <div class="w-full md:w-1/2 mx-auto p-6">

      <form method="POST" action="{{ route('profile.update', $user) }}" enctype="multipart/form-data">
          @csrf
          @method('patch')
          <!-- Name -->
          <div>
              <x-label for="name" :value="__('Name')" />

              <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required autofocus />
          </div>

          <!-- Email Address -->
          <div class="mt-4">
              <x-label for="email" :value="__('Email')" />
                  <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required />
          </div>

          <!-- Avatar -->
          <div class="mt-4">
              <x-label for="avatar" :value="__('プロフィール画像（任意・1MBまで）')" />
              <div class="rounded-full w-36">
                  <img src="{{asset('storage/avatar/'.($user->avatar??'default_user.png'))}}">
              </div>

              <x-input id="avatar" class="block mt-1 w-full rounded-none" type="file" name="avatar" :value="old('avatar')" />

          </div>

          <!-- Password -->
          <div class="mt-4">
              <x-label for="password" :value="__('Password')" />

              <x-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="new-password" />
          </div>

          <!-- Confirm Password -->
          <div class="mt-4">
              <x-label for="password_confirmation" :value="__('Confirm Password')" />

              <x-input id="password_confirmation" class="block mt-1 w-full"
                              type="password"
                              name="password_confirmation" required />
          </div>

          <div class="flex items-center justify-end mt-4">
              <x-button class="ml-4">
                  {{ __('送信する') }}
              </x-button>
          </div>
      </form>
      </div>
  </div>
</x-app-layout>
