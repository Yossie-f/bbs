<x-guest-layout>
  <div class="h-screen pb-14 bg-right bg-cover">
      <div class="container pt-10 md:pt-18 px-6 mx-auto flex flex-wrap flex-col md:flex-row items-center bg-yellow-50">
          <!--左側-->
          <div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden ">
              <h1 class="my-4 text-3xl md:text-5xl text-blue-400 font-bold leading-tight text-center md:text-left slide-in-bottom-h1">Sneakly</h1>
              <p class="leading-normal text-base md:text-2xl mb-8 text-center md:text-left slide-in-bottom-subtitle">
                  ポリテク滋賀ICT科限定の掲示板サイトです。勉強や就活に関すること、趣味や息抜きに関すること、活発に情報共有して、より良い未来に繋げていきましょう。
              </p>
          
              <p class="text-blue-400 font-bold pb-8 lg:pb-6 text-center md:text-left fade-in">
                  まだ会員登録してない方は登録ボタンから。
              </p>
              <div class="flex w-full justify-center md:justify-start pb-24 lg:pb-0 fade-in ">
                  {{-- x-buttonコンポーネント --}}
                  <a href="{{route('register')}}">
                   <x-button class="btn-set bg-red-700">会員登録</x-button>
                  </a>
                  <a href="{{route('login')}}">
                    <x-button class="btn-set bg-green-600">Myページ</x-button>
                  </a>
                  
                </div>
                <div class="flex justify-center mt-8">
                  <x-button class="btn-set bg-gray-100">お問合せはこちら</x-button>
                </div>
          </div>
          {{-- 右側 --}}
          <div class="w-full xl:w-3/5 py-6 overflow-y-hidden">
              <img class="w-5/6 mx-auto lg:mr-0 slide-in-bottom rounded-lg shadow-xl" src="{{asset('logo/22761504.png')}}">
          </div>
      </div>
      <div class="container pt-10 md:pt-18 px-6 mx-auto flex flex-wrap flex-col md:flex-row items-center">
          <div class="w-full text-sm text-center md:text-left fade-in border-2 p-4 text-red-800 leading-8 mb-8">
              <P> ここは色々いれてください。</p>
          </div>
          <!--フッタ-->
          <div class="w-full pt-10 pb-6 text-sm md:text-left fade-in">
              <p class="text-gray-500 text-center">@2022 このWebサイトは個人が運営する非公式のサイトであり、ポリテクセンター滋賀は運営上一切の関連はありません。</p>
              <p class="text-gray-500 text-center">Sneakly</p>
          </div>
      </div>
  </div>
  </x-guest-layout>