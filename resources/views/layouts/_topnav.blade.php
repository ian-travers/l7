<nav class="navbar navbar-expand-md navbar-dark navbar-nfsu-cup">
    <div class="container">
        <a href="{{ url('/') }}">
            <img class="logo-img rounded-circle" src="/images/logo.png" alt="NFSU Cup">
            <span class="navbar-brand h3">NFSU Cup</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('nav.toggle-nav') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('nav.news') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('nav.tourneys') }}</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown">{{ __('nav.stats') }}</a>
                    <div class="dropdown-menu navbar-nfsu-cup border border-light">
                        <a class="dropdown-item dropdown-nfsu nav-link-nfsu"
                           href="#">{{ __('nav.personal-standings') }}</a>
                        <a class="dropdown-item dropdown-nfsu nav-link-nfsu" href="#">{{ __('nav.clan-standings') }}</a>
                        <a class="dropdown-item dropdown-nfsu nav-link-nfsu"
                           href="#">{{ __('nav.countries-standings') }}</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown">{{ __('nav.game-server') }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu navbar-nfsu-cup border border-light">
                        <a class="dropdown-item dropdown-nfsu nav-link-nfsu" href="#">{{ __('nav.monitor') }}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item dropdown-nfsu nav-link-nfsu"
                           href="#">{{ __('nav.best-performers') }}</a>
                        <a class="dropdown-item dropdown-nfsu nav-link-nfsu" href="#">{{ __('nav.ratings') }}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item dropdown-nfsu nav-link-nfsu" href="#">{{ __('nav.about') }}</a>
                    </div>
                </li>

                @can('admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">{{ __('nav.adm') }}</a>
                    </li>
                @endcan
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('auth.login') }}</a>
                    </li>

                    @if (Route::has('register'))
                        <li class="nav-item border border-light rounded">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('auth.register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                            @if(auth()->user()->hasAvatar())

                                <img src="{{ asset(auth()->user()->avatar_path) }}" class="rounded-circle mr-1" width="30"
                                     height="30">

                            @endif

                            {{ auth()->user()->nickname }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right navbar-nfsu-cup border border-light"
                             aria-labelledby="navbarDropdown">
                            <a class="dropdown-item dropdown-nfsu nav-link-nfsu"
                               href="{{ route('settings.profile') }}">{{ __('auth.settings') }}</a>
                            <a class="dropdown-item dropdown-nfsu nav-link-nfsu" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('auth.logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
                <li class="dropdown navbar-nfsu-cup">
                    <a id="selectLang" class="nav-link" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ language()->flag() }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-nfsu-cup border border-light">
                        {{ language()->flags() }}
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>



