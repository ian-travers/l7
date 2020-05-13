@php /** @var \App\User $user */ @endphp

<x-frontend-layout :title="__('settings.account')">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <x-settings-menu/>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <span class="h2">{{ __('settings.account') }}</span>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header text-light bg-info">
                                <span class="h3">{{ __('auth.email') }}</span>
                            </div>
                            <div class="card-body">
                                <p>{{ __('auth.change-email-message') }}</p>
                                <form action="{{ route('settings.account.email') }}" method="post">

                                    @csrf

                                    <div class="form-group">
                                        <label for="email">{{ __('auth.email') }}</label>
                                        <input
                                            id="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            name="email"
                                            value="{{ old('email', $user->email) }}" required
                                        >

                                        @error('email')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg w-30">{{ __('misc.update') }}</button>
                                </form>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-header text-dark bg-light">
                                <span class="h3">{{ __('auth.password') }}</span>
                            </div>
                            <div class="card-body">
                                <p>{{ __('auth.change-password-message') }}</p>
                                <button
                                    class="btn btn-outline-dark btn-lg w-30">{{ __('auth.change-password') }}</button>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-header text-white bg-warning">
                                <span class="h3">{{ __('auth.delete-account') }}</span>
                            </div>
                            <div class="card-body">
                                <p>{{ __('auth.delete-account-warning') }}</p>
                                <button
                                    class="btn btn-outline-danger btn-lg w-40">{{ __('auth.delete-your-account') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-frontend-layout>
