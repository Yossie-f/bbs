<x-guest-layout>

  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 bg-yellow-50 h-screen">
      <div class="mx-4 sm:p-8">
          <h1 class="text-xl text-gray-700 font-semibold hover:underline cursor-pointer">
              お問い合わせ
          </h1>
          <x-auth-validation-errors class="mb-4" :errors="$errors" />
          <x-message :message="session('message')" />

          <form method="post" action="{{route('contact.store')}}" enctype="multipart/form-data">
              @csrf
              <div class="md:flex items-center mt-8">
                <div class="w-full flex flex-col">
                    <label for="name" class="font-semibold leading-none mt-4">お名前</label>
                    <input type="text" name="name" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="name" value="{{old('name')}}" placeholder="お名前を入力してください">
                </div>
            </div>

              <div class="md:flex items-center mt-8">
                  <div class="w-full flex flex-col">
                      <label for="title" class="font-semibold leading-none mt-4">件名</label>
                      <input type="text" name="title" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="title" value="{{old('title')}}" placeholder="件名を入力してください">
                  </div>
              </div>

              <div class="w-full flex flex-col">
                  <label for="text" class="font-semibold leading-none mt-4">お問い合せ内容</label>
                  <textarea name="text" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="text" cols="30" rows="10" placeholder="お問合せ内容を入力してください">{{old('text')}}</textarea>
              </div>

              <div class="md:flex items-center">
                  <div class="w-full flex flex-col">
                      <label for="email" class="font-semibold leading-none mt-4">メールアドレス</label>
                      <input type="text" name="email" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="email" value="{{old('email')}}" placeholder="ご連絡先のメールアドレスを入力してください">
                  </div>
              </div>
              <x-button class=" mt-4 btn-set-gray">
                  送信する
              </x-button>
              
          </form>
      </div>
  </div>
</x-guest-layout>