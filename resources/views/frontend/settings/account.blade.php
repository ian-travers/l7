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
                                        <form method="post">

                                            @csrf
                                            <div class="form-group">
                                                <label for="password">{{ __('auth.new-password') }}</label>
                                                <input id="password" type="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       name="password"
                                                       required>

                                                <span class="invalid-feedback" id="password-error"
                                                      role="alert"><strong id="password-error-message"></strong></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="password-confirm">{{ __('auth.confirm-password') }}</label>
                                                <input id="password-confirm" type="password" class="form-control"
                                                       name="password_confirmation" required>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer d-block">
                                        <div class="text-center">
                                            <button
                                                id="submitChangePasswordForm"
                                                type="button"
                                                class="btn btn-primary"
                                            >{{ __('auth.persist-new-password') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div id="deleteAccountForm" class="modal fade" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('auth.delete-account-form-header') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post">

                                        @csrf
                                        @method('delete')

                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="password-check">{{ __('auth.password-check') }}</label>
                                                <input id="password-check" type="password"
                                                       class="form-control @error('passwordCheck') is-invalid @enderror"
                                                       name="passwordCheck"
                                                       required>

                                                <span class="invalid-feedback" id="password-check-error"
                                                      role="alert"><strong
                                                        id="password-check-error-message"></strong></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="verify-phrase">{{ __('auth.verify-phrase') }}</label>
                                                <input id="verify-phrase" type="text"
                                                       class="form-control @error('verifyPhrase') is-invalid @enderror"
                                                       name="verifyPhrase"
                                                       required>

                                                <span class="invalid-feedback" id="verify-phrase-error"
                                                      role="alert"><strong
                                                        id="verify-phrase-error-message"></strong></span>
                                            </div>

                                        </div>
                                        <div class="modal-footer d-block">
                                            <div class="text-center">
                                                <button
                                                    id="submitDeleteAccountForm"
                                                    type="button"
                                                    class="btn btn-primary"
                                                >{{ __('auth.delete-account') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="card mt-4">
                            <div class="card-header text-white bg-warning">
                                <span class="h3">{{ __('auth.delete-account') }}</span>
                            </div>
                            <div class="card-body">
                                <p>{{ __('auth.delete-account-warning') }}</p>
                                <button
                                    type="button"
                                    data-toggle="modal"
                                    data-target="#deleteAccountForm"
                                    class="btn btn-outline-danger btn-lg w-40"
                                >{{ __('auth.delete-your-account') }}</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('script')
        <script type="text/javascript">
            $('body').on('click', '#submitChangePasswordForm', function () {
                axios.post('/settings/account/password', {
                    password: $('#password').val(),
                    password_confirmation: $('#password-confirm').val()
                })
                    .then(() => {
                        $('#changePasswordForm').modal('hide');
                        iziToast.success({
                            title: "{{ __('flash.success') }}",
                            message: "{{ __('auth.password-changed') }}"
                        });
                    })
                    .catch(error => {
                        if (error.response) {
                            console.log(error.response.data.errors.password[0]);
                            $('#password').addClass('is-invalid');
                            $('#password-error-message').html(error.response.data.errors.password[0]);
                        }
                    });
            })
                .on('click', '#submitDeleteAccountForm', function () {
                    axios.post('/settings/account', {
                        passwordCheck: $('#password-check').val(),
                        verifyPhrase: $('#verify-phrase').val()
                    })
                        .then(() => {
                            iziToast.success({
                                title: "{{ __('flash.success') }}",
                                message: "{{ __('auth.account-deleted') }}"
                            });
                            iziToast.info({
                                title: "{{ __('flash.info') }}",
                                message: "{{ __('flash.redirecting') }}"
                            });
                            setTimeout(function () {
                                window.location = location.origin;
                            }, 3000);
                        })
                        .catch(error => {
                            if (error.response) {
                                console.log(error.response.data.errors);
                                let passwordCheck = $('#password-check');
                                let passwordCheckErrorMessage = $('#password-check-error-message');
                                let verifyPhrase = $('#verify-phrase');
                                let verifyPhraseErrorMessage = $('#verify-phrase-error-message');

                                passwordCheck.removeClass('is-invalid');
                                passwordCheckErrorMessage.html('');
                                verifyPhrase.removeClass('is-invalid');
                                verifyPhraseErrorMessage.html('');

                                if ('passwordCheck' in error.response.data.errors) {
                                    passwordCheck.addClass('is-invalid');
                                    passwordCheckErrorMessage.html(error.response.data.errors.passwordCheck[0]);
                                }

                                if ('verifyPhrase' in error.response.data.errors) {
                                    verifyPhrase.addClass('is-invalid');
                                    verifyPhraseErrorMessage.html(error.response.data.errors.verifyPhrase[0]);
                                }
                            }
                        });
                });
        </script>
    @endsection
</x-frontend-layout>
