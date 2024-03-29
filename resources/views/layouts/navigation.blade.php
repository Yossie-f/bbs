<nav x-data="{ open: false }" class=" border-gray-100 brown-c sticky top-0 z-50">

    <!-- Primary Navigation Menu -->

    <div class="w-full mx-auto px-4 pt-2  sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('toppage') }}">
                        <img src="{{asset('logo/22761504.png')}}" style="max-height: 60px;">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('post.index')" :active="request()->routeIs('post.index')" class="text-lg font-semibold">
                        HOME
                    </x-nav-link>
                    <x-nav-link :href="route('post.create')" :active="request()->routeIs('post.create')" class=" text-base font-semibold">
                        投稿する
                    </x-nav-link>
                    <x-nav-link :href="route('post.mypost')" :active="request()->routeIs('post.mypost')" class=" text-base font-semibold">
                        あなたの投稿
                    </x-nav-link>
                    <x-nav-link :href="route('post.mycomment')" :active="request()->routeIs('post.mycomment')" class=" text-base font-semibold">
                        コメントした投稿
                    </x-nav-link>
                    @can('admin')
                        <x-nav-link :href="route('profile.index')" :active="request()->routeIs('profile.index')" class=" text-base font-semibold">
                            会員一覧
                        </x-nav-link>
                    @endcan
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div class="text-white hover:animation-pulse hover:font-semibold">
                                {{-- Aueh::check()は、ログインしていれば true が返る。 Auth::user()->でログインユーザーのカラム情報を取得する。 --}}
                                @if(Auth::check()) {{ Auth::user()->name }}
                                @endif 
                            </div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot> 

                   <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit', auth()->user()->id)">
                            プロフィール変更
                        </x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div> 

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-teal-500 hover:animate-pulse focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-300 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('post.index')" :active="request()->routeIs('post.index')" class=" text-base font-semibold border-b-2">
                HOME
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('post.create')" :active="request()->routeIs('post.create')" class=" text-base font-semibold border-b-2">
                投稿する
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('post.mypost')" :active="request()->routeIs('post.mypost')" class=" text-base font-semibold border-b-2">
                あなたの投稿
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('post.mycomment')" :active="request()->routeIs('post.mycomment')" class=" text-base font-semibold border-b-2">
                コメントした投稿
            </x-responsive-nav-link>
            {{-- ゲート制限admin: ユーザーの
                roleがadminならユーザー一覧を表示させる --}}
            @can('admin')
                <x-responsive-nav-link :href="route('profile.index')" :active="request()->routeIs('profile.index')" class=" text-base font-semibold border-b-2">
                    会員一覧
                </x-responsive-nav-link> 
            @endcan
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                {{-- Aueh::check()は、ログインしていれば true が返る。 Auth::user()->でログインユーザーのカラム情報を取得する。 --}}
                <div class="text-lg font-semibold text-base text-white"> @if(Auth::check()) {{ Auth::user()->name }} @endif </div>
                <div class="text-base  text-white"> @if(Auth::check()){{ Auth::user()->email }} @endif </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link class=" text-base font-semibold border-b-2" :href="route('profile.edit', auth()->user()->id)">
                    プロフィール変更
                </x-responsive-nav-link>
            </div>
            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link class=" text-base font-semibold border-b-2" :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

