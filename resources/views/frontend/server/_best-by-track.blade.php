@if(empty($trackRating))
    <div class="h3 text-warning">{{ __('server.track-info-empty') }}</div>

@else
    <table class="table table-bordered-info table-sm text-info">
        <thead>
        <tr class="text-center">
            <th class="w-10">{{ __('server.rating') }}</th>
            <th>{{ __('server.player-name') }}</th>
            <th>{{ $isDrift ? __('server.score') : __('server.time') }}</th>
            <th>{{ __('server.car') }}</th>
            <th>{{ __('server.direction') }}</th>
        </tr>
        </thead>
        <tbody>

        @foreach($trackRating as $rating)
            <tr>
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td>{{ $rating['name'] }}</td>
                <td class="text-right">{{ $rating['result_for_humans'] }}</td>
                <td>{{ $rating['car'] }}</td>
                <td>{{ $rating['direction'] }}</td>
            </tr>

        @endforeach
        </tbody>
    </table>

@endif
