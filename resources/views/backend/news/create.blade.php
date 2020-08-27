<x-backend-layout :title="__('backend.new-news')">
    <div class="card">
        <div class="card-header">
            <span class="h3 d-block">{{ __('backend.new-news') }}</span>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.news.store') }}" method="post">
                @csrf
                @include('backend.news._form')
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ __('misc.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</x-backend-layout>

