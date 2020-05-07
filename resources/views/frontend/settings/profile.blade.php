@php /** @var \App\User $user */ @endphp

<x-frontend-layout :title="__('settings.profile') . ':: ' . config('app.name')">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <x-settings-menu/>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <h3>{{ __('settings.profile') }}</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-7">
                                <form action="{{ route('settings.profile.update') }}" method="post">

                                    @csrf

                                    <div class="form-group">
                                        <label for="nickname">{{ __('auth.nickname') }}</label>
                                        <input id="nickname" type="text" maxlength="15"
                                               class="form-control @error('nickname') is-invalid @enderror"
                                               name="nickname"
                                               value="{{ old('nickname', $user->nickname) }}" required
                                               autocomplete="nickname" autofocus>

                                        @error('nickname')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <em><label for="name">{{ __('auth.name') }} ({{ __('misc.optional') }})</label></em>
                                        <input id="name" type="text" maxlength="40"
                                               class="form-control @error('name') is-invalid @enderror" name="name"
                                               value="{{ old('name', $user->name) }}" autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="country">{{ __('auth.country') }}</label>
                                        <select-country name="country" locale="{{ $user->locale }}"
                                                        value="{{ old('country', $user->country) }}"></select-country>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-lg">
                                        {{ __('misc.update') }}
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-5">
                                <div class="text-center">

                                    <p>{{ __('auth.avatar') }}</p>

                                    @if($user->avatar_path)
                                        <img src="{{ asset('storage/' . $user->avatar_path) }}" alt="" width="100%">

                                    @else
                                        <p>{{ __('auth.have-not-avatar') }}</p>

                                    @endif

                                    <hr>

                                    <button
                                        type="button"
                                        data-toggle="modal"
                                        data-target="#imageForm"
                                        class="btn btn-light btn-lg mb-2 border"
                                    >
                                        {{ __('auth.upload-new-avatar') }}
                                    </button>
                                    <br>

                                    <form method="post" action="{{ route('settings.profile.no-avatar') }}">

                                        @csrf

                                        <button type="submit" class="btn btn-light btn-sm border">{{ __('auth.without-avatar') }}</button>
                                    </form>


                                    {{-- Modal form--}}
                                    <avatar-form
                                        header_title="{{ __('auth.select-image-for-avatar') }}"
                                        placeholder="{{ __('auth.upload-file') }}"
                                        browse_caption="{{ __('auth.browse') }}"
                                        upload_caption="{{ __('auth.upload-avatar') }}"
                                        no_img_warning_title="{{ __('flash.warning') }}"
                                        no_img_warning_message="{{ __('flash.image-not-selected') }}"
                                    ></avatar-form>
                                    {{-- End Modal--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-frontend-layout>

