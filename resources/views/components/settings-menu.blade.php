<div class="card">
    <div class="card-header">{{ __('settings.personal-settings') }}</div>
    <ul class="nav flex-column">
        <li class="nav-item border-bottom position-relative">
            <a
                class="nav-link {{ $current == 'settings.profile' ? 'active-vertical-menu' : '' }}"
                href="{{ route('settings.profile') }}"
            >
                {{ __('settings.profile') }}
            </a>
        </li>
        <li class="nav-item border-bottom position-relative">
            <a
                class="nav-link {{ $current == 'settings.account' ? 'active-vertical-menu' : '' }}"
                href="{{ route('settings.account') }}"
            >
                {{ __('settings.account') }}
            </a>
        </li>
        <li class="nav-item position-relative">
            <a
                class="nav-link {{ $current == 'settings.team' ? 'active-vertical-menu' : '' }}"
                href="{{ route('settings.team') }}"
            >
                {{ __('settings.team') }}
            </a>
        </li>
    </ul>
</div>
