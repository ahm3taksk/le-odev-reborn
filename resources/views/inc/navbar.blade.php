<div class="container">
    <header class="sticky-top navbar">
        <div class="navbarMenu">
            <a class="navbarLogo" href="{{ route('index') }}">
                <img class="img-fluid" src="/image/logo.png">
            </a>
            <div class="navbarMenuCenter">
                <div class="navbarItem">
                    <a aria-current="page" href="{{ route('index') }}">Anasayfa</a>
                </div>
                @auth
                <div class="navbarItem">
                    <a aria-current="page" href="{{ route('ask', ['userid' => auth()->user()->id]) }}">Soru sor</a>
                </div>
                @if(auth()->user()->isAdmin())
                    <div class="navbarItem">
                        <a aria-current="page" href="{{ url('/Le-Odev/admin/') }}">Admin Paneli</a>
                    </div>
                @endif
                <div class="navbarItem">
                    <a aria-current="page" href="{{ route('index') }}">Yardıma İhtiyacım Var</a>
                </div>
            </div>
            <div class="navbarMenuRight">
                    <div class="navbarDropdownBtn">
                        
                        <a href="#">
                            <i class="fa-regular fa-user"></i>  
                            Kullanıcı
                        </a>
                        <div class="navbarDropdown">
                            <div class="navbarDropdownItem">
                                <a aria-current="page" href="{{ route('profile.show', ['user' => auth()->user()->username]) }}">Profil</a>
                            </div>
                            <div class="navbarDropdownItem">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Çıkış Yap</a>
                                </form>
                            </div>
                        </div>
                    </div>
                @else

                    <div class="btnPrimary">
                        <a class="" href="{{ route('login') }}">Giriş Yap</a>
                    </div>
                    <div class="btnSecondary">
                        <a class="" href="{{ route('register') }}">Kayıt Ol</a>
                    </div>  
                </div>
                @endauth
        </div>
    </header>
</div>
