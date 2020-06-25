<x-frontend-layout :title="config('app.name')">
    <div class="container">

        @guest
            <div class="row">
                <div class="col-md-8 position-relative">
                    <div
                        class="text-light position-absolute"
                        style="top: calc(50% - 6em); height: 12em;"
                    >
                        <div class="display-4 font-weight-bold mb-2">Let's play NFS Underground</div>
                        <p class="h3">
                            The simple way to get online racing. You can play here with your friends and unfamiliar
                            players.</p>
                        <p class="h3">
                            Hey! And if a tourney is scheduled, don't forget to take part in it.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{ route('register') }}">

                                @csrf
                                @include('frontend.partials.register-form')

                                <div class="mb-0 mt-3 text-center">
                                    <button type="submit" class="btn btn-success btn-lg btn-block">
                                        {{ __('auth.register') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        @endguest

        @auth
            <div class="container text-info">
                <h3><b>{{ auth()->user()->nickname }}</b> overall score information</h3>
            </div>
        @endauth
    </div>
</x-frontend-layout>
