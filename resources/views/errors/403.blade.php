<x-error-layout :title="__('errors.403-title')">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-6">
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <p class="display-1 text-warning">403</p>
                <div class="lead m-n2 p-3 bg-warning text-light">
                    <span>{{ __('errors.403-message') }}</span>
                </div>
            </div>
        </div>
    </div>
</x-error-layout>
