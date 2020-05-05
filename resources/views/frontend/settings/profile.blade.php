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
                                        <p>{{ __('You have not an avatar.') }}</p>

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
                                    <a href="#" class="btn btn-light btn-sm border">{{ __('auth.without-avatar') }}</a>

                                    {{-- Modal form--}}
                                    <form method="post" action="{{ route('settings.profile.avatar') }}"
                                          enctype="multipart/form-data">

                                        @csrf
                                        <div id="imageForm" class="modal fade" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">{{ __('auth.select-image-for-avatar') }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <input id="imageFile" type="file" name="avatar" class="file"
                                                               accept="image/*">
                                                        <div class="input-group my-3">
                                                            <input type="text" class="form-control" disabled
                                                                   placeholder="{{ __('auth.upload-file') }}" id="file">
                                                            <div class="input-group-append">
                                                                <button type="button" class="browse btn btn-primary">
                                                                    {{ __('misc.browse') }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <img src="https://placehold.it/80x80" id="preview"
                                                             class="img-thumbnail" alt="">
                                                    </div>
                                                    <div class="modal-footer d-block">
                                                        <div class="text-center">
                                                            <button
                                                                id="ajaxSubmit"
                                                                type="submit"
                                                                class="btn btn-primary"
                                                            >
                                                                {{ __('auth.upload-avatar') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    {{-- End Modal--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('script')
        <script type="text/javascript">
            $(document).on("click", ".browse", function () {
                var file = $(this).parents().find(".file");
                file.trigger("click");
            });
            $('input[type="file"]').change(function (e) {
                var fileName = e.target.files[0].name;
                $("#file").val(fileName);

                var reader = new FileReader();
                reader.onload = function (e) {
                    // get loaded data and render thumbnail.
                    document.getElementById("preview").src = e.target.result;
                };
                // read the image file as a data URL.
                reader.readAsDataURL(this.files[0]);
            });
        </script>
    @endsection
</x-frontend-layout>

