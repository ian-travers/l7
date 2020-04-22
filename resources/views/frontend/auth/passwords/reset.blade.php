<x-auth-layout :title="__('auth.reset-password') . ':: ' . config('app.name')">
    <div class="row justify-content-center py-3">
        <h2 class="text-light">{{ __('auth.reset-password') }}</h2>
    </div>
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">
                <div class="card-title">{{ __('auth.resetting-password-intro') }}</div>
            </div>

            <div class="card-body">
                <form method="post" action="{{ route('password.update') }}">

                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <label for="email" class="font-weight-bolder">{{ __('auth.email') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                               autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="font-weight-bolder">{{ __('auth.password') }}</label>
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror" name="password"
                               required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group pb-3 border-bottom">
                        <label for="password-confirm"
                               class="font-weight-bolder">{{ __('auth.confirm-password') }}</label>
                        <input id="password-confirm" type="password" class="form-control"
                               name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="form-group mb-0 mt-3">
                        <button type="submit" class="btn btn-primary btn-lg">
                            {{ __('auth.reset-password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-auth-layout>
