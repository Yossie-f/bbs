<x-guest-layout>
    <div class="pb-14 bg-red-700 bg-cover w-full">
        <div  class="w-full  pt-10 md:pt-18 px-6 mx-auto flex-wrap flex-col md:flex-row  bg-yellow-50">

            <div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden ">
                <h1 class="my-4 text-3xl md:text-5xl text-blue-400 font-bold leading-tight text-center md:text-left">Sample</h1>
                <p class="leading-normal text-base md:text-2xl mb-8 text-center md:text-left slide-in-bottom-subtitle">会員制の掲示板サイトです</p>
                <p class="text-blue-400 font-bold pb-8 lg:pb-6 text-center md:text-left fade-in">まだ会員登録してない方は登録ボタンから</p>
                <div class="flex w-full justify-center md:justify-start  fade-in ">
                    <a href="{{route('register')}}">
                        <x-button class="btn-set bg-red-600 hover:animate-pulse">会員登録</x-button>
                    </a>
                    <a href="{{route('login')}}">
                        <x-button class="btn-set bg-teal-600 hover:animate-pulse">ログイン</x-button>
                    </a>
                </div>
                <div class="flex w-full justify-center mt-2 md:justify-start pb-24 lg:pb-0 fade-in">
                    <a href="{{route('contact.create')}}">
                        <x-button class="btn-set-gray">お問合せ</x-button>
                    </a>
                </div>
            </div>

          <div class="w-full  py-6 overflow-y-hidden">
              <img class="w-5/6 mx-auto lg:mr-0 slide-in-bottom rounded-lg shadow-xl" src="{{asset('logo/22761504.png')}}">
          </div>
      </div>
      <div class=" pt-10 md:pt-18 px-6 mx-auto flex flex-wrap flex-col md:flex-row items-center">
          <div class="w-full pt-10 pb-6 text-sm md:text-left fade-in">
              <p class="text-gray-500 text-center">@2022 
              <p class="text-gray-500 text-center">掲示板</p>
          </div>
      </div>
  </div>
  </x-guest-layout>