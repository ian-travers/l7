@php /** @var App\Entities\NFSUServer\Ratings $ratings */ @endphp

<x-frontend-layout :title="__('server.ratings')">
    <div class="container-fluid text-info mt-n3">
        <ul class="nav nav-pills" id="ratings">
            <li class="nav-item">
                <a class="nav-link link-text-info active" href="#overall" id="overall-tab" data-toggle="tab" role="tab" aria-controls="overall" aria-selected="true">{{ __('server.overall') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-text-info" href="#circuit" id="circuit-tab" data-toggle="tab" role="tab" aria-controls="circuit" aria-selected="true">{{ __('server.circuit') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-text-info" href="#sprint" id="sprint-tab" data-toggle="tab" role="tab" aria-controls="sprint" aria-selected="true">{{ __('server.sprint') }}</a>
            </li>

            <li class="nav-item">
                <a class="nav-link link-text-info" href="#drag" id="drag-tab" data-toggle="tab" role="tab" aria-controls="drag" aria-selected="true">{{ __('server.drag') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-text-info" href="#drift" id="drift-tab" data-toggle="tab" role="tab" aria-controls="drift" aria-selected="true">{{ __('server.drift') }}</a>
            </li>
        </ul>

        <div class="tab-content" id="ratingsContent">
            <div class="tab-pane fade show active" id="overall" role="tabpanel" aria-labelledby="home-tab">
                <div class="py-2">

                    @include('frontend.server._rating-table', ['players' => $overall])
                </div>
            </div>
            <div class="tab-pane fade" id="circuit" role="tabpanel" aria-labelledby="profile-tab">
                <div class="py-2">

                    @include('frontend.server._rating-table', ['players' => $circuit])
                </div>
            </div>
            <div class="tab-pane fade" id="sprint" role="tabpanel" aria-labelledby="contact-tab"><div class="py-2">

                    @include('frontend.server._rating-table', ['players' => $sprint])
                </div></div>
            <div class="tab-pane fade" id="drag" role="tabpanel" aria-labelledby="contact-tab"><div class="py-2">

                    @include('frontend.server._rating-table', ['players' => $drag])
                </div></div>
            <div class="tab-pane fade" id="drift" role="tabpanel" aria-labelledby="contact-tab"><div class="py-2">

                    @include('frontend.server._rating-table', ['players' => $drift])
                </div></div>
        </div>
    </div>
</x-frontend-layout>



