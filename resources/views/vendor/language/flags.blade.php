@foreach (language()->allowed() as $code => $name)
    <a href="{{ language()->back($code) }}" class="dropdown-item dropdown-nfsu nav-link-nfsu">
        <img src="{{ asset('assets/img/flags/'. language()->country($code) .'.png') }}"
             alt="{{ $name }}"
             width="{{ config('language.flags.width') }}"
        />&nbsp; {{ $name }}
    </a>
@endforeach
