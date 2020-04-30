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
    <label for="email">{{ __('auth.email') }}</label>
    <input id="email" type="email"
           class="form-control @error('email') is-invalid @enderror" name="email"
           value="{{ old('email') }}" required autocomplete="email">

    @error('email')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>

<div class="form-group">
    <label for="country">{{ __('auth.country') }}</label>
    <select-country
        name="country"
        locale="{{ app()->getLocale() }}"
        title="{{ __('misc.select-your-country') }}"
        value="{{ old('country') }}"
    ></select-country>
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


