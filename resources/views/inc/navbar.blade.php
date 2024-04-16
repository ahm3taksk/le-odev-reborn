<header class="sticky-top navigation">
    <div class="container px-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent px-0">
            <a class="navbar-brand" href="{{ route('index'); }}">
                <img class="img-fluid" src="/image/logo.png">

            </a>
            <button class="navbar-toggler border-0" type="button" data-toggle="collapse"
                data-target="#navigation">
                <i class="ti-align-right h4 text-dark menu"></i>
            </button>
            <div class="collapse navbar-collapse text-center justify-content-end" id="navigation">
                <ul class="navbar-nav align-items-center">
                    <li class="navitem nav-item w-auto text-center navitem">
                        <a class="nav-link active fw-bold text-turkuaz" aria-current="page"
                            href="{{ url('/Le-Odev/') }}">Anasayfa</a>
                    </li>

                    @auth
                    <li class="navitem nav-item w-auto text-center">
                        <a class="nav-link active fw-bold text-turkuaz" aria-current="page"
                        href="{{ route('ask', ['userid' => auth()->id()]) }}">Soru sor</a>
                    </li>
                    @if(auth()->user()->isAdmin())
                    <li class="navitem nav-item w-auto text-center">
                        <a class="nav-link active fw-bold text-turkuaz" aria-current="page"
                            href="{{ url('/Le-Odev/admin/') }}">Admin Paneli</a>
                    </li>
                    @endif
                    <li class="navitem nav-item w-auto text-center float-end">
                        <a class="nav-link active fw-bold text-turkuaz"
                            href="{{ route('index', ['userid' => auth()->id()]) }}">
                            <span class="text-dark text-decoration-none"> Yardıma İhtiyacım Var</span></a>
                    </li>
                    <li class="navitem nav-item w-auto text-center float-end">
                        <a class="nav-link active fw-bold text-turkuaz"
                            href="{{ route('profile.show', ['user' => auth()->user()->username]) }}">
                            <span class="text-dark text-decoration-none"> Profil</span></a>
                    </li>
                    <li class="navitem nav-item w-auto text-center float-end">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="btn gradient-5 fw-bold ml-lg-4" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();">Çıkış Yap</a>
                        </form>
                    </li>
                    @else
                    <li class="navitem nav-item w-auto text-center float-end">
                        <a class="fw-bold ml-lg-4" href="{{ route('login') }}">Giriş Yap</a>
                    </li>
                    <li class="navitem nav-item w-auto text-center float-end">
                        <a class="fw-bold ml-lg-4" href="{{ route('register') }}">Kayıt Ol</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </div>
</header>
