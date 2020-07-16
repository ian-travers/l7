@php /** @var App\Entities\NFSUServer\RealServerInfo $serverInfo */ @endphp

<x-frontend-layout :title="__('server.monitor')">
    <div class="container-fluid text-info mt-n3">

        @if($serverInfo->isOnline())
            <div class="d-flex justify-content-start align-items-baseline mb-3">
                <span class="d-flex align-items-center mr-sm-4 mr-md-5 mr-1">
                    <span class="mr-3">
                        {{ __('server.players') }}
                    </span>
                    <span class="d-flex flex-column justify-content-end">
                        <span class="text-right">{{ __('server.online-count', ['count' => $serverInfo->playersCount()]) }}</span>
                        <span class="text-right">{{ __('server.in-races-count', ['count' => $serverInfo->playersInRaces()]) }}</span>
                    </span>
                </span>
                <span class="mr-sm-4 mr-md-5 mr-1">{{ __('server.tj-guard') }}: {!!
                    $serverInfo->isBanCheaters()
                        ? '<span class="badge badge-danger">' . __('server.on') . '</span>'
                        : '<span class="badge badge-success">' . __('server.off') . '</span>'
                !!}</span>
                <span class="mr-5">{{ __('server.own-rooms-guard') }}: {!!
                    $serverInfo->isBanNewRooms()
                        ? '<span class="badge badge-danger">' . __('server.disabled') . '</span>'
                        : '<span class="badge badge-success">' . __('server.enabled') . '</span>'
                 !!}</span>
            </div>

            <div class="h2 text-center ls-4">RANKED GAME</div>
            <div class="row">
                <div class="col-md-3 col-6">
                    <p class="text-center ls-2 h4">Circuit</p>
                    <x-rooms-table :rooms="$serverInfo->roomsCircuitRanked()"/>
                </div>
                <div class="col-md-3 col-6">
                    <p class="text-center ls-2 h4">Sprint</p>
                    <x-rooms-table :rooms="$serverInfo->roomsSprintRanked()"/>
                </div>
                <div class="col-md-3 col-6 clearfix">
                    <p class="text-center ls-2 h4">Drift</p>
                    <x-rooms-table :rooms="$serverInfo->roomsDriftRanked()"/>
                </div>
                <div class="col-md-3 col-6">
                    <p class="text-center ls-2 h4">Drag</p>
                    <x-rooms-table :rooms="$serverInfo->roomsDragRanked()"/>
                </div>
            </div>
            <div class="h2 text-center ls-4 mt-3">UNRANKED GAME</div>
            <div class="row">
                <div class="col-md-3 col-6">
                    <p class="text-center ls-2 h4">Circuit</p>
                    <x-rooms-table :rooms="$serverInfo->roomsCircuitUnranked()"/>
                </div>
                <div class="col-md-3 col-6">
                    <p class="text-center ls-2 h4">Sprint</p>
                    <x-rooms-table :rooms="$serverInfo->roomsSprintUnranked()"/>
                </div>
                <div class="col-md-3 col-6 clearfix">
                    <p class="text-center ls-2 h4">Drift</p>
                    <x-rooms-table :rooms="$serverInfo->roomsDriftUnranked()"/>
                </div>
                <div class="col-md-3 col-6">
                    <p class="text-center ls-2 h4">Drag</p>
                    <x-rooms-table :rooms="$serverInfo->roomsDragUnranked()"/>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <span>
                    <small class="text-secondary"><b>{{ $serverInfo->name() }}</b> (version: {{ $serverInfo->version() }} | platform: {{ $serverInfo->platform() }} | IP: {{ $serverInfo->ip() }})</small></span>
                <span class="text-right">
                    <small class="text-secondary">{{ $serverInfo->onlineTimeForHumans() }}</small>
                </span>
            </div>

        @else
            <div class="text-center">
                <p class="display-4 text-warning">{{ __('server.offline') }}</p>
                <p class="h2">{{ __('server.check-back-later') }}</p>
                <span class="text-secondary">IP: {{ $serverInfo->ip() }}</span>
            </div>

        @endif
    </div>
</x-frontend-layout>



