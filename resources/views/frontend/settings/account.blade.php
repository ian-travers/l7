@php /** @var \App\User $user */ @endphp

<x-frontend-layout :title="__('settings.account') . ':: ' .config('app.name')">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <x-settings-menu />
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <h3>{{ __('settings.account') }}</h3>
                        {{ $user->name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-frontend-layout>
