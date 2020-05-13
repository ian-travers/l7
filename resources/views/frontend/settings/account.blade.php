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
                                    <button type="submit"
                                            class="btn btn-primary btn-lg w-30">{{ __('misc.update') }}</button>
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
                                    type="button"
                                    data-toggle="modal"
                                    data-target="#changePasswordForm"
                                    class="btn btn-outline-dark btn-lg w-30"
                                >
                                    {{ __('auth.change-password') }}
                                </button>
                            </div>
                        </div>


                        <div id="changePasswordForm" class="modal fade" tabindex="-1" role="dialog">
                            <form method="post" action="{{ route('settings.account.password') }}">

                                @csrf

                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ __('auth.changing-password') }}</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="password">{{ __('auth.new-password') }}</label>
                                                <input id="password" type="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       name="password"
                                                       required>

                                                @error('password')
                                                <span class="invalid-feedback"
                                                      role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="password-confirm">{{ __('auth.confirm-password') }}</label>
                                                <input id="password-confirm" type="password" class="form-control"
                                                       name="password_confirmation" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer d-block">
                                            <div class="text-center">
                                                <button
                                                    type="submit"
                                                    class="btn btn-primary"
                                                >{{ __('auth.persist-new-password') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
