<x-auth-layout :title="__('auth.register') . ':: ' . config('app.name')">
    <div class="row justify-content-center py-3">
        <h2 class="text-center text-light">{{ __('Join to NFSU Cup') }}</h2>
        <p class="lead text-muted text-center mb-0">{{ __('The simple way to get online') }}</p>
        <p class="lead text-muted text-center mb-0">{{ __('Need for Speed Underground.') }}</p>
    </div>
    <div class="row justify-content-center">
        <div class="card w-100">
            <div class="card-header lead">{{ __('auth.create-account') }}</div>
            <div class="card-body">
                <form method="post" action="{{ route('register') }}">

                    @csrf
                    @include('frontend.partials.register-form')

                    <div class="d-flex align-items-end mb-0 mt-3">
                        <button type="submit" class="btn btn-primary btn-lg">
                            {{ __('auth.register') }}
                        </button>
                        <button class="ml-auto btn btn-secondary btn-sm" type="button"
                                onclick="window.history.back()">{{ __('misc.cancel') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-auth-layout>
