<div class="card">
    <div class="card-header text-center">
        {{ __('backend.sections') }}
    </div>
    <nav class="nav flex-column">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <a href="#">{{ __('backend.users') }}</a>
            </li>
            <li class="list-group-item @if($controller == 'PostsController') active-vertical-menu @endif">
                <a href="{{ route('admin.posts') }}">{{ __('user.posts') }}</a>
            </li>
            <li class="list-group-item @if($controller == 'QuestionsController') active-vertical-menu @endif">
                <a href="{{ route('admin.tests.questions') }}">{{ __('backend.tests') }}</a>
            </li>
            <li class="list-group-item @if($controller == 'PagesController') active-vertical-menu @endif">
                <a href="{{ route('admin.pages') }}">{{ __('backend.pages') }}</a>
            </li>
        </ul>
    </nav>
</div>
