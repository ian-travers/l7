<x-auth-layout :title="__('auth.register') . ':: ' . config('app.name')">
    <div class="row justify-content-center py-3">
        <h2 class="text-center text-light">{{ __('Join to NFSU Cup') }}</h2>
        <p class="lead text-muted text-center">{{ __('The simple way to get online Need for Speed Underground.') }}</p>
    </div>
    <div class="row justify-content-center">
        <div class="card w-100">
            <div class="card-header lead">{{ __('auth.create-account') }}</div>
            <div class="card-body">
                <form method="post" action="{{ route('register') }}">

                    @csrf

                    <div class="form-group">
                        <label for="nickname">{{ __('auth.nickname') }}</label>
                        <input id="nickname" type="text"
                               class="form-control @error('nickname') is-invalid @enderror" name="nickname"
                               value="{{ old('nickname') }}" required autocomplete="nickname" autofocus>

                        @error('nickname')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">{{ __('auth.name') }}</label>
                        <input id="name" type="text"
                               class="form-control @error('name') is-invalid @enderror" name="name"
                               value="{{ old('name') }}" autocomplete="name">

                        @error('name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">{{ __('auth.email') }}</label>
                        <input id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror" name="email"
                               value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('auth.password') }}</label>
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror" name="password"
                               required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">{{ __('auth.confirm-password') }}</label>
                        <input id="password-confirm" type="password" class="form-control"
                               name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="d-flex align-items-end mb-0 mt-3">
                        <button type="submit" class="btn btn-outline-primary btn-lg">
                            {{ __('auth.register') }}
                        </button>
                        <button class="ml-auto btn btn-outline-secondary btn-sm" type="button"
                                onclick="window.history.back()">{{ __('misc.cancel') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-auth-layout>
