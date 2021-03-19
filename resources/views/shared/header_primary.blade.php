<header class="fixed w-full bg-white shadow z-40">
    <div class="w-full container mx-auto p-4 h-16 md:h-20 flex items-center justify-between">
        <div class="menu md:hidden" onclick="mobileMenu(event)">
            <svg class="stroke-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16"/></svg>
        </div>
        <div class="text-center md:text-left font-bold text-2xl">
            <a href="/"><img src="/images/logo-lazisnu-kalsel.png" class="h-12"></a>
        </div>
        <div class="search md:hidden">
            <svg class="stroke-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>
        <div id="drawer" class="drawer hidden md:hidden" onclick="mobileMenu(event)"></div>
        <nav id="navigation" class="navigation">
            <ul>
                <div class="mobile-logo"><a href="`/`"><img src="/images/logo-lazisnu-kalsel.png" class="h-12 mx-auto"></a></div>
                <li class="w-full md:w-auto"><a href="{{ route('campaigns.index') }}" class="nav-link {{ Helper::isActive('campaigns') }}">Program</a></li>
                <li class="w-full md:w-auto"><a href="{{ route('posts.index') }}" class="nav-link {{ Helper::isActive('posts') }}">Berita</a></li>
                <li class="w-full md:w-auto"><a href="#" class="nav-link">Tentang</a></li>
                <li class="w-full md:w-auto"><a href="#" class="nav-link">Layanan</a></li>
                <li class="-mt-2 pb-2 md:-my-1 md:pb-0 md:px-2"><span class="inline-block h-px w-full md:h-full md:w-px bg-gray-200"></span></li>
                @guest
                <li class="w-full md:w-auto"><a href="{{ route('login') }}" class="inline-block w-full px-4 py-3 rounded text-center font-bold text-sm uppercase bg-gray-100 md:bg-transparent hover:text-green-400 mb-2 md:mb-0">Masuk</a></li>
                <li class="w-full md:w-auto"><a href="{{ route('register') }}" class="inline-block w-full px-8 py-3 rounded text-center font-bold text-sm uppercase bg-green-500 text-white hover:bg-green-400 md:ml-2">Daftar</a></li>
                @endguest
                @auth
                <li class="w-full md:w-auto"><a href="{{ route('logout') }}" class="inline-block w-full px-8 py-3 rounded text-center font-bold text-sm uppercase bg-green-500 text-white hover:bg-green-400 md:ml-2"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Keluar</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                @endauth
            </ul>
        </nav>
    </div>
</header>