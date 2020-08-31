<div class="bg-nfsu-cup border-top border-info px-2 d-flex align-items-baseline">
    <div class="navbar navbar-dark mr-3">
        <div class="navbar-nav">
            <a class="nav-link lead py-0" href="{{ route('page', 'about') }}">{{ __('pages.about') }}</a>
            <a class="nav-link ml-3 py-0" href="{{ route('page', 'about/cup') }}">{{ __('pages.about.cup') }}</a>
            <a class="nav-link ml-3 py-0" href="{{ route('page', 'about/server') }}">{{ __('pages.about.server') }}</a>
            <a class="nav-link ml-3 py-0" href="{{ route('contact.contact-show') }}">{{ __('pages.about.contact') }}</a>
            <a class="nav-link ml-3 py-0" href="{{ route('page', 'about/donate') }}">{{ __('pages.about.donate') }}</a>
        </div>
    </div>

    <div class="navbar navbar-dark mr-3">
        <div class="navbar-nav">
            <a class="nav-link lead py-0" href="{{ route('page', 'help') }}">{{ __('pages.help') }}</a>
            <a class="nav-link ml-3 py-0" href="{{ route('page', 'help/gameplay') }}">{{ __('pages.help.gameplay') }}</a>
            <a class="nav-link ml-3 py-0" href="{{ route('page', 'help/faq') }}">{{ __('pages.help.faq') }}</a>
        </div>
    </div>

    <div class="navbar navbar-dark mr-3">
        <div class="navbar-nav">
            <a class="nav-link lead py-0" href="{{ route('page', 'download') }}">{{ __('pages.downloads') }}</a>
            <a class="nav-link ml-3 py-0" href="{{ route('page', 'download/nfsu') }}">{{ __('pages.downloads.nfsu') }}</a>
            <a class="nav-link ml-3 py-0" href="{{ route('page', 'download/nfsu-client') }}">{{ __('pages.downloads.nfsu-client') }}</a>
            <a class="nav-link ml-3 py-0" href="{{ route('page', 'download/nfsu-save') }}">{{ __('pages.downloads.nfsu-save') }}</a>
            <a class="nav-link ml-3 py-0" href="{{ route('page', 'download/nfsu-save-patcher') }}">{{ __('pages.downloads.nfsu-save-patcher') }}</a>
        </div>
    </div>

    <div class="navbar navbar-dark mr-3">
        <div class="navbar-nav">
            <a class="nav-link lead py-0" href="{{ route('news') }}">{{ __('misc.news') }}</a>
        </div>
    </div>

    <div class="navbar navbar-dark mr-3">
        <div class="navbar-nav">
            <a class="nav-link lead py-0" href="{{ route('blogs') }}">{{ __('misc.blogs') }}</a>
        </div>
    </div>
</div>

