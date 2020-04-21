<x-auth-layout :title="__('auth.reset-password') . ':: ' . config('app.name')">
    <div class="row justify-content-center py-3">
        <h2 class="text-center text-light">{{ __('auth.reset-password') }}</h2>
    </div>
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">
                <div class="card-title">{{ __('auth.request-reset-password-intro') }}</div>
            </div>
            <div class="card-body">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="post" action="{{ route('password.email') }}">

                    @csrf

                    <div class="form-group border-bottom pb-3">
                        <label for="email" class="font-weight-bolder">{{ __('auth.email') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="d-flex align-items-end mb-0 mt-3">
                        <button type="submit"
                                class="btn btn-outline-primary btn-lg">{{ __('auth.send-reset-link') }}</button>
                        <button class="ml-auto btn btn-outline-secondary btn-sm" type="button"
                                onclick="window.history.back()">{{ __('misc.cancel') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-auth-layout>
