<div class="card">
    <div class="card-header text-center">
        {{ __('user.sections') }}
    </div>

    <nav class="nav flex-column">
        <ul class="list-group list-group-flush">
            <li class="list-group-item @if($controller == 'TourneysController') active-vertical-menu @endif">
                <a href="#">{{ __('user.tourneys') }}</a>
            </li>
            <li class="list-group-item @if($controller == 'PostsController') active-vertical-menu @endif">
                <a href="{{ route('user.posts') }}">{{ __('user.posts') }}</a>
            </li>
        </ul>
    </nav>
</div>
