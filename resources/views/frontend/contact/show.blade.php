<x-frontend-layout :title="__('pages.about.contact')">
    <div class="container">
        <div class="text-info">
            <p class="text-center h2">{{ __('pages.about.contact') }}</p>
            <p class="lead">{{ __('contact.intro') }}</p>
        </div>
        <div class="card">
            <div class="card-body">
                <form id="contact-form" action="{{ route('contact.contact-send') }}" method="post">

                    @csrf
                    <div class="form-group">
                        <label for="name" class="font-weight-bolder">{{ __('auth.name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email" class="font-weight-bolder">{{ __('contact.email') }}</label>
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}"  autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="subject" class="font-weight-bolder">{{ __('contact.subject') }}</label>
                        <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror"
                               name="subject" value="{{ old('subject') }}"  autocomplete="subject">

                        @error('subject')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="body" class="font-weight-bolder">{{ __('contact.body') }}</label>
                        <textarea id="body" class="form-control @error('body') is-invalid @enderror"
                                  name="body" rows="4" >{{ old('body') }}</textarea>

                        @error('body')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-primary">{{ __('contact.send') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-frontend-layout>



