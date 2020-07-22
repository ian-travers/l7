@php /** @var App\Entities\NFSUServer\SpecificGameData $sgd */ @endphp

<x-frontend-layout :title="__('server.best-performers')">
    <div class="container-fluid text-info mt-n3">
        <ul class="nav nav-pills" id="pills-best-performers">
            <li class="nav-item dropdown mr-3">
                <a class="nav-link active link-text-info dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="true" aria-expanded="false">{{ __('server.circuit') }}</a>
                <div class="dropdown-menu bg-nfsu-cup border border-light">

                    @foreach($sgd->tracksCircuit() as $trackName)
                        <a class="dropdown-item dropdown-nfsu link-text-info" href="#l-{!! Str::slug($trackName) !!}"
                           data-toggle="tab">{!! $trackName !!}</a>
                    @endforeach
                </div>
            </li>
            <li class="nav-item dropdown mr-3">
                <a class="nav-link link-text-info dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="true" aria-expanded="false">{{ __('server.sprint') }}</a>
                <div class="dropdown-menu bg-nfsu-cup border border-light">

                    @foreach($sgd->tracksSprint() as $trackName)
                        <a class="dropdown-item dropdown-nfsu link-text-info" href="#l-{!! Str::slug($trackName) !!}"
                           data-toggle="tab">{!! $trackName !!}</a>
                    @endforeach
                </div>
            </li>
            <li class="nav-item dropdown mr-3">
                <a class="nav-link link-text-info dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="true" aria-expanded="false">{{ __('server.drag') }}</a>
                <div class="dropdown-menu bg-nfsu-cup border border-light">

                    @foreach($sgd->tracksDrag() as $trackName)
                        <a class="dropdown-item dropdown-nfsu link-text-info" href="#l-{!! Str::slug($trackName) !!}"
                           data-toggle="tab">{!! $trackName !!}</a>
                    @endforeach
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link link-text-info dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="true" aria-expanded="false">{{ __('server.drift') }}</a>
                <div class="dropdown-menu bg-nfsu-cup border border-light">

                    @foreach($sgd->tracksDrift() as $trackName)
                        <a class="dropdown-item dropdown-nfsu link-text-info" href="#l-{!! Str::slug($trackName) !!}"
                           data-toggle="tab">{!! $trackName !!}</a>
                    @endforeach
                </div>
            </li>
        </ul>

        <div class="tab-content" id="pill-best-performersContent">

            @foreach($sgd->tracksAll() as $id => $name)
                <div class="mt-3 tab-pane fade {{ $id == '1001' ? 'show active' : ''}}" id="l-{!! Str::slug($name) !!}">
                    <p class="h1">{!! $name !!}</p>

                    @include('frontend.server._best-by-track', ['trackRating' => $allTracks[$id], 'isDrift' => substr($id, 1, 1) == '3'])
                </div>

            @endforeach
        </div>
    </div>
</x-frontend-layout>

