@php /** @var \App\User $user */ @endphp

<x-frontend-layout :title="__('settings.profile') . ':: ' .config('app.name')">
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
                            <div class="col-md-6">
                                <form action="#">
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
                                        <em><label for="name">{{ __('auth.name') }} ({{ __('misc.optional') }})</label></em>
                                        <input id="name" type="text"
                                               class="form-control @error('name') is-invalid @enderror" name="name"
                                               value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-lg">
                                        {{ __('misc.update') }}
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-frontend-layout>

