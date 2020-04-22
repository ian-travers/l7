<x-auth-layout :title="__('auth.login') . ':: ' . config('app.name')">
    <div class="row justify-content-center py-3">
        <h2 class="text-center text-light">{{ __('Login to NFSU Cup') }}</h2>
    </div>
    <div class="row justify-content-center">
        <div class="card w-100">
            <div class="card-body">
                <form method="post" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="font-weight-bolder">{{ __('auth.email') }}</label>
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="font-weight-bolder">{{ __('auth.password') }}</label>
                        @if (Route::has('password.request'))
                            <span class="float-right"><a class="btn-link" href="{{ route('password.request') }}"
                                                         tabindex="9">{{ __('auth.forgot-password-question') }}</a></span>
                        @endif
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror" name="password" required
                               autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group border-bottom pb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember"
                                   id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">{{ __('auth.remember-me') }}</label>
                        </div>
                    </div>
                    <div class="d-flex align-items-end mb-0 mt-3">
                        <button type="submit" class="btn btn-primary btn-lg">{{ __('auth.login') }}</button>
                        <button class="ml-auto btn btn-secondary btn-sm" type="button"
                                onclick="window.history.back()">{{ __('misc.cancel') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row justify-content-center pt-3">
        <div class="card w-100">
            <div class="card-body">
                {{ __('auth.new-question') }}
                <a href="{{ route('register') }}">{{ __('auth.create-account') }}</a>
            </div>
        </div>
    </div>
</x-auth-layout>
